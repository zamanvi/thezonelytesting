@extends('frontend.layouts._app')
@section('title', 'My Bookings & Inquiries')
@section('content')
<div class="min-h-screen bg-slate-50 pt-20 pb-16 px-4">
    <div class="max-w-2xl mx-auto py-6">

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('buyer.dashboard') }}" class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-100 transition">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
            <h1 class="text-xl font-bold text-slate-900">My Bookings & Inquiries</h1>
        </div>

        {{-- Filter Tabs --}}
        <div class="flex gap-2 mb-5 overflow-x-auto pb-1 scroll-hide">
            <button onclick="filterBookings(this,'all')" class="book-tab active-tab shrink-0 px-4 py-2 rounded-xl text-xs font-bold bg-teal-700 text-white whitespace-nowrap">All</button>
            <button onclick="filterBookings(this,'active')" class="book-tab shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 whitespace-nowrap transition">Active</button>
            <button onclick="filterBookings(this,'won')" class="book-tab shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 whitespace-nowrap transition">Completed</button>
            <button onclick="filterBookings(this,'lost')" class="book-tab shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 whitespace-nowrap transition">Cancelled</button>
        </div>

        <div class="space-y-3" id="bookingList">
            @forelse($bookings as $lead)
            @php
                $isActive    = in_array($lead->status, ['new','pending']);
                $isCompleted = $lead->status === 'won';
                $isCancelled = $lead->status === 'lost';
                $tabStatus   = $isActive ? 'active' : ($isCompleted ? 'won' : 'lost');
                $statusLabel = $isActive ? 'Active' : ($isCompleted ? 'Completed' : 'Cancelled');
                $statusClass = $isActive
                    ? 'bg-amber-100 text-amber-700'
                    : ($isCompleted ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-500');
                $initials = strtoupper(substr($lead->seller?->name ?? 'PR', 0, 2));
            @endphp
            <div class="booking-card bg-white rounded-2xl border border-slate-100 shadow-sm p-5"
                 data-status="{{ $tabStatus }}">
                <div class="flex items-start justify-between gap-4 mb-3">
                    <div class="flex items-start gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-teal-100 flex items-center justify-center shrink-0 font-bold text-teal-700 text-sm">
                            {{ $initials }}
                        </div>
                        <div>
                            <p class="font-bold text-slate-900">{{ $lead->seller?->name ?? 'Professional' }}</p>
                            <p class="text-xs text-slate-500 mt-0.5">{{ $lead->service ?? 'General Inquiry' }}</p>
                            <p class="text-[10px] text-slate-400 mt-1">
                                <i class="fa-solid fa-calendar mr-1"></i>
                                {{ $lead->created_at?->format('D, M d Y') }}
                            </p>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold px-2.5 py-1 rounded-full shrink-0 {{ $statusClass }}">
                        {{ $statusLabel }}
                    </span>
                </div>

                @if($lead->message)
                <p class="text-xs text-slate-400 italic mb-3 pl-15">"{{ Str::limit($lead->message, 80) }}"</p>
                @endif

                <div class="flex gap-2">
                    @if($lead->seller?->phone && $isActive)
                    <a href="tel:{{ $lead->seller->phone }}"
                       class="flex-1 py-2.5 rounded-xl text-xs font-bold bg-teal-50 text-teal-700 hover:bg-teal-100 transition text-center">
                        <i class="fa-solid fa-phone mr-1"></i> Call
                    </a>
                    @endif
                    @if($isActive)
                    <button onclick="cancelBooking({{ $lead->id }}, this)"
                        class="flex-1 py-2.5 rounded-xl text-xs font-bold bg-red-50 text-red-500 hover:bg-red-100 transition">
                        Cancel
                    </button>
                    @endif
                    @if($lead->seller)
                    <a href="{{ route('frontend.service.show', $lead->seller->slug ?? $lead->seller->id) }}"
                       class="py-2.5 px-4 rounded-xl text-xs font-bold bg-slate-50 text-slate-500 hover:bg-slate-100 transition">
                        Profile
                    </a>
                    @endif
                </div>
            </div>
            @empty
            <div class="bg-white rounded-2xl border-2 border-dashed border-slate-200 p-12 text-center">
                <div class="w-16 h-16 bg-teal-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-calendar text-teal-400 text-2xl"></i>
                </div>
                <p class="font-bold text-slate-700 mb-1">No bookings yet</p>
                <p class="text-sm text-slate-400 mb-5">Browse professionals and book a service to get started.</p>
                <a href="{{ route('frontend.service.all') }}"
                   class="inline-flex items-center gap-2 bg-teal-700 hover:bg-teal-800 text-white font-bold px-5 py-2.5 rounded-2xl text-sm transition">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i> Find Professionals
                </a>
            </div>
            @endforelse
        </div>

        @if($bookings->hasPages())
        <div class="mt-8">
            {{ $bookings->links() }}
        </div>
        @endif

    </div>
</div>

<style>
    .scroll-hide { -ms-overflow-style:none; scrollbar-width:none; }
    .scroll-hide::-webkit-scrollbar { display:none; }
</style>

<script>
function filterBookings(btn, status) {
    document.querySelectorAll('.book-tab').forEach(b => {
        b.className = 'book-tab shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 whitespace-nowrap transition';
    });
    btn.className = 'book-tab active-tab shrink-0 px-4 py-2 rounded-xl text-xs font-bold bg-teal-700 text-white whitespace-nowrap';
    document.querySelectorAll('.booking-card').forEach(card => {
        card.style.display = (status === 'all' || card.dataset.status === status) ? '' : 'none';
    });
}

function cancelBooking(id, btn) {
    if (!confirm('Cancel this inquiry?')) return;
    btn.disabled = true;
    fetch('/buyer/bookings/' + id + '/cancel', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content || '' }
    })
    .then(r => r.ok ? location.reload() : Promise.reject())
    .catch(() => { btn.disabled = false; alert('Failed. Please try again.'); });
}
</script>
@endsection
