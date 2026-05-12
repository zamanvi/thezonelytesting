@extends('frontend.layouts.__prof_app')
@section('title', 'My Reviews')
@section('content')
<div class="pb-10">
    <div class="max-w-2xl mx-auto py-6">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900">My Reviews</h1>
            <p class="text-sm text-slate-500 mt-0.5">What clients say about you</p>
        </div>

        {{-- Rating Summary --}}
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-5">
            <div class="flex items-center gap-6">
                <div class="text-center shrink-0">
                    <p class="text-5xl font-black text-slate-900">{{ number_format($avgRating ?? 4.8, 1) }}</p>
                    <div class="flex justify-center gap-0.5 mt-1 mb-1">
                        @for($i = 1; $i <= 5; $i++)
                        <i class="fa-solid fa-star text-sm {{ $i <= round($avgRating ?? 4.8) ? 'text-amber-400' : 'text-slate-200' }}"></i>
                        @endfor
                    </div>
                    <p class="text-xs text-slate-400">{{ $totalReviews ?? 0 }} reviews</p>
                </div>
                <div class="flex-1 space-y-1.5">
                    @foreach([5,4,3,2,1] as $star)
                    @php $pct = $ratingBreakdown[$star] ?? 0; @endphp
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] font-bold text-slate-400 w-4 text-right">{{ $star }}</span>
                        <i class="fa-solid fa-star text-[10px] text-amber-400"></i>
                        <div class="flex-1 bg-slate-100 rounded-full h-1.5 overflow-hidden">
                            <div class="h-full bg-amber-400 rounded-full" style="width:{{ $pct }}%"></div>
                        </div>
                        <span class="text-[10px] text-slate-400 w-6">{{ $pct }}%</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Filter --}}
        <div class="flex gap-2 mb-5 overflow-x-auto pb-1">
            <button onclick="filterReviews(this,'all')" class="rev-tab active-rtab shrink-0 px-4 py-2 rounded-xl text-xs font-bold bg-teal-700 text-white whitespace-nowrap">All</button>
            <button onclick="filterReviews(this,'5')" class="rev-tab shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 whitespace-nowrap transition">
                <i class="fa-solid fa-star text-amber-400"></i> 5 stars
            </button>
            <button onclick="filterReviews(this,'4')" class="rev-tab shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 whitespace-nowrap transition">
                <i class="fa-solid fa-star text-amber-400"></i> 4 stars
            </button>
            <button onclick="filterReviews(this,'low')" class="rev-tab shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 whitespace-nowrap transition">
                3 stars &amp; below
            </button>
        </div>

        {{-- Pending Review Requests --}}
        @if(isset($pendingRequests) && $pendingRequests->count())
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 mb-5">
            <p class="text-xs font-bold text-amber-700 mb-3 flex items-center gap-2">
                <i class="fa-solid fa-clock"></i> Awaiting Response ({{ $pendingRequests->count() }})
            </p>
            <div class="space-y-2">
                @foreach($pendingRequests as $req)
                <div class="flex items-center justify-between gap-3 bg-white rounded-xl p-3">
                    <div>
                        <p class="text-sm font-semibold text-slate-800">{{ $req->reviewer_name }}</p>
                        <p class="text-xs text-slate-400">{{ $req->created_at?->diffForHumans() }}</p>
                    </div>
                    <button onclick="copyReviewLink('{{ url('/r/'.$req->review_token) }}', this)"
                        class="shrink-0 px-3 py-1.5 bg-amber-100 hover:bg-amber-200 text-amber-800 text-xs font-bold rounded-lg transition">
                        <i class="fa-solid fa-copy mr-1"></i> Copy Link
                    </button>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="space-y-3" id="reviewList">
            @forelse($reviews ?? [] as $review)
            <div class="review-card bg-white rounded-2xl border border-slate-100 shadow-sm p-5"
                 data-stars="{{ $review->rating }}">
                <div class="flex items-start justify-between gap-3 mb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-teal-100 flex items-center justify-center font-bold text-teal-700 text-sm shrink-0">
                            {{ strtoupper(substr($review->reviewer_name ?? $review->reviewer?->name ?? 'AN', 0, 2)) }}
                        </div>
                        <div>
                            <p class="font-bold text-sm text-slate-900">{{ $review->reviewer_name ?? $review->reviewer?->name ?? 'Anonymous' }}</p>
                            <p class="text-xs text-slate-400">{{ $review->created_at?->format('M d, Y') }}</p>
                        </div>
                    </div>
                    <div class="flex gap-0.5 shrink-0">
                        @for($i = 1; $i <= 5; $i++)
                        <i class="fa-solid fa-star text-xs {{ $i <= $review->rating ? 'text-amber-400' : 'text-slate-200' }}"></i>
                        @endfor
                    </div>
                </div>
                <p class="text-base text-slate-700 leading-relaxed">"{{ $review->review }}"</p>
                @if($review->tags)
                <div class="flex flex-wrap gap-1.5 mt-3">
                    @foreach(explode(',', $review->tags) as $tag)
                    <span class="px-2.5 py-1 bg-teal-50 text-teal-800 text-[10px] font-bold rounded-lg">{{ trim($tag) }}</span>
                    @endforeach
                </div>
                @endif
                @if($review->reply)
                <div class="mt-3 pt-3 border-t border-slate-100">
                    <p class="text-[10px] font-bold text-slate-400 mb-1">YOUR REPLY</p>
                    <p class="text-xs text-slate-600">{{ $review->reply }}</p>
                </div>
                @else
                <button onclick="toggleReply(this, {{ $review->id }})"
                    class="mt-3 text-xs font-bold text-teal-700 hover:underline">
                    <i class="fa-solid fa-reply mr-1"></i> Reply
                </button>
                <div class="reply-box hidden mt-3">
                    <textarea rows="2" placeholder="Write a professional, friendly reply..."
                        class="w-full px-3 py-2.5 border border-slate-200 rounded-xl text-xs focus:outline-none focus:border-teal-400 resize-none"></textarea>
                    <button onclick="submitReply(this, {{ $review->id }})"
                        class="mt-2 px-4 py-2 bg-teal-700 hover:bg-teal-800 text-white text-xs font-bold rounded-xl transition">
                        Post Reply
                    </button>
                </div>
                @endif
            </div>
            @empty
            <div class="bg-white rounded-2xl border-2 border-dashed border-slate-200 p-12 text-center">
                <div class="w-16 h-16 bg-amber-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-star text-amber-400 text-2xl"></i>
                </div>
                <p class="font-bold text-slate-700 mb-1">No reviews yet</p>
                <p class="text-sm text-slate-400 mb-5">Ask satisfied clients to leave a review on your public profile. Reviews build trust and increase leads.</p>
                <a href="{{ route('frontend.service.show', auth()->user()->slug ?? auth()->id()) }}" target="_blank"
                   class="inline-flex items-center gap-2 bg-teal-700 hover:bg-teal-800 text-white font-bold px-5 py-2.5 rounded-2xl text-sm transition">
                    <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i> View Your Public Page
                </a>
            </div>
            @endforelse
        </div>

    </div>
</div>

<script>
function copyReviewLink(url, btn) {
    const copy = () => {
        btn.innerHTML = '<i class="fa-solid fa-check mr-1"></i> Copied!';
        setTimeout(() => btn.innerHTML = '<i class="fa-solid fa-copy mr-1"></i> Copy Link', 2000);
    };
    if (navigator.clipboard) {
        navigator.clipboard.writeText(url).then(copy).catch(() => {
            const el = document.createElement('textarea');
            el.value = url; document.body.appendChild(el); el.select();
            document.execCommand('copy'); document.body.removeChild(el); copy();
        });
    } else {
        const el = document.createElement('textarea');
        el.value = url; document.body.appendChild(el); el.select();
        document.execCommand('copy'); document.body.removeChild(el); copy();
    }
}
function filterReviews(btn, val) {
    document.querySelectorAll('.rev-tab').forEach(b => {
        b.className = 'rev-tab shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 whitespace-nowrap transition';
        if (b.querySelector('i')) b.className += '';
    });
    btn.className = 'rev-tab active-rtab shrink-0 px-4 py-2 rounded-xl text-xs font-bold bg-teal-700 text-white whitespace-nowrap';
    document.querySelectorAll('.review-card').forEach(card => {
        const s = parseInt(card.dataset.stars);
        let show = false;
        if (val === 'all') show = true;
        else if (val === 'low') show = s <= 3;
        else show = s === parseInt(val);
        card.style.display = show ? '' : 'none';
    });
}
function toggleReply(btn, id) {
    const box = btn.nextElementSibling;
    box.classList.toggle('hidden');
    if (!box.classList.contains('hidden')) box.querySelector('textarea').focus();
}
function submitReply(btn, id) {
    const box = btn.closest('.reply-box');
    const text = box.querySelector('textarea').value.trim();
    if (!text) return;
    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i>';
    fetch('/seller/reviews/' + id + '/reply', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content || '' },
        body: JSON.stringify({ reply: text })
    }).then(() => {
        box.innerHTML = `<p class="text-[10px] font-bold text-slate-400 mb-1">YOUR REPLY</p><p class="text-xs text-slate-600">${text}</p>`;
    });
}
</script>
@endsection
