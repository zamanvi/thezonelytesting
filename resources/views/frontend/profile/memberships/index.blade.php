@extends('frontend.layouts.__prof_app')
@section('title', 'Memberships & Associations')
@section('page-title', 'Memberships')

@section('content')
<div class="pb-10 max-w-2xl mx-auto">

    <div class="mb-6 flex items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <a href="{{ route('seller.onboarding') }}"
               class="w-9 h-9 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-blue-600 hover:border-blue-300 transition">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
            <div>
                <h1 class="text-xl font-bold text-gray-900">Memberships & Associations</h1>
                <p class="text-xs text-gray-500 mt-0.5">Professional organizations, boards, associations</p>
            </div>
        </div>
        <a href="{{ route('user.memberships.create') }}"
           class="shrink-0 flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl text-sm transition">
            <i class="fa-solid fa-plus text-xs"></i> Add
        </a>
    </div>

    @if(session('success'))
    <div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-2xl flex items-center gap-2">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
    @endif

    @forelse($memberships as $item)
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 mb-3">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-id-badge text-blue-500 text-sm"></i>
                </div>
                <div class="min-w-0">
                    <p class="font-bold text-slate-800 text-sm truncate">{{ $item->name }}</p>
                    @if($item->start || $item->end)
                    <p class="text-xs text-slate-400 mt-0.5">{{ $item->start ?? '' }}{{ ($item->start && $item->end) ? ' – ' : '' }}{{ $item->end ?? '' }}</p>
                    @endif
                    @if($item->address)
                    <p class="text-xs text-slate-400">{{ $item->address }}</p>
                    @endif
                </div>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <a href="{{ route('user.memberships.edit', $item->id) }}"
                   class="w-8 h-8 flex items-center justify-center bg-slate-100 hover:bg-blue-100 hover:text-blue-600 text-slate-500 rounded-xl transition">
                    <i class="fa-solid fa-pen text-xs"></i>
                </a>
                <form action="{{ route('user.memberships.destroy', $item->id) }}" method="POST"
                      onsubmit="return confirm('Delete: {{ addslashes($item->name) }}?')">
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
        <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <i class="fa-solid fa-id-badge text-blue-400 text-2xl"></i>
        </div>
        <p class="font-bold text-slate-700 mb-1">No memberships yet</p>
        <p class="text-sm text-slate-400 mb-5">Bar associations, medical boards, and professional organizations add credibility.</p>
        <a href="{{ route('user.memberships.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl text-sm transition">
            <i class="fa-solid fa-plus text-xs"></i> Add First Membership
        </a>
    </div>
    @endforelse

</div>
@endsection
