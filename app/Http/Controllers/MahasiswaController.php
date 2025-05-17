<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;

class MahasiswaController extends Controller
{
    public function updateProfil(Request $request)
    {
        $request->validate([
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:20',
            'semester' => 'required|integer',
            'prodi' => 'required|string',
            'ttl' => 'required|string',
            'alamat' => 'required|string',
        ]);

        // Misal mahasiswa adalah user yang sedang login
        $user = Auth::user();

        // Asumsikan user punya relasi ke model Mahasiswa
        $mahasiswa = Mahasiswa::firstOrNew(['user_id' => $user->id]);

        $mahasiswa->nama = $request->nama;
        $mahasiswa->nim = $request->nim;
        $mahasiswa->semester = $request->semester;
        $mahasiswa->prodi = $request->prodi;
        $mahasiswa->ttl = $request->ttl;
        $mahasiswa->alamat = $request->alamat;

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFile = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/foto'), $namaFile);
            $mahasiswa->foto = $namaFile;
        }

        $mahasiswa->user_id = $user->id;
        $mahasiswa->save();

        return back()->with('success', 'Data diri berhasil diperbarui.');
    }

    public function editProfil()
{
    $user = auth()->user();

    // Coba cari entri Mahasiswa berdasarkan user_id
    $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

    // Kalau tidak ditemukan, tapi sudah ada dengan email sama, perbaiki user_id-nya
    if (!$mahasiswa) {
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();

        if ($mahasiswa) {
            // Perbaiki user_id agar relasi jalan
            $mahasiswa->user_id = $user->id;
            $mahasiswa->save();
        } else {
            // Benar-benar tidak ada, buat baru
            $mahasiswa = Mahasiswa::create([
                'user_id' => $user->id,
                'nama' => 'Nama Belum Diisi',
                'nim' => '-',
                'semester' => 1,
                'prodi' => '-',
                'ttl' => '-',
                'alamat' => '-',
                'email' => $user->email ?? 'email@kosong.com'
            ]);
        }
    }

    return view('mahasiswa.edit', compact('mahasiswa'));
}

}
