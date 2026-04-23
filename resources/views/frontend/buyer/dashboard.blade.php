@extends('frontend.layouts._app')
@section('title', 'My Dashboard')
@section('content')
<div class="min-h-screen bg-slate-50 pt-20 pb-16 px-4">
    <div class="max-w-3xl mx-auto py-6">

        {{-- Welcome --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-xl font-bold text-slate-900">Hello, {{ explode(' ', auth()->user()->name)[0] }} 👋</h1>
                <p class="text-sm text-slate-500 mt-0.5">Find and book local experts near you</p>
            </div>
            <a href="{{ route('buyer.profile') ?? '#' }}" class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </a>
        </div>

        {{-- Search --}}
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm flex items-center gap-3 px-4 py-3.5 mb-6">
            <i class="fa-solid fa-magnifying-glass text-slate-300"></i>
            <input type="text" placeholder="Search for a service or professional..."
                class="flex-1 text-sm focus:outline-none text-slate-700 placeholder-slate-400"
                onkeydown="if(event.key==='Enter') window.location='{{ route('frontend.service.search') ?? '#' }}?q='+this.value">
            <a href="{{ route('frontend.service.all') ?? '#' }}" class="text-xs font-bold text-blue-600 whitespace-nowrap">Browse all →</a>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-3 gap-2 sm:gap-3 mb-6">
            <div class="bg-white rounded-2xl border border-slate-100 p-3 sm:p-4 shadow-sm text-center">
                <p class="text-xl sm:text-2xl font-black text-blue-600">{{ $stats['bookings'] ?? 0 }}</p>
                <p class="text-[10px] sm:text-xs text-slate-500 font-semibold mt-0.5">Bookings</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-100 p-3 sm:p-4 shadow-sm text-center">
                <p class="text-xl sm:text-2xl font-black text-emerald-600">{{ $stats['completed'] ?? 0 }}</p>
                <p class="text-[10px] sm:text-xs text-slate-500 font-semibold mt-0.5">Completed</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-100 p-3 sm:p-4 shadow-sm text-center">
                <p class="text-xl sm:text-2xl font-black text-amber-500">{{ $stats['reviews'] ?? 0 }}</p>
                <p class="text-[10px] sm:text-xs text-slate-500 font-semibold mt-0.5">Reviews</p>
            </div>
        </div>

        {{-- Upcoming Bookings --}}
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm mb-6">
            <div class="flex items-center justify-between p-5 border-b border-slate-100">
                <h2 class="font-bold text-slate-900">Upcoming Bookings</h2>
                <a href="{{ route('buyer.bookings') ?? '#' }}" class="text-xs font-bold text-blue-600 hover:underline">View all →</a>
            </div>
            @if(isset($upcomingBookings) && $upcomingBookings->count())
                @foreach($upcomingBookings as $booking)
                <div class="px-5 py-4 flex items-center gap-4 border-b border-slate-50 last:border-0">
                    <div class="w-11 h-11 bg-blue-100 rounded-xl flex items-center justify-center shrink-0 font-bold text-blue-600 text-sm">
                        {{ strtoupper(substr($booking->seller->name ?? 'PR', 0, 2)) }}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-bold text-sm text-slate-900">{{ $booking->seller->name ?? 'Professional' }}</p>
                        <p class="text-xs text-slate-500">{{ $booking->service ?? 'Service' }} · {{ $booking->slot_time }}</p>
                    </div>
                    <div class="text-right shrink-0">
                        <p class="text-xs font-bold text-slate-900">{{ \Carbon\Carbon::parse($booking->date)->format('M d') }}</p>
                        <span class="text-[10px] bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full font-bold">Upcoming</span>
                    </div>
                </div>
                @endforeach
            @else
            <div class="p-10 text-center">
                <i class="fa-solid fa-calendar-xmark text-4xl text-slate-200 mb-3"></i>
                <p class="font-semibold text-slate-400 text-sm">No upcoming bookings</p>
                <a href="{{ route('frontend.service.all') ?? '#' }}" class="inline-block mt-3 bg-blue-600 text-white font-bold px-5 py-2.5 rounded-2xl text-sm hover:bg-blue-700 transition">
                    Find a Professional
                </a>
            </div>
            @endif
        </div>

        {{-- Pending Reviews --}}
        @if(isset($pendingReviews) && $pendingReviews->count())
        <div class="bg-white rounded-3xl border border-amber-100 shadow-sm mb-6">
            <div class="p-5 border-b border-amber-100">
                <h2 class="font-bold text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-star text-amber-500 text-sm"></i> Leave a Review
                </h2>
                <p class="text-xs text-slate-500 mt-0.5">You have {{ $pendingReviews->count() }} completed booking(s) awaiting a review</p>
            </div>
            @foreach($pendingReviews as $booking)
            <div class="px-5 py-4 flex items-center gap-4 border-b border-slate-50 last:border-0">
                <div class="w-11 h-11 bg-amber-100 rounded-xl flex items-center justify-center shrink-0 font-bold text-amber-600 text-sm">
                    {{ strtoupper(substr($booking->seller->name ?? 'PR', 0, 2)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-bold text-sm text-slate-900">{{ $booking->seller->name ?? 'Professional' }}</p>
                    <p class="text-xs text-slate-500">{{ $booking->service ?? 'Service' }} · {{ \Carbon\Carbon::parse($booking->date)->format('M d') }}</p>
                </div>
                <a href="{{ route('buyer.review', $booking->id) ?? '#' }}"
                   class="bg-amber-500 hover:bg-amber-600 text-white font-bold px-4 py-2 rounded-xl text-xs transition shrink-0">
                    Review
                </a>
            </div>
            @endforeach
        </div>
        @endif

        {{-- Quick Links --}}
        <div class="grid grid-cols-2 gap-3">
            <a href="{{ route('frontend.service.all') ?? '#' }}" class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-3 hover:border-blue-200 transition">
                <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-search text-blue-600 text-sm"></i>
                </div>
                <div>
                    <p class="font-bold text-sm text-slate-900">Find Experts</p>
                    <p class="text-xs text-slate-500">Browse all services</p>
                </div>
            </a>
            <a href="{{ route('buyer.bookings') ?? '#' }}" class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-3 hover:border-blue-200 transition">
                <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-calendar-check text-emerald-600 text-sm"></i>
                </div>
                <div>
                    <p class="font-bold text-sm text-slate-900">My Bookings</p>
                    <p class="text-xs text-slate-500">View & manage</p>
                </div>
            </a>
            <a href="{{ route('buyer.profile') ?? '#' }}" class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-3 hover:border-blue-200 transition">
                <div class="w-10 h-10 bg-purple-100 rounded-xl flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-user text-purple-600 text-sm"></i>
                </div>
                <div>
                    <p class="font-bold text-sm text-slate-900">My Profile</p>
                    <p class="text-xs text-slate-500">Edit your info</p>
                </div>
            </a>
            <a href="{{ route('frontend.help') }}" class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center gap-3 hover:border-blue-200 transition">
                <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-circle-question text-slate-500 text-sm"></i>
                </div>
                <div>
                    <p class="font-bold text-sm text-slate-900">Help & FAQ</p>
                    <p class="text-xs text-slate-500">Get support</p>
                </div>
            </a>
        </div>

    </div>
</div>
@endsection
