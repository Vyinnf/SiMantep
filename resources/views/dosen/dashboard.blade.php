<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Dosen</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2>Selamat Datang di Dashboard Dosen</h2>
        <p>Ini adalah halaman dashboard khusus untuk dosen.</p>
        <a href="{{ route('dosen.logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="btn btn-danger mt-3">Logout</a>
        <form id="logout-form" action="{{ route('dosen.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</body>
</html>
