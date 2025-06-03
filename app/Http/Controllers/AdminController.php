<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\PendaftaranPKL;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MahasiswaExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function storeDosen(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:dosens,email',
        'password' => 'required|min:6',
        'nip' => 'required|digits:18',
    ]);

    \App\Models\Dosen::create([
        'name' => $request->name,
        'email' => $request->email,
        'nip' => $request->nip,
        'gender' =>$request->gender,
        'password' => Hash::make($request->password),
    ]);

    return redirect()->route('admin.dosen.create')->with('success', 'Akun dosen berhasil ditambahkan!');
}

public function indexMahasiswa()
{
    $mahasiswa = Mahasiswa::with('user')->get();
    return view('admin.mahasiswa.index', compact('mahasiswa'));
}

public function showMahasiswa($id)
{
    $mahasiswa = Mahasiswa::findOrFail($id);
    return view('admin.mahasiswa.show', compact('mahasiswa'));
}

public function updateMahasiswa(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:mahasiswas,email,'.$id,
        'password' => 'nullable|min:6',
    ]);

    $mahasiswa = Mahasiswa::findOrFail($id);
    $mahasiswa->name = $request->name;
    $mahasiswa->email = $request->email;
    if ($request->filled('password')) {
        $mahasiswa->password = Hash::make($request->password);
    }
    $mahasiswa->save();

    return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil diupdate.');
}

public function destroyMahasiswa($id)
{
    $mahasiswa = Mahasiswa::findOrFail($id);
    if ($mahasiswa->user) {
        $mahasiswa->user->delete();
    }
    $mahasiswa->delete();
    return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus.');
}

public function indexDosen()
{
    $dosen = Dosen::all();
    return view('admin.dosen.index', compact('dosen'));
}

public function indexPendaftaran()
{
    $pendaftaran = PendaftaranPKL::with('mahasiswa')->orderBy('created_at', 'desc')->get();
    $dosens = Dosen::all(); // Ambil semua dosen untuk dropdown
    return view('admin.pendaftaran.index', compact('pendaftaran', 'dosens'));
}

public function verifikasiPendaftaran($id)
{
    $pendaftaran = PendaftaranPKL::findOrFail($id);
    $pendaftaran->status = 'diterima';
    $pendaftaran->save();
    return redirect()->route('admin.pendaftaran.index')->with('success', 'Pendaftaran berhasil diverifikasi.');
}

public function tolakPendaftaran($id)
{
    $pendaftaran = PendaftaranPKL::findOrFail($id);
    $pendaftaran->status = 'ditolak';
    $pendaftaran->save();
    return redirect()->route('admin.pendaftaran.index')->with('success', 'Pendaftaran berhasil ditolak.');
}

public function exportMahasiswa(Request $request)
{
    $type = $request->query('type');
    if ($type == 'excel') {
        return Excel::download(new MahasiswaExport, 'mahasiswa.xlsx');
    } elseif ($type == 'pdf') {
        $mahasiswa = \App\Models\Mahasiswa::all();
        $pdf = PDF::loadView('admin.mahasiswa.export-pdf', compact('mahasiswa'));
        return $pdf->download('mahasiswa.pdf');
    }
    return redirect()->back();
}

public function dashboardCustom() {
    $totalMahasiswa = \App\Models\Mahasiswa::count();
    $totalDosen = \App\Models\Dosen::count();
    $totalPendaftaran = \App\Models\PendaftaranPKL::count();
    $totalNotifikasi = 0; // Ganti sesuai kebutuhan

    return view('admin.dashboard-custom', compact(
        'totalMahasiswa', 'totalDosen', 'totalPendaftaran', 'totalNotifikasi'
    ));
}
}
