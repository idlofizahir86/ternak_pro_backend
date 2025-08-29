<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ternak Pro | Login</title>
        <link rel="icon" type="image/png" href="{{ asset('assets/logo.png') }}">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    </head>
    <body>
        <div class="container">
            <div class="left-panel">
                <img src="{{ asset('assets/footer-logo.png') }}" href="/" alt="Ternak Pro Logo" class="logo">
            </div>
            <div class="right-panel">
                <div class="form-container">
                    <h1>Masuk Akun Kamu</h1>
                    <p>Belum Punya Akun? <a href="/register">Daftar</a></p>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <i class="fas fa-envelope icon"></i>
                            <input type="email" id="email" name="email" placeholder="Masukkan Email Aktif" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <i class="fas fa-lock icon"></i>
                            <input type="password" id="password" name="password" placeholder="Password Minimal 8 Angka" required>
                        </div>
                        <div class="remember">
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Ingat Saya</label>
                        </div>
                        <button type="submit" class="login-btn">Masuk</button>
                        <p class="or">Atau</p>
                        <button type="button" class="google-btn">
                            <img src="{{ asset('assets/google_icon.png') }}" alt="Google"> Masuk dengan Google
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>