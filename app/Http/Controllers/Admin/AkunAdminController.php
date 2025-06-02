<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin; // <<< GANTI KE MODEL ADMIN
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password as PasswordRules;
use Illuminate\Support\Facades\Auth; // Tetap gunakan Auth, tapi pastikan guard-nya benar

class AkunAdminController extends Controller
{
    // Peran yang bisa dikelola dalam fitur ini (diasumsikan ada kolom 'role' di tabel 'admins')
    protected $manageableAdminRoles = ['superadmin', 'admin'];

    // Guard yang digunakan untuk admin, ganti jika berbeda (mis. 'web' jika admin login via guard default)
    protected $adminGuard = 'admin'; // Sesuaikan dengan nama guard admin Anda di config/auth.php

    public function index(Request $request)
    {
        $query = Admin::query(); // <<< GUNAKAN MODEL ADMIN

        // Jangan tampilkan akun admin yang sedang login
        if (Auth::guard($this->adminGuard)->check()) {
            $query->where('id', '!=', Auth::guard($this->adminGuard)->id());
        }

        // Filter berdasarkan peran jika kolom 'role' ada dan digunakan
        // $query->whereIn('role', $this->manageableAdminRoles);


        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $adminAccounts = $query->orderBy('name')->paginate(10);
        return view('admin.akun_admin.index', compact('adminAccounts'));
    }

    public function create()
    {
        // Otorisasi: Hanya superadmin yang boleh membuat akun baru
        if (Auth::guard($this->adminGuard)->user()->role !== 'superadmin') {
            return redirect()->route('admin.akun.index')->with('error', 'Hanya superadmin yang dapat menambah akun admin baru.');
        }
        return view('admin.akun_admin.create', ['roles' => $this->manageableAdminRoles]);
    }

    public function store(Request $request)
    {
        if (Auth::guard($this->adminGuard)->user()->role !== 'superadmin') {
            abort(403, 'Operasi tidak diizinkan.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email'], // Validasi ke tabel 'admins'
            'password' => ['required', 'confirmed', PasswordRules::min(8)->mixedCase()->numbers()->symbols()],
            'role' => ['required', Rule::in($this->manageableAdminRoles)], // Validasi role
        ]);

        Admin::create([ // <<< GUNAKAN MODEL ADMIN
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role, // Simpan role
        ]);

        return redirect()->route('admin.akun.index')->with('success', 'Akun admin baru berhasil ditambahkan.');
    }

    // Parameter di sini harus $admin (nama variabel) dan tipenya Admin
    public function edit(Admin $admin)
    {
        // Pastikan user yang diedit adalah salah satu dari peran yang bisa dikelola (jika ada role)
        // if (!in_array($admin->role, $this->manageableAdminRoles)) {
        //     return redirect()->route('admin.akun.index')->with('error', 'Akun yang diminta tidak valid.');
        // }

        // Superadmin tidak bisa diedit oleh admin biasa
        if ($admin->role === 'superadmin' && Auth::guard($this->adminGuard)->user()->role !== 'superadmin') {
            return redirect()->route('admin.akun.index')->with('error', 'Anda tidak memiliki hak akses untuk mengedit akun superadmin.');
        }
        return view('admin.akun_admin.edit', ['user' => $admin, 'roles' => $this->manageableAdminRoles]);
    }

    public function update(Request $request, Admin $admin)
    {
        // if (!in_array($admin->role, $this->manageableAdminRoles)) { ... }
        if ($admin->role === 'superadmin' && Auth::guard($this->adminGuard)->user()->role !== 'superadmin') {
             abort(403, 'Hanya Superadmin yang dapat mengubah akun superadmin lain.');
        }
        // Superadmin tidak bisa mengubah role dirinya sendiri menjadi lebih rendah
        if ($admin->id === Auth::guard($this->adminGuard)->id() && $admin->role === 'superadmin' && $request->role !== 'superadmin') {
            return back()->withErrors(['role' => 'Superadmin tidak dapat menurunkan peran diri sendiri.'])->withInput();
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('admins')->ignore($admin->id)], // Validasi ke tabel 'admins'
            'password' => ['nullable', 'confirmed', PasswordRules::min(8)->mixedCase()->numbers()->symbols()],
            'role' => ['required', Rule::in($this->manageableAdminRoles)], // Validasi role
        ]);

        $admin->name = $request->name;
        $admin->email = $request->email;

        // Logika agar role superadmin tidak bisa diubah sembarangan
        if (Auth::guard($this->adminGuard)->user()->role === 'superadmin') {
            // Hanya superadmin yang bisa mengubah role, termasuk dirinya sendiri jika tidak menurunkan dari superadmin
             if ($admin->id !== Auth::guard($this->adminGuard)->id() || $request->role === 'superadmin') {
                 $admin->role = $request->role;
             }
        } elseif ($admin->role !== 'superadmin') { // Admin biasa bisa mengubah role admin biasa lainnya
            $admin->role = $request->role;
        }


        if ($request->filled('password')) {
            $admin->password = Hash::make($request->password);
        }
        $admin->save();

        return redirect()->route('admin.akun.index')->with('success', 'Akun admin berhasil diperbarui.');
    }

    public function destroy(Admin $admin)
    {
        if ($admin->id === Auth::guard($this->adminGuard)->id()) {
            return redirect()->route('admin.akun.index')->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Logika untuk mencegah penghapusan superadmin terakhir atau oleh non-superadmin
        if ($admin->role === 'superadmin') {
             if (Auth::guard($this->adminGuard)->user()->role !== 'superadmin' || Admin::where('role', 'superadmin')->count() <= 1) {
                return redirect()->route('admin.akun.index')->with('error', 'Akun superadmin tidak dapat dihapus atau minimal harus ada satu superadmin.');
             }
        }

        $admin->delete();
        return redirect()->route('admin.akun.index')->with('success', 'Akun admin berhasil dihapus.');
    }
}
