@extends('frontend.layouts.__app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-3xl shadow-2xl p-8 border">

    <h2 class="text-3xl font-bold mb-6">Add Language</h2>

    <form action="{{ route('user.languages.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block font-semibold mb-2">Language Name</label>
            <input type="text" name="name" required
                placeholder="e.g. English, Bangla"
                class="w-full px-6 py-4 rounded-2xl border focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none">
        </div>

        <div class="flex justify-between">
            <a href="{{ route('user.languages.index') }}"
               class="text-slate-500 font-semibold hover:text-slate-900">
                ← Back
            </a>

            <button class="bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold hover:bg-blue-600">
                Save
            </button>
        </div>

    </form>

</div>
@endsection