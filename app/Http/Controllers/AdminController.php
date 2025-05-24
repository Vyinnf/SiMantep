<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\PendaftaranPKL;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MahasiswaExport;
use PDF;

class AdminController extends Controller
{
    public function storeDosen(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:dosens,email',
        'password' => 'required|min:6',
    ]);

    \App\Models\Dosen::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => \Hash::make($request->password),
    ]);

    return redirect()->route('admin.dosen.create')->with('success', 'Akun dosen berhasil ditambahkan!');
}

public function indexMahasiswa()
{
    $mahasiswa = Mahasiswa::all();
    return view('admin.mahasiswa.index', compact('mahasiswa'));
}

public function showMahasiswa($id)
{
    $mahasiswa = Mahasiswa::findOrFail($id);
    return view('admin.mahasiswa.show', compact('mahasiswa'));
}

// public function editMahasiswa($id)
// {
//     $mahasiswa = Mahasiswa::findOrFail($id);
//     return view('admin.mahasiswa.edit', compact('mahasiswa'));
// }

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
        $mahasiswa->password = \Hash::make($request->password);
    }
    $mahasiswa->save();

    return redirect()->route('admin.mahasiswa.index')->with('success', 'Data mahasiswa berhasil diupdate.');
}

public function destroyMahasiswa($id)
{
    $mahasiswa = Mahasiswa::findOrFail($id);
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
    return view('admin.pendaftaran.index', compact('pendaftaran'));
}

public function verifikasiPendaftaran($id)
{
    $pendaftaran = PendaftaranPKL::findOrFail($id);
    $pendaftaran->status = 'verified';
    $pendaftaran->save();
    return redirect()->route('admin.pendaftaran.index')->with('success', 'Pendaftaran berhasil diverifikasi.');
}

public function tolakPendaftaran($id)
{
    $pendaftaran = PendaftaranPKL::findOrFail($id);
    $pendaftaran->status = 'rejected';
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
}
