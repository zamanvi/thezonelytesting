<nav class="fixed top-0 w-full z-[100] px-4 md:px-8 py-4">
    <div class="max-w-7xl mx-auto glass rounded-2xl px-6 py-3 flex justify-between items-center shadow-sm">
        <div class="flex items-center gap-2">
            {{-- <div class="w-8 h-8 animate-gradient rounded-lg"></div> --}}
            {{-- <span class="text-xl font-extrabold tracking-tighter uppercase"><a href="{{ route('frontend.home') }}">{{ env('APP_NAME') }}</a></span> --}}
            <span class="text-xl font-extrabold tracking-tighter uppercase"><a href="{{ route('frontend.home') }}"><img src="{{ asset('frontend/img/zonely_logo.jpeg') }}" height="50px" width="50px" alt=""></a></span>
        </div>
        <div class="hidden lg:flex gap-8 text-xs font-bold uppercase tracking-widest text-slate-500">
            <a class="hover:text-blue-600 transition" href="{{ route('frontend.tools') }}">Tools</a>
            <a class="hover:text-blue-600 transition" href="{{ route('frontend.blog') }}">Blog</a>
            <a class="hover:text-blue-600 transition" href="{{ route('frontend.help') }}">Help</a>
        </div>
        @auth
            <a class="bg-slate-900 text-white px-5 py-2 rounded-xl text-xs font-bold hover:scale-105 transition-all" href="{{ route('dashboard') }}">Dashboard</a>
        @else
            <a class="bg-slate-900 text-white px-5 py-2 rounded-xl text-xs font-bold hover:scale-105 transition-all" href="{{ route('user.login') }}">Login</a>
        @endauth
    </div>
</nav>