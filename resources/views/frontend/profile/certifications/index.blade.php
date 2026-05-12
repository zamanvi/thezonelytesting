@extends('frontend.layouts.__prof_app')
@section('title', 'Certifications')
@section('page-title', 'Certifications')

@section('content')
<div class="pb-10 max-w-2xl mx-auto">

    <div class="mb-6 flex items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <a href="{{ route('seller.onboarding') }}"
               class="w-9 h-9 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-teal-700 hover:border-teal-300 transition">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
            <div>
                <h1 class="text-xl font-bold text-gray-900">Certifications</h1>
                <p class="text-xs text-gray-500 mt-0.5">Licenses, certifications, and professional credentials</p>
            </div>
        </div>
        <a href="{{ route('user.certifications.create') }}"
           class="shrink-0 flex items-center gap-2 px-4 py-2.5 bg-teal-700 hover:bg-teal-800 text-white font-bold rounded-2xl text-sm transition">
            <i class="fa-solid fa-plus text-xs"></i> Add
        </a>
    </div>

    @if(session('success'))
    <div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-2xl flex items-center gap-2">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
    @endif

    @forelse($certifications as $item)
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 mb-3">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-certificate text-amber-500 text-sm"></i>
                </div>
                <div class="min-w-0">
                    <p class="font-bold text-slate-800 text-sm truncate">{{ $item->name }}</p>
                    <p class="text-xs text-slate-400 mt-0.5">
                        {{ $item->issuer ?? '' }}
                        @if($item->issuer && $item->issued_year) · @endif
                        {{ $item->issued_year ?? '' }}
                        @if($item->expiry_year) – {{ $item->expiry_year }} @endif
                    </p>
                    @if($item->credential_id)
                    <p class="text-xs text-teal-600 mt-0.5">ID: {{ $item->credential_id }}</p>
                    @endif
                </div>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <a href="{{ route('user.certifications.edit', $item->id) }}"
                   class="w-8 h-8 flex items-center justify-center bg-slate-100 hover:bg-teal-100 hover:text-teal-700 text-slate-500 rounded-xl transition">
                    <i class="fa-solid fa-pen text-xs"></i>
                </a>
                <form action="{{ route('user.certifications.destroy', $item->id) }}" method="POST"
                      onsubmit="return confirm('Delete this certification?')">
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
        <div class="w-14 h-14 bg-amber-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <i class="fa-solid fa-certificate text-amber-400 text-2xl"></i>
        </div>
        <p class="font-bold text-slate-700 mb-1">No certifications yet</p>
        <p class="text-sm text-slate-400 mb-5">Licenses and certifications (CPA, CFA, etc.) build credibility.</p>
        <a href="{{ route('user.certifications.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-teal-700 hover:bg-teal-800 text-white font-bold rounded-2xl text-sm transition">
            <i class="fa-solid fa-plus text-xs"></i> Add First Certification
        </a>
    </div>
    @endforelse

</div>
@endsection
