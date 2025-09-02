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

            // Membuat URL dengan data login sebagai query parameters
            const queryParams = new URLSearchParams(userData).toString();

            // Redirect ke aplikasi Flutter Web dengan query params
            window.location.href = 'https://app.ternakpro.id?' + queryParams;
        }
    </script>
</head>
<body>
    <p>Redirecting...</p>
</body>
</html>