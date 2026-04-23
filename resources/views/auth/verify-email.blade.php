@extends('frontend.layouts._app')
@section('title', 'Verify Email')

@section('content')
<div class="min-h-screen bg-slate-50 flex items-center justify-center px-4 pt-20 pb-16">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 sm:p-10 text-center">

            <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-5">
                <i class="fa-solid fa-envelope-circle-check text-blue-600 text-2xl"></i>
            </div>

            <h1 class="text-2xl font-black text-slate-900 mb-2">Verify your email</h1>
            <p class="text-sm text-slate-500 leading-relaxed mb-6">
                Thanks for signing up! Click the link we sent to your email address to get started. Check your spam folder if you don't see it.
            </p>

            @if(session('status') == 'verification-link-sent')
            <div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-2xl">
                A new verification link has been sent to your email address.
            </div>
            @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-2xl text-sm transition">
                    Resend Verification Email
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="text-sm text-slate-400 hover:text-slate-600 hover:underline transition">
                    Log out
                </button>
            </form>

        </div>
    </div>
</div>
@endsection
