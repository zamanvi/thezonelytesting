@extends('frontend.layouts._app')
@section('title', 'Settings')
@section('content')
<div class="min-h-screen bg-slate-50 pt-20 pb-28 lg:pb-16 px-4 lg:pl-60 lg:pr-6">
    <div class="max-w-2xl mx-auto py-6">
        @include('frontend.seller._nav')
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-900">Settings</h1>
            <p class="text-sm text-slate-500 mt-0.5">Manage your account preferences</p>
        </div>

        @if(session('success'))
            <div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-2xl flex items-center gap-2">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        {{-- Profile Info --}}
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-4">
            <h2 class="font-bold text-slate-900 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-user text-blue-600 text-sm"></i> Profile Information
            </h2>
            <form action="{{ route('seller.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf @method('PUT')
                <div class="flex items-center gap-5 mb-5 p-4 bg-slate-50 rounded-2xl">
                    <div class="relative shrink-0">
                        @if(auth()->user()->profile_photo)
                            <img src="{{ asset(auth()->user()->profile_photo) }}"
                                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&size=80&background=3b82f6&color=fff'"
                                 class="w-20 h-20 rounded-2xl object-cover shadow">
                        @else
                            <div class="w-20 h-20 rounded-2xl bg-blue-600 text-white flex items-center justify-center font-bold text-2xl shadow">
                                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                            </div>
                        @endif
                    </div>
                    <div>
                        <p class="font-bold text-slate-900 text-sm">Profile Photo</p>
                        <label class="mt-1.5 inline-flex items-center gap-1.5 text-sm font-bold text-blue-600 cursor-pointer hover:underline">
                            <i class="fa-solid fa-camera"></i> Change Photo
                            <input type="file" name="profile_photo" accept="image/*" class="hidden" onchange="this.form.submit()">
                        </label>
                        <p class="text-xs text-slate-400 mt-0.5">JPG, PNG, WebP · max 2MB</p>
                    </div>
                </div>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Full Name</label>
                        <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}"
                            class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Business Name</label>
                        <input type="text" name="business_name" value="{{ old('business_name', auth()->user()->business_name) }}"
                            class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email</label>
                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}"
                            class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}"
                            class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">WhatsApp</label>
                        <input type="text" name="whatsapp" value="{{ old('whatsapp', auth()->user()->whatsapp) }}"
                            class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Professional Title</label>
                        <input type="text" name="title" value="{{ old('title', auth()->user()->title) }}"
                            class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition">
                    </div>
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3 rounded-2xl text-base transition">
                    <i class="fa-solid fa-floppy-disk mr-2"></i> Save Changes
                </button>
            </form>
        </div>

        {{-- Change Password --}}
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-4">
            <h2 class="font-bold text-slate-900 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-lock text-blue-600 text-sm"></i> Change Password
            </h2>
            <form action="{{ route('seller.settings.update') }}" method="POST" class="space-y-4">
                @csrf @method('PUT')
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Current Password</label>
                    <input type="password" name="current_password"
                        class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition">
                    @error('current_password', 'updatePassword')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">New Password</label>
                        <input type="password" name="password"
                            class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Confirm Password</label>
                        <input type="password" name="password_confirmation"
                            class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition">
                    </div>
                </div>
                <button type="submit" class="bg-slate-800 hover:bg-slate-900 text-white font-bold px-8 py-3 rounded-2xl text-base transition">
                    <i class="fa-solid fa-lock mr-2"></i> Update Password
                </button>
            </form>
        </div>

        {{-- Notifications --}}
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-4">
            <h2 class="font-bold text-slate-900 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-bell text-blue-600 text-sm"></i> Notifications
            </h2>
            <div class="space-y-4">
                @foreach([
                    ['key'=>'notify_new_lead','label'=>'New Lead Alerts','desc'=>'Get notified immediately when a new lead comes in'],
                    ['key'=>'notify_payment','label'=>'Payment Reminders','desc'=>'Remind me about unpaid lead fees before deadline'],
                    ['key'=>'notify_review','label'=>'New Reviews','desc'=>'Alert me when a buyer leaves a review'],
                    ['key'=>'notify_booking','label'=>'Booking Requests','desc'=>'Notify me when someone books a time slot'],
                ] as $n)
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-semibold text-base text-slate-900">{{ $n['label'] }}</p>
                        <p class="text-sm text-slate-400">{{ $n['desc'] }}</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="{{ $n['key'] }}" {{ auth()->user()->{$n['key']} ?? true ? 'checked' : '' }} class="sr-only peer" onchange="saveNotification('{{ $n['key'] }}', this.checked)">
                        <div class="w-11 h-6 bg-slate-200 rounded-full peer peer-checked:bg-blue-600 peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all"></div>
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Public Page Link --}}
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-6 mb-4">
            <h2 class="font-bold text-slate-900 mb-1 flex items-center gap-2">
                <i class="fa-solid fa-link text-blue-600 text-sm"></i> Your Public Page
            </h2>
            <p class="text-xs text-slate-500 mb-3">Share this link with clients and on Google Business Profile</p>
            <div class="flex gap-2">
                <input type="text" readonly
                    value="{{ url('/service/' . (auth()->user()->slug ?? auth()->user()->id)) }}"
                    class="flex-1 text-sm bg-slate-50 border border-slate-200 rounded-2xl px-4 py-3 text-slate-600 font-mono focus:outline-none">
                <a href="{{ url('/service/' . (auth()->user()->slug ?? auth()->user()->id)) }}" target="_blank"
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-4 py-3 rounded-2xl text-sm transition shrink-0">
                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                </a>
            </div>
        </div>

        {{-- Danger Zone --}}
        <div class="bg-white rounded-3xl border border-red-100 shadow-sm p-6">
            <h2 class="font-bold text-red-600 mb-1 flex items-center gap-2">
                <i class="fa-solid fa-triangle-exclamation text-sm"></i> Danger Zone
            </h2>
            <p class="text-xs text-slate-500 mb-4">Permanently delete your account and all associated data. This cannot be undone.</p>
            <button onclick="document.getElementById('deleteModal').classList.remove('hidden')"
                class="bg-red-50 hover:bg-red-100 text-red-600 font-bold px-5 py-2.5 rounded-2xl text-sm border border-red-200 transition">
                <i class="fa-solid fa-trash mr-1"></i> Delete Account
            </button>
        </div>

    </div>
</div>

{{-- Delete Confirm Modal --}}
<div id="deleteModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 px-4">
    <div class="bg-white rounded-3xl p-8 max-w-sm w-full shadow-2xl">
        <div class="text-center mb-5">
            <div class="w-14 h-14 bg-red-100 rounded-2xl flex items-center justify-center mx-auto mb-3">
                <i class="fa-solid fa-trash text-red-600 text-xl"></i>
            </div>
            <h3 class="font-bold text-lg text-slate-900">Delete Account?</h3>
            <p class="text-sm text-slate-500 mt-1">All your data, leads, and profile will be permanently removed.</p>
        </div>
        <form action="{{ route('profile.destroy') }}" method="POST" class="space-y-4">
            @csrf @method('DELETE')
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1.5">Enter password to confirm</label>
                <input type="password" name="password" required placeholder="Your current password"
                    class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:border-red-400 focus:ring-2 focus:ring-red-50 transition">
            </div>
            <div class="flex gap-3">
                <button type="button" onclick="document.getElementById('deleteModal').classList.add('hidden')"
                    class="flex-1 border border-slate-200 text-slate-600 font-bold py-3 rounded-2xl text-sm hover:bg-slate-50 transition">Cancel</button>
                <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-2xl text-sm transition">Delete</button>
            </div>
        </form>
    </div>
</div>

<script>
function saveNotification(key, val) {
    fetch('/user/settings/notifications', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content || '' },
        body: JSON.stringify({ key, value: val })
    });
}
</script>
@endsection
