@extends('frontend.layouts.__app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-3xl shadow-2xl p-8 border">

    <h2 class="text-3xl font-bold mb-6">Edit Working Zone</h2>

    <form action="{{ route('user.memberships.update', $membership->id) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block font-semibold mb-2">Working Zone Name</label>
            <input type="text" name="name" value="{{ $membership->name }}"
                class="w-full px-6 py-4 rounded-2xl border focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none">
        </div>
        <div>
            <label class="block font-semibold mb-2">Start</label>
            <input type="text" name="start" value="{{ $membership->start }}"
                class="w-full px-6 py-4 rounded-2xl border focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none">
        </div>
        <div>
            <label class="block font-semibold mb-2">End</label>
            <input type="text" name="end" value="{{ $membership->end }}"
                class="w-full px-6 py-4 rounded-2xl border focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none">
        </div>
        <div>
            <label class="block font-semibold mb-2">Address</label>
            <input type="text" name="address" value="{{ $membership->address }}"
                class="w-full px-6 py-4 rounded-2xl border focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none">
        </div>

        <button class="bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold hover:bg-blue-600">
            Update
        </button>
    </form>

</div>
@endsection