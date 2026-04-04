<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join as Pro | Zonely – Discover & Hire Local Experts Near Me</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .font-serif {
            font-family: 'Playfair Display', serif;
        }

        .glass {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .step-indicator {
            @apply flex items-center justify-center w-10 h-10 rounded-full text-sm font-bold;
        }

        .step-complete {
            @apply bg-blue-600 text-white;
        }

        .step-active {
            @apply bg-slate-900 text-white;
        }

        .step-inactive {
            @apply bg-slate-200 text-slate-500;
        }

        .progress-bar {
            @apply h-1 bg-slate-200;
        }

        .progress-fill {
            @apply h-1 bg-blue-600 transition-all duration-500;
        }

        .step {
            display: none;
        }

        .step.active {
            display: block;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-slate-50 to-blue-50 min-h-screen">

    <nav class="fixed top-0 w-full z-50 px-4 md:px-8 py-4">
        <div class="max-w-7xl mx-auto glass rounded-2xl px-6 py-3 flex justify-between items-center shadow-sm">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-gradient-to-br from-blue-600 to-violet-600 rounded-lg"></div>
                <span class="text-2xl font-extrabold tracking-tighter">ZONELY</span>
            </div>
            <a href="/" class="text-sm font-bold text-slate-500 hover:text-blue-600 transition">Back to Home</a>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-6 pt-32 pb-24">
        
        @yield('content')

    </main>

    @yield('script')

</body>

</html>
