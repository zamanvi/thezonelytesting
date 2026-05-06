@extends('frontend.layouts.__prof_app')
@section('title', 'Profile Review')
@section('page-title', 'Profile Review')

@section('content')
<div class="pb-10 max-w-2xl mx-auto">

    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('seller.onboarding') }}"
           class="w-9 h-9 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-blue-600 hover:border-blue-300 transition">
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-xl font-bold text-gray-900">Review & Confirm</h1>
            <p class="text-xs text-gray-500 mt-0.5">Check your details before going live</p>
        </div>
    </div>

    {{-- Profile summary card --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5 mb-4">
        <div class="flex items-center gap-4">
            @if($user->profile_photo)
            <img src="{{ asset($user->profile_photo) }}" class="w-16 h-16 rounded-2xl object-cover border border-slate-200 shrink-0">
            @else
            <div class="w-16 h-16 rounded-2xl bg-blue-600 flex items-center justify-center text-white font-black text-xl shrink-0">
                {{ strtoupper(substr($user->name, 0, 2)) }}
            </div>
            @endif
            <div class="min-w-0">
                <p class="font-bold text-slate-900 text-base truncate">{{ $user->name }}</p>
                @if($user->business_name)
                <p class="text-sm text-slate-500 truncate">{{ $user->business_name }}</p>
                @endif
                @if($user->title)
                <p class="text-xs text-blue-600 font-semibold mt-0.5">{{ $user->title }}</p>
                @endif
            </div>
        </div>
    </div>

    <div class="space-y-3 mb-6">

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm divide-y divide-slate-50">
            <div class="flex items-center justify-between px-5 py-3">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">Email</span>
                <span class="text-sm font-semibold text-slate-700">{{ $user->email }}</span>
            </div>
            <div class="flex items-center justify-between px-5 py-3">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">Phone</span>
                <span class="text-sm font-semibold text-slate-700">{{ $user->phone ?: '—' }}</span>
            </div>
            <div class="flex items-center justify-between px-5 py-3">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">WhatsApp</span>
                <span class="text-sm font-semibold text-slate-700">{{ $user->whatsapp ?: '—' }}</span>
            </div>
            <div class="flex items-center justify-between px-5 py-3">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">Experience</span>
                <span class="text-sm font-semibold text-slate-700">{{ $user->experience ? $user->experience . ' years' : '—' }}</span>
            </div>
            <div class="flex items-center justify-between px-5 py-3">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wide">Location</span>
                <span class="text-sm font-semibold text-slate-700">
                    {{ collect([$user->city, $user->state])->filter()->implode(', ') ?: '—' }}
                </span>
            </div>
        </div>

        @if($user->bio)
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-wide mb-2">Bio</p>
            <p class="text-sm text-slate-600 leading-relaxed">{{ Str::limit($user->bio, 200) }}</p>
        </div>
        @endif

    </div>

    {{-- Public page link --}}
    @if($user->slug)
    <div class="bg-blue-50 border border-blue-100 rounded-2xl p-4 mb-5 flex items-center justify-between gap-3">
        <div class="min-w-0">
            <p class="text-xs font-bold text-blue-500 mb-0.5">Your live public page</p>
            <p class="text-sm font-mono text-slate-700 truncate">thezonely.com/{{ $user->slug }}</p>
        </div>
        <a href="{{ route('frontend.service.show', $user->slug) }}" target="_blank"
           class="shrink-0 flex items-center gap-1.5 text-xs font-bold text-blue-600 hover:text-blue-800 border border-blue-200 px-3 py-1.5 rounded-lg transition">
            <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i> Preview
        </a>
    </div>
    @endif

    <form method="POST" action="{{ route('save.seller.profile', ['type' => $type, 'setup' => 'review']) }}">
        @csrf
        <label class="flex items-start gap-3 mb-5 cursor-pointer">
            <input type="checkbox" required class="mt-0.5 w-4 h-4 rounded text-blue-600 border-slate-300 focus:ring-blue-500">
            <span class="text-sm text-slate-600">All information above is correct and I'm ready to go live on Zonely</span>
        </label>
        <button type="submit"
            class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-2xl text-sm transition flex items-center justify-center gap-2">
            <i class="fa-solid fa-rocket"></i> Confirm & Go Live
        </button>
    </form>

</div>
@endsection
