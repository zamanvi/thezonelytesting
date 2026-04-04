@extends('frontend.layouts.__app')

@section('content')
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 text-gray-900">
                    @php
                        $user = Auth::user();
                    @endphp
                    @if (!$user->status)
                        <span style="color: red">{{ $user->remark }}</span> <br>
                    @endif
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
@endsection
