@extends('frontend.profile.edit.layout')

@section('form')
<h2 class="text-2xl font-bold text-slate-900 mb-1">Services & Service Location</h2>
<p class="text-sm text-slate-500 mb-8">Your public page shows these details to potential clients.</p>

<form method="POST" action="{{ route('save.seller.profile', ['type' => $type, 'setup' => 'service_location']) }}" class="space-y-8">
    @csrf

    @if($errors->any())
    <div class="p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-2xl">
        <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    {{-- Mother Category Banner --}}
    @php
        $parentCat = $user->category?->parent ?? $user->category;
        $childCat  = $user->category;
    @endphp
    @if($parentCat)
    <div class="flex items-center gap-4 p-4 bg-blue-50 border border-blue-100 rounded-2xl">
        <div class="w-11 h-11 flex items-center justify-center rounded-xl bg-blue-600 text-white shrink-0">
            <i class="fa-solid fa-layer-group text-sm"></i>
        </div>
        <div class="min-w-0">
            <p class="text-xs font-semibold text-blue-500 uppercase tracking-wide mb-0.5">Your Industry</p>
            <p class="text-base font-bold text-slate-800 truncate">{{ $parentCat->title }}</p>
            @if($childCat && $childCat->id !== $parentCat->id)
            <p class="text-xs text-slate-500 mt-0.5">Currently set to: <span class="font-semibold text-slate-700">{{ $childCat->title }}</span></p>
            @endif
        </div>
        <div class="ml-auto shrink-0">
            <a href="{{ route('user.register.category') }}"
               class="text-xs font-bold text-blue-600 hover:text-blue-800 border border-blue-200 hover:border-blue-400 px-3 py-1.5 rounded-lg transition whitespace-nowrap">
                Change Industry
            </a>
        </div>
    </div>
    @endif

    {{-- Primary Service Category --}}
    <div>
        <label class="block text-sm font-bold text-slate-700 mb-2">
            Primary Service Category <span class="text-red-500">*</span>
        </label>
        @if($categories->isEmpty())
        <div class="p-4 bg-amber-50 border border-amber-200 text-amber-700 text-sm rounded-2xl flex items-center gap-2">
            <i class="fa-solid fa-triangle-exclamation"></i>
            No sub-categories found for your industry. <a href="{{ route('user.register.category') }}" class="font-bold underline">Change industry</a> to see options.
        </div>
        @else
        <select name="category_id" required
            class="w-full px-5 py-3.5 rounded-2xl border border-slate-200 bg-white text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition">
            <option value="">Select your service category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $user->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->title }}
                </option>
            @endforeach
        </select>
        <p class="text-xs text-slate-400 mt-1.5">Only categories under your industry are shown.</p>
        @endif
    </div>

    {{-- Service Locations --}}
    <div>
        <label class="block text-sm font-bold text-slate-700 mb-1">
            Service Location <span class="text-red-500">*</span>
        </label>
        <p class="text-xs text-slate-400 mb-4">The area where you provide services to clients.</p>

        <div class="location-block p-5 bg-slate-50 rounded-2xl border border-slate-200 space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                {{-- Country --}}
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1.5">Country <span class="text-red-500">*</span></label>
                    <select name="country" required
                        class="country-select w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition">
                        <option value="">Select Country</option>
                    </select>
                </div>

                {{-- State --}}
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1.5">State / Province <span class="text-red-500">*</span></label>
                    <select name="state" required
                        class="state-select w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition"
                        disabled>
                        <option value="">Select State</option>
                    </select>
                </div>

                {{-- City --}}
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1.5">City <span class="text-red-500">*</span></label>
                    <select name="city" required
                        class="city-select w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition"
                        disabled>
                        <option value="">Select City</option>
                    </select>
                </div>

                {{-- ZIP --}}
                <div>
                    <label class="block text-xs font-bold text-slate-600 mb-1.5">ZIP / Postal Code <span class="text-red-500">*</span></label>
                    <select name="zip_code" required
                        class="zip-select w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition"
                        disabled>
                        <option value="">Select ZIP Code</option>
                    </select>
                </div>

            </div>

            {{-- Additional Details --}}
            <div>
                <label class="block text-xs font-bold text-slate-600 mb-1.5">Additional Details <span class="text-slate-400 font-normal">(optional)</span></label>
                <input type="text" name="additional_details" value="{{ $user->additional_details }}"
                    placeholder="Neighborhood, borough, or service notes..."
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition">
            </div>
        </div>
    </div>

    {{-- Hidden old values for JS restore --}}
    <input type="hidden" id="old_country" value="{{ $user->country }}">
    <input type="hidden" id="old_state"   value="{{ $user->state }}">
    <input type="hidden" id="old_city"    value="{{ $user->city }}">
    <input type="hidden" id="old_zip"     value="{{ $user->zip_code }}">

    <div class="pt-2">
        <button type="submit"
            class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl text-sm transition">
            Save & Continue →
        </button>
    </div>

</form>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    let oldCountry = document.getElementById('old_country').value;
    let oldState   = document.getElementById('old_state').value;
    let oldCity    = document.getElementById('old_city').value;
    let oldZip     = document.getElementById('old_zip').value;

    if (oldCountry) {
        document.querySelector('.country-select').value = oldCountry;
        document.querySelector('.country-select').dispatchEvent(new Event('change'));
        setTimeout(() => {
            document.querySelector('.state-select').value = oldState;
            document.querySelector('.state-select').dispatchEvent(new Event('change'));
            setTimeout(() => {
                document.querySelector('.city-select').value = oldCity;
                document.querySelector('.city-select').dispatchEvent(new Event('change'));
                setTimeout(() => {
                    document.querySelector('.zip-select').value = oldZip;
                }, 500);
            }, 500);
        }, 500);
    }
});

document.addEventListener('change', function (e) {
    if (e.target.classList.contains('country-select')) {
        let id = e.target.value;
        let block = e.target.closest('.location-block');
        let stateS = block.querySelector('.state-select');
        let cityS  = block.querySelector('.city-select');
        let zipS   = block.querySelector('.zip-select');
        stateS.innerHTML = '<option value="">Select State</option>';
        cityS.innerHTML  = '<option value="">Select City</option>';
        zipS.innerHTML   = '<option value="">Select ZIP Code</option>';
        stateS.disabled = cityS.disabled = zipS.disabled = true;
        if (id) fetch('/states/' + id).then(r => r.json()).then(data => {
            stateS.innerHTML = '<option value="">Select State</option>' + data.map(i => `<option value="${i.id}">${i.title}</option>`).join('');
            stateS.disabled = false;
        });
    }
    if (e.target.classList.contains('state-select')) {
        let id = e.target.value;
        let block = e.target.closest('.location-block');
        let cityS = block.querySelector('.city-select');
        let zipS  = block.querySelector('.zip-select');
        cityS.innerHTML = '<option value="">Select City</option>';
        zipS.innerHTML  = '<option value="">Select ZIP Code</option>';
        cityS.disabled = zipS.disabled = true;
        if (id) fetch('/cities/' + id).then(r => r.json()).then(data => {
            cityS.innerHTML = '<option value="">Select City</option>' + data.map(i => `<option value="${i.id}">${i.title}</option>`).join('');
            cityS.disabled = false;
        });
    }
    if (e.target.classList.contains('city-select')) {
        let id = e.target.value;
        let block = e.target.closest('.location-block');
        let zipS  = block.querySelector('.zip-select');
        zipS.innerHTML = '<option value="">Select ZIP Code</option>';
        zipS.disabled = true;
        if (id) fetch('/postal-codes/' + id).then(r => r.json()).then(data => {
            zipS.innerHTML = '<option value="">Select ZIP Code</option>' + data.map(i => `<option value="${i.id}">${i.title}</option>`).join('');
            zipS.disabled = false;
        });
    }
});
</script>
@endsection
