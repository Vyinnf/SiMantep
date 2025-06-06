{{-- filepath: resources/views/dosen/mahasiswa.blade.php --}}
@extends('layouts.dosen')
@section('title', 'Monitoring Mahasiswa Magang')

@section('content')
    <div class="container py-4">
        <h3 class="mb-4">Monitoring Mahasiswa Magang</h3>
        @if ($pendaftaran ->isEmpty())
        <div class="alert alert-info">Tidak ada mahasiswa yang sedang magang.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Semester</th>
                            <th>Judul PKL</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pendaftaran as $item)
                            @php
                                $user = $item->user;
                                $mhs = $user->mahasiswa ?? null;
                            @endphp
                            @if ($mhs)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name ?? '-' }}</td>
                                    <td>{{ $mhs->nim ?? '-' }}</td>
                                    <td>{{ $mhs->semester ?? '-' }}</td>
                                    <td>{{ $item->judul_pkl ?? '-' }}</td>
                                    <td><span class="badge bg-success">{{ ucfirst($item->status) }}</span></td>
                                </tr>
                            @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
