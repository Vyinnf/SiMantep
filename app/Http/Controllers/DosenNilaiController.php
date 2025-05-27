<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa; // Pastikan model ini sesuai

class DosenNilaiController extends Controller
{
    public function index()
    {
        // Ambil mahasiswa yang sudah selesai magang dan siap dinilai
        $mahasiswa = Mahasiswa::where('status', 'selesai')->with('user')->get();
        return view('dosen.nilai', compact('mahasiswa'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'nilai' => 'required|numeric|min:0|max:100',
        ]);

        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->nilai = $request->nilai;
        $mahasiswa->save();

        return redirect()->route('dosen.nilai')->with('success', 'Nilai berhasil diupload.');
    }
}
