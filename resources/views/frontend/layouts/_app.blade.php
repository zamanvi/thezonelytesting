<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title') - @isset($site_author) {{ $site_author }} @else Discover & Hire Local Experts Near Me @endisset </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="{{ $meta_title ?? '' }}">
    <meta name="description" content="{{ $meta_description ?? '' }}">
    <meta name="keywords" content="{{ $meta_keywords ?? '' }}">
    {{-- <link rel="shortcut icon" href="{{ asset('frontend/img/favicon.png') }}" type="image/x-icon"> --}}

    <meta name="google-site-verification" content="dwwJ-8RPBJ7ZKJVORVBjX84ehyNkdpSXMj3JsAqlZZQ" />

    @include('frontend.layouts._styles')
    @yield('css')
</head>

<body>
    <div class="container">
        @include('frontend.layouts._header')
        @yield('content')
        @include('frontend.layouts._footer')
    </div>
    @include('frontend.layouts._scripts')
    @yield('scripts')
</body>

</html>
