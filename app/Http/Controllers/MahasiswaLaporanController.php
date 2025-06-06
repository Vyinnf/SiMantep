<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Laporan;
use Illuminate\Support\Facades\Storage;

class MahasiswaLaporanController extends Controller
{
    // Tampilkan halaman upload laporan beserta data laporan terakhir
    public function create()
    {
        $user = Auth::user();
        $laporanMagang = Laporan::where('mahasiswa_id', $user->mahasiswa->id ?? null)
            ->latest()
            ->first();

        return view('mahasiswa.laporan', compact('laporanMagang'));
    }

    // Proses upload atau update laporan
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'laporan' => 'required|file|mimes:pdf|max:5120',
            'judul_laporan' => 'required|string|max:255',
        ]);

        $mahasiswaId = $user->mahasiswa->id ?? null;
        if (!$mahasiswaId) {
            return redirect()->route('mahasiswa.laporan')->with('upload_error', 'Data mahasiswa tidak ditemukan.');
        }

        $laporanLama = Laporan::where('mahasiswa_id', $mahasiswaId)->latest()->first();

        $path = $request->file('laporan')->store('laporan_magang', 'public');

        if ($laporanLama) {
            // Hapus file lama jika ada
            if ($laporanLama->file && Storage::disk('public')->exists($laporanLama->file)) {
                Storage::disk('public')->delete($laporanLama->file);
            }

            $laporanLama->update([
                'judul' => $request->judul_laporan,
                'file' => $path,
                'status' => 'menunggu koreksi',
                'komentar' => null,
            ]);
        } else {
            Laporan::create([
                'mahasiswa_id' => $mahasiswaId,
                'judul' => $request->judul_laporan,
                'file' => $path,
                'status' => 'diajukan',
            ]);
        }

        return redirect()->route('mahasiswa.laporan')->with('upload_success', 'Laporan berhasil diupload.');
    }

    public function riwayat()
    {
        $userId = auth()->id(); // ID user login
        $laporan = \App\Models\Laporan::with('mahasiswa')
            ->whereHas('mahasiswa', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->orderByDesc('updated_at')
            ->get();

        return view('mahasiswa.riwayat', compact('laporan'));
    }
}
