@extends('frontend.layouts._app')
@section('title', 'My Bookings')
@section('content')
<div class="min-h-screen bg-slate-50 pt-20 pb-16 px-4">
    <div class="max-w-2xl mx-auto py-6">

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('buyer.dashboard') ?? '#' }}" class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-100 transition">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
            <h1 class="text-xl font-bold text-slate-900">My Bookings</h1>
        </div>

        {{-- Filter Tabs --}}
        <div class="flex gap-2 mb-5 overflow-x-auto pb-1 scroll-hide">
            <button onclick="filterBookings(this,'all')" class="book-tab active-tab shrink-0 px-4 py-2 rounded-xl text-xs font-bold bg-teal-700 text-white whitespace-nowrap">All</button>
            <button onclick="filterBookings(this,'upcoming')" class="book-tab shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 whitespace-nowrap transition">Upcoming</button>
            <button onclick="filterBookings(this,'completed')" class="book-tab shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 whitespace-nowrap transition">Completed</button>
            <button onclick="filterBookings(this,'cancelled')" class="book-tab shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 whitespace-nowrap transition">Cancelled</button>
        </div>

        <div class="space-y-3" id="bookingList">

            @forelse($bookings ?? [] as $booking)
            <div class="booking-card bg-white rounded-2xl border border-slate-100 shadow-sm p-5"
                 data-status="{{ $booking->status }}">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-start gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-teal-100 flex items-center justify-center shrink-0 font-bold text-teal-700">
                            {{ strtoupper(substr($booking->seller->name ?? 'PR', 0, 2)) }}
                        </div>
                        <div>
                            <p class="font-bold text-slate-900">{{ $booking->seller->name ?? 'Professional' }}</p>
                            <p class="text-xs text-slate-500 mt-0.5">{{ $booking->service ?? 'Service' }}</p>
                            <p class="text-xs text-slate-400 mt-1">
                                <i class="fa-solid fa-calendar mr-1"></i>
                                {{ \Carbon\Carbon::parse($booking->date)->format('D, M d Y') }}
                                &nbsp;·&nbsp;
                                <i class="fa-solid fa-clock mr-1"></i>
                                {{ $booking->slot_time }}
                            </p>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold px-2.5 py-1 rounded-full shrink-0
                        {{ $booking->status === 'upcoming' ? 'bg-teal-100 text-teal-800' : ($booking->status === 'completed' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-500') }}">
                        {{ ucfirst($booking->status) }}
                    </span>
                </div>

                @if($booking->message)
                <p class="text-xs text-slate-500 mt-3 pl-15 italic">"{{ $booking->message }}"</p>
                @endif

                <div class="flex gap-2 mt-4">
                    @if($booking->status === 'upcoming')
                    <a href="tel:{{ $booking->seller->phone ?? '' }}"
                       class="flex-1 py-2.5 rounded-xl text-xs font-bold bg-teal-50 text-teal-700 hover:bg-teal-100 transition text-center">
                        <i class="fa-solid fa-phone mr-1"></i> Call
                    </a>
                    <button onclick="cancelBooking({{ $booking->id }})"
                        class="flex-1 py-2.5 rounded-xl text-xs font-bold bg-red-50 text-red-500 hover:bg-red-100 transition">
                        Cancel
                    </button>
                    @elseif($booking->status === 'completed' && !$booking->review_id)
                    <a href="{{ route('buyer.review', $booking->id) ?? '#' }}"
                       class="flex-1 py-2.5 rounded-xl text-xs font-bold bg-amber-50 text-amber-600 hover:bg-amber-100 transition text-center">
                        <i class="fa-solid fa-star mr-1"></i> Leave Review
                    </a>
                    @elseif($booking->status === 'completed' && $booking->review_id)
                    <span class="flex-1 py-2.5 rounded-xl text-xs font-bold bg-emerald-50 text-emerald-600 text-center">
                        <i class="fa-solid fa-check mr-1"></i> Reviewed
                    </span>
                    @endif
                    <a href="{{ route('frontend.service.show', $booking->seller->slug ?? $booking->seller->id ?? '#') }}"
                       class="py-2.5 px-4 rounded-xl text-xs font-bold bg-slate-50 text-slate-500 hover:bg-slate-100 transition">
                        Profile
                    </a>
                </div>
            </div>
            @empty
            {{-- Demo bookings --}}
            @foreach([
                ['init'=>'JL','name'=>'James Law Office','service'=>'Business Contract Review','date'=>'Apr 25, 2026','slot'=>'10:00 AM','status'=>'upcoming','reviewed'=>false],
                ['init'=>'TK','name'=>'TK Tax Services','service'=>'Personal Tax Return','date'=>'Apr 19, 2026','slot'=>'2:00 PM','status'=>'completed','reviewed'=>false],
                ['init'=>'AP','name'=>'AllPro Plumbing','service'=>'Emergency Pipe Repair','date'=>'Apr 10, 2026','slot'=>'9:00 AM','status'=>'completed','reviewed'=>true],
                ['init'=>'EC','name'=>'Elite Cleaning Co.','service'=>'Deep Home Cleaning','date'=>'Apr 5, 2026','slot'=>'11:00 AM','status'=>'cancelled','reviewed'=>false],
            ] as $b)
            <div class="booking-card bg-white rounded-2xl border border-slate-100 shadow-sm p-5" data-status="{{ $b['status'] }}">
                <div class="flex items-start justify-between gap-4">
                    <div class="flex items-start gap-3">
                        <div class="w-12 h-12 rounded-2xl bg-teal-100 flex items-center justify-center shrink-0 font-bold text-teal-700">{{ $b['init'] }}</div>
                        <div>
                            <p class="font-bold text-slate-900">{{ $b['name'] }}</p>
                            <p class="text-xs text-slate-500 mt-0.5">{{ $b['service'] }}</p>
                            <p class="text-xs text-slate-400 mt-1"><i class="fa-solid fa-calendar mr-1"></i>{{ $b['date'] }} · <i class="fa-solid fa-clock mr-1"></i>{{ $b['slot'] }}</p>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold px-2.5 py-1 rounded-full shrink-0
                        {{ $b['status']==='upcoming' ? 'bg-teal-100 text-teal-800' : ($b['status']==='completed' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-500') }}">
                        {{ ucfirst($b['status']) }}
                    </span>
                </div>
                <div class="flex gap-2 mt-4">
                    @if($b['status']==='upcoming')
                    <button class="flex-1 py-2.5 rounded-xl text-xs font-bold bg-teal-50 text-teal-700 hover:bg-teal-100 transition text-center">
                        <i class="fa-solid fa-phone mr-1"></i> Call
                    </button>
                    <button class="flex-1 py-2.5 rounded-xl text-xs font-bold bg-red-50 text-red-500 hover:bg-red-100 transition">Cancel</button>
                    @elseif($b['status']==='completed' && !$b['reviewed'])
                    <button class="flex-1 py-2.5 rounded-xl text-xs font-bold bg-amber-50 text-amber-600 hover:bg-amber-100 transition">
                        <i class="fa-solid fa-star mr-1"></i> Leave Review
                    </button>
                    @elseif($b['status']==='completed' && $b['reviewed'])
                    <span class="flex-1 py-2.5 rounded-xl text-xs font-bold bg-emerald-50 text-emerald-600 text-center">
                        <i class="fa-solid fa-check mr-1"></i> Reviewed
                    </span>
                    @endif
                    <button class="py-2.5 px-4 rounded-xl text-xs font-bold bg-slate-50 text-slate-500 hover:bg-slate-100 transition">Profile</button>
                </div>
            </div>
            @endforeach
            @endforelse

        </div>
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

function cancelBooking(id) {
    if (!confirm('Cancel this booking?')) return;
    fetch('/buyer/bookings/' + id + '/cancel', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content || '' }
    }).then(() => location.reload());
}
</script>
@endsection
