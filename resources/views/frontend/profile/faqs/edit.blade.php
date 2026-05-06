@extends('frontend.layouts.__prof_app')
@section('title', 'Edit Question')
@section('page-title', 'Edit Question')

@section('content')
<div class="pb-10 max-w-2xl mx-auto">

    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('user.faqs.index') }}"
           class="w-9 h-9 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-blue-600 hover:border-blue-300 transition">
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-xl font-bold text-gray-900">Edit Question</h1>
            <p class="text-xs text-gray-500 mt-0.5">Changes appear live on your public page</p>
        </div>
    </div>

    @if($errors->any())
    <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-2xl">
        <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <form action="{{ route('user.faqs.update', $faq->id) }}" method="POST" class="space-y-4">
        @csrf @method('PUT')

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-2">
                Question <span class="text-red-500">*</span>
            </label>
            <input type="text" name="question" value="{{ old('question', $faq->question) }}" required
                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition">
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-2">
                Answer <span class="text-red-500">*</span>
            </label>
            <textarea name="answer" rows="5" required
                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition resize-none">{{ old('answer', $faq->answer) }}</textarea>
        </div>

        <div class="flex items-center justify-between">
            <form action="{{ route('user.faqs.destroy', $faq->id) }}" method="POST"
                  onsubmit="return confirm('Delete this question?')">
                @csrf @method('DELETE')
                <button type="submit"
                    class="flex items-center gap-2 px-5 py-3 bg-red-50 hover:bg-red-500 hover:text-white text-red-500 font-bold rounded-2xl text-sm transition">
                    <i class="fa-solid fa-trash text-xs"></i> Delete
                </button>
            </form>
            <button type="submit"
                class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl text-sm transition">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Save Changes
            </button>
        </div>
    </form>
</div>
@endsection
