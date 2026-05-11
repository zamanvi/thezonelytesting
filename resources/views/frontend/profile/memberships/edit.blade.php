@extends('frontend.layouts.__prof_app')
@section('title', 'Edit Membership')
@section('page-title', 'Edit Membership')

@section('content')
<div class="pb-10 max-w-2xl mx-auto">
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('user.memberships.index') }}" class="w-9 h-9 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-teal-700 hover:border-teal-300 transition">
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-xl font-bold text-gray-900">Edit Membership</h1>
            <p class="text-xs text-gray-500 mt-0.5">Changes appear live on your public page</p>
        </div>
    </div>
    @if($errors->any())
    <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-2xl">
        <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif
    <form action="{{ route('user.memberships.update', $membership->id) }}" method="POST" class="space-y-4">
        @csrf @method('PUT')
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-2">Organization Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $membership->name) }}" required class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition">
        </div>
        @php $isOngoing = strtolower($membership->end ?? '') === 'present'; @endphp
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Start Year</label>
                    <input type="text" name="start" value="{{ old('start', $membership->start) }}" placeholder="e.g. 2015" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">End Year</label>
                    <input type="text" id="endYear" value="{{ old('end', $membership->end) }}" placeholder="e.g. 2023"
                        {{ $isOngoing ? 'disabled' : '' }}
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition {{ $isOngoing ? 'bg-slate-50 text-slate-400' : '' }}">
                    <input type="hidden" name="end" id="endYearHidden" value="{{ old('end', $membership->end) }}">
                </div>
            </div>
            <label class="flex items-center gap-2.5 mt-3 cursor-pointer select-none">
                <input type="checkbox" id="ongoingMembership" onchange="toggleOngoing('endYear','Present',this)"
                    {{ $isOngoing ? 'checked' : '' }}
                    class="w-4 h-4 rounded text-teal-700 border-slate-300 focus:ring-teal-600">
                <span class="text-sm text-slate-600">Currently a member <span class="text-emerald-600 font-semibold">(Ongoing)</span></span>
            </label>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-2">Location / Details</label>
            <input type="text" name="address" value="{{ old('address', $membership->address) }}" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition">
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" form="deleteForm" onclick="return confirm('Delete this?')"
                class="flex items-center gap-2 px-5 py-3 bg-red-50 hover:bg-red-500 hover:text-white text-red-500 font-bold rounded-2xl text-sm transition">
                <i class="fa-solid fa-trash text-xs"></i> Delete
            </button>
            <button type="submit" class="px-8 py-3 bg-teal-700 hover:bg-teal-800 text-white font-bold rounded-2xl text-sm transition">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Save Changes
            </button>
        </div>
    </form>
    <form id="deleteForm" action="{{ route('user.memberships.destroy', $membership->id) }}" method="POST">
        @csrf @method('DELETE')
    </form>
</div>
<script>
function toggleOngoing(inputId, presentLabel, checkbox) {
    const input  = document.getElementById(inputId);
    const hidden = document.getElementById(inputId + 'Hidden');
    const val    = checkbox.checked ? presentLabel : '';
    input.value  = val;
    if (hidden) hidden.value = val;
    input.disabled = checkbox.checked;
    input.classList.toggle('bg-slate-50',   checkbox.checked);
    input.classList.toggle('text-slate-400', checkbox.checked);
    input.addEventListener('input', () => { if (hidden) hidden.value = input.value; });
}
</script>
@endsection
