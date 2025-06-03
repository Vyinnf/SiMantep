@extends('layouts.admin')

@section('title', 'Daftar Pendaftaran PKL')

@section('content')
    <div class="container"> {{-- Anda bisa tetap menggunakan container ini di dalam content --}}
        <h2>Daftar Pendaftaran PKL Mahasiswa</h2>

        {{-- @if (session('success'))
            <div class="alert alert-success global-alert alert-dismissible fade show">
                <i class="mdi mdi-check-circle-outline alert-icon"></i>
                <span>{{ session('success') }}</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif --}}

        {{-- Mungkin perlu card atau panel di sekitar tabel untuk konsistensi dengan dashboard --}}
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <table class="table table-bordered table-hover table-striped"> {{-- Tambahkan class sesuai kebutuhan --}}
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Prodi</th>
                            <th>Tanggal Daftar</th>
                            <th>Judul PKL</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendaftaran as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nim ?? '-' }}</td>
                                <td>{{ $item->mahasiswa->name ?? '-' }}</td>
                                <td>{{ $item->prodi ?? '-' }}</td>
                                <td>{{ $item->judul_pkl ?? '-' }}</td>
                                <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                <td>
                                    @if ($item->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span> {{-- text-dark agar terbaca di bg-warning --}}
                                    @elseif($item->status == 'diterima')
                                        <span class="badge bg-success">Terverifikasi</span>
                                    @elseif($item->status == 'ditolak')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($item->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($item->status == 'pending')
                                        <form action="{{ route('admin.pendaftaran.verifikasi', $item->id) }}" method="POST"
                                            style="display:inline-block; margin-bottom: 0.25rem;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">
                                                <i class="mdi mdi-check"></i> Verifikasi
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.pendaftaran.tolak', $item->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="mdi mdi-cancel"></i> Tolak
                                            </button>
                                        </form>
                                    @elseif($item->status == 'diterima')
                                        {{-- Form Assign Dosen --}}
                                        <form action="{{ route('admin.pendaftaran.assignDosen', $item->id) }}"
                                            method="POST" class="d-flex" style="gap: 4px;">
                                            @csrf
                                            <select name="dosen_id" class="form-select form-select-sm" required>
                                                <option value="">Pilih Dosen</option>
                                                @foreach ($dosens as $dosen)
                                                    <option value="{{ $dosen->id }}"
                                                        {{ $item->dosen_id == $dosen->id ? 'selected' : ''}}>
                                                        {{ $dosen->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-sm">
                                                <i class="mdi mdi-account-check"></i> Simpan
                                            </button>
                                        </form>
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada pendaftaran PKL.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
