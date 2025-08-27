<div class="iq-sidebar">
    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
            <ul id="iq-sidebar-toggle" class="iq-menu">
                <li class="@if (Route::is('admin.dashboard')) active @endif">
                    <a href="{{ route('admin.dashboard') }}">
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="@if (Route::is(['admin.blogs.create', 'admin.blogs.show', 'admin.blogs.edit'])) active @endif">
                    <a href="{{ route('admin.blogs.create') }}" class="iq-waves-effect collapsed"><i
                            class="ri-record-circle-line iq-arrow-left"></i>
                        <span>Blog Management</span>
                    </a>
                </li>
                <li class="@if (Route::is(['admin.categories.create', 'admin.categories.show', 'admin.categories.edit'])) active @endif">
                    <a href="{{ route('admin.categories.create') }}" class="iq-waves-effect collapsed"><i
                            class="ri-record-circle-line iq-arrow-left"></i>
                        <span>Categories</span>
                    </a>
                </li>
                <li class="@if (Route::is(['admin.services.create', 'admin.services.show', 'admin.services.edit'])) active @endif">
                    <a href="{{ route('admin.services.create') }}" class="iq-waves-effect collapsed"><i
                            class="ri-record-circle-line iq-arrow-left"></i>
                        <span>Services</span>
                    </a>
                </li>
                <li class="@if (Route::is(['admin.services.create', 'admin.services.show', 'admin.services.edit'])) active @endif">
                    <a href="{{ route('admin.services.create') }}" class="iq-waves-effect collapsed"><i
                            class="ri-record-circle-line iq-arrow-left"></i>
                        <span>Vendors</span>
                    </a> 
                </li>
                <li>
                    <a href="{{ route('admin.clear.cache') }}" class="iq-waves-effect collapsed"><i
                            class="ri-record-circle-line iq-arrow-left"></i>
                        <span>Clear Cache</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>
