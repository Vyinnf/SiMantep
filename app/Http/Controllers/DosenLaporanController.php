<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Laporan; // Pastikan model ini sesuai

class DosenLaporanController extends Controller
{
    public function index()
    {
        // Ambil laporan yang perlu dikoreksi (misal status = 'diajukan')
        $laporan = Laporan::where('status', 'diajukan')->with('mahasiswa.user')->get();
        return view('dosen.laporan', compact('laporan'));
    }

    public function show($id)
    {
        $laporan = Laporan::with('mahasiswa.user')->findOrFail($id);
        return view('dosen.laporan-detail', compact('laporan'));
    }

    public function revisi(Request $request, $id)
    {
        $request->validate(['komentar' => 'required|string|max:255']);
        $laporan = Laporan::findOrFail($id);
        $laporan->status = 'revisi';
        $laporan->komentar = $request->komentar;
        $laporan->save();
        return redirect()->route('dosen.laporan')->with('success', 'Komentar revisi berhasil dikirim.');
    }

    public function terima($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->status = 'diterima';
        $laporan->komentar = null;
        $laporan->save();
        return redirect()->route('dosen.laporan')->with('success', 'Laporan diterima.');
    }
}
