@extends('frontend.layouts.__prof_app')
@section('title', 'Service Location')
@section('page-title', 'Service Location')

@section('content')
<div class="pb-10 max-w-2xl mx-auto">

    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('seller.onboarding') }}"
           class="w-9 h-9 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-teal-700 hover:border-teal-300 transition">
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-xl font-bold text-gray-900">Service Location</h1>
            <p class="text-xs text-gray-500 mt-0.5">Shown in the map and Find Us section of your public page</p>
        </div>
    </div>

    @if($errors->any())
    <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-2xl">
        <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    @if(session('success'))
    <div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-2xl flex items-center gap-2">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('save.seller.profile', ['type' => $type, 'setup' => 'service_location']) }}" class="space-y-4">
        @csrf

        {{-- Industry Banner --}}
        @php
            $parentCat = $user->category?->parent ?? $user->category;
            $childCat  = $user->category;
        @endphp
        @if($parentCat)
        <div class="flex items-center gap-4 p-4 bg-teal-50 border border-teal-100 rounded-2xl">
            <div class="w-10 h-10 flex items-center justify-center rounded-xl bg-teal-700 text-white shrink-0">
                <i class="fa-solid fa-layer-group text-sm"></i>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-[10px] font-bold text-teal-400 uppercase tracking-wide mb-0.5">Your Industry</p>
                <p class="text-sm font-bold text-slate-800 truncate">{{ $parentCat->title }}</p>
                @if($childCat && $childCat->id !== $parentCat->id)
                <p class="text-xs text-slate-500 mt-0.5">Category: <span class="font-semibold text-slate-700">{{ $childCat->title }}</span></p>
                @endif
            </div>
            <a href="{{ route('user.register.category') }}"
               class="shrink-0 text-xs font-bold text-teal-700 hover:text-teal-800 border border-teal-200 hover:border-teal-400 px-3 py-1.5 rounded-lg transition">
                Change
            </a>
        </div>
        @endif

        {{-- Primary Service Category --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-1">
                Primary Service Category <span class="text-red-500">*</span>
            </label>
            <p class="text-xs text-slate-400 mb-3">Specialization within your industry</p>
            @if($categories->isEmpty())
            <div class="p-4 bg-amber-50 border border-amber-200 text-amber-700 text-sm rounded-xl flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation"></i>
                No sub-categories found. <a href="{{ route('user.register.category') }}" class="font-bold underline ml-1">Change industry</a>
            </div>
            @else
            <select name="category_id" required
                class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition">
                <option value="">Select your service category</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $user->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->title }}
                </option>
                @endforeach
            </select>
            @endif
        </div>

        {{-- Location --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-1">Service Location <span class="text-red-500">*</span></label>
            <p class="text-xs text-slate-400 mb-4">The area where you serve clients — shown on your public map</p>

            <div class="location-block space-y-3">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <div>
                        <label class="block text-xs font-bold text-slate-500 mb-1.5">Country <span class="text-red-500">*</span></label>
                        <select name="country" required
                            class="country-select w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition">
                            <option value="">Select Country</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 mb-1.5">State / Province <span class="text-red-500">*</span></label>
                        <select name="state" required
                            class="state-select w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition"
                            disabled>
                            <option value="">Select State</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 mb-1.5">City <span class="text-red-500">*</span></label>
                        <select name="city" required
                            class="city-select w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition"
                            disabled>
                            <option value="">Select City</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-500 mb-1.5">ZIP / Postal Code <span class="text-red-500">*</span></label>
                        <select name="zip_code" required
                            class="zip-select w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition"
                            disabled>
                            <option value="">Select ZIP Code</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-500 mb-1.5">Additional Details <span class="text-slate-400 font-normal">(optional)</span></label>
                    <input type="text" name="additional_details" value="{{ $user->additional_details ?? '' }}"
                        placeholder="Neighborhood, suite number, or service notes..."
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition">
                </div>
            </div>
        </div>

        {{-- Hidden restore values --}}
        <input type="hidden" id="old_country" value="{{ $user->country }}">
        <input type="hidden" id="old_state"   value="{{ $user->state }}">
        <input type="hidden" id="old_city"    value="{{ $user->city }}">
        <input type="hidden" id="old_zip"     value="{{ $user->zip_code }}">

        <div class="flex justify-end pt-2">
            <button type="submit"
                class="px-8 py-3 bg-teal-700 hover:bg-teal-800 text-white font-bold rounded-2xl text-sm transition">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Save Location
            </button>
        </div>
    </form>
</div>

<script>
const OLD = {
    country: document.getElementById('old_country').value,
    state:   document.getElementById('old_state').value,
    city:    document.getElementById('old_city').value,
    zip:     document.getElementById('old_zip').value,
};

function loadSelect(url, select, oldVal, label) {
    return fetch(url).then(r => r.json()).then(data => {
        select.innerHTML = `<option value="">${label}</option>` +
            data.map(i => `<option value="${i.id}" ${i.id == oldVal ? 'selected' : ''}>${i.title ?? i.name ?? i.code ?? ''}</option>`).join('');
        select.disabled = false;
        return oldVal;
    });
}

document.addEventListener('DOMContentLoaded', function () {
    if (!OLD.country) return;

    const cs = document.querySelector('.country-select');
    const ss = document.querySelector('.state-select');
    const cy = document.querySelector('.city-select');
    const zs = document.querySelector('.zip-select');

    loadSelect('/countries', cs, OLD.country, 'Select Country')
        .then(() => loadSelect('/states/' + OLD.country, ss, OLD.state, 'Select State'))
        .then(() => OLD.state ? loadSelect('/cities/' + OLD.state, cy, OLD.city, 'Select City') : null)
        .then(() => OLD.city ? loadSelect('/postal-codes/' + OLD.city, zs, OLD.zip, 'Select ZIP Code') : null)
        .catch(() => {});
});

// Also pre-populate countries on load even without old value
fetch('/countries').then(r => r.json()).then(data => {
    const cs = document.querySelector('.country-select');
    if (cs.options.length <= 1) {
        cs.innerHTML = '<option value="">Select Country</option>' +
            data.map(i => `<option value="${i.id}" ${i.id == OLD.country ? 'selected' : ''}>${i.title ?? i.name ?? ''}</option>`).join('');
        cs.disabled = false;
    }
});

document.addEventListener('change', function (e) {
    if (e.target.classList.contains('country-select')) {
        const id = e.target.value;
        const block = e.target.closest('.location-block');
        const ss = block.querySelector('.state-select');
        const cy = block.querySelector('.city-select');
        const zs = block.querySelector('.zip-select');
        ss.innerHTML = '<option value="">Select State</option>';
        cy.innerHTML = '<option value="">Select City</option>';
        zs.innerHTML = '<option value="">Select ZIP Code</option>';
        ss.disabled = cy.disabled = zs.disabled = true;
        if (id) fetch('/states/' + id).then(r => r.json()).then(data => {
            ss.innerHTML = '<option value="">Select State</option>' + data.map(i => `<option value="${i.id}">${i.title ?? i.name}</option>`).join('');
            ss.disabled = false;
        });
    }
    if (e.target.classList.contains('state-select')) {
        const id = e.target.value;
        const block = e.target.closest('.location-block');
        const cy = block.querySelector('.city-select');
        const zs = block.querySelector('.zip-select');
        cy.innerHTML = '<option value="">Select City</option>';
        zs.innerHTML = '<option value="">Select ZIP Code</option>';
        cy.disabled = zs.disabled = true;
        if (id) fetch('/cities/' + id).then(r => r.json()).then(data => {
            cy.innerHTML = '<option value="">Select City</option>' + data.map(i => `<option value="${i.id}">${i.title ?? i.name}</option>`).join('');
            cy.disabled = false;
        });
    }
    if (e.target.classList.contains('city-select')) {
        const id = e.target.value;
        const block = e.target.closest('.location-block');
        const zs = block.querySelector('.zip-select');
        zs.innerHTML = '<option value="">Select ZIP Code</option>';
        zs.disabled = true;
        if (id) fetch('/postal-codes/' + id).then(r => r.json()).then(data => {
            zs.innerHTML = '<option value="">Select ZIP Code</option>' + data.map(i => `<option value="${i.id}">${i.title ?? i.code}</option>`).join('');
            zs.disabled = false;
        });
    }
});
</script>
@endsection
