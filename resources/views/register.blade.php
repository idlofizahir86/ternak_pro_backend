<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ternak Pro | Daftar</title>
        <link rel="icon" type="image/png" href="{{ asset('assets/icon_ternakpro.png') }}">
        
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('css/login.css') }}?v={{ time() }}">
        <style>
            /* Additional style for the loading spinner */
            .loading-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                display: none;
                justify-content: center;
                align-items: center;
                z-index: 9999;
            }
            .loading-spinner {
                border: 4px solid #f3f3f3;
                border-top: 4px solid #3498db;
                border-radius: 50%;
                width: 50px;
                height: 50px;
                animation: spin 2s linear infinite;
            }
            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="left-panel">
                <a href="{{ route('home') }}"> <img src="{{ asset('assets/footer-logo.png') }}" alt="Ternak Pro Logo" class="logo"></a>
            </div>
            <div class="right-panel">
                <div class="form-container">
                    <h1>Daftar Akun Baru</h1>
                    <p>Sudah Punya Akun? <a href="{{ route('login') }}">Masuk</a></p>
                    <form action="{{ route('register.web') }}" method="POST" id="register-form">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <i class="fas fa-user icon"></i>
                            <input type="text" id="name" name="name" placeholder="Masukkan Nama Lengkap" value="{{ old('name') }}" required>
                            @error('name')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <i class="fas fa-envelope icon"></i>
                            <input type="email" id="email" name="email" placeholder="Masukkan Email Aktif" value="{{ old('email') }}" required>
                            @error('email')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <i class="fas fa-lock icon"></i>
                            <input type="password" id="password" name="password" placeholder="Password Minimal 8 Karakter" required>
                            @error('password')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <i class="fas fa-lock icon"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi Password" required>
                            @error('password_confirmation')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                        <button type="submit" class="login-btn">Daftar</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Loading Spinner -->
        <div class="loading-overlay" id="loading-overlay">
            <div class="loading-spinner"></div>
        </div>

        <script>
            // Show loading spinner when submitting form
            document.getElementById('register-form').addEventListener('submit', function() {
                document.getElementById('loading-overlay').style.display = 'flex';
            });
        </script>
    </body>
</html>
