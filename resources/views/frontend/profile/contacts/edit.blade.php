@extends('frontend.layouts.__prof_app')
@section('title', 'Edit Contact')
@section('page-title', 'Edit Contact')

@section('content')
<div class="pb-10 max-w-2xl mx-auto">
    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('user.contacts.index') }}"
           class="w-9 h-9 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-teal-700 hover:border-teal-300 transition">
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-xl font-bold text-gray-900">Edit Contact</h1>
        </div>
    </div>

    @if($errors->any())
    <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-2xl">
        <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <form action="{{ route('user.contacts.update', $contact->id) }}" method="POST" class="space-y-4">
        @csrf @method('PUT')
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-2">Type <span class="text-red-500">*</span></label>
            <select name="type" required
                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition bg-white">
                <option value="email"    {{ old('type',$contact->type)=='email'    ? 'selected' : '' }}>Email</option>
                <option value="phone"    {{ old('type',$contact->type)=='phone'    ? 'selected' : '' }}>Phone</option>
                <option value="whatsapp" {{ old('type',$contact->type)=='whatsapp' ? 'selected' : '' }}>WhatsApp</option>
                <option value="address"  {{ old('type',$contact->type)=='address'  ? 'selected' : '' }}>Address</option>
            </select>
        </div>
        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-2">Value <span class="text-red-500">*</span></label>
            <input type="text" name="value" value="{{ old('value', $contact->value) }}" required
                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition">
        </div>
        <div class="flex items-center justify-between">
            <button type="submit"
                class="px-8 py-3 bg-teal-700 hover:bg-teal-800 text-white font-bold rounded-2xl text-sm transition">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Save Changes
            </button>
            <button type="submit" form="deleteForm" onclick="return confirm('Delete this contact?')"
                class="flex items-center gap-2 px-5 py-3 bg-red-50 hover:bg-red-500 hover:text-white text-red-500 font-bold rounded-2xl text-sm transition">
                <i class="fa-solid fa-trash text-xs"></i> Delete
            </button>
        </div>
    </form>
    <form id="deleteForm" action="{{ route('user.contacts.destroy', $contact->id) }}" method="POST">
        @csrf @method('DELETE')
    </form>
</div>
@endsection
