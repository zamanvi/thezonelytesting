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
                <li>
                    <a href="{{ route('admin.clear.cash') }}" class="iq-waves-effect collapsed"><i
                            class="ri-record-circle-line iq-arrow-left"></i>
                        <span>Clear Cash</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>
