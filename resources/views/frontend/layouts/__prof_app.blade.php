<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zonely - Leads Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', system-ui, sans-serif;
        }

        .step-active {
            background-color: #2563eb;
            color: white;
        }

        .menu-active {
            background-color: #dbeafe;
            color: #1e40af;
            font-weight: 600;
        }

        .landing-preview {
            height: 620px;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #64748b #f1f5f9;
            border-radius: 24px;
        }

        .landing-preview::-webkit-scrollbar {
            width: 6px;
        }

        .landing-preview::-webkit-scrollbar-thumb {
            background-color: #64748b;
            border-radius: 20px;
        }
    </style>
</head>

<body class="bg-gray-50 min-h-screen">

    <div class="max-w-7xl mx-auto p-3 sm:p-6">

        <!-- Top Navigation -->
        <div class="flex items-center justify-between mb-6 bg-white shadow-sm rounded-3xl px-4 sm:px-8 py-4 sm:py-5">
            <div class="flex items-center gap-2 sm:gap-3">
                <a href="{{ route('frontend.home') }}" class="w-10 h-10 sm:w-11 sm:h-11 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-bold text-2xl sm:text-3xl shrink-0">Z</a>
                <span class="text-lg sm:text-2xl font-semibold text-gray-900">Zonely</span>
            </div>
            <h1 class="hidden sm:block text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h1>

            <!-- More Menu -->
            <div class="relative">
                <button onclick="toggleMenu()"
                    class="flex items-center gap-2 px-4 sm:px-6 py-2.5 sm:py-3 bg-white border border-gray-200 rounded-2xl hover:border-blue-300 transition-all text-sm font-medium">
                    <span class="hidden sm:inline">More</span>
                    <i class="fas fa-bars sm:fa-chevron-down"></i>
                </button>
                <div id="moreMenu"
                    class="hidden absolute right-0 mt-3 w-56 sm:w-64 bg-white rounded-3xl shadow-xl py-4 border border-gray-100 z-50 text-sm sm:text-base">
                    <a href="{{ route('frontend.home') }}" class="flex items-center gap-3 px-5 sm:px-6 py-3 hover:bg-gray-50"><i class="fas fa-home w-4"></i> Back to Home</a>
                    <a href="{{ route('seller.dashboard') }}" class="flex items-center gap-3 px-5 sm:px-6 py-3 hover:bg-gray-50"><i class="fas fa-phone w-4"></i> Leads Dashboard</a>
                    <a href="{{ route('seller.affiliate') }}" class="flex items-center gap-3 px-5 sm:px-6 py-3 hover:bg-gray-50"><i class="fas fa-handshake w-4"></i> Affiliate</a>
                    <a href="{{ route('seller.settings') }}" class="flex items-center gap-3 px-5 sm:px-6 py-3 hover:bg-gray-50"><i class="fas fa-cog w-4"></i> Settings</a>
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-5 sm:px-6 py-3 hover:bg-gray-50"><i class="fas fa-user w-4"></i> Edit Profile</a>
                    <div class="border-t border-gray-100 my-2 mx-4"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-3 px-5 sm:px-6 py-3 text-red-600 hover:bg-gray-50 text-left">
                            <i class="fas fa-sign-out-alt w-4"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        @yield('content')

    </div>

    <script>
        function toggleMenu() {
            document.getElementById('moreMenu').classList.toggle('hidden');
        }

        function switchStep(step) {
            alert(`✅ Moving to Step ${step} (Demo Preview)`);
        }

        function selectTitle(btn) {
            document.querySelectorAll('.title-btn').forEach(b => {
                b.classList.remove('bg-blue-600', 'text-white');
                b.classList.add('bg-gray-100');
            });
            btn.classList.add('bg-blue-600', 'text-white');
        }

        function toggleLanguage(btn) {
            if (btn.classList.contains('bg-blue-100')) {
                btn.classList.remove('bg-blue-100', 'text-blue-700', 'border-blue-500');
                btn.classList.add('bg-gray-100');
            } else {
                btn.classList.add('bg-blue-100', 'text-blue-700', 'border-blue-500');
            }
        }

        document.addEventListener('click', function (e) {
            if (!e.target.closest('.group')) {
                document.getElementById('moreMenu').classList.add('hidden');
            }
        });
    </script>
</body>

</html>