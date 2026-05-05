@php
    $cr = Route::currentRouteName();
    $navItems = [
        ['route' => route('seller.dashboard'),     'name' => 'seller.dashboard',     'icon' => 'fa-gauge-high',          'label' => 'Dashboard'],
        ['route' => route('seller.onboarding'),    'name' => 'seller.onboarding',    'icon' => 'fa-user-pen',            'label' => 'Profile'],
        ['route' => route('seller.settings'),      'name' => 'seller.settings',      'icon' => 'fa-gear',                'label' => 'Settings'],
        ['route' => route('seller.billing'),       'name' => 'seller.billing',       'icon' => 'fa-file-invoice-dollar', 'label' => 'Billing'],
        ['route' => route('seller.schedule'),      'name' => 'seller.schedule',      'icon' => 'fa-calendar-days',       'label' => 'Schedule'],
        ['route' => route('seller.reviews'),       'name' => 'seller.reviews',       'icon' => 'fa-star',                'label' => 'Reviews'],
        ['route' => route('seller.notifications'), 'name' => 'seller.notifications', 'icon' => 'fa-bell',                'label' => 'Notifications'],
        ['route' => route('seller.affiliate'),     'name' => 'seller.affiliate',     'icon' => 'fa-link',                'label' => 'Affiliate'],
    ];
@endphp

{{-- ── DESKTOP SIDEBAR ─────────────────────────────────────────── --}}
<aside class="hidden lg:flex flex-col fixed left-0 top-[68px] bottom-0 w-56 bg-white border-r border-slate-100 z-30">
    <div class="flex-1 px-3 pt-6 space-y-0.5 overflow-y-auto">
        @foreach($navItems as $item)
        <a href="{{ $item['route'] }}"
           class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-all
                  {{ $cr === $item['name']
                      ? 'bg-blue-600 text-white shadow-sm'
                      : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
            <i class="fa-solid {{ $item['icon'] }} w-4 text-center shrink-0 text-[15px]"></i>
            {{ $item['label'] }}
        </a>
        @endforeach
    </div>
    <div class="px-4 py-4 border-t border-slate-100 shrink-0">
        <a href="{{ route('frontend.service.show', auth()->user()->slug ?? auth()->user()->id) }}"
           target="_blank"
           class="flex items-center gap-2 text-xs font-bold text-blue-600 hover:underline">
            <i class="fa-solid fa-arrow-up-right-from-square"></i> View Public Page
        </a>
    </div>
</aside>

{{-- ── MOBILE BOTTOM NAV ────────────────────────────────────────── --}}
<nav class="lg:hidden fixed bottom-0 left-0 right-0 bg-white border-t border-slate-100 z-40 flex justify-around px-1 py-1 shadow-lg">
    @foreach($navItems as $item)
    <a href="{{ $item['route'] }}"
       class="flex flex-col items-center gap-0.5 flex-1 py-2 rounded-xl text-center transition
              {{ $cr === $item['name'] ? 'text-blue-600' : 'text-slate-400 hover:text-blue-600' }}">
        <i class="fa-solid {{ $item['icon'] }} text-[15px]"></i>
        <span class="text-[9px] font-bold leading-none mt-0.5">{{ $item['label'] }}</span>
    </a>
    @endforeach
</nav>
