<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to App</title>
    <script>
        window.onload = function () {
            // Ambil data login yang disimpan dalam session
            const userData = @json($userData);

            // Simpan data di localStorage
            localStorage.setItem('flutter.token', userData.token);
            localStorage.setItem('flutter.user_id', userData.user_id);
            localStorage.setItem('flutter.email', userData.email);
            localStorage.setItem('flutter.name', userData.name);
            localStorage.setItem('flutter.role_id', userData.role_id);

            // Redirect ke aplikasi Flutter Web
            window.location.href = 'https://app.ternakpro.id';
        }
    </script>
</head>
<body>
    <p>Redirecting...</p>
</body>
</html>
