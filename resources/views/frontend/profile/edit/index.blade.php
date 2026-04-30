@extends('frontend.layouts._app')

@section('content')
    <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-2xl p-4 sm:p-8 md:p-12 border border-slate-100">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
            <h2 class="text-2xl sm:text-3xl font-bold">Edit Profile</h2>

            @if (auth()->user()->type === 'seller')
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('type.profile', ['seller', 'account']) }}"
                        class="bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs sm:text-sm hover:bg-blue-500">
                        Account
                    </a>
                    <a href="{{ route('type.profile', ['seller', 'service_location']) }}"
                        class="bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs sm:text-sm hover:bg-blue-500">
                        Service Location
                    </a>
                    <a href="{{ route('type.profile', ['seller', 'contact']) }}"
                        class="bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs sm:text-sm hover:bg-blue-500">
                        Contact
                    </a>
                    <a href="{{ route('type.profile', ['seller', 'review']) }}"
                        class="bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs sm:text-sm hover:bg-blue-500">
                        Review
                    </a>
                </div>
            @endif
        </div>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8 sm:space-y-10">
            @csrf

            <!-- Basic Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">

                <div>
                    <label class="block text-sm font-semibold mb-1.5">Name *</label>
                    <input @readonly(true) name="name" value="{{ $user->name }}"
                        class="w-full px-4 sm:px-5 py-3 sm:py-4 rounded-2xl border focus:ring-4 focus:ring-blue-100 text-sm">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1.5">Email *</label>
                    <input @readonly(true) name="email" value="{{ $user->email }}"
                        class="w-full px-4 sm:px-5 py-3 sm:py-4 rounded-2xl border focus:ring-4 focus:ring-blue-100 text-sm">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1.5">Phone</label>
                    <input type="text" name="phone" value="{{ $user->phone }}"
                        class="w-full px-4 sm:px-5 py-3 sm:py-4 rounded-2xl border focus:ring-4 focus:ring-blue-100 text-sm">
                </div>

                @if ($user->type === 'seller')
                    <div>
                        <label class="block text-sm font-semibold mb-1.5">WhatsApp</label>
                        <input type="text" name="whatsapp" value="{{ $user->whatsapp }}"
                            class="w-full px-4 sm:px-5 py-3 sm:py-4 rounded-2xl border focus:ring-4 focus:ring-blue-100 text-sm">
                    </div>
                @endif

            </div>

            <!-- Submit -->
            <div class="flex flex-col sm:flex-row sm:justify-between gap-3 pt-4 sm:pt-6">
                <a href="{{ route('user.dashboard') }}" class="text-slate-500 font-semibold text-sm py-2">
                    ← Back
                </a>
                <button class="w-full sm:w-auto bg-slate-900 text-white px-8 sm:px-10 py-3.5 sm:py-4 rounded-2xl font-bold hover:bg-blue-600 transition text-sm">
                    Update Profile
                </button>
            </div>

        </form>
    </div>
@endsection
