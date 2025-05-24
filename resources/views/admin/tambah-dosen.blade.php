<!-- filepath: c:\laragon\www\Project Sistem PKL\laravel\resources\views\admin\tambah-dosen.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun Dosen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title mb-4 text-center">Tambah Akun Dosen</h4>
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $err)
                                        <li>{{ $err }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('admin.dosen.store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Dosen</label>
                                <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Dosen</label>
                                <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Tambah Dosen</button>
                        </form>
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-link mt-3 w-100">Kembali ke Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
