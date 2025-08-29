<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ternak Pro | Daftar</title>
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
                    <h1>Daftar Akun Baru</h1>
                    <p>Sudah Punya Akun? <a href="/login">Masuk</a></p>
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <i class="fas fa-user icon"></i>
                            <input type="text" id="name" name="name" placeholder="Masukkan Nama Lengkap" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <i class="fas fa-envelope icon"></i>
                            <input type="email" id="email" name="email" placeholder="Masukkan Email Aktif" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <i class="fas fa-lock icon"></i>
                            <input type="password" id="password" name="password" placeholder="Password Minimal 8 Karakter" required>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <i class="fas fa-lock icon"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi Password" required>
                        </div>
                        <button type="submit" class="login-btn">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>