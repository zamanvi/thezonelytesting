<footer class="max-w-7xl mx-auto mt-8 px-4 sm:px-6 border-t pt-10 pb-6 text-center">

    <a href="{{ route('frontend.home') }}" class="inline-block text-xl font-extrabold mb-5 hover:text-blue-600 transition" style="min-height:unset;min-width:unset;">
        ZONELY<span class="text-blue-600">.</span>
    </a>

    {{-- Nav links: wrap on mobile, row on sm+ --}}
    <div class="flex flex-wrap justify-center gap-x-5 gap-y-3 text-xs font-bold text-slate-500 mb-5 uppercase tracking-widest">
        <a href="{{ route('frontend.privacy-policy') }}"       class="hover:text-blue-600 transition" style="min-height:unset;">Privacy Policy</a>
        <a href="{{ route('frontend.terms-and-condition') }}"  class="hover:text-blue-600 transition" style="min-height:unset;">Terms of Service</a>
        <a href="{{ route('frontend.about-us') }}"             class="hover:text-blue-600 transition" style="min-height:unset;">About Us</a>
        <a href="{{ route('frontend.help') }}"                 class="hover:text-blue-600 transition" style="min-height:unset;">Help</a>
        <a href="https://migotrucking.com" target="_blank" rel="noopener" class="hover:text-blue-600 transition" style="min-height:unset;">Sister Site</a>
    </div>

    {{-- Social --}}
    <div class="flex justify-center gap-5 mb-5">
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

    <div class="mt-4 mb-2">
        <a href="{{ route('user.register', 'seller') }}"
           class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-bold px-5 py-2.5 rounded-xl transition" style="min-height:unset;">
            <i class="fa-solid fa-briefcase text-xs"></i>
            List Your Business — It's Free
        </a>
    </div>

    <p class="text-xs text-slate-400">© {{ date('Y') }} Zonely. Empowering Local Experts.</p>
</footer>
