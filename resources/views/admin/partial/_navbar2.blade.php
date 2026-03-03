<div class="topbar" id="topbar">
    <div class="d-flex justify-content-between align-items-center">
        <h2 class="h4 mb-0">Dashboard Overview</h2>
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-outline-secondary btn-sm" id="themeToggle"><i class="fas fa-moon"></i></button>
            <div class="dropdown">
                <a class="dropdown-toggle text-decoration-none text-dark" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle fa-2x"></i> <strong>{{ Auth::user()->name }}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a href="{{ route('admin.clear.cache') }}" class="dropdown-item">Clear Cache</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    {{-- <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li> --}}
                    <li>
                        <form class="dropdown-item" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <input type="submit" value="Logout">
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
