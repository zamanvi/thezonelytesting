@extends('frontend.layouts._app')
@section('title', 'Confirm Password')

@section('content')
<div class="min-h-screen bg-slate-50 flex items-center justify-center px-4 pt-20 pb-16">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 p-8 sm:p-10">

            <div class="text-center mb-8">
                <div class="w-14 h-14 bg-amber-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <i class="fa-solid fa-lock text-amber-600 text-xl"></i>
                </div>
                <h1 class="text-2xl font-black text-slate-900">Confirm identity</h1>
                <p class="text-sm text-slate-500 mt-1">This is a secure area. Please re-enter your password.</p>
            </div>

            @if($errors->any())
            <div class="mb-5 p-4 bg-red-50 border border-red-200 text-red-700 text-sm rounded-2xl">
                @foreach($errors->all() as $e)<p>{{ $e }}</p>@endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1.5">Password</label>
                    <input type="password" name="password" required
                        class="w-full px-4 py-3 border border-slate-200 rounded-2xl text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-50 transition bg-slate-50"
                        placeholder="Your current password">
                </div>
                <button type="submit"
                    class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-2xl text-sm transition">
                    Confirm
                </button>
            </form>

        </div>
    </div>
</div>
@endsection
