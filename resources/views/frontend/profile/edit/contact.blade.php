@extends('frontend.layouts.__prof_app')
@section('title', 'Contact Info')
@section('page-title', 'Contact Info')

@section('content')
<div class="pb-10 max-w-2xl mx-auto">

    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('seller.onboarding') }}"
           class="w-9 h-9 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-teal-700 hover:border-teal-300 transition">
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-xl font-bold text-gray-900">Contact Info</h1>
            <p class="text-xs text-gray-500 mt-0.5">How customers reach you on your public page</p>
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

    <form action="{{ route('save.seller.profile', ['type' => $type, 'setup' => 'contact']) }}" method="POST" class="space-y-4">
        @csrf

        {{-- Phone --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-9 h-9 bg-teal-50 rounded-xl flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-phone text-teal-700 text-sm"></i>
                </div>
                <div>
                    <p class="font-bold text-slate-800 text-sm">Phone Number</p>
                    <p class="text-xs text-slate-400">Shown as call button on your public page</p>
                </div>
            </div>
            <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}"
                placeholder="+1 (917) 000-0000"
                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition">
            <label class="flex items-center gap-2.5 mt-3 cursor-pointer select-none">
                <div class="relative">
                    <input type="checkbox" name="show_phone" value="1" id="showPhoneToggle"
                        class="sr-only peer" {{ $user->show_phone ? 'checked' : '' }}>
                    <div class="w-10 h-5 bg-slate-200 peer-checked:bg-teal-700 rounded-full transition-colors"></div>
                    <div class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform peer-checked:translate-x-5"></div>
                </div>
                <span class="text-sm text-slate-600">Show phone number publicly</span>
            </label>
            <p class="text-xs text-slate-400 mt-2">
                <i class="fa-solid fa-circle-info mr-1"></i>
                If you have a Zonely tracking number, it replaces your real number for privacy.
            </p>
        </div>

        {{-- WhatsApp --}}
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-9 h-9 bg-emerald-50 rounded-xl flex items-center justify-center shrink-0">
                    <i class="fab fa-whatsapp text-emerald-600 text-base"></i>
                </div>
                <div>
                    <p class="font-bold text-slate-800 text-sm">WhatsApp Number</p>
                    <p class="text-xs text-slate-400">Shown as WhatsApp button — include country code</p>
                </div>
            </div>
            <input type="tel" name="whatsapp" value="{{ old('whatsapp', $user->whatsapp) }}"
                placeholder="+1 (917) 000-0000"
                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-emerald-400 focus:ring-2 focus:ring-emerald-50 transition">
            <p class="text-xs text-slate-400 mt-2">
                <i class="fab fa-whatsapp mr-1 text-emerald-500"></i>
                Always include country code, e.g. <strong>+1</strong>9175610271
            </p>
        </div>

        {{-- Booking info --}}
        <div class="bg-teal-50 border border-teal-100 rounded-2xl p-5">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-9 h-9 bg-teal-100 rounded-xl flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-calendar-check text-teal-700 text-sm"></i>
                </div>
                <div>
                    <p class="font-bold text-teal-800 text-sm">Booking Form</p>
                    <p class="text-xs text-teal-600">Always active — customers fill a form to contact you</p>
                </div>
            </div>
            <p class="text-xs text-teal-700 leading-relaxed ml-12">
                The inquiry / booking form is automatically shown on your public page.
                Leads from the form appear in your <a href="{{ route('seller.dashboard') }}" class="font-bold underline">Dashboard</a>.
            </p>
        </div>

        <div class="flex justify-end pt-2">
            <button type="submit"
                class="px-8 py-3 bg-teal-700 hover:bg-teal-800 text-white font-bold rounded-2xl text-sm transition">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Save Contact Info
            </button>
        </div>
    </form>
</div>
@endsection
