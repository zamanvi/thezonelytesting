<nav class="fixed top-0 w-full z-[100] px-4 md:px-8 py-4">
    <div class="max-w-7xl mx-auto glass rounded-2xl px-6 py-3 shadow-sm">

        <div class="flex justify-between items-center">

            <!-- LOGO -->
            <a href="{{ route('frontend.home') }}">
                <img src="{{ asset('frontend/img/zonely_logo.jpeg') }}" class="w-10 h-10" alt="Zonely">
            </a>

            <!-- ================= DESKTOP MENU ================= -->
            <div class="hidden lg:flex gap-8 text-xs font-bold uppercase tracking-widest text-slate-500">

                @foreach ($allMenuCategories as $category)
                    <div class="relative group">

                        <a href="#" class="hover:text-blue-600 transition flex items-center gap-1">
                            {{ $category->title }}

                            @if ($category->children->count())
                                <svg class="w-3 h-3 mt-[2px]" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            @endif
                        </a>

                        @if ($category->children->count())
                            <div class="absolute left-0 mt-3 w-52 bg-white rounded-xl shadow-lg opacity-0 invisible 
                                group-hover:opacity-100 group-hover:visible transition-all duration-200">

                                @foreach ($category->children as $child)
                                    <a href="{{ route('frontend.category', $child->slug) }}"
                                        class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">
                                        {{ $child->title }}
                                    </a>
                                @endforeach

                            </div>
                        @endif

                    </div>
                @endforeach

                <!-- OTHERS -->
                <div class="relative group">
                    <a href="#" class="hover:text-blue-600 transition flex items-center gap-1">
                        Others
                        <svg class="w-3 h-3 mt-[2px]" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>

                    <div class="absolute left-0 mt-3 w-48 bg-white rounded-xl shadow-lg opacity-0 invisible 
                        group-hover:opacity-100 group-hover:visible transition-all duration-200">

                        <a href="{{ route('frontend.tools') }}"
                            class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">
                            Tools
                        </a>
                        <a href="{{ route('frontend.blog') }}"
                            class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">
                            Blog
                        </a>
                        <a href="{{ route('frontend.help') }}"
                            class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-100">
                            Help
                        </a>

                    </div>
                </div>

            </div>

            <!-- AUTH -->
            <div class="hidden lg:block">
                @auth
                    <a class="bg-slate-900 text-white px-5 py-2 rounded-xl text-xs font-bold"
                        href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <a class="bg-slate-900 text-white px-5 py-2 rounded-xl text-xs font-bold"
                        href="{{ route('user.login') }}">Login</a>
                @endauth
            </div>

            <!-- MOBILE BUTTON -->
            <button id="menuBtn" class="lg:hidden text-slate-800">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

        </div>

        <!-- ================= MOBILE MENU ================= -->
        <div id="mobileMenu" class="hidden mt-6 space-y-3 text-left">

            @foreach ($allMenuCategories as $category)
                <div class="border-b pb-2">

                    <!-- PARENT -->
                    <button class="w-full flex justify-between items-center text-sm font-semibold text-slate-700 mobile-toggle">
                        {{ $category->title }}

                        @if ($category->children->count())
                            <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                                stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        @endif
                    </button>

                    <!-- CHILDREN -->
                    @if ($category->children->count())
                        <div class="pl-4 mt-2 space-y-1 mobile-submenu hidden">

                            @foreach ($category->children as $child)
                                <a href="{{ route('frontend.category', $child->slug) }}"
                                    class="block text-sm text-slate-600 py-1">
                                    • {{ $child->title }}
                                </a>
                            @endforeach

                        </div>
                    @endif

                </div>
            @endforeach

            <!-- OTHERS -->
            <div class="border-b pb-2">

                <button class="w-full flex justify-between items-center text-sm font-semibold text-slate-700 mobile-toggle">
                    Others
                    <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div class="hidden pl-4 mt-2 space-y-1 mobile-submenu">

                    <a href="{{ route('frontend.tools') }}" class="block text-sm text-slate-600 py-1">Tools</a>
                    <a href="{{ route('frontend.blog') }}" class="block text-sm text-slate-600 py-1">Blog</a>
                    <a href="{{ route('frontend.help') }}" class="block text-sm text-slate-600 py-1">Help</a>

                </div>
            </div>

            <!-- AUTH -->
            <div class="pt-3 text-center">
                @auth
                    <a class="inline-block bg-slate-900 text-white px-6 py-2 rounded-xl text-xs font-bold"
                        href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <a class="inline-block bg-slate-900 text-white px-6 py-2 rounded-xl text-xs font-bold"
                        href="{{ route('user.login') }}">Login</a>
                @endauth
            </div>

        </div>

    </div>
</nav>