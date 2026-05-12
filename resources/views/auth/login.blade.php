@extends('frontend.layouts._app')
@section('title', 'Log In')

@section('content')
<div class="min-h-screen bg-slate-50 flex items-center justify-center px-4 pt-20 pb-16">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 sm:p-10">

            <div class="text-center mb-8">
                <a href="{{ route('frontend.home') }}" class="inline-block mb-5">
                    <img src="{{ asset('frontend/img/zonely_logo.svg') }}" class="w-12 h-12 mx-auto" alt="Zonely">
                </a>
                <h1 class="text-2xl font-black text-slate-900">Welcome back</h1>
                <p class="text-sm text-slate-500 mt-1">Sign in to your Zonely account</p>
            </div>

            @if(session('status'))
            <div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm rounded-2xl">
                {{ session('status') }}
            </div>
            @endif

            @if($errors->any())
            <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-2xl">
                @foreach($errors->all() as $e)<p>{{ $e }}</p>@endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-1.5">Email address</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition bg-slate-50"
                            placeholder="you@example.com">
                    </div>
                    <div>
                        <div class="flex justify-between items-center mb-1.5">
                            <label class="text-sm font-semibold text-slate-700">Password</label>
                            @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs text-blue-600 hover:underline">Forgot password?</a>
                            @endif
                        </div>
                        <input type="password" name="password" required
                            class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition bg-slate-50"
                            placeholder="••••••••">
                    </div>
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="remember" id="remember"
                            class="w-4 h-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <label for="remember" class="text-sm text-slate-600">Remember me</label>
                    </div>
                </div>
                <button type="submit"
                    class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-2xl text-sm transition">
                    Sign In
                </button>
            </form>

            <p class="text-center text-sm text-slate-500 mt-6">
                Don't have an account?
                <a href="{{ route('user.register1') }}" class="text-blue-600 font-bold hover:underline">Get started free</a>
            </p>

        </div>
    </div>
</div>
@endsection
