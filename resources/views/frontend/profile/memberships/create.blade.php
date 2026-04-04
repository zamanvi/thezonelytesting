@extends('frontend.layouts.__app')

@section('content')
<div class="max-w-2xl mx-auto bg-white rounded-3xl shadow-2xl p-8 border">

    <h2 class="text-3xl font-bold mb-6">Create Membership</h2>

    <form action="{{ route('user.memberships.store') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <label class="block font-semibold mb-2">Membership Name</label>
            <input type="text" name="name"
                class="w-full px-6 py-4 rounded-2xl border focus:border-blue-600 focus:ring-4 focus:ring-blue-100 outline-none">
        </div>

        <button class="bg-slate-900 text-white px-8 py-4 rounded-2xl font-bold hover:bg-blue-600">
            Save
        </button>
    </form>

</div>
@endsection