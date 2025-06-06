<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran;

class DosenVerifikasiController extends Controller
{
    public function index()
    {
        // Ambil data pendaftaran PKL yang perlu diverifikasi
        $pendaftaran = Pendaftaran::where('status', 'menunggu')->get();

        return view('dosen.verifikasi', compact('pendaftaran'));
    }

    public function update(Request $request, $id)
    {
        $pendaftaran = \App\Models\Pendaftaran::findOrFail($id);

        // Validasi status
        $request->validate([
            'nim' => 'required|string|max:20',
            'prodi' => 'required|string|max:100',
            'semester' => 'required|integer|min:1|max:14',
            'alamat_mahasiswa' => 'required|string',
            'no_hp' => 'required|string|max:15',
            'instansi_id' => 'required',
            'nama_instansi_manual' => 'nullable|required_if:instansi_id,other|string|max:255',
            'alamat_instansi_manual' => 'nullable|required_if:instansi_id,other|string',
            'judul_pkl' => 'required|string|max:255',
            'status' => 'required|in:,pending,diterima,ditolak',
        ]);

        $pendaftaran->status = $request->status;
        $pendaftaran->save();

        return redirect()->route('dosen.verifikasi')->with('success', 'Status pendaftaran berhasil diperbarui.');
    }
}
