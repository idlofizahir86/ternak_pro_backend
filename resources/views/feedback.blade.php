<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback TernakPro - Summit Day 9th IndonesiaNext</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(to bottom, #f7fafc, #e2e8f0);
        }
        .fade-in {
            opacity: 0;
            transition: opacity 1s ease-in;
        }
        .fade-in.visible {
            opacity: 1;
        }
        .iframe-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        @media (max-width: 768px) {
            .iframe-container {
                padding: 10px;
            }
            iframe {
                width: 100%;
                height: 6000px; /* Adjusted for mobile */
            }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <!-- Header -->
    <header class="bg-green-600 text-white py-6">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-4xl font-bold">Feedback TernakPro</h1>
            <p class="mt-2 text-lg">Berikan masukan Anda untuk pengalaman terbaik di Summit Day 9th IndonesiaNext!</p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow py-10">
        <div class="iframe-container fade-in">
            <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSdz-V0dUmEQUOJ4pD_mYoaF3Tz_ZOxgpltgbjvpambpCQXfXQ/viewform?embedded=true" 
                    width="640" 
                    height="6566" 
                    frameborder="0" 
                    marginheight="0" 
                    marginwidth="0"
                    class="w-full">Memuat…</iframe>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto px-4 text-center">
            <p class="text-sm">© 2025 TernakPro. Semua hak dilindungi.</p>
            <p class="mt-2 text-sm">Terima kasih atas partisipasi Anda di Summit Day 9th IndonesiaNext!</p>
        </div>
    </footer>

    <!-- JavaScript for Fade-in Effect -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const iframeContainer = document.querySelector(".iframe-container");
            setTimeout(() => {
                iframeContainer.classList.add("visible");
            }, 100);
        });
    </script>
</body>
</html>