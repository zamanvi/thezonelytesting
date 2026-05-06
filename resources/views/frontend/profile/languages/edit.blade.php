@extends('frontend.layouts.__prof_app')
@section('title', 'Edit Language')
@section('page-title', 'Edit Language')

@section('content')
<div class="pb-10 max-w-2xl mx-auto">
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('user.languages.index') }}" class="w-9 h-9 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-blue-600 hover:border-blue-300 transition">
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </a>
        <div><h1 class="text-xl font-bold text-gray-900">Edit Language</h1></div>
    </div>
    <form action="{{ route('user.languages.update', $language->id) }}" method="POST" class="space-y-4">
        @csrf @method('PUT')
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-2">Language <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $language->name) }}" required class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition">
        </div>
        <div class="flex items-center justify-between">
            <form action="{{ route('user.languages.destroy', $language->id) }}" method="POST" onsubmit="return confirm('Delete?')">
                @csrf @method('DELETE')
                <button type="submit" class="flex items-center gap-2 px-5 py-3 bg-red-50 hover:bg-red-500 hover:text-white text-red-500 font-bold rounded-2xl text-sm transition">
                    <i class="fa-solid fa-trash text-xs"></i> Delete
                </button>
            </form>
            <button type="submit" class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl text-sm transition">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Save
            </button>
        </div>
    </form>
</div>
@endsection
