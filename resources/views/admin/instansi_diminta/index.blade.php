@extends('layouts.admin')

@section('title', 'Daftar Instansi Yang Diminta')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="mdi mdi-check-circle-outline alert-icon"></i>
            <span>{{ session('success') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="mdi mdi-alert-circle-outline alert-icon"></i>
            <span>{{ session('error') }}</span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="page-header-container mb-4">
        <h2 class="page-title mb-0">Instansi Yang Diminta</h2>
        {{-- Tidak ada tombol "Tambah" karena ini adalah review pengajuan --}}
    </div>

    <div class="card shadow-sm border-0 data-table-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table data-table table-hover table-striped table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5%;">No</th>
                            <th>Nama Instansi</th>
                            <th>Alamat</th>
                            <th>Kontak</th>
                            <th>Diajukan Oleh</th>
                            <th style="width: 10%; text-align:center;">Status</th>
                            <th style="width: 25%; text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pengajuanInstansis as $pengajuan)
                        <tr>
                            <td class="text-center">{{ $loop->iteration + $pengajuanInstansis->firstItem() - 1 }}</td>
                            <td>{{ $pengajuan->nama_instansi }}</td>
                            <td>{{ Str::limit($pengajuan->alamat_instansi, 50) }}</td>
                            <td>{{ $pengajuan->kontak_instansi }}</td>
                            <td>{{ $pengajuan->user->name ?? 'N/A' }} <small class="text-muted d-block">{{$pengajuan->user->mahasiswa->nim ?? ''}}</small></td>
                            <td class="text-center">
                                @if($pengajuan->status == 'pending')
                                    <span class="badge bg-warning text-dark">{{ Str::ucfirst($pengajuan->status) }}</span>
                                @elseif($pengajuan->status == 'approved')
                                    <span class="badge bg-success">{{ Str::ucfirst($pengajuan->status) }}</span>
                                @elseif($pengajuan->status == 'rejected')
                                    <span class="badge bg-danger">{{ Str::ucfirst($pengajuan->status) }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($pengajuan->status == 'pending')
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#approveModal{{ $pengajuan->id }}" title="Setujui">
                                        <i class="mdi mdi-check-bold"></i> Setujui
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $pengajuan->id }}" title="Tolak">
                                        <i class="mdi mdi-close-thick"></i> Tolak
                                    </button>
                                @else
                                    <span class="text-muted fst-italic">Sudah diproses</span>
                                @endif
                                <form action="{{ route('admin.instansi.diminta.destroy', $pengajuan->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus pengajuan ini secara permanen? Tindakan ini tidak dapat diurungkan.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-dark btn-sm" title="Hapus Pengajuan">
                                        <i class="mdi mdi-delete-outline"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center data-empty-message">
                                Tidak ada data pengajuan instansi saat ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($pengajuanInstansis->hasPages())
                <div class="mt-3">
                    {{ $pengajuanInstansis->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- Modal untuk Approve dan Reject --}}
    @foreach ($pengajuanInstansis as $pengajuan)
        @if($pengajuan->status == 'pending')
            {{-- Approve Modal --}}
            <div class="modal fade" id="approveModal{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="approveModalLabel{{ $pengajuan->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('admin.instansi.diminta.approve', $pengajuan->id) }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="approveModalLabel{{ $pengajuan->id }}">Setujui Pengajuan Instansi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Anda akan menyetujui instansi: <strong>{{ $pengajuan->nama_instansi }}</strong>.</p>
                                <p>Instansi ini akan ditambahkan ke daftar utama jika belum ada.</p>
                                <div class="mb-3">
                                    <label for="catatan_admin_approve_{{ $pengajuan->id }}" class="form-label">Catatan (Opsional):</label>
                                    <textarea class="form-control" id="catatan_admin_approve_{{ $pengajuan->id }}" name="catatan_admin" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-success"><i class="mdi mdi-check-bold"></i> Ya, Setujui</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Reject Modal --}}
            <div class="modal fade" id="rejectModal{{ $pengajuan->id }}" tabindex="-1" aria-labelledby="rejectModalLabel{{ $pengajuan->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="{{ route('admin.instansi.diminta.reject', $pengajuan->id) }}" method="POST">
                        @csrf
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="rejectModalLabel{{ $pengajuan->id }}">Tolak Pengajuan Instansi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Anda akan menolak instansi: <strong>{{ $pengajuan->nama_instansi }}</strong>.</p>
                                <div class="mb-3">
                                    <label for="catatan_admin_reject_{{ $pengajuan->id }}" class="form-label">Alasan Penolakan (Wajib Diisi):</label>
                                    <textarea class="form-control" id="catatan_admin_reject_{{ $pengajuan->id }}" name="catatan_admin" rows="3" required minlength="5"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-danger"><i class="mdi mdi-close-thick"></i> Ya, Tolak</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @endforeach

@endsection
