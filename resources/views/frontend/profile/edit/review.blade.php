@extends('frontend.profile.edit.layout')

@section('form')
    <h2 class="text-3xl font-bold mb-6">Review & Confirm</h2>

    <div class="space-y-4 text-lg">

        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Phone:</strong> {{ $user->phone }}</p>
        <p><strong>Experience:</strong> {{ $user->experience }} years</p>

    </div>

    <form method="POST" action="{{ route('save.seller.profile', ['type' => $type, 'setup' => 'review']) }}">
        @csrf

        <label class="flex items-center gap-2 mt-6">
            <input type="checkbox" required>
            I confirm everything is correct
        </label>

        <button class="btn-primary mt-6 w-full">Finish Profile</button>

    </form>
@endsection
