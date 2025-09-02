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
            background-color: linear-gradient(90deg, #298FBB 0%, #0EBCB1 100%);
            background: linear-gradient(90deg, #298FBB 0%, #0EBCB1 100%);
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
            border: 2.5px solid #7ed8ff;
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
            background-color: linear-gradient(90deg, #298FBB 0%, #0EBCB1 100%);
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

</body>
</html>