@extends('mahasiswa.side')
@section('title', 'Riwayat Laporan Magang')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Riwayat Pengumpulan Laporan</h3>
    @if($laporan->isEmpty())
        <div class="alert alert-info">Belum ada laporan yang diunggah.</div>
    @else
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>File</th>
                    <th>Status</th>
                    <th>Komentar</th>
                    <th>Diunggah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($laporan as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <a href="{{ asset('storage/laporan/' . $item->file) }}" target="_blank">
                            {{ $item->file }}
                        </a>
                    </td>
                    <td>
                        <span class="badge
                            @if($item->status == 'diterima') bg-success
                            @elseif($item->status == 'revisi') bg-danger
                            @else bg-warning text-dark
                            @endif
                        ">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td>{{ $item->komentar ?? '-' }}</td>
                    <td>{{ $item->updated_at->format('d M Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection
