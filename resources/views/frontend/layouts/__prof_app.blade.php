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

    <div class="max-w-7xl mx-auto p-6">

        <!-- Top Navigation -->
        <div class="flex items-center justify-between mb-8 bg-white shadow-sm rounded-3xl px-8 py-5">
            <div class="flex items-center gap-3">
                <div
                    class="w-11 h-11 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-bold text-3xl">
                    Z</div>
                <span class="text-2xl font-semibold text-gray-900">Zonely</span>
            </div>
            <h1 class="text-2xl font-semibold text-gray-800">Leads Dashboard</h1>

            <!-- More Menu -->
            <div class="relative group">
                <button onclick="toggleMenu()"
                    class="flex items-center gap-2 px-6 py-3 bg-white border border-gray-200 rounded-2xl hover:border-blue-300 transition-all text-sm font-medium">
                    More <i class="fas fa-chevron-down ml-1"></i>
                </button>
                <div id="moreMenu"
                    class="hidden absolute right-0 mt-3 w-64 bg-white rounded-3xl shadow-xl py-4 border border-gray-100 z-50 text-base">
                    <a href="#" class="flex items-center gap-3 px-6 py-3.5 hover:bg-gray-50"><i
                            class="fas fa-home w-5"></i> Back to Home</a>
                    <a href="#" class="flex items-center gap-3 px-6 py-3.5 hover:bg-gray-50"><i
                            class="fas fa-user w-5"></i> Profile</a>
                    <a href="#" class="flex items-center gap-3 px-6 py-3.5 hover:bg-gray-50"><i
                            class="fas fa-phone w-5"></i> Leads Dashboard</a>
                    <a href="#" class="flex items-center gap-3 px-6 py-3.5 hover:bg-gray-50"><i
                            class="fas fa-handshake w-5"></i> Affiliate Dashboard</a>
                    <a href="#" class="flex items-center gap-3 px-6 py-3.5 hover:bg-gray-50"><i
                            class="fas fa-cog w-5"></i> Settings</a>
                    <div class="border-t border-gray-100 my-2 mx-4"></div>
                    <a href="#" class="flex items-center gap-3 px-6 py-3.5 text-red-600 hover:bg-gray-50"><i
                            class="fas fa-sign-out-alt w-5"></i> Logout</a>
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