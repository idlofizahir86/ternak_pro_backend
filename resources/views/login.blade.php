<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ternak Pro | Login</title>
        <link rel="icon" type="image/png" href="{{ asset('assets/icon_ternakpro.png') }}">
        
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}?v={{ time() }}">
    </head>
    <body>
        <div class="container">
            <div class="left-panel">
                <a href="{{ route('home') }}"> <img src="{{ asset('assets/footer-logo.png') }}" alt="Ternak Pro Logo" class="logo"></a>
            </div>
            <div class="right-panel">
                <div class="form-container">
                    <h1>Masuk Akun Kamu</h1>
                    <p>Belum Punya Akun? <a href="/register">Daftar</a></p>

                    <!-- Display error messages from the backend -->
                    @if (session('error'))
                        <div class="error-message" style="color: red; margin-bottom: 15px;">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="error-message" style="color: red; margin-bottom: 15px;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login.web') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email_or_phone">Email atau Nomor Telepon</label>
                            <i class="fas fa-user icon"></i>
                            <input type="text" id="email_or_phone" name="email_or_phone" placeholder="Masukkan Email atau Nomor Telepon" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <i class="fas fa-lock icon"></i>
                            <input type="password" id="password" name="password" placeholder="Password Minimal 8 Karakter" required>
                        </div>
                        <div class="remember">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Ingat Saya</label>
                        </div>
                        <button type="submit" class="login-btn">Masuk</button>
                        <p class="or">Atau</p>
                        <!-- Google login (optional, implement if supported) -->
                        <button type="button" class="google-btn" disabled title="Fitur ini belum tersedia">
                            <img src="{{ asset('assets/google_icon.png') }}" alt="Google"> Masuk dengan Google
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>