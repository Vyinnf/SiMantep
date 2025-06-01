<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
</head>

<body>
    <div class="login-container">
        <div class="login-card">
            <div class="card-highlight"></div>
            <div class="text-center mb-4">
                <h3 class="login-title">Admin Panel Login</h3>
            </div>

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <div class="input-field-group mb-4">
                    <label for="email" class="input-label">
                        <i class="fas fa-envelope"></i>Email
                    </label>
                    <input type="email" name="email" id="email" class="form-control" required autofocus
                        placeholder=" ">
                </div>

                <div class="input-field-group mb-5"> <label for="password" class="input-label">
                        <i class="fas fa-lock"></i>Password
                    </label>
                    <input type="password" name="password" id="password" class="form-control" required placeholder=" ">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg login-button">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </button>
                </div>
            </form>
            <div class="mt-4 pt-2 text-center"> <small class="text-muted">Pastikan kredensial Anda aman.</small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/login-glow.js') }}"></script>
</body>

</html>
