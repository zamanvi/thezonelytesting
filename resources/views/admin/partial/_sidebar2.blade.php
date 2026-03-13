<nav class="sidebar" id="sidebar">
    <div class="d-flex align-items-center justify-content-between mb-5">
        <h3 class="mb-0 logo-text"><a href="{{ route('admin.dashboard') }}"
                class="@if (Route::is('admin.dashboard')) active @endif"><i class="fas fa-home me-2"></i>Zonely</a></h3>
        <i class="fas fa-bars btn-toggle-sidebar text-white" id="toggleSidebar"></i>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item mb-2"><a href="{{ route('admin.blogs.create') }}"
                class="@if (Route::is(['admin.blogs.create', 'admin.blogs.show', 'admin.blogs.edit'])) active @endif"><i class="fas fa-users"></i><span
                    class="nav-text ms-3">Blog Management</span></a></li>
        <li class="nav-item mb-2"><a href="{{ route('admin.profiles.index') }}"
                class="@if (Route::is(['admin.profiles.index'])) active @endif"><i class="fas fa-users"></i><span
                    class="nav-text ms-3">All Profiles</span></a></li>
        <li class="nav-item mb-2"><a href="{{ route('admin.vehicles.index') }}"
                class="@if (Route::is([
                        'admin.vehicles.index',
                        'admin.vehicles.create',
                        'admin.vehicles.show',
                        'admin.vehicles.edit',
                        'admin.policies.create',
                        'admin.policies.show',
                        'admin.policies.edit',
                        'admin.payments.create',
                        'admin.payments.show',
                        'admin.payments.edit',
                    ])) active @endif"><i class="fas fa-users"></i><span
                    class="nav-text ms-3">All Vehicles</span></a></li>
        <li class="d-none nav-item mb-2"><a href="{{ route('admin.categories.index') }}"
                class="@if (Route::is(['admin.categories.create', 'admin.categories.show', 'admin.categories.edit'])) active @endif"><i class="fas fa-users"></i><span
                    class="nav-text ms-3">Categories</span></a></li>
        <li class="d-none nav-item mb-2"><a href="{{ route('admin.services.index') }}"
                class="@if (Route::is(['admin.services.create', 'admin.services.show', 'admin.services.edit'])) active @endif"><i class="fas fa-users"></i><span
                    class="nav-text ms-3">Services</span></a></li>
        {{-- <li class="d-none nav-item mb-2"><a href="{{ route('admin.vendors.index') }}" class="@if (Route::is(['admin.vendors.index'])) active @endif"><i class="fas fa-users"></i><span class="nav-text ms-3">Vendors</span></a></li> --}}
        {{-- <li class="nav-item mb-2"><a href="{{ route('admin.clear.cache') }}"><i class="fas fa-users"></i><span class="nav-text ms-3">Clear Cache</span></a></li> --}}
        <li class="nav-item mb-2">
            <a href="#" class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseAddSetup"
                aria-expanded="false" aria-controls="collapseAddSetup">
                <i class="fas fa-cogs"></i><span class="nav-text ms-3"> Add (Setup)</span>
                <i class="fas fa-chevron-down ms-auto"></i>
            </a>
            <ul class="nav collapse" id="collapseAddSetup" data-bs-parent="#sidebar-menu">
                <li class="nav-item">
                    <a href="#" class="nav-link ps-4 collapsed" data-bs-toggle="collapse"
                        data-bs-target="#collapseAreas" aria-expanded="false" aria-controls="collapseAreas">
                        <h6><i class="fas fa-map-marked-alt me-2"></i>Areas <i class="fas fa-chevron-down ms-auto"></i>
                        </h6>
                    </a>
                    <ul class="nav collapse" id="collapseAreas" data-bs-parent="#collapseAddSetup">
                        <li class="nav-item">
                            <a href="{{ route('admin.countries.create') }}" class="nav-link ps-4">
                                <h6><i class="fas fa-map-marked-alt me-2"></i>Countries</h6>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link ps-4 collapsed" data-bs-toggle="collapse"
                        data-bs-target="#collapseCategories" aria-expanded="false" aria-controls="collapseCategories">
                        <h6><i class="fas fa-tags me-2"></i> Service Categories <i
                                class="fas fa-chevron-down ms-auto"></i></h6>
                    </a>
                    <ul class="nav collapse" id="collapseCategories" data-bs-parent="#collapseAddSetup">
                    </ul>
                </li>
            </ul>
        </li>

        <li class="nav-item mb-2">
            <a href="#" class="nav-link collapsed" data-bs-toggle="collapse"
                data-bs-target="#collapseAdminHierarchy" aria-expanded="false" aria-controls="collapseAdminHierarchy">
                <i class="fas fa-sitemap"></i><span class="nav-text ms-3"> Admin Hierarchy</span>
                <i class="fas fa-chevron-down ms-auto"></i>
            </a>
            <ul class="nav collapse" id="collapseAdminHierarchy" data-bs-parent="#sidebar-menu">
            </ul>
        </li>


        {{-- <li class="nav-item mb-2"><a href="#Blog"><i class="fas fa-sitemap"></i><span class="nav-text ms-3">
                    Blog</span></a></li> --}}
        {{-- <li class="nav-item mt-5"><a href="#logout"><i class="fas fa-sign-out-alt"></i><span
                    class="nav-text ms-3">Logout</span></a></li> --}}
    </ul>
</nav>
