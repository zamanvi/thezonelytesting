<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <title>Complete Your Profile | Zonely</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:wght@700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- jQuery required for Select2 on profile setup pages --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" defer></script>
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
            @apply bg-teal-700 text-white;
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
            @apply h-1 bg-teal-700 transition-all duration-500;
        }

        .step {
            display: none;
        }

        .step.active {
            display: block;
        }
    </style>
    @yield('css')
</head>

<body class="bg-gradient-to-br from-slate-50 to-teal-50 min-h-screen">

    <nav class="fixed top-0 w-full z-50 px-4 md:px-8 py-4">
        <div class="max-w-7xl mx-auto glass rounded-2xl px-6 py-3 flex justify-between items-center shadow-sm">
            <div class="flex items-center gap-3">
                {{-- <div class="w-9 h-9 bg-gradient-to-br from-teal-700 to-violet-600 rounded-lg"></div>
                <span class="text-2xl font-extrabold tracking-tighter">ZONELY</span> --}}
                <a href="{{ route('frontend.home') }}">
                    <img src="{{ asset('frontend/img/zonely_logo.jpeg') }}" class="w-10 h-10" alt="Zonely">
                </a>
            </div>
            <div class="">

                @auth
                    <div class="relative inline-block">
                        <button onclick="toggleDropdown()"
                            class="text-sm font-bold text-slate-500 hover:text-teal-700 transition">
                            More ▼
                        </button>
                        <div id="dropdownMenu"
                            class="hidden absolute right-0 bg-white shadow-xl rounded-2xl mt-2 w-48 border border-slate-100 z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-5 py-3 hover:bg-teal-50">Edit Profile</a>
                            @if (Auth::user()->type === 'seller')
                                <a href="{{ route('user.memberships.index') }}"
                                    class="block px-5 py-3 hover:bg-teal-50">Memberships</a>
                                <a href="{{ route('user.languages.index') }}"
                                    class="block px-5 py-3 hover:bg-teal-50">Language</a>
                                <a href="{{ route('user.educations.index') }}"
                                    class="block px-5 py-3 hover:bg-teal-50">Education</a>
                            @endif

                        </div>
                    </div>
                @endauth
                <a href="/" class="text-sm font-bold text-slate-500 hover:text-teal-700 transition">Back to
                    Home</a>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 pt-28 sm:pt-32 pb-16 sm:pb-24">

        @yield('content')

    </main>

    @yield('script')
    <script>
        function toggleDropdown() {
            document.getElementById('dropdownMenu').classList.toggle('hidden');
        }

        // click বাইরে করলে close
        document.addEventListener('click', function(e) {
            let dropdown = document.getElementById('dropdownMenu');
            if (!e.target.closest('.relative')) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

</body>

</html>
