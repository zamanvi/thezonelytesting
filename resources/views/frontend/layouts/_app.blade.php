<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title') - @isset($site_author) {{ $site_author }} @endisset Zonely</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Standard Meta --}}
    <meta name="title" content="{{ $meta_title ?? '' }}">
    <meta name="description" content="{{ $meta_description ?? '' }}">
    <meta name="keywords" content="{{ $meta_keywords ?? '' }}">

    {{-- Open Graph (Facebook, LinkedIn, WhatsApp) --}}
    <meta property="og:title" content="{{ $meta_title ?? '' }}">
    <meta property="og:description" content="{{ $meta_description ?? '' }}">
    <meta property="og:image" content="{{ asset('frontend/img/favicon.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="profile">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $meta_title ?? '' }}">
    <meta name="twitter:description" content="{{ $meta_description ?? '' }}">
    <meta name="twitter:image" content="{{ asset('frontend/img/favicon.png') }}">

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{ asset('frontend/img/favicon.png') }}" type="image/x-icon">

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
