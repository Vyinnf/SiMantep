<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Reset Password</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('assets/css/forgot-password.css') }}">
</head>
<body>
  <div class="reset-container">
    <form method="POST" action="{{ route('password.email') }}">
    @csrf
    <input type="email" name="email" required placeholder="Masukkan email Anda">
    <button type="submit">Kirim Link Reset</button>
</form>
  </div>
</body>
</html>
