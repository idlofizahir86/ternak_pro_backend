<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to TernakPro..</title>
    <script>
        window.onload = function () {
            // Ambil data login yang disimpan dalam session
            const userData = @json($userData);

            // Membuat URL dengan data login sebagai query parameters
            const queryParams = new URLSearchParams(userData).toString();

            // Redirect ke aplikasi Flutter Web dengan query params
            window.location.href = 'https://app.ternakpro.id?' + queryParams;
        }
    </script>
    <style>
        /* Mengatur gaya dasar halaman */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f1f1f1;
        }

        /* Kontainer utama */
        .loading-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Animasi Box */
        .box-loading {
            width: 220px;
            height: 100px;
            position: relative;
            overflow: hidden;
        }

        /* Path animasi keliling */
        .box-path {
            position: absolute;
            width: 200px;
            height: 60px;
            top: 20px;
            left: 10px;
            border-radius: 12px;
            border: 2.5px solid #298fbb;
            animation: pathAnimation 2s infinite linear;
        }

        /* Animasi Teks */
        .loading-text {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 20px;
            font-weight: bold;
            color: white;
            background: linear-gradient(90deg, #298fbb, #0ebcb1);
            -webkit-background-clip: text;
            background-clip: text;
            animation: gradientAnimation 2s infinite linear;
        }

        /* Animasi untuk path (keliling kotak) */
        @keyframes pathAnimation {
            0% {
                stroke-dashoffset: 0;
            }
            100% {
                stroke-dashoffset: 1200; /* Menentukan panjang path */
            }
        }

        /* Animasi untuk teks */
        @keyframes gradientAnimation {
            0% {
                background-position: 100%;
            }
            100% {
                background-position: -100%;
            }
        }
    </style>
</head>
<body>
    <div class="loading-container">
        <div class="box-loading">
            <div class="box-path"></div>
            <div class="loading-text">TernakPro</div>
        </div>
    </div>

    <script>
        window.onload = function() {
            // Mengambil data dari query string di URL
            const urlParams = new URLSearchParams(window.location.search);
            const token = urlParams.get('flutter.token');
            const userId = urlParams.get('flutter.user_id');
            const name = urlParams.get('flutter.name');
            const email = urlParams.get('flutter.email');

            // Jika data valid, simpan ke localStorage
            if (token && userId && name && email) {
                localStorage.setItem('flutter.token', token);
                localStorage.setItem('flutter.user_id', userId);
                localStorage.setItem('flutter.name', name);
                localStorage.setItem('flutter.email', email);
                console.log('User data saved to localStorage');

                // Menghapus query string dari URL tanpa reload
                window.history.replaceState(null, document.title, window.location.pathname);
                
                // Redirect ke aplikasi Flutter Web
                window.location.href = 'https://app.ternakpro.id';
            } else {
                // Jika data tidak valid, redirect ke login
                window.location.href = 'https://ternakpro.id/login';
            }
        }
    </script>
</body>
</html>