@extends('frontend.layouts._app')
@section('title', $staff->role_label . ' Dashboard')

@section('css')
<style>
    .bar { transition: height 0.4s ease; }
    .bar:hover { filter: brightness(1.1); }
    .scroll-hide { -ms-overflow-style:none; scrollbar-width:none; }
    .scroll-hide::-webkit-scrollbar { display:none; }
    .commission-ring { transform: rotate(-90deg); transform-origin: 50% 50%; }
</style>
@endsection

@section('content')

@php
    $totalLeads     = $leads->count();
    $paidCount      = $paidLeads->count();
    $unpaidCount    = $unpaidLeads->count();
    $activeSellers  = $sellers->count();
    $totalCommission= $commissionReceived + $commissionPending;
    $receivedPct    = $totalCommission > 0 ? round($commissionReceived / $totalCommission * 100) : 0;
    $roleColors     = [
        'area_manager'     => 'blue',
        'city_manager'     => 'violet',
        'district_manager' => 'amber',
        'country_manager'  => 'red',
    ];
    $color = $roleColors[$staff->role] ?? 'blue';
    $recentLeads = $leads->take(10);
@endphp

<div class="min-h-screen bg-slate-50 pt-20 pb-24">
<div class="max-w-3xl mx-auto px-4 py-6">

    {{-- ── HEADER ── --}}
    <div class="mb-6">
        <div class="flex items-start justify-between gap-3">
            <div class="min-w-0">
                <p class="text-xs font-bold text-{{ $color }}-600 uppercase tracking-widest mb-1">
                    {{ $staff->role_label }} Dashboard
                </p>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900 truncate">{{ $user->name }}</h1>
                @if($staff->assigned_area)
                <p class="text-sm text-slate-500 mt-0.5 flex items-center gap-1.5 flex-wrap">
                    <i class="fas fa-map-marker-alt text-{{ $color }}-500 text-xs shrink-0"></i>
                    <span>Area: <span class="font-semibold text-slate-700">{{ $staff->assigned_area }}</span>
                    @if($staff->assigned_state) · {{ $staff->assigned_state }} @endif</span>
                </p>
                @endif
            </div>
            <div class="flex flex-col items-end gap-1.5 shrink-0">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold
                    {{ $staff->status === 'active' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                    <span class="w-1.5 h-1.5 rounded-full {{ $staff->status === 'active' ? 'bg-emerald-500' : 'bg-amber-500' }} animate-pulse"></span>
                    {{ ucfirst($staff->status) }}
                </span>
                @if($staff->parent)
                <span class="text-xs text-slate-400 text-right">Reports to:<br><span class="font-semibold text-slate-600">{{ $staff->parent->user?->name }}</span></span>
                @endif
            </div>
        </div>
    </div>

    {{-- ── KPI STRIP ── --}}
    <div class="grid grid-cols-2 gap-3 mb-5">

        {{-- Sellers in area --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-{{ $color }}-50 flex items-center justify-center shrink-0">
                    <i class="fas fa-store text-{{ $color }}-600 text-sm"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-slate-900">{{ $activeSellers }}</p>
                    <p class="text-xs text-slate-500">Sellers in Area</p>
                </div>
            </div>
        </div>

        {{-- Total Leads --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center shrink-0">
                    <i class="fas fa-bolt text-indigo-600 text-sm"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-slate-900">{{ $totalLeads }}</p>
                    <p class="text-xs text-slate-500">Total Leads</p>
                </div>
            </div>
        </div>

        {{-- Paid Leads --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center shrink-0">
                    <i class="fas fa-circle-check text-emerald-600 text-sm"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-emerald-600">{{ $paidCount }}</p>
                    <p class="text-xs text-slate-500">Paid Leads</p>
                </div>
            </div>
        </div>

        {{-- Unpaid Leads --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center shrink-0">
                    <i class="fas fa-clock text-amber-500 text-sm"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-amber-500">{{ $unpaidCount }}</p>
                    <p class="text-xs text-slate-500">Pending Leads</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ── COMMISSION CARD ── --}}
    <div class="bg-gradient-to-br from-{{ $color }}-600 to-{{ $color }}-800 rounded-3xl text-white p-6 mb-5 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-48 h-48 bg-white/5 rounded-full -translate-y-16 translate-x-16"></div>
        <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/5 rounded-full translate-y-10 -translate-x-10"></div>

        <div class="relative">
            <p class="text-xs font-bold uppercase tracking-widest text-white/70 mb-1">Commission Rate</p>
            <p class="text-4xl font-bold mb-4">{{ $staff->commission_rate }}%
                <span class="text-base font-normal text-white/60">per paid lead</span>
            </p>

            <div class="grid grid-cols-2 gap-4">
                {{-- Received --}}
                <div class="bg-white/15 backdrop-blur rounded-2xl p-4">
                    <div class="flex items-center gap-1.5 mb-1">
                        <i class="fas fa-circle-check text-emerald-300 text-xs"></i>
                        <span class="text-xs font-bold text-white/80 uppercase tracking-wide">Received</span>
                    </div>
                    <p class="text-2xl font-bold">${{ number_format($commissionReceived, 2) }}</p>
                    <p class="text-xs text-white/60 mt-0.5">From ${{ number_format($totalRevenue, 0) }} paid leads</p>
                    <div class="mt-2 h-1 bg-white/20 rounded-full">
                        <div class="h-1 bg-emerald-400 rounded-full" style="width:{{ $receivedPct }}%"></div>
                    </div>
                </div>

                {{-- Pending --}}
                <div class="bg-white/15 backdrop-blur rounded-2xl p-4">
                    <div class="flex items-center gap-1.5 mb-1">
                        <i class="fas fa-clock text-amber-300 text-xs"></i>
                        <span class="text-xs font-bold text-white/80 uppercase tracking-wide">Pending</span>
                    </div>
                    <p class="text-2xl font-bold">${{ number_format($commissionPending, 2) }}</p>
                    <p class="text-xs text-white/60 mt-0.5">From ${{ number_format($pendingRevenue, 0) }} unpaid leads</p>
                    <div class="mt-2 h-1 bg-white/20 rounded-full">
                        <div class="h-1 bg-amber-400 rounded-full" style="width:{{ 100 - $receivedPct }}%"></div>
                    </div>
                </div>
            </div>

            <div class="mt-4 pt-4 border-t border-white/20 flex items-center justify-between">
                <span class="text-xs text-white/60">Total Commission (all time)</span>
                <span class="text-lg font-bold">${{ number_format($totalCommission, 2) }}</span>
            </div>
        </div>
    </div>

    {{-- ── MONTHLY CHART ── --}}
    @if(array_sum(array_column($monthly, 'leads')) > 0)
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-5 mb-5">
        <p class="text-sm font-bold text-slate-700 mb-4">Monthly Overview (Last 6 Months)</p>
        <div class="flex items-end gap-2 h-24">
            @php $maxLeads = max(array_merge(array_column($monthly,'leads'),[1])); @endphp
            @foreach($monthly as $month => $data)
            <div class="flex-1 flex flex-col items-center gap-1">
                <span class="text-[10px] text-slate-400 font-semibold">{{ $data['leads'] }}</span>
                <div class="w-full rounded-t-lg bar bg-{{ $color }}-500"
                     style="height:{{ max(4, round($data['leads']/$maxLeads*80)) }}px"></div>
                <span class="text-[10px] text-slate-400">{{ $month }}</span>
            </div>
            @endforeach
        </div>
        <div class="mt-3 grid grid-cols-3 gap-2 pt-3 border-t border-slate-100 text-center">
            @php
                $totalMonthLeads = array_sum(array_column($monthly, 'leads'));
                $totalMonthRev   = array_sum(array_column($monthly, 'revenue'));
                $totalMonthComm  = array_sum(array_column($monthly, 'commission'));
            @endphp
            <div>
                <p class="text-base font-bold text-slate-800">{{ $totalMonthLeads }}</p>
                <p class="text-[11px] text-slate-500">Leads</p>
            </div>
            <div>
                <p class="text-base font-bold text-emerald-600">${{ number_format($totalMonthRev, 0) }}</p>
                <p class="text-[11px] text-slate-500">Revenue</p>
            </div>
            <div>
                <p class="text-base font-bold text-{{ $color }}-600">${{ number_format($totalMonthComm, 2) }}</p>
                <p class="text-[11px] text-slate-500">Commission</p>
            </div>
        </div>
    </div>
    @endif

    {{-- ── SELLERS TABLE ── --}}
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-5 mb-5">
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm font-bold text-slate-700">Sellers in Your Area</p>
            <span class="text-xs bg-{{ $color }}-100 text-{{ $color }}-700 font-bold px-2.5 py-1 rounded-full">{{ $activeSellers }}</span>
        </div>

        @forelse($sellers as $seller)
        @php
            $sellerLeads   = $leads->where('seller_id', $seller->id);
            $sellerPaid    = $sellerLeads->filter(fn($l) => $l->paid_at !== null);
            $sellerPending = $sellerLeads->filter(fn($l) => $l->paid_at === null);
            $sellerComm    = round($sellerPaid->sum('fee') * ($staff->commission_rate / 100), 2);
        @endphp
        <div class="flex items-center gap-3 py-3 border-b border-slate-50 last:border-0">
            <img src="{{ asset($seller->profile_photo ?? '') }}" alt="{{ $seller->name }}"
                 class="w-10 h-10 rounded-xl object-cover border border-slate-100 shrink-0"
                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($seller->name) }}&background=2563eb&color=fff&size=80'">
            <div class="flex-1 min-w-0">
                <p class="text-sm font-bold text-slate-800 truncate">{{ $seller->name }}</p>
                <p class="text-xs text-slate-400 truncate">{{ $seller->city ?? '' }}{{ $seller->zip_code ? ' · '.$seller->zip_code : '' }}</p>
            </div>
            <div class="text-right shrink-0">
                <div class="flex items-center gap-2 text-xs">
                    <span class="bg-emerald-50 text-emerald-700 font-bold px-2 py-0.5 rounded-lg">{{ $sellerPaid->count() }} paid</span>
                    @if($sellerPending->count())
                    <span class="bg-amber-50 text-amber-600 font-bold px-2 py-0.5 rounded-lg">{{ $sellerPending->count() }} pending</span>
                    @endif
                </div>
                <p class="text-xs font-bold text-{{ $color }}-600 mt-1">${{ number_format($sellerComm, 2) }} comm.</p>
            </div>
        </div>
        @empty
        <div class="text-center py-8 text-slate-400">
            <i class="fas fa-store text-2xl mb-2 opacity-30"></i>
            <p class="text-sm">No sellers found in your assigned area.</p>
        </div>
        @endforelse
    </div>

    {{-- ── RECENT LEADS ── --}}
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-5">
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm font-bold text-slate-700">Recent Leads</p>
            <span class="text-xs bg-slate-100 text-slate-600 font-bold px-2.5 py-1 rounded-full">{{ $totalLeads }} total</span>
        </div>

        @forelse($recentLeads as $lead)
        <div class="flex items-center gap-3 py-3 border-b border-slate-50 last:border-0">
            <div class="w-9 h-9 rounded-xl {{ $lead->paid_at ? 'bg-emerald-100' : 'bg-amber-100' }} flex items-center justify-center shrink-0">
                <i class="fas {{ $lead->paid_at ? 'fa-circle-check text-emerald-600' : 'fa-clock text-amber-500' }} text-sm"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-bold text-slate-800 truncate">{{ $lead->name }}</p>
                <p class="text-xs text-slate-400 truncate">{{ $lead->seller?->name ?? '—' }} · {{ $lead->service ?? 'General' }}</p>
            </div>
            <div class="text-right shrink-0">
                <p class="text-sm font-bold {{ $lead->paid_at ? 'text-emerald-600' : 'text-amber-500' }}">${{ number_format($lead->fee, 0) }}</p>
                <p class="text-[10px] text-slate-400">{{ $lead->paid_at ? 'Paid' : 'Pending' }}</p>
                @if($staff->commission_rate > 0)
                <p class="text-[10px] font-semibold text-{{ $color }}-500">
                    +${{ number_format($lead->fee * ($staff->commission_rate/100), 2) }} comm
                    {{ $lead->paid_at ? '' : '(pending)' }}
                </p>
                @endif
            </div>
        </div>
        @empty
        <div class="text-center py-8 text-slate-400">
            <i class="fas fa-bolt text-2xl mb-2 opacity-30"></i>
            <p class="text-sm">No leads yet from your area sellers.</p>
        </div>
        @endforelse
    </div>

    {{-- ── BASE SALARY NOTE ── --}}
    @if($staff->base_salary > 0)
    <div class="mt-4 bg-slate-800 rounded-2xl p-4 flex items-center gap-3">
        <div class="w-9 h-9 rounded-xl bg-white/10 flex items-center justify-center shrink-0">
            <i class="fas fa-wallet text-white text-sm"></i>
        </div>
        <div>
            <p class="text-white text-sm font-bold">Base Salary: ${{ number_format($staff->base_salary, 0) }}/mo</p>
            <p class="text-slate-400 text-xs">Fixed monthly pay + commission on top</p>
        </div>
    </div>
    @endif

</div>
</div>

@endsection
