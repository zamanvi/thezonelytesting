@extends('frontend.layouts.__prof_app')
@section('title', 'Work Experience')
@section('page-title', 'Work Experience')

@section('content')
<div class="pb-10 max-w-2xl mx-auto">

    <div class="mb-6 flex items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <a href="{{ route('seller.onboarding') }}"
               class="w-9 h-9 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-teal-700 hover:border-teal-300 transition">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
            <div>
                <h1 class="text-xl font-bold text-gray-900">Work Experience</h1>
                <p class="text-xs text-gray-500 mt-0.5">Shown in the Experience section of your public profile</p>
            </div>
        </div>
        <a href="{{ route('user.experiences.create') }}"
           class="shrink-0 flex items-center gap-2 px-4 py-2.5 bg-teal-700 hover:bg-teal-800 text-white font-bold rounded-2xl text-sm transition">
            <i class="fa-solid fa-plus text-xs"></i> Add
        </a>
    </div>

    @if(session('success'))
    <div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-2xl flex items-center gap-2">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
    @endif

    @forelse($experiences as $item)
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 mb-3">
        <div class="flex items-start justify-between gap-4">
            <div class="flex items-start gap-3 min-w-0">
                <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center shrink-0 mt-0.5">
                    <i class="fa-solid fa-briefcase text-indigo-600 text-sm"></i>
                </div>
                <div class="min-w-0">
                    <p class="font-bold text-slate-800 text-sm">{{ $item->title }}</p>
                    @if($item->company)
                    <p class="text-sm text-teal-700 font-medium mt-0.5">{{ $item->company }}</p>
                    @endif
                    <p class="text-xs text-slate-400 mt-0.5">
                        {{ $item->start_date ?? '' }}
                        @if($item->start_date) – @endif
                        {{ $item->is_current ? 'Present' : ($item->end_date ?? '') }}
                    </p>
                    @if($item->description)
                    <p class="text-xs text-slate-500 mt-1 line-clamp-2">{{ $item->description }}</p>
                    @endif
                </div>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <a href="{{ route('user.experiences.edit', $item->id) }}"
                   class="w-8 h-8 flex items-center justify-center bg-slate-100 hover:bg-teal-100 hover:text-teal-700 text-slate-500 rounded-xl transition">
                    <i class="fa-solid fa-pen text-xs"></i>
                </a>
                <form action="{{ route('user.experiences.destroy', $item->id) }}" method="POST"
                      onsubmit="return confirm('Delete this experience?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                        class="w-8 h-8 flex items-center justify-center bg-slate-100 hover:bg-red-100 hover:text-red-600 text-slate-500 rounded-xl transition">
                        <i class="fa-solid fa-trash text-xs"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="bg-white rounded-2xl border-2 border-dashed border-slate-200 p-10 text-center">
        <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <i class="fa-solid fa-briefcase text-indigo-400 text-2xl"></i>
        </div>
        <p class="font-bold text-slate-700 mb-1">No experience yet</p>
        <p class="text-sm text-slate-400 mb-5">Past roles and companies help clients understand your background.</p>
        <a href="{{ route('user.experiences.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-teal-700 hover:bg-teal-800 text-white font-bold rounded-2xl text-sm transition">
            <i class="fa-solid fa-plus text-xs"></i> Add First Experience
        </a>
    </div>
    @endforelse

</div>
@endsection
