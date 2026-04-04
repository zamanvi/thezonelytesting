@extends('frontend.profile.edit.layout')

@section('form')
    <h2 class="text-2xl font-bold mb-6">Profile Details</h2>

    <form method="POST" enctype="multipart/form-data"
        action="{{ route('save.seller.profile', ['type' => $type, 'setup' => 'profile']) }}">
        @csrf

        <div class="space-y-6">

            <input type="file" name="profile_photo" class="input">

            @if ($user->profile_photo)
                <img src="{{ asset($user->profile_photo) }}" class="w-24 rounded-full">
            @endif

            <textarea name="bio" placeholder="Short Bio" class="input">{{ $user->bio }}</textarea>

            <input type="number" name="experience" value="{{ $user->experience }}" placeholder="Experience (years)"
                class="input">

        </div>

        <button class="btn-primary mt-6">Save & Next →</button>
    </form>
@endsection
