@extends('frontend.layouts.__prof_app')
@section('title', 'Add Experience')
@section('page-title', 'Add Experience')

@section('content')
<div class="pb-10 max-w-2xl mx-auto">

    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('user.experiences.index') }}"
           class="w-9 h-9 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-teal-700 hover:border-teal-300 transition">
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-xl font-bold text-gray-900">Add Work Experience</h1>
            <p class="text-xs text-gray-500 mt-0.5">Past positions and companies</p>
        </div>
    </div>

    @if($errors->any())
    <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-2xl">
        <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <form action="{{ route('user.experiences.store') }}" method="POST" class="space-y-4">
        @csrf
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-2">Job Title <span class="text-red-500">*</span></label>
            <input type="text" name="title" value="{{ old('title') }}" required
                placeholder="e.g. Senior Manager, CPA, Tax Advisor"
                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition">
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-2">Company / Organization</label>
            <input type="text" name="company" value="{{ old('company') }}"
                placeholder="e.g. Ernst & Young, Self-employed"
                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition">
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Start Date</label>
                    <input type="text" name="start_date" value="{{ old('start_date') }}"
                        placeholder="e.g. Jan 2018"
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">End Date</label>
                    <input type="text" name="end_date" id="endDate" value="{{ old('end_date') }}"
                        placeholder="e.g. Dec 2022"
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition">
                </div>
            </div>
            <label class="flex items-center gap-2.5 mt-3 cursor-pointer select-none">
                <input type="checkbox" name="is_current" id="isCurrent" value="1"
                    onchange="toggleCurrent(this)" {{ old('is_current') ? 'checked' : '' }}
                    class="w-4 h-4 rounded text-teal-700 border-slate-300 focus:ring-teal-600">
                <span class="text-sm text-slate-600">Currently working here <span class="text-emerald-600 font-semibold">(Present)</span></span>
            </label>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-2">Description <span class="text-slate-400 font-normal">(optional)</span></label>
            <textarea name="description" rows="3"
                placeholder="Brief description of your role and responsibilities..."
                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition resize-none">{{ old('description') }}</textarea>
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-8 py-3 bg-teal-700 hover:bg-teal-800 text-white font-bold rounded-2xl text-sm transition">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Save
            </button>
        </div>
    </form>
</div>
<script>
function toggleCurrent(cb) {
    const endDate = document.getElementById('endDate');
    endDate.disabled = cb.checked;
    endDate.classList.toggle('bg-slate-50', cb.checked);
    endDate.classList.toggle('text-slate-400', cb.checked);
    if (cb.checked) endDate.value = '';
}
</script>
@endsection
