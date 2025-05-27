<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PendaftaranPKL; // Pastikan model ini sesuai dengan tabel pendaftaran PKL

class DosenVerifikasiController extends Controller
{
    public function index()
    {
        // Ambil data pendaftaran PKL yang perlu diverifikasi
        $pendaftaran = PendaftaranPKL::where('status', 'menunggu')->get();

        return view('dosen.verifikasi', compact('pendaftaran'));
    }

    public function update(Request $request, $id)
    {
        $pendaftaran = \App\Models\PendaftaranPKL::findOrFail($id);

        // Validasi status
        $request->validate([
            'status' => 'required|in:diterima,ditolak',
        ]);

        $pendaftaran->status = $request->status;
        $pendaftaran->save();

        return redirect()->route('dosen.verifikasi')->with('success', 'Status pendaftaran berhasil diperbarui.');
    }
}
