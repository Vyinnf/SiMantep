@extends('layouts.admin')

@section('title', 'Manajemen Surat PKL')

@section('content')
    {{-- Alert global sudah ada di layouts/admin.blade.php --}}

    <div class="page-header-container mb-4">
        <h2 class="page-title mb-0">Manajemen Surat PKL</h2>
        <div class="action-bar ms-auto">
            <a href="{{ route('admin.surat.pkl.create') }}" class="btn btn-primary">
                <i class="mdi mdi-plus-circle-outline"></i> Buat Pengajuan Surat Baru
            </a>
        </div>
    </div>

    <div class="card shadow-sm border-0 data-table-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table data-table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No.</th>
                            <th>No. Surat</th>
                            <th>Nama Mahasiswa</th>
                            <th>NIM</th>
                            <th>Instansi Tujuan</th>
                            <th>Tgl Mulai - Selesai</th>
                            <th style="width: 10%; text-align:center;">Status</th>
                            <th style="width: 20%; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($daftarSurat as $surat)
                        <tr>
                            <td class="text-center">{{ $loop->iteration + $daftarSurat->firstItem() - 1 }}</td>
                            <td>{{ $surat->nomor_surat ?? '-' }}</td>
                            <td>{{ $surat->mahasiswa->name ?? 'N/A' }}</td>
                            <td>{{ $surat->mahasiswa->mahasiswa->nim ?? ($surat->mahasiswa->nim ?? '-') }}</td> {{-- Sesuaikan dengan struktur model User/Mahasiswa Anda --}}
                            <td>{{ $surat->instansi->nama_instansi ?? 'N/A' }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($surat->tanggal_mulai_pkl)->isoFormat('D MMM YYYY') }}
                                -
                                {{ \Carbon\Carbon::parse($surat->tanggal_selesai_pkl)->isoFormat('D MMM YYYY') }}
                            </td>
                            <td class="text-center">
                                @if($surat->status_surat == 'selesai_dibuat')
                                    <span class="badge bg-success">{{ Str::ucfirst(str_replace('_', ' ', $surat->status_surat)) }}</span>
                                @elseif($surat->status_surat == 'diproses')
                                    <span class="badge bg-info text-dark">{{ Str::ucfirst($surat->status_surat) }}</span>
                                @elseif($surat->status_surat == 'diajukan')
                                    <span class="badge bg-warning text-dark">{{ Str::ucfirst($surat->status_surat) }}</span>
                                @elseif($surat->status_surat == 'ditolak')
                                    <span class="badge bg-danger">{{ Str::ucfirst($surat->status_surat) }}</span>
                                @else
                                    <span class="badge bg-secondary">{{ Str::ucfirst(str_replace('_', ' ', $surat->status_surat)) }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.surat.pkl.edit', $surat->id) }}" class="btn btn-info btn-sm" title="Edit/Proses Surat">
                                    <i class="mdi mdi-pencil-box-outline"></i> Proses
                                </a>
                                @if($surat->file_surat_path)
                                <a href="{{ route('admin.surat.pkl.download', $surat->id) }}" class="btn btn-primary btn-sm" title="Download Surat">
                                    <i class="mdi mdi-download-outline"></i> Download
                                </a>
                                @endif
                                <form action="{{ route('admin.surat.pkl.destroy', $surat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data surat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" title="Hapus">
                                        <i class="mdi mdi-delete-outline"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center data-empty-message"> {{-- Sesuaikan colspan --}}
                                Belum ada data pengajuan surat PKL.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($daftarSurat->hasPages())
                <div class="mt-4 d-flex justify-content-center">
                    {{ $daftarSurat->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
