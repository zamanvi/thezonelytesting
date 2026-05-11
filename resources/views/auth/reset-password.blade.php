@extends('frontend.layouts._app')
@section('title', 'Set New Password')

@section('content')
<div class="min-h-screen bg-slate-50 flex items-center justify-center px-4 pt-20 pb-16">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 sm:p-10">

            <div class="text-center mb-8">
                <a href="{{ route('frontend.home') }}" class="inline-block mb-5">
                    <img src="{{ asset('frontend/img/zonely_logo.jpeg') }}" class="w-12 h-12 mx-auto" style="mix-blend-mode:multiply" alt="Zonely">
                </a>
                <h1 class="text-2xl font-black text-slate-900">Set new password</h1>
                <p class="text-sm text-slate-500 mt-1">Choose a strong password for your account.</p>
            </div>

            @if($errors->any())
            <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-2xl">
                @foreach($errors->all() as $e)<p>{{ $e }}</p>@endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email address</label>
                        <input type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus
                            class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition bg-slate-50">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">New password</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition bg-slate-50"
                            placeholder="Min. 8 characters">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Confirm password</label>
                        <input type="password" name="password_confirmation" required
                            class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition bg-slate-50"
                            placeholder="Repeat password">
                    </div>
                </div>

                <button type="submit"
                    class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-2xl text-sm transition">
                    Reset Password
                </button>
            </form>

        </div>
    </div>
</div>
@endsection
