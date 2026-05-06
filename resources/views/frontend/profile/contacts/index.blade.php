@extends('frontend.layouts.__prof_app')
@section('title', 'Contact Links')
@section('page-title', 'Contact Links')

@section('content')
<div class="pb-10 max-w-3xl mx-auto">

    @if(session('success'))
    <div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-2xl flex items-center gap-2">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
    @endif

    <div class="flex items-center justify-between mb-6 gap-3">
        <div class="flex items-center gap-3">
            <a href="{{ route('seller.onboarding') }}"
               class="w-9 h-9 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-blue-600 hover:border-blue-300 transition shrink-0">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>
            <div>
                <h1 class="text-xl font-bold text-gray-900">Contact Links</h1>
                <p class="text-xs text-gray-500 mt-0.5">Additional contact methods shown on your public page</p>
            </div>
        </div>
        <a href="{{ route('user.contacts.create') }}"
           class="shrink-0 flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-2.5 rounded-2xl text-sm transition">
            <i class="fa-solid fa-plus"></i> Add
        </a>
    </div>

    @php
    $typeIcon = ['email'=>'fa-envelope','phone'=>'fa-phone','address'=>'fa-location-dot','whatsapp'=>'fa-whatsapp fab'];
    $typeLabel = ['email'=>'Email','phone'=>'Phone','address'=>'Address','whatsapp'=>'WhatsApp'];
    @endphp

    <div class="space-y-3">
        @forelse($contacts as $contact)
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm flex items-center justify-between px-5 py-4 gap-4">
            <div class="flex items-center gap-3 min-w-0">
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center shrink-0">
                    <i class="{{ $typeIcon[$contact->type] ?? 'fa-solid fa-link' }} text-blue-600 text-sm"></i>
                </div>
                <div class="min-w-0">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wide">{{ $typeLabel[$contact->type] ?? $contact->type }}</p>
                    <p class="font-semibold text-slate-800 text-sm truncate">{{ $contact->value }}</p>
                </div>
            </div>
            <div class="flex gap-2 shrink-0">
                <a href="{{ route('user.contacts.edit', $contact->id) }}"
                   class="w-9 h-9 bg-slate-100 hover:bg-blue-600 hover:text-white text-slate-600 rounded-xl flex items-center justify-center transition">
                    <i class="fa-solid fa-pen text-xs"></i>
                </a>
                <form action="{{ route('user.contacts.destroy', $contact->id) }}" method="POST"
                      onsubmit="return confirm('Delete this contact?')">
                    @csrf @method('DELETE')
                    <button type="submit"
                        class="w-9 h-9 bg-slate-100 hover:bg-red-500 hover:text-white text-slate-600 rounded-xl flex items-center justify-center transition">
                        <i class="fa-solid fa-trash text-xs"></i>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="text-center py-16 bg-white rounded-3xl border border-dashed border-slate-200">
            <i class="fa-solid fa-address-card text-4xl text-slate-200 mb-3"></i>
            <p class="font-bold text-slate-400">No contact links yet</p>
            <p class="text-sm text-slate-400 mt-1 mb-4">Add email, phone, or address to appear on your page</p>
            <a href="{{ route('user.contacts.create') }}"
               class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold px-5 py-3 rounded-2xl text-sm transition">
                <i class="fa-solid fa-plus"></i> Add First Contact
            </a>
        </div>
        @endforelse
    </div>

    {{ $contacts->links() }}

</div>
@endsection
