@extends('frontend.layouts.__prof_app')
@section('title', 'Languages Spoken')
@section('page-title', 'Languages')

@section('content')
<div class="pb-10 max-w-2xl mx-auto">

    <div class="mb-6 flex items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <a href="{{ route('seller.onboarding') }}"
               class="w-9 h-9 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-blue-600 hover:border-blue-300 transition">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
            <div>
                <h1 class="text-xl font-bold text-gray-900">Languages Spoken</h1>
                <p class="text-xs text-gray-500 mt-0.5">Languages you can serve clients in</p>
            </div>
        </div>
        <a href="{{ route('user.languages.create') }}"
           class="shrink-0 flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl text-sm transition">
            <i class="fa-solid fa-plus text-xs"></i> Add
        </a>
    </div>

    @if(session('success'))
    <div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-2xl flex items-center gap-2">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
    @endif

    @if($languages->count())
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 mb-3">
        <div class="flex flex-wrap gap-3">
            @foreach($languages as $item)
            <div class="flex items-center gap-2 px-4 py-2 bg-blue-50 border border-blue-100 rounded-2xl">
                <i class="fa-solid fa-language text-blue-500 text-xs"></i>
                <span class="text-sm font-semibold text-slate-700">{{ $item->name }}</span>
                <div class="flex items-center gap-1 ml-1">
                    <a href="{{ route('user.languages.edit', $item->id) }}"
                       class="w-6 h-6 flex items-center justify-center text-slate-400 hover:text-blue-600 transition">
                        <i class="fa-solid fa-pen text-[10px]"></i>
                    </a>
                    <form action="{{ route('user.languages.destroy', $item->id) }}" method="POST"
                          onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="w-6 h-6 flex items-center justify-center text-slate-400 hover:text-red-500 transition">
                            <i class="fa-solid fa-times text-[10px]"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="bg-white rounded-2xl border-2 border-dashed border-slate-200 p-10 text-center">
        <div class="w-14 h-14 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <i class="fa-solid fa-language text-blue-400 text-2xl"></i>
        </div>
        <p class="font-bold text-slate-700 mb-1">No languages added</p>
        <p class="text-sm text-slate-400 mb-5">Multi-language sellers get more leads from diverse communities.</p>
        <a href="{{ route('user.languages.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl text-sm transition">
            <i class="fa-solid fa-plus text-xs"></i> Add Language
        </a>
    </div>
    @endif

</div>
@endsection
