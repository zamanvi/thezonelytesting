@extends('frontend.layouts.__prof_app')
@section('title', 'Add Language')
@section('page-title', 'Add Language')

@section('content')
<div class="pb-10 max-w-2xl mx-auto">
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('user.languages.index') }}" class="w-9 h-9 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-teal-700 hover:border-teal-300 transition">
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-xl font-bold text-gray-900">Add Language</h1>
            <p class="text-xs text-gray-500 mt-0.5">Languages you can serve clients in</p>
        </div>
    </div>
    @if($errors->any())
    <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-2xl">
        <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif
    <div class="mb-4 p-4 bg-slate-50 border border-slate-100 rounded-2xl">
        <p class="text-xs font-bold text-slate-600 mb-2">Quick add:</p>
        <div class="flex flex-wrap gap-2">
            <button type="button" onclick="document.getElementById('langInput').value='English'" class="text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-600 hover:border-teal-400 hover:text-teal-800 transition">English</button>
            <button type="button" onclick="document.getElementById('langInput').value='Spanish'" class="text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-600 hover:border-teal-400 hover:text-teal-800 transition">Spanish</button>
            <button type="button" onclick="document.getElementById('langInput').value='French'" class="text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-600 hover:border-teal-400 hover:text-teal-800 transition">French</button>
            <button type="button" onclick="document.getElementById('langInput').value='Mandarin'" class="text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-600 hover:border-teal-400 hover:text-teal-800 transition">Mandarin</button>
            <button type="button" onclick="document.getElementById('langInput').value='Arabic'" class="text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-600 hover:border-teal-400 hover:text-teal-800 transition">Arabic</button>
            <button type="button" onclick="document.getElementById('langInput').value='Bengali'" class="text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-600 hover:border-teal-400 hover:text-teal-800 transition">Bengali</button>
            <button type="button" onclick="document.getElementById('langInput').value='Hindi'" class="text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-600 hover:border-teal-400 hover:text-teal-800 transition">Hindi</button>
            <button type="button" onclick="document.getElementById('langInput').value='Portuguese'" class="text-xs px-3 py-1.5 bg-white border border-slate-200 rounded-lg text-slate-600 hover:border-teal-400 hover:text-teal-800 transition">Portuguese</button>
        </div>
    </div>
    <form action="{{ route('user.languages.store') }}" method="POST" class="space-y-4">
        @csrf
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-2">Language <span class="text-red-500">*</span></label>
            <input type="text" id="langInput" name="name" value="{{ old('name') }}" required placeholder="e.g. English, Spanish, Bengali" class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition">
        </div>
        <div class="flex justify-end">
            <button type="submit" class="px-8 py-3 bg-teal-700 hover:bg-teal-800 text-white font-bold rounded-2xl text-sm transition">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Save
            </button>
        </div>
    </form>
</div>
@endsection
