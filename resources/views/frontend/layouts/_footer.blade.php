<footer class="max-w-7xl mx-auto mt-8 px-4 sm:px-6 border-t pt-12 pb-8">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">

        {{-- Brand --}}
        <div class="sm:col-span-2 lg:col-span-1">
            <a href="{{ route('frontend.home') }}" class="inline-block text-xl font-extrabold mb-3 hover:text-blue-600 transition" style="min-height:unset;min-width:unset;">
                ZONELY<span class="text-blue-600">.</span>
            </a>
            <p class="text-xs text-slate-500 leading-relaxed mb-5 max-w-xs">
                Find verified local experts near you. Plumbers, lawyers, tax professionals, and more — all in one place.
            </p>
            <div class="flex gap-3">
                <a href="https://www.facebook.com/profile.php?id=61581047693543" target="_blank" rel="noopener"
                   class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-100 hover:bg-blue-100 hover:text-blue-600 text-slate-500 transition" style="min-height:unset;min-width:unset;">
                    <i class="fab fa-facebook text-sm"></i>
                </a>
                <a href="https://www.linkedin.com/company/102732925/admin/dashboard" target="_blank" rel="noopener"
                   class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-100 hover:bg-blue-100 hover:text-blue-600 text-slate-500 transition" style="min-height:unset;min-width:unset;">
                    <i class="fab fa-linkedin text-sm"></i>
                </a>
                <a href="https://www.youtube.com/@thezonely" target="_blank" rel="noopener"
                   class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-100 hover:bg-red-100 hover:text-red-600 text-slate-500 transition" style="min-height:unset;min-width:unset;">
                    <i class="fab fa-youtube text-sm"></i>
                </a>
            </div>
        </div>

        {{-- Quick Links --}}
        <div>
            <p class="text-[11px] font-black uppercase tracking-widest text-slate-400 mb-4">Explore</p>
            <ul class="space-y-3">
                <li><a href="{{ route('frontend.service.all') }}"  class="text-sm font-medium text-slate-600 hover:text-blue-600 transition" style="min-height:unset;">Browse Professionals</a></li>
                <li><a href="{{ route('frontend.tools') }}"        class="text-sm font-medium text-slate-600 hover:text-blue-600 transition" style="min-height:unset;">Tools</a></li>
                <li><a href="{{ route('frontend.blog') }}"         class="text-sm font-medium text-slate-600 hover:text-blue-600 transition" style="min-height:unset;">Blog</a></li>
                <li><a href="{{ route('frontend.help') }}"         class="text-sm font-medium text-slate-600 hover:text-blue-600 transition" style="min-height:unset;">Help Center</a></li>
                <li><a href="{{ route('frontend.about-us') }}"     class="text-sm font-medium text-slate-600 hover:text-blue-600 transition" style="min-height:unset;">About Us</a></li>
            </ul>
        </div>

        {{-- Legal --}}
        <div>
            <p class="text-[11px] font-black uppercase tracking-widest text-slate-400 mb-4">Legal</p>
            <ul class="space-y-3">
                <li><a href="{{ route('frontend.privacy-policy') }}"      class="text-sm font-medium text-slate-600 hover:text-blue-600 transition" style="min-height:unset;">Privacy Policy</a></li>
                <li><a href="{{ route('frontend.terms-and-condition') }}" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition" style="min-height:unset;">Terms of Service</a></li>
                <li><a href="https://migotrucking.com" target="_blank" rel="noopener" class="text-sm font-medium text-slate-600 hover:text-blue-600 transition" style="min-height:unset;">Sister Site</a></li>
            </ul>
        </div>

        {{-- CTA --}}
        <div>
            <p class="text-[11px] font-black uppercase tracking-widest text-slate-400 mb-4">For Professionals</p>
            <p class="text-xs text-slate-500 leading-relaxed mb-4">
                Get qualified leads in your area. Free to join. Pay per verified lead only.
            </p>
            <a href="{{ route('user.register', 'seller') }}"
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold px-5 py-3 rounded-xl transition" style="min-height:unset;">
                <i class="fa-solid fa-briefcase text-xs"></i>
                List Your Business Free
            </a>
        </div>

    </div>

    <div class="border-t pt-6 flex flex-col sm:flex-row items-center justify-between gap-3">
        <p class="text-xs text-slate-400">© {{ date('Y') }} Zonely. Empowering Local Experts.</p>
        <p class="text-xs text-slate-400">Made with <span class="text-red-400">♥</span> for local communities across the USA</p>
    </div>

</footer>
