@extends('frontend.layouts.__app')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-2xl p-8 border">

    <h2 class="text-3xl font-bold mb-6">Add Education</h2>

    <form action="{{ route('user.educations.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Degree -->
        <div>
            <label class="block font-semibold mb-2">Degree *</label>
            <input type="text" name="degree" required
                placeholder="e.g. BSc in CSE"
                class="w-full px-6 py-4 rounded-2xl border focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none">
        </div>

        <!-- Institution -->
        <div>
            <label class="block font-semibold mb-2">Institution</label>
            <input type="text" name="institution"
                placeholder="e.g. Dhaka University"
                class="w-full px-6 py-4 rounded-2xl border focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none">
        </div>

        <!-- Passing Year -->
        <div>
            <label class="block font-semibold mb-2">Passing Year</label>
            <input type="text" name="passing_year"
                placeholder="e.g. 2023"
                class="w-full px-6 py-4 rounded-2xl border focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none">
        </div>

        <div class="flex justify-between">
            <a href="{{ route('user.educations.index') }}"
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