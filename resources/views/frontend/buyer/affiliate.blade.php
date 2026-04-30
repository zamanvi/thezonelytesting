@extends('frontend.layouts._app')
@section('title', 'Affiliate — Earn with Zonely')

@section('content')
<div class="min-h-screen bg-slate-50 pt-20 pb-16 px-4">
<div class="max-w-3xl mx-auto py-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Earn with Zonely</h1>
            <p class="text-sm text-slate-500 mt-0.5">Refer local businesses — earn cash when they get leads</p>
        </div>
        <a href="{{ route('buyer.dashboard') }}"
           class="text-xs font-bold text-slate-500 border border-slate-200 bg-white px-3 py-2 rounded-xl hover:border-blue-300 hover:text-blue-600 transition">
            ← Dashboard
        </a>
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-6">
        <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm text-center">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Referrals</p>
            <p class="text-3xl font-black text-slate-900">{{ $stats['referrals'] }}</p>
        </div>
        <div class="bg-blue-600 rounded-2xl p-4 text-white text-center shadow-sm">
            <p class="text-[10px] font-bold opacity-70 uppercase tracking-widest mb-1">Total Earned</p>
            <p class="text-3xl font-black">${{ number_format($stats['earned'], 2) }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm text-center">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Pending</p>
            <p class="text-3xl font-black text-amber-500">${{ number_format($stats['pending'], 2) }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm text-center">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Paid Out</p>
            <p class="text-3xl font-black text-emerald-600">${{ number_format($stats['paid_out'], 2) }}</p>
        </div>
    </div>

    {{-- How it works --}}
    <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-3xl p-6 mb-6 text-white">
        <h2 class="font-bold text-lg mb-4">How it works</h2>
        <div class="grid grid-cols-3 gap-4 text-center">
            <div>
                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-2">
                    <i class="fa-solid fa-link text-white"></i>
                </div>
                <p class="text-xs font-bold text-blue-100">1. Share your link</p>
                <p class="text-[10px] text-blue-200 mt-0.5">Send to any local business owner</p>
            </div>
            <div>
                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-2">
                    <i class="fa-solid fa-user-plus text-white"></i>
                </div>
                <p class="text-xs font-bold text-blue-100">2. They sign up</p>
                <p class="text-[10px] text-blue-200 mt-0.5">Business joins Zonely as seller</p>
            </div>
            <div>
                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-2">
                    <i class="fa-solid fa-dollar-sign text-white"></i>
                </div>
                <p class="text-xs font-bold text-blue-100">3. You earn $10</p>
                <p class="text-[10px] text-blue-200 mt-0.5">When they receive first lead</p>
            </div>
        </div>
    </div>

    {{-- Referral link --}}
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-6">
        <h2 class="font-bold text-slate-900 mb-1">Your Referral Link</h2>
        <p class="text-xs text-slate-500 mb-4">
            Share this link with business owners. Earn
            <strong class="text-blue-600">$10</strong>
            for every business that joins and receives their first lead.
        </p>
        <div class="flex gap-2">
            <input type="text" id="refLink"
                   value="{{ url('/user/register/seller?ref=' . ($user->slug ?? $user->id)) }}"
                   readonly
                   class="flex-1 text-sm bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none text-slate-600 font-mono">
            <button onclick="copyRef()"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-3 rounded-2xl text-sm transition shrink-0">
                <i class="fa-solid fa-copy mr-1"></i> Copy
            </button>
        </div>

        {{-- Share buttons --}}
        @php $refUrl = url('/user/register/seller?ref=' . ($user->slug ?? $user->id)); @endphp
        <div class="flex flex-wrap gap-3 mt-4">
            <a href="https://wa.me/?text={{ urlencode('Know a local business? Join Zonely and get customers sent to you! Sign up here: ' . $refUrl) }}"
               target="_blank"
               class="flex items-center gap-2 text-xs font-bold text-emerald-600 bg-emerald-50 border border-emerald-100 px-4 py-2.5 rounded-xl hover:bg-emerald-100 transition">
                <i class="fab fa-whatsapp"></i> WhatsApp
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($refUrl) }}"
               target="_blank"
               class="flex items-center gap-2 text-xs font-bold text-blue-600 bg-blue-50 border border-blue-100 px-4 py-2.5 rounded-xl hover:bg-blue-100 transition">
                <i class="fab fa-facebook"></i> Facebook
            </a>
            <a href="mailto:?subject={{ urlencode('Grow your local business with Zonely') }}&body={{ urlencode('Hi! I found this platform that sends customers directly to local businesses. Check it out: ' . $refUrl) }}"
               class="flex items-center gap-2 text-xs font-bold text-slate-600 bg-slate-50 border border-slate-200 px-4 py-2.5 rounded-xl hover:bg-slate-100 transition">
                <i class="fa-solid fa-envelope"></i> Email
            </a>
            <a href="sms:?body={{ urlencode('Join Zonely — get customers sent to your business: ' . $refUrl) }}"
               class="flex items-center gap-2 text-xs font-bold text-slate-600 bg-slate-50 border border-slate-200 px-4 py-2.5 rounded-xl hover:bg-slate-100 transition">
                <i class="fa-solid fa-comment-sms"></i> SMS
            </a>
        </div>
    </div>

    {{-- Referral history --}}
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm mb-6">
        <div class="px-6 pt-5 pb-4 border-b border-slate-100">
            <h2 class="font-bold text-slate-900">Referral History</h2>
            <p class="text-xs text-slate-500 mt-0.5">Businesses that signed up using your link</p>
        </div>

        @forelse($commissions as $commission)
        @php
            $isPaid = $commission->status === 'paid';
        @endphp
        <div class="flex items-center gap-4 px-6 py-4 border-b border-slate-50 last:border-0">
            <div class="w-10 h-10 rounded-xl {{ $isPaid ? 'bg-emerald-100' : 'bg-amber-100' }} flex items-center justify-center font-bold text-sm {{ $isPaid ? 'text-emerald-600' : 'text-amber-600' }} shrink-0">
                {{ strtoupper(substr($commission->referredUser?->name ?? 'B', 0, 2)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-bold text-sm text-slate-900 truncate">{{ $commission->referredUser?->name ?? 'Business' }}</p>
                <p class="text-xs text-slate-400">Joined {{ $commission->created_at->format('M d, Y') }}</p>
            </div>
            <div class="text-right shrink-0">
                <p class="font-black text-sm {{ $isPaid ? 'text-emerald-600' : 'text-amber-500' }}">${{ number_format($commission->amount, 2) }}</p>
                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full {{ $isPaid ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                    {{ ucfirst($commission->status) }}
                </span>
            </div>
        </div>
        @empty
        <div class="px-6 py-12 text-center">
            <i class="fa-solid fa-share-nodes text-4xl text-slate-200 mb-3"></i>
            <p class="text-sm font-semibold text-slate-400">No referrals yet</p>
            <p class="text-xs text-slate-400 mt-1">Share your link above to start earning</p>
        </div>
        @endforelse
    </div>

    {{-- Payout info --}}
    <div class="bg-slate-100 rounded-2xl px-5 py-4 text-xs text-slate-500 flex items-start gap-3">
        <i class="fa-solid fa-circle-info text-slate-400 mt-0.5 shrink-0"></i>
        <p>Commissions are reviewed and paid by Zonely admin monthly. Pending commissions become paid once the referred business receives their first verified lead.</p>
    </div>

</div>
</div>

@section('scripts')
<script>
function copyRef() {
    const input = document.getElementById('refLink');
    navigator.clipboard.writeText(input.value).then(() => {
        const btn = event.currentTarget;
        btn.innerHTML = '<i class="fa-solid fa-check mr-1"></i> Copied!';
        btn.classList.replace('bg-blue-600', 'bg-emerald-600');
        setTimeout(() => {
            btn.innerHTML = '<i class="fa-solid fa-copy mr-1"></i> Copy';
            btn.classList.replace('bg-emerald-600', 'bg-blue-600');
        }, 2000);
    });
}
</script>
@endsection
@endsection
