<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class DosenMahasiswaController extends Controller
{
    public function index()
    {
        $dosenId = auth()->id();
        $pendaftaran = Pendaftaran::with(['user.mahasiswa'])
            ->where('status', 'diterima')
            ->where('dosen_id', $dosenId)
            ->get();

        return view('dosen.mahasiswa', compact('pendaftaran'));
    }
}
