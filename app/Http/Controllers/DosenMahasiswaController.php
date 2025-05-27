<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa; // Pastikan model ini sesuai

class DosenMahasiswaController extends Controller
{
    public function index()
    {
        // Ambil mahasiswa yang sedang magang (misal status = 'magang')
        $mahasiswa = Mahasiswa::where('status', 'magang')->with('user')->get();
        return view('dosen.mahasiswa', compact('mahasiswa'));
    }
}
