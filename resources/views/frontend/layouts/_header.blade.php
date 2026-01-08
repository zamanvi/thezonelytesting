<nav class="fixed top-0 w-full z-[100] px-4 md:px-8 py-4">
    <div class="max-w-7xl mx-auto glass rounded-2xl px-6 py-3 shadow-sm">

        <div class="flex justify-between items-center">
            <!-- LOGO -->
            <a href="{{ route('frontend.home') }}">
                <img src="{{ asset('frontend/img/zonely_logo.jpeg') }}" class="w-10 h-10" alt="Zonely">
            </a>

            <!-- DESKTOP MENU -->
            <div class="hidden lg:flex gap-8 text-xs font-bold uppercase tracking-widest text-slate-500">
                <a class="hover:text-blue-600 transition" href="{{ route('frontend.tools') }}">Tools</a>
                <a class="hover:text-blue-600 transition" href="{{ route('frontend.blog') }}">Blog</a>
                <a class="hover:text-blue-600 transition" href="{{ route('frontend.help') }}">Help</a>
            </div>

            <!-- AUTH BUTTON -->
            <div class="hidden lg:block">
                @auth
                    <a class="bg-slate-900 text-white px-5 py-2 rounded-xl text-xs font-bold hover:scale-105 transition"
                        href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <a class="bg-slate-900 text-white px-5 py-2 rounded-xl text-xs font-bold hover:scale-105 transition"
                        href="{{ route('user.login') }}">Login</a>
                @endauth
            </div>

            <!-- MOBILE MENU BUTTON -->
            <button id="menuBtn" class="lg:hidden text-slate-800">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- MOBILE MENU -->
        <div id="mobileMenu" class="hidden mt-6 space-y-4 text-center">
            <a class="block text-sm font-semibold text-slate-700" href="{{ route('frontend.tools') }}">Tools</a>
            <a class="block text-sm font-semibold text-slate-700" href="{{ route('frontend.blog') }}">Blog</a>
            <a class="block text-sm font-semibold text-slate-700" href="{{ route('frontend.help') }}">Help</a>

            @auth
                <a class="inline-block bg-slate-900 text-white px-6 py-2 rounded-xl text-xs font-bold"
                    href="{{ route('dashboard') }}">Dashboard</a>
            @else
                <a class="inline-block bg-slate-900 text-white px-6 py-2 rounded-xl text-xs font-bold"
                    href="{{ route('user.login') }}">Login</a>
            @endauth
        </div>

    </div>
</nav>
