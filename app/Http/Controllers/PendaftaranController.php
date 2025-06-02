<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanInstansi;
use App\Models\PendaftaranPKL;
use App\Models\Pendaftaran;
use App\Models\Instansi;
use App\Models\Dosen;
use App\Models\Admin;
use App\Notifications\PendaftaranBaruNotification;
use Illuminate\Support\Facades\Notification;

class PendaftaranController extends Controller
{
    public function create()
    {
        $instansiList = Instansi::all();
        $mahasiswa = auth()->user()->mahasiswa;

        return view('mahasiswa.pendaftaran', compact('instansiList', 'mahasiswa'));
    }

    public function store(Request $request)
    {
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
        ]);

        // dd($request->all());

        // Update data Mahasiswa jika ada
        $mahasiswa = auth()->user()->mahasiswa;
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan. Harap lengkapi profil terlebih dahulu.');
        }

        // Update data mahasiswa
        $mahasiswa->update([
            'nim' => $request->nim,
            'prodi' => $request->prodi,
            'semester' => $request->semester,
            'alamat' => $request->alamat_mahasiswa,
            'no_hp' => $request->no_hp,
        ]);

        // Proses instansi
        if ($request->instansi_id === 'other') {
            $pengajuanInstansi = PengajuanInstansi::create([
                'nama_instansi' => $request->nama_instansi_manual,
                'alamat' => $request->alamat_instansi_manual,
                'kontak_instansi' => $request->no_hp,
                'user_id' => auth()->id(),
                'status' => 'pending',
            ]);

            $instansiId = null;
            $alamatInstansi = $request->alamat_instansi_manual;

        } else {
            $instansi = Instansi::find($request->instansi_id);
            $instansiId = $instansi ? $instansi->id : null;
            $alamatInstansi = $instansi ? $instansi->alamat : null;
        }

        // Buat data pendaftaran dan simpan ke variable $pendaftaran

        // dd($alamatInstansi);
        PendaftaranPKL::create([
            'user_id' => auth()->id(),
            'instansi_id' => $instansiId,
            'nim' => $request->nim,
            'prodi' => $request->prodi,
            'semester' => $request->semester,
            'alamat_mahasiswa' => $request->alamat_mahasiswa,
            'no_hp' => $request->no_hp,
            'alamat_instansi' => $alamatInstansi,
            'judul_pkl' => $request->judul_pkl,
            'status' => 'pending',
        ]);

        // Kirim notifikasi ke dosen dan admin
        // $dosens = Dosen::all();
        // $admins = Admin::all();

        // \Log::info('Mengirim notifikasi', [
        //     'mahasiswa_nama' => $pendaftaran->mahasiswa->nama ?? 'null',
        //     'instansi_nama' => $pendaftaran->instansi->nama ?? ($pendaftaran->instansi_manual ?? 'null'),
        // ]);

        // Notification::send($dosens, new PendaftaranBaruNotification($pendaftaran));
        // Notification::send($admins, new PendaftaranBaruNotification($pendaftaran));

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Pendaftaran PKL berhasil dikirim.');
    }
    public function dashboard()
    {
        // Ambil data mahasiswa yang login
        $mahasiswa = auth()->user()->mahasiswa;

        // Ambil pendaftaran terbaru atau semua pendaftaran milik user
        $pendaftaran = PendaftaranPKL::where('user_id', auth()->id())
            ->latest()
            ->first();

        return view('mahasiswa.dashboard', compact('mahasiswa', 'pendaftaran'));
    }
    public function index()
    {
        $pendaftaran = PendaftaranPKL::with('mahasiswa')->latest()->get(); // Relasi mahasiswa wajib di-load

        return view('admin.pendaftaran.index', compact('pendaftaran'));
    }
    public function verifikasi($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update(['status' => 'diterima']); // pakai tanda kutip

        return redirect()->back()->with('success', 'Pendaftaran berhasil diverifikasi.');
    }
}
