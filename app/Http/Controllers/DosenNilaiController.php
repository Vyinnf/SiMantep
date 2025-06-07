<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa; // Pastikan model ini sesuai
use App\Models\Laporan; // Pastikan model ini sesuai

class DosenNilaiController extends Controller
{
    public function index()
    {
        // Ambil mahasiswa yang sudah selesai magang dan siap dinilai
        $mahasiswa = Laporan::where('status', 'diterima')->with('mahasiswa')->get();
        return view('dosen.nilai', compact('mahasiswa'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
        ]);
        // dd($id);

        $mahasiswa = Laporan::findOrFail($id);
        $mahasiswa->nilai = $request->nilai;
        $mahasiswa->save();

        return redirect()->route('dosen.nilai')->with('success', 'Nilai berhasil diupload.');
    }
}
