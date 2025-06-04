<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\PengajuanInstansi;
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

        $mahasiswa = Auth::user()->id;
        $excitingPendaftaran = Pendaftaran::where('user_id', $mahasiswa)->whereIn('status', ['pending', 'diterima'])->first();
        if ($excitingPendaftaran) {
            return redirect()->back()->with('error', 'Anda sudah memiliki pendaftaran PKL yang masih aktif.');
        }

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

        $mahasiswa = auth()->user()->mahasiswa;
        if (!$mahasiswa) {
            return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan. Harap lengkapi profil terlebih dahulu.');
        }

        $mahasiswa->update([
            'nim' => $request->nim,
            'prodi' => $request->prodi,
            'semester' => $request->semester,
            'alamat' => $request->alamat_mahasiswa,
            'no_hp' => $request->no_hp,
        ]);

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

        Pendaftaran::create([
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

        $pendaftaran = Pendaftaran::where('user_id', auth()->id())->latest()->first();

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Pendaftaran PKL berhasil dikirim.');
    }

    public function dashboard()
    {

        $mahasiswa = auth()->user()->mahasiswa;
        $pendaftaran = Pendaftaran::with('dosen')->where('user_id', auth()->id())->latest()->first();
        return view('mahasiswa.dashboard', compact('mahasiswa', 'pendaftaran'));
    }

    public function index()
    {
        $pendaftaran = Pendaftaran::with('mahasiswa')->latest()->get();
        $dosens = Dosen::all();
        return view('admin.pendaftaran.index', compact('pendaftaran'));
    }

    public function verifikasi($id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->update(['status' => 'diterima']);

        return redirect()->back()->with('success', 'Pendaftaran berhasil diverifikasi.');
    }

    public function assignDosen(Request $request, $id)
    {
        $request->validate([
            'dosen_id' => 'required|exists:dosens,id',
        ]);

        $pendaftaran = Pendaftaran::findOrFail($id);
        $pendaftaran->dosen_id = $request->dosen_id;
        $pendaftaran->save();

        return redirect()->back()->with('success', 'Dosen pembimbing berhasil ditugaskan.');
    }
}
