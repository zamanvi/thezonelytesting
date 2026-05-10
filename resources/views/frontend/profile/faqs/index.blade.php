@extends('frontend.layouts.__prof_app')
@section('title', 'Q&A — Manage Questions')
@section('page-title', 'Q & A')

@section('content')
<div class="pb-10 max-w-2xl mx-auto">

    <div class="mb-6 flex items-center justify-between gap-3">
        <div class="flex items-center gap-3">
            <a href="{{ route('seller.onboarding') }}"
               class="w-9 h-9 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-blue-600 hover:border-blue-300 transition">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
            <div>
                <h1 class="text-xl font-bold text-gray-900">Frequently Asked Questions</h1>
                <p class="text-xs text-gray-500 mt-0.5">Shown in the Q&A section of your public page</p>
            </div>
        </div>
        <a href="{{ route('user.faqs.create') }}"
           class="shrink-0 flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl text-sm transition">
            <i class="fa-solid fa-plus text-xs"></i> Add Question
        </a>
    </div>

    @if(session('success'))
    <div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-2xl flex items-center gap-2">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
    @endif

    @forelse($faqs as $faq)
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 mb-3">
        <div class="flex items-start justify-between gap-4">
            <div class="min-w-0 flex-1">
                <div class="flex items-center gap-2 mb-1">
                    <span class="w-5 h-5 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-question text-[9px]"></i>
                    </span>
                    <p class="text-sm font-bold text-slate-800 truncate">{{ $faq->question }}</p>
                </div>
                <p class="text-xs text-slate-500 leading-relaxed ml-7 line-clamp-2">{{ $faq->answer }}</p>
            </div>
            <div class="flex items-center gap-2 shrink-0">
                <a href="{{ route('user.faqs.edit', $faq->id) }}"
                   class="w-8 h-8 flex items-center justify-center bg-slate-100 hover:bg-blue-100 hover:text-blue-600 text-slate-500 rounded-xl transition text-sm">
                    <i class="fa-solid fa-pen text-xs"></i>
                </a>
                <form action="{{ route('user.faqs.destroy', $faq->id) }}" method="POST"
                      onsubmit="return confirm('Delete question: {{ addslashes(Str::limit($faq->question, 60)) }}?')">
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
            <i class="fa-solid fa-circle-question text-blue-400 text-2xl"></i>
        </div>
        <p class="font-bold text-slate-700 mb-1">No questions yet</p>
        <p class="text-sm text-slate-400 mb-5">Add common questions clients ask — builds trust and reduces inquiries.</p>
        <a href="{{ route('user.faqs.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl text-sm transition">
            <i class="fa-solid fa-plus text-xs"></i> Add First Question
        </a>
    </div>
    @endforelse

    @if($faqs->count() > 0)
    <div class="mt-4 p-4 bg-blue-50 border border-blue-100 rounded-2xl flex items-start gap-3">
        <i class="fa-solid fa-lightbulb text-blue-500 text-sm mt-0.5 shrink-0"></i>
        <p class="text-xs text-blue-700">Tip: 4–6 questions works best. Cover pricing, response time, service area, and process.</p>
    </div>
    @endif

</div>
@endsection
