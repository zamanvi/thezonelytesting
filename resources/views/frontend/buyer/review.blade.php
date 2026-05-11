@extends('frontend.layouts._app')
@section('title', 'Leave a Review')
@section('content')
<div class="min-h-screen bg-slate-50 pt-20 pb-16 px-4">
    <div class="max-w-xl mx-auto py-6">

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('buyer.bookings') ?? '#' }}" class="w-9 h-9 rounded-xl border border-slate-200 flex items-center justify-center text-slate-500 hover:bg-slate-100 transition">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
            <h1 class="text-xl font-bold text-slate-900">Leave a Review</h1>
        </div>

        {{-- Booking Reference --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-4 mb-6 flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-teal-700 text-white flex items-center justify-center font-bold text-lg shrink-0">
                {{ strtoupper(substr($booking->seller->name ?? 'PR', 0, 2)) }}
            </div>
            <div>
                <p class="font-bold text-slate-900">{{ $booking->seller->name ?? 'Professional' }}</p>
                <p class="text-xs text-slate-500 mt-0.5">{{ $booking->service ?? 'Service' }}</p>
                <p class="text-xs text-slate-400 mt-1">
                    <i class="fa-solid fa-calendar mr-1"></i>
                    {{ \Carbon\Carbon::parse($booking->date ?? now())->format('D, M d Y') }}
                    &nbsp;·&nbsp;
                    <i class="fa-solid fa-clock mr-1"></i>
                    {{ $booking->slot_time ?? '—' }}
                </p>
            </div>
        </div>

        <form action="{{ route('buyer.review.store', $booking->id ?? 0) ?? '#' }}" method="POST" id="reviewForm">
            @csrf
            <input type="hidden" name="booking_id" value="{{ $booking->id ?? 0 }}">
            <input type="hidden" name="seller_id" value="{{ $booking->seller->id ?? 0 }}">
            <input type="hidden" name="rating" id="ratingInput" value="">

            {{-- Star Rating --}}
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-4">
                <h2 class="font-bold text-slate-900 mb-1">Your Rating <span class="text-red-500">*</span></h2>
                <p class="text-xs text-slate-400 mb-5">How was your experience?</p>

                <div class="flex items-center justify-center gap-3 mb-4" id="starRow">
                    @for($i = 1; $i <= 5; $i++)
                    <button type="button" onclick="setRating({{ $i }})"
                        class="star-btn text-4xl text-slate-200 hover:text-amber-400 transition-all hover:scale-110"
                        data-star="{{ $i }}">
                        <i class="fa-solid fa-star"></i>
                    </button>
                    @endfor
                </div>

                <p class="text-center text-sm font-bold text-slate-400 h-5" id="ratingLabel"></p>
            </div>

            {{-- Review Text --}}
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-4">
                <h2 class="font-bold text-slate-900 mb-1">Your Review <span class="text-red-500">*</span></h2>
                <p class="text-xs text-slate-400 mb-4">Share your experience to help others</p>
                <textarea name="review" id="reviewText" rows="5" required minlength="10" maxlength="1000"
                    placeholder="Describe your experience — was the professional helpful, punctual, professional? What did you like most?"
                    class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition resize-none">{{ old('review') }}</textarea>
                <div class="flex justify-between mt-1.5">
                    <p class="text-xs text-red-500 hidden" id="reviewError">Please write at least 10 characters.</p>
                    <p class="text-xs text-slate-400 ml-auto"><span id="charCount">0</span>/1000</p>
                </div>
            </div>

            {{-- Tags --}}
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-6">
                <h2 class="font-bold text-slate-900 mb-1">Highlights <span class="text-xs font-normal text-slate-400">(optional)</span></h2>
                <p class="text-xs text-slate-400 mb-4">Pick what stood out</p>
                <div class="flex flex-wrap gap-2" id="tagCloud">
                    @foreach(['Punctual','Professional','Great communication','Good value','Highly skilled','Friendly','Fast service','Would recommend'] as $tag)
                    <button type="button" onclick="toggleTag(this, '{{ $tag }}')"
                        class="tag-btn px-3 py-1.5 rounded-xl text-xs font-semibold border border-slate-200 text-slate-500 bg-white hover:border-teal-300 hover:text-teal-700 transition"
                        data-tag="{{ $tag }}">
                        {{ $tag }}
                    </button>
                    @endforeach
                </div>
                <input type="hidden" name="tags" id="tagsInput">
            </div>

            @if($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-2xl">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <button type="submit" id="submitBtn" onclick="return validateReview()"
                class="w-full bg-slate-300 text-slate-500 font-bold py-4 rounded-2xl text-sm transition cursor-not-allowed"
                disabled>
                <i class="fa-solid fa-paper-plane mr-2"></i> Submit Review
            </button>
        </form>

    </div>
</div>

<script>
let selectedRating = 0;
const selectedTags = new Set();
const labels = ['','Terrible','Poor','Average','Good','Excellent'];

function setRating(n) {
    selectedRating = n;
    document.getElementById('ratingInput').value = n;
    document.querySelectorAll('.star-btn').forEach((btn, i) => {
        const star = btn.querySelector('i');
        if (i < n) {
            btn.classList.remove('text-slate-200');
            btn.classList.add('text-amber-400');
        } else {
            btn.classList.remove('text-amber-400');
            btn.classList.add('text-slate-200');
        }
    });
    document.getElementById('ratingLabel').textContent = labels[n];
    document.getElementById('ratingLabel').className = 'text-center text-sm font-bold h-5 ' +
        (n >= 4 ? 'text-emerald-500' : n === 3 ? 'text-amber-500' : 'text-red-500');
    updateSubmit();
}

function toggleTag(btn, tag) {
    if (selectedTags.has(tag)) {
        selectedTags.delete(tag);
        btn.classList.remove('border-teal-600','text-teal-700','bg-teal-50');
        btn.classList.add('border-slate-200','text-slate-500','bg-white');
    } else {
        selectedTags.add(tag);
        btn.classList.remove('border-slate-200','text-slate-500','bg-white');
        btn.classList.add('border-teal-600','text-teal-700','bg-teal-50');
    }
    document.getElementById('tagsInput').value = [...selectedTags].join(',');
}

document.getElementById('reviewText').addEventListener('input', function() {
    document.getElementById('charCount').textContent = this.value.length;
    updateSubmit();
});

function updateSubmit() {
    const ready = selectedRating > 0 && document.getElementById('reviewText').value.trim().length >= 10;
    const btn = document.getElementById('submitBtn');
    btn.disabled = !ready;
    btn.className = `w-full font-bold py-4 rounded-2xl text-sm transition ${ready ? 'bg-teal-700 hover:bg-teal-800 text-white cursor-pointer' : 'bg-slate-300 text-slate-500 cursor-not-allowed'}`;
}

function validateReview() {
    if (!selectedRating) {
        alert('Please select a star rating.');
        return false;
    }
    const text = document.getElementById('reviewText').value.trim();
    if (text.length < 10) {
        document.getElementById('reviewError').classList.remove('hidden');
        document.getElementById('reviewText').focus();
        return false;
    }
    document.getElementById('reviewError').classList.add('hidden');
    return true;
}
</script>
@endsection
