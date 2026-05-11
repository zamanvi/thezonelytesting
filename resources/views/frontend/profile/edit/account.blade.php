@extends('frontend.layouts.__prof_app')
@section('title', 'Business Basics')
@section('page-title', 'Business Basics')

@section('content')
<div class="pb-10 max-w-2xl mx-auto">

    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('seller.onboarding') }}"
           class="w-9 h-9 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-teal-700 hover:border-teal-300 transition">
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-xl font-bold text-gray-900">Business Basics</h1>
            <p class="text-xs text-gray-500 mt-0.5">Appears in the hero section of your public page</p>
        </div>
    </div>

    @if($errors->any())
    <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-2xl">
        <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    @if(session('success'))
    <div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-2xl flex items-center gap-2">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
    @endif

    <form method="POST" action="{{ route('save.seller.profile', ['type' => $type, 'setup' => 'account']) }}" class="space-y-4">
        @csrf

        {{-- Owner Name --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-1">
                Business Owner Name <span class="text-red-500">*</span>
            </label>
            <p class="text-xs text-slate-400 mb-3">Your full name as the owner or licensed professional</p>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                placeholder="e.g. John Smith"
                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition">
        </div>

        {{-- Business Name --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-1">Business Name</label>
            <p class="text-xs text-slate-400 mb-3">The official name of your firm or practice (e.g. "A K Azad CPA PLLC")</p>
            <input type="text" name="business_name" value="{{ old('business_name', $user->business_name) }}"
                placeholder="e.g. Smith & Associates LLC"
                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition">
        </div>

        {{-- Phone --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-1">Phone Number</label>
            <p class="text-xs text-slate-400 mb-3">Primary number for your account — visibility controlled in Contact Info</p>
            <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}"
                placeholder="+1 (917) 000-0000"
                class="w-full sm:w-64 px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition">
        </div>

        <div class="flex justify-end pt-2">
            <button type="submit"
                class="px-8 py-3 bg-teal-700 hover:bg-teal-800 text-white font-bold rounded-2xl text-sm transition">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Save & Continue
            </button>
        </div>
    </form>
</div>
@endsection
