<!-- Navigation Menu -->
<nav class="navbar navbar-expand-lg navbar-dark py-3">
    <img src="{{ asset('frontend/img/new-logo.png') }}" class="mr-2" alt="{{ env('APP_NAME') }}" width="60px" style="object-fit: cover">
    <a class="navbar-brand" style="color: #17212b; font-size: 30px" href="{{ route('frontend.home') }}">{{ env('APP_NAME') }}</a>
    <button class="navbar-toggler" style="background-color: #000" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto mr-5">
            {{-- <li class="nav-item">
                <a style="color: #17212b" class="nav-link" href="{{ route('frontend.blog') }}">Blog</a>
            </li>
            <li class="nav-item dropdown">
                <a style="color: #17212b" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Types of Services
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item {{ Route::currentRouteName() == 'service1' ? 'active' : '' }}" href="{{ route('frontend.service1') }}">Tow trucks near me</a>
                    <a class="dropdown-item {{ Route::currentRouteName() == 'service2' ? 'active' : '' }}" href="{{ route('frontend.service2') }}">Tow truck company near me</a>
                    <a class="dropdown-item {{ Route::currentRouteName() == 'service3' ? 'active' : '' }}" href="{{ route('frontend.service3') }}">Cheap tow truck near me</a>
                    <a class="dropdown-item {{ Route::currentRouteName() == 'service4' ? 'active' : '' }}" href="{{ route('frontend.service4') }}">Tow Truck Service Near Me</a>
                    <a class="dropdown-item {{ Route::currentRouteName() == 'service5' ? 'active' : '' }}" href="{{ route('frontend.service5') }}">Tow Truck Companies Near Me</a>
                    <a class="dropdown-item {{ Route::currentRouteName() == 'service6' ? 'active' : '' }}" href="{{ route('frontend.service6') }}">Tow Truck Diecast 1:64 Scale</a>
                    <a class="dropdown-item {{ Route::currentRouteName() == 'service7' ? 'active' : '' }}" href="{{ route('frontend.service7') }}">Truck Towing Near Me</a>
                    <a class="dropdown-item {{ Route::currentRouteName() == 'service8' ? 'active' : '' }}" href="{{ route('frontend.service8') }}">$50 Tow Truck Near Me</a>
                    <a class="dropdown-item {{ Route::currentRouteName() == 'service9' ? 'active' : '' }}" href="{{ route('frontend.service9') }}">Tow Truck Near Me Cheap</a>
                </div>
            </li> --}}
            <li class="nav-item">
                <a style="color: #17212b" class="nav-link" href="{{ route('frontend.help') }}">Help</a>
            </li>
        </ul>
    </div>
</nav>
