@extends('frontend.layouts.__app')

@section('content')

<div class="max-w-4xl mx-auto py-12">

    <!-- Header -->
    <div class="text-center mb-10">
        <h1 class="text-4xl font-bold text-slate-900">Edit Your Profile</h1>
        <p class="text-slate-600 mt-2">Update your information step by step</p>
    </div>

    <!-- Step Navigation -->
    {{-- <div class="flex justify-between mb-10 text-sm font-semibold">

        @php
            $steps = ['account','service_location','contact','profile','review'];
        @endphp

        @foreach($steps as $step)
            <a href="{{ route('type.profile', [$type, $step]) }}"
               class="px-4 py-2 rounded-full
               {{ request()->segment(3) == $step ? 'bg-slate-900 text-white' : 'bg-slate-100 text-slate-600' }}">
                {{ ucfirst(str_replace('_',' ', $step)) }}
            </a>
        @endforeach

    </div> --}}

    <!-- Form Container -->
    <div class="bg-white shadow-2xl rounded-3xl p-8 border border-slate-100">

        @yield('form')

    </div>

</div>

@endsection