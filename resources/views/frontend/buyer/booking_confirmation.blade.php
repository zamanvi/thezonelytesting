@extends('frontend.layouts._app')
@section('title', 'Booking Confirmed!')
@section('content')
<div class="min-h-screen bg-slate-50 pt-20 pb-16 px-4 flex items-center justify-center">
    <div class="max-w-md mx-auto w-full py-6">

        {{-- Success Animation --}}
        <div class="text-center mb-8">
            <div class="w-24 h-24 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-5 animate-bounce-once">
                <i class="fa-solid fa-circle-check text-emerald-500 text-5xl"></i>
            </div>
            <h1 class="text-2xl font-black text-slate-900 mb-2">You're all booked!</h1>
            <p class="text-slate-500 text-sm">Your appointment has been confirmed. We'll send you a reminder before your session.</p>
        </div>

        {{-- Booking Summary Card --}}
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-5">
            <h2 class="font-bold text-slate-900 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-calendar-check text-blue-600"></i> Booking Details
            </h2>

            <div class="flex items-center gap-4 mb-5 pb-5 border-b border-slate-100">
                <div class="w-14 h-14 rounded-2xl bg-blue-600 text-white flex items-center justify-center font-bold text-lg shrink-0">
                    {{ strtoupper(substr($booking->seller->name ?? 'PR', 0, 2)) }}
                </div>
                <div>
                    <p class="font-bold text-slate-900">{{ $booking->seller->name ?? 'Professional' }}</p>
                    <p class="text-xs text-slate-500 mt-0.5">{{ $booking->service ?? 'Service' }}</p>
                </div>
            </div>

            <div class="space-y-3">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-blue-50 rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-calendar text-blue-600 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Date</p>
                        <p class="text-sm font-bold text-slate-900">
                            {{ \Carbon\Carbon::parse($booking->date ?? now())->format('l, F j, Y') }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-blue-50 rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-clock text-blue-600 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Time</p>
                        <p class="text-sm font-bold text-slate-900">{{ $booking->slot_time ?? '—' }}</p>
                    </div>
                </div>
                @if($booking->seller->phone ?? false)
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-blue-50 rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-phone text-blue-600 text-xs"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Contact</p>
                        <p class="text-sm font-bold text-slate-900">{{ $booking->seller->phone }}</p>
                    </div>
                </div>
                @endif
            </div>

            {{-- Reference Number --}}
            <div class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-between">
                <p class="text-xs text-slate-400">Booking Ref</p>
                <p class="text-xs font-black text-slate-700 tracking-widest">#BK{{ str_pad($booking->id ?? rand(1000,9999), 6, '0', STR_PAD_LEFT) }}</p>
            </div>
        </div>

        {{-- What Happens Next --}}
        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5 mb-6">
            <h3 class="font-bold text-blue-900 text-sm mb-3 flex items-center gap-2">
                <i class="fa-solid fa-circle-info text-blue-500"></i> What happens next?
            </h3>
            <div class="space-y-2.5">
                <div class="flex items-start gap-3">
                    <div class="w-5 h-5 bg-blue-600 text-white rounded-full flex items-center justify-center text-[10px] font-black shrink-0 mt-0.5">1</div>
                    <p class="text-xs text-blue-800">The professional will review your booking and confirm it.</p>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-5 h-5 bg-blue-600 text-white rounded-full flex items-center justify-center text-[10px] font-black shrink-0 mt-0.5">2</div>
                    <p class="text-xs text-blue-800">You'll receive a reminder before your appointment time.</p>
                </div>
                <div class="flex items-start gap-3">
                    <div class="w-5 h-5 bg-blue-600 text-white rounded-full flex items-center justify-center text-[10px] font-black shrink-0 mt-0.5">3</div>
                    <p class="text-xs text-blue-800">After your session, you can leave a review to help others.</p>
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="space-y-3">
            <a href="{{ route('buyer.bookings') ?? '#' }}"
               class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl text-sm text-center block transition">
                View My Bookings
            </a>
            <a href="{{ route('frontend.service.all') ?? '#' }}"
               class="w-full bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 font-bold py-4 rounded-2xl text-sm text-center block transition">
                Find Another Professional
            </a>
        </div>

    </div>
</div>

<style>
@keyframes bounce-once {
    0%, 100% { transform: translateY(0); }
    30% { transform: translateY(-18px); }
    60% { transform: translateY(-8px); }
}
.animate-bounce-once { animation: bounce-once 0.8s ease-out; }
</style>
@endsection
