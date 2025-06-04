<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendaftaran; // Pastikan model ini sesuai dengan tabel pendaftaran PKL

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
            'status' => 'required|in:,pending,diterima,ditolak',
        ]);

        $pendaftaran->status = $request->status;
        $pendaftaran->save();

        return redirect()->route('dosen.verifikasi')->with('success', 'Status pendaftaran berhasil diperbarui.');
    }
}
