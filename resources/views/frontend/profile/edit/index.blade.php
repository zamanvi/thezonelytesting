@extends('frontend.layouts.__app')

@section('content')
    <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-2xl p-8 md:p-12 border border-slate-100">

        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-bold">Edit Profile</h2>

            @if (auth()->user()->type === 'seller')
                <div class="flex gap-2">
                    <a href="{{ route('type.profile', ['seller', 'account']) }}"
                        class="bg-blue-600 text-white px-3 py-1 rounded-lg text-sm hover:bg-blue-500">
                        Account
                    </a>
                    <a href="{{ route('type.profile', ['seller', 'service_location']) }}"
                        class="bg-blue-600 text-white px-3 py-1 rounded-lg text-sm hover:bg-blue-500">
                        Service Location
                    </a>
                    <a href="{{ route('type.profile', ['seller', 'contact']) }}"
                        class="bg-blue-600 text-white px-3 py-1 rounded-lg text-sm hover:bg-blue-500">
                        Contact
                    </a>
                    <a href="{{ route('type.profile', ['seller', 'review']) }}"
                        class="bg-blue-600 text-white px-3 py-1 rounded-lg text-sm hover:bg-blue-500">
                        Review
                    </a>
                </div>
            @endif
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-10">
            @csrf

            <!-- Basic Info -->
            <div class="grid md:grid-cols-2 gap-6">

                <div>
                    <label class="font-semibold">Name *</label>
                    <input @readonly(true) name="name" value="{{ $user->name }}"
                        class="w-full px-5 py-4 rounded-2xl border focus:ring-4 focus:ring-blue-100">
                </div>

                <div>
                    <label class="font-semibold">Email *</label>
                    <input @readonly(true) name="email" value="{{ $user->email }}"
                        class="w-full px-5 py-4 rounded-2xl border focus:ring-4 focus:ring-blue-100">
                </div>

                <div>
                    <label class="font-semibold">Phone</label>
                    <input type="text" name="phone" value="{{ $user->phone }}"
                        class="w-full px-5 py-4 rounded-2xl border focus:ring-4 focus:ring-blue-100">
                </div>

                @if ($user->type === 'seller')
                    <div>
                        <label class="font-semibold">WhatsApp</label>
                        <input type="text" name="whatsapp" value="{{ $user->whatsapp }}"
                            class="w-full px-5 py-4 rounded-2xl border focus:ring-4 focus:ring-blue-100">
                    </div>
                @endif

            </div>

            <!-- Submit -->
            <div class="flex justify-between pt-6">
                <a href="{{ route('user.dashboard') }}" class="text-slate-500 font-semibold">
                    ← Back
                </a>

                <button class="bg-slate-900 text-white px-10 py-4 rounded-2xl font-bold hover:bg-blue-600 transition">
                    Update Profile
                </button>
            </div>

        </form>
    </div>
@endsection
