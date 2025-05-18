<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Mahasiswa</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login-style.css') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="container" id="container">
        <!-- Sign Up Form -->
        <div class="form-container sign-up-container">
            <form method="POST" action="{{ route('mahasiswa.register') }}">
                @csrf
                <h1>Create Account</h1>
                <input type="text" placeholder="Name" name="nama" required />
                <input type="email" placeholder="Email" name="email" required />
                <input type="password" placeholder="Password" name="password" required />
                <input type="password" placeholder="Confirm Password" name="password_confirmation" required />
                <button type="submit">Sign Up</button>
                {{-- back button --}}
                <div class="back-button">
                    <div class="circle-wrapper" onclick="window.location='{{ url('/') }}'">
                        <button class="circle-button" type="button">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24">
                                    <path fill="black"
                                        d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" />
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
                {{-- end back buttton --}}
            </form>
        </div>

        <!-- Sign In Form -->
        <div class="form-container sign-in-container">
            <form method="POST" action="{{ route('mahasiswa.login') }}">
                @csrf
                <h1>Sign in</h1>
                <input type="email" placeholder="Email" name="email" required />
                <input type="password" placeholder="Password" name="password" required />
                <a href="{{ route('password.request') }}" class="forgot-password-link">Forgot your password?</a>
                <button type="submit">Sign In</button>

                {{-- back button --}}
                <div class="back-button">
                    <div class="circle-wrapper" onclick="window.location='{{ url('/') }}'">
                        <button class="circle-button" type="button">
                            <span class="icon">
                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24">
                                    <path fill="black"
                                        d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" />
                                </svg>
                            </span>
                        </button>
                    </div>
                </div>
                {{-- end back buttton --}}

            </form>
        </div>

        <!-- Overlay -->
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start your journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    @if (session('success') || session('error'))
    <div id="custom-alert" class="custom-alert {{ session('success') ? 'success' : 'error' }}">
        <span class="alert-message">
            {{ session('success') ?? session('error') }}
        </span>
        <button class="close-alert" onclick="document.getElementById('custom-alert').style.display='none'">&times;</button>
    </div>
    @endif
    <script src="{{ asset('assets/js/login-script.js') }}"></script>
</body>

</html>
