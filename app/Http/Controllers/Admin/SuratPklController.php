<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SuratPkl;
use App\Models\User;
use App\Models\Instansi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class SuratPklController extends Controller
{
    public function index()
    {
        $daftarSurat = SuratPkl::with(['mahasiswa', 'instansi'])->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.surat_pkl.index', compact('daftarSurat'));
    }

    public function create()
    {
        $mahasiswas = User::where('role', 'mahasiswa')->orderBy('name')->get(); // Asumsi ada kolom 'role'
        $instansis = Instansi::orderBy('nama_instansi')->get();
        return view('admin.suratpkl.create', compact('mahasiswas', 'instansis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'instansi_id' => 'required|exists:instansis,id',
            'tanggal_mulai_pkl' => 'required|date',
            'tanggal_selesai_pkl' => 'required|date|after_or_equal:tanggal_mulai_pkl',
            'judul_pkl' => 'nullable|string|max:255',
            'nomor_surat' => 'nullable|string|max:100|unique:surat_pkls,nomor_surat',
        ]);

        $suratPkl = new SuratPkl();
        $suratPkl->user_id = $request->user_id;
        $suratPkl->instansi_id = $request->instansi_id;
        $suratPkl-> tanggal_mulai_pkl = $request->tanggal_mulai_pkl;
        $suratPkl->tanggal_selesai_pkl = $request->tanggal_selesai_pkl;
        $suratPkl->judul_pkl = $request->judul_pkl;
        $suratPkl->nomor_surat = $request->nomor_surat;
        $suratPkl->status_surat = 'diproses';
        $suratPkl->tanggal_disetujui_atau_dibuat = now();

        // Placeholder: Logika untuk generate file surat (misalnya PDF) dan simpan path-nya
        // $filePath = $this->generateSuratFile($suratPkl); // Anda perlu membuat method ini
        // $suratPkl->file_surat_path = $filePath;
        // $suratPkl->status_surat = 'selesai_dibuat'; // Update status jika langsung jadi

        $suratPkl->save();

        return redirect()->route('admin.surat.pkl.index')->with('success', 'Data Surat PKL berhasil ditambahkan.');
    }

    public function show(SuratPkl $suratPkl)
    {
        $suratPkl->load(['mahasiswa', 'instansi', 'adminPemroses']);
        return view('admin.surat_pkl.show', compact('suratPkl'));
    }

    public function edit(SuratPkl $suratPkl)
    {
        $mahasiswas = User::orderBy('name')->get();
        $instansis = Instansi::orderBy('nama_instansi')->get();
        return view('admin.surat_pkl.edit', compact('suratPkl', 'mahasiswas', 'instansis'));
    }

    public function update(Request $request, SuratPkl $suratPkl)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'instansi_id' => 'required|exists:instansis,id',
            'tanggal_mulai_pkl' => 'required|date',
            'tanggal_selesai_pkl' => 'required|date|after_or_equal:tanggal_mulai_pkl',
            'judul_pkl' => 'nullable|string|max:255',
            'nomor_surat' => 'nullable|string|max:100|unique:surat_pkls,nomor_surat,' . $suratPkl->id,
            'status_surat' => 'required|in:diajukan,diproses,selesai_dibuat',
            'catatan_admin' => 'nullable|string|max:1000',
            'file_surat' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // Max 5MB
        ]);

        $suratPkl->fill($request->except('file_surat'));

        if ($request->hasFile('file_surat')) {
            if ($suratPkl->file_surat_path && Storage::disk('public')->exists($suratPkl->file_surat_path)) {
                Storage::disk('public')->delete($suratPkl->file_surat_path);
            }
            $filePath = $request->file('file_surat')->store('surat_pkl_files', 'public');
            $suratPkl->file_surat_path = $filePath;
        }

        if($request->status_surat === 'selesai_dibuat' && is_null($suratPkl->tanggal_disetujui_atau_dibuat)){
            $suratPkl->tanggal_disetujui_atau_dibuat = now();
        }

        $suratPkl->save();

        return redirect()->route('admin.surat.pkl.index')->with('success', 'Data Surat PKL berhasil diperbarui.');
    }

    public function destroy(SuratPkl $suratPkl)
    {
        if ($suratPkl->file_surat_path && Storage::disk('public')->exists($suratPkl->file_surat_path)) {
            Storage::disk('public')->delete($suratPkl->file_surat_path);
        }
        $suratPkl->delete();
        return redirect()->route('admin.surat.pkl.index')->with('success', 'Data Surat PKL berhasil dihapus.');
    }

    public function download(SuratPkl $suratPkl)
    {
        if ($suratPkl->file_surat_path && Storage::disk('public')->exists($suratPkl->file_surat_path)) {
            return Storage::disk('public')->download($suratPkl->file_surat_path);
        }
        return redirect()->back()->with('error', 'File surat tidak ditemukan atau tidak dapat diakses.');
    }
}
