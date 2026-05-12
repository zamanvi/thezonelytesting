@extends('frontend.layouts.__prof_app')
@section('title', 'Edit Certification')
@section('page-title', 'Edit Certification')

@section('content')
<div class="pb-10 max-w-2xl mx-auto">

    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('user.certifications.index') }}"
           class="w-9 h-9 bg-white border border-slate-200 rounded-xl flex items-center justify-center text-slate-500 hover:text-teal-700 hover:border-teal-300 transition">
            <i class="fa-solid fa-arrow-left text-sm"></i>
        </a>
        <div>
            <h1 class="text-xl font-bold text-gray-900">Edit Certification</h1>
            <p class="text-xs text-gray-500 mt-0.5">{{ $certification->name }}</p>
        </div>
    </div>

    @if($errors->any())
    <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-2xl">
        <ul class="list-disc list-inside space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <form action="{{ route('user.certifications.update', $certification->id) }}" method="POST" class="space-y-4">
        @csrf @method('PUT')

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-2">Certification Name <span class="text-red-500">*</span></label>
            <input type="text" name="name" value="{{ old('name', $certification->name) }}" required
                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition">
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-2">Issuing Organization</label>
            <input type="text" name="issuer" value="{{ old('issuer', $certification->issuer) }}"
                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition">
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Issue Year</label>
                    <input type="text" name="issued_year" value="{{ old('issued_year', $certification->issued_year) }}"
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition">
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Expiry Year</label>
                    <input type="text" name="expiry_year" value="{{ old('expiry_year', $certification->expiry_year) }}"
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition">
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm p-5">
            <label class="block text-sm font-bold text-slate-700 mb-2">Credential ID</label>
            <input type="text" name="credential_id" value="{{ old('credential_id', $certification->credential_id) }}"
                class="w-full px-4 py-3 border border-slate-200 rounded-xl text-sm focus:outline-none focus:border-teal-600 focus:ring-2 focus:ring-teal-50 transition">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="px-8 py-3 bg-teal-700 hover:bg-teal-800 text-white font-bold rounded-2xl text-sm transition">
                <i class="fa-solid fa-floppy-disk mr-2"></i> Save
            </button>
        </div>
    </form>

    <form action="{{ route('user.certifications.destroy', $certification->id) }}" method="POST"
          onsubmit="return confirm('Delete this certification?')" class="mt-2">
        @csrf @method('DELETE')
        <button type="submit" class="px-5 py-3 text-red-500 hover:bg-red-50 font-semibold rounded-2xl text-sm transition w-full text-center">
            <i class="fa-solid fa-trash mr-1"></i> Delete this certification
        </button>
    </form>
</div>
@endsection
