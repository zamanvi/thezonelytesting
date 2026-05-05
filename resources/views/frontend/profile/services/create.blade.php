@extends('frontend.layouts.__prof_app')
@section('title', 'Add Service')
@section('page-title', 'Add Service')

@section('content')
<div class="pb-10 max-w-2xl mx-auto">

    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('user.services.index') }}"
           class="w-9 h-9 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-blue-600 hover:border-blue-300 transition">
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-xl font-bold text-gray-900">Add New Service</h1>
            <p class="text-xs text-gray-500 mt-0.5">Appears in the Pricing section of your public page</p>
        </div>
    </div>

    @if($errors->any())
    <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-2xl">
        <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <form action="{{ route('user.services.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf

        {{-- Title --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-2">Service Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" required
                placeholder="e.g. Individual Tax Return (1040)"
                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition">
        </div>

        {{-- Price + Pricing Type --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-3">Pricing</label>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-xs text-slate-500 mb-1.5">Price ($)</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 font-bold text-sm">$</span>
                        <input type="number" name="price" value="{{ old('price') }}" min="0" step="0.01"
                            placeholder="179"
                            class="w-full pl-7 pr-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition">
                    </div>
                    <p class="text-xs text-slate-400 mt-1">Leave blank to show "Contact"</p>
                </div>
                <div>
                    <label class="block text-xs text-slate-500 mb-1.5">Pricing Type</label>
                    <select name="pricing_type"
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition bg-white">
                        <option value="starting_at" {{ old('pricing_type')=='starting_at' ? 'selected' : '' }}>starting at</option>
                        <option value="per_month"   {{ old('pricing_type')=='per_month'   ? 'selected' : '' }}>per month</option>
                        <option value="per_hour"    {{ old('pricing_type')=='per_hour'    ? 'selected' : '' }}>per hour</option>
                        <option value="flat_rate"   {{ old('pricing_type')=='flat_rate'   ? 'selected' : '' }}>flat rate</option>
                        <option value="free"        {{ old('pricing_type')=='free'        ? 'selected' : '' }}>free</option>
                        <option value="contact"     {{ old('pricing_type')=='contact'     ? 'selected' : '' }}>contact us</option>
                    </select>
                </div>
            </div>
        </div>

        {{-- Features / Bullet Points --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-1">Feature Bullet Points</label>
            <p class="text-xs text-slate-400 mb-3">One feature per line — shown as ✓ checkmarks under the service</p>
            <div id="featuresContainer" class="space-y-2">
                @foreach(array_filter(array_map('trim', explode("\n", old('features', '')))) as $f)
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-check text-emerald-500 text-xs shrink-0"></i>
                    <input type="text" name="feature_lines[]" value="{{ $f }}"
                        class="flex-1 px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 transition"
                        placeholder="e.g. Federal & New York State Return">
                    <button type="button" onclick="this.closest('div').remove()"
                        class="text-slate-300 hover:text-red-400 transition"><i class="fa-solid fa-times text-xs"></i></button>
                </div>
                @endforeach
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-check text-emerald-500 text-xs shrink-0"></i>
                    <input type="text" name="feature_lines[]"
                        class="flex-1 px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 transition"
                        placeholder="e.g. Federal & New York State Return">
                    <button type="button" onclick="this.closest('div').remove()"
                        class="text-slate-300 hover:text-red-400 transition"><i class="fa-solid fa-times text-xs"></i></button>
                </div>
            </div>
            <button type="button" onclick="addFeature()"
                class="mt-3 flex items-center gap-1.5 text-xs font-bold text-blue-600 hover:underline">
                <i class="fa-solid fa-plus text-[10px]"></i> Add Feature
            </button>
            <input type="hidden" name="features" id="featuresHidden">
        </div>

        {{-- Description --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-2">Description <span class="text-slate-400 font-normal">(optional)</span></label>
            <textarea name="description" rows="3"
                placeholder="Brief description shown when expanded..."
                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition resize-none">{{ old('description') }}</textarea>
        </div>

        {{-- Status --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 flex items-center justify-between">
            <div>
                <p class="text-sm font-bold text-slate-700">Show on public page</p>
                <p class="text-xs text-slate-400 mt-0.5">Inactive services are hidden from visitors</p>
            </div>
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" name="is_active" value="1" checked class="sr-only peer">
                <div class="w-11 h-6 bg-slate-200 peer-checked:bg-blue-600 rounded-full peer transition-all after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-5"></div>
            </label>
        </div>

        <div class="flex justify-end">
            <button type="submit"
                onclick="buildFeatures()"
                class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl text-sm transition">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Save Service
            </button>
        </div>

    </form>
</div>

<script>
function addFeature() {
    const d = document.createElement('div');
    d.className = 'flex items-center gap-2';
    d.innerHTML = `<i class="fa-solid fa-check text-emerald-500 text-xs shrink-0"></i>
        <input type="text" name="feature_lines[]"
            class="flex-1 px-3 py-2.5 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 transition"
            placeholder="e.g. Itemized deductions & credits">
        <button type="button" onclick="this.closest('div').remove()" class="text-slate-300 hover:text-red-400 transition"><i class="fa-solid fa-times text-xs"></i></button>`;
    document.getElementById('featuresContainer').appendChild(d);
    d.querySelector('input').focus();
}
function buildFeatures() {
    const lines = [...document.querySelectorAll('[name="feature_lines[]"]')]
        .map(i => i.value.trim()).filter(Boolean).join("\n");
    document.getElementById('featuresHidden').value = lines;
}
</script>
@endsection
