<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') || Admin Panel - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
            --primary-accent: #0ea5e9;
            --success-color: #10b981;
            --warning-color: #f59e0b;
            --text-light: #e2e8f0;
        }

        body {
            background-color: #f1f5f9;
            transition: background-color 0.3s;
        }

        body.dark-mode {
            background-color: #0f172a;
            color: #e2e8f0;
        }

        body.dark-mode .topbar {
            background-color: var(--sidebar-bg);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
        }

        body.dark-mode .kpi-card,
        body.dark-mode .section-card {
            background-color: var(--sidebar-bg);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3);
        }

        body.dark-mode .kpi-card p {
            color: #94a3b8;
        }

        body.dark-mode .card-header {
            background-color: var(--sidebar-hover) !important;
        }

        body.dark-mode .text-dark {
            color: #e2e8f0 !important;
        }

        body.dark-mode .dropdown-menu {
            background-color: var(--sidebar-bg);
            color: #e2e8f0;
        }

        body.dark-mode .dropdown-item {
            color: #e2e8f0;
        }

        body.dark-mode .dropdown-item:hover {
            background-color: var(--sidebar-hover);
        }

        body.dark-mode .list-group-item {
            background-color: var(--sidebar-hover);
            color: #e2e8f0;
            border-color: #334155;
        }

        body.dark-mode .border {
            border-color: #334155 !important;
        }

        .sidebar {
            background-color: var(--sidebar-bg);
            color: var(--text-light);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 280px;
            padding: 1.5rem;
            transition: all 0.3s;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar.collapsed {
            width: 80px;
            padding: 1.5rem 0.8rem;
        }

        .sidebar.collapsed .nav-text,
        .sidebar.collapsed .logo-text {
            display: none;
        }

        .sidebar a {
            color: var(--text-light);
            text-decoration: none;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            transition: all 0.2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: var(--sidebar-hover);
            color: white;
        }

        .sidebar i {
            width: 36px;
            font-size: 1.2rem;
            text-align: center;
        }

        .main-content {
            margin-left: 280px;
            transition: all 0.3s;
            padding: 2rem;
        }

        .main-content.expanded {
            margin-left: 80px;
        }

        .topbar {
            background-color: white;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            padding: 1rem 2rem;
            position: fixed;
            top: 0;
            left: 280px;
            right: 0;
            z-index: 999;
            transition: all 0.3s;
        }

        .topbar.expanded {
            left: 80px;
        }

        .kpi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .kpi-card {
            background: white;
            padding: 1.5rem;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-left: 4px solid var(--primary-accent);
            transition: transform 0.2s;
        }

        .kpi-card:hover {
            transform: translateY(-5px);
        }

        .kpi-card h3 {
            margin: 0;
            font-size: 2rem;
        }

        .kpi-card p {
            margin: 0.5rem 0 0;
            color: #64748b;
        }

        .section-card {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            overflow: hidden;
            transition: transform 0.2s;
        }

        .section-card:hover {
            transform: translateY(-5px);
        }

        .btn-toggle-sidebar {
            cursor: pointer;
            font-size: 1.5rem;
        }

        .hover-shadow:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
            transition: all 0.2s;
        }

        .role-badge {
            font-size: 0.75rem;
            padding: 0.3rem 0.6rem;
            border-radius: 0.5rem;
        }

        ul.dynamic-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.3rem;
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
                padding: 1.5rem 0.8rem;
            }

            .sidebar .nav-text,
            .sidebar .logo-text {
                display: none;
            }

            .main-content,
            .topbar {
                margin-left: 80px;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    @include('admin.partial._sidebar2')

    <!-- Topbar -->
    @include('admin.partial._navbar2')

    <!-- Main Content -->
    <main class="main-content" id="mainContent">
        @yield('content')
    </main>

    <!-- Modal for Add Location -->
    <div class="modal fade" id="addLocationModal" tabindex="-1" aria-labelledby="addLocationLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLocationLabel">Add Location</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="locationInput"
                        placeholder="Enter Location (Country/State/City/Area)">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveLocation()">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Add Category -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control" id="categoryInput"
                        placeholder="Enter Category (Mother/Child)">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveCategory()">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Add Role -->
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRoleLabel">Add New Role</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control mb-3" id="roleName" placeholder="Role Name">
                    <input type="text" class="form-control" id="roleLevel" placeholder="Level (e.g., Level 6)">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="saveRole()">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        /* Sidebar Toggle */
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('collapsed');
            document.getElementById('mainContent').classList.toggle('expanded');
            document.getElementById('topbar').classList.toggle('expanded');
        });

        /* Theme Toggle */
        // document.getElementById('themeToggle').addEventListener('click', function() {
        //     document.body.classList.toggle('dark-mode');
        //     const icon = this.querySelector('i');
        //     icon.classList.toggle('fa-moon');
        //     icon.classList.toggle('fa-sun');
        // });
        // Apply the saved theme on page load
        document.addEventListener('DOMContentLoaded', () => {
            const isDarkMode = localStorage.getItem('darkMode') === 'true';
            if (isDarkMode) {
                document.body.classList.add('dark-mode');
                const icon = document.getElementById('themeToggle').querySelector('i');
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            }
        });

        // Toggle theme on button click
        document.getElementById('themeToggle').addEventListener('click', function() {
            document.body.classList.toggle('dark-mode');

            const isDark = document.body.classList.contains('dark-mode');
            localStorage.setItem('darkMode', isDark); // Save preference

            const icon = this.querySelector('i');
            icon.classList.toggle('fa-moon');
            icon.classList.toggle('fa-sun');
        });

        /* Active Link Highlight */
        // document.querySelectorAll('.sidebar a').forEach(link => {
        //     link.addEventListener('click', function() {
        //         document.querySelectorAll('.sidebar a').forEach(l => l.classList.remove('active'));
        //         this.classList.add('active');
        //     });
        // });

        /* Dynamic Locations, Categories, Roles */
        // let locations = [];
        // let categories = [];
        // let roles = [{
        //         name: 'CEO Team – Full Control',
        //         level: 'Level 1',
        //         badge: 'bg-dark text-light',
        //         icon: 'crown'
        //     },
        //     {
        //         name: 'Country Manager',
        //         level: 'Level 2',
        //         badge: 'bg-primary',
        //         icon: 'globe'
        //     },
        //     {
        //         name: 'State Manager',
        //         level: 'Level 3',
        //         badge: 'bg-success',
        //         icon: 'map'
        //     },
        //     {
        //         name: 'District Manager',
        //         level: 'Level 4',
        //         badge: 'bg-info',
        //         icon: 'vector-square'
        //     },
        //     {
        //         name: 'City Manager',
        //         level: 'Level 5',
        //         badge: 'bg-warning',
        //         icon: 'city'
        //     },
        //     {
        //         name: 'Area Manager',
        //         level: 'Level 6',
        //         badge: 'bg-secondary',
        //         icon: 'map-marked-alt'
        //     }
        // ];

        // function addLocation() {
        //     new bootstrap.Modal(document.getElementById('addLocationModal')).show();
        // }

        // function saveLocation() {
        //     let name = document.getElementById('locationInput').value;
        //     if (name) {
        //         locations.push(name);
        //         renderList('areaList', locations);
        //         renderSidebarAreas();
        //     }
        //     bootstrap.Modal.getInstance(document.getElementById('addLocationModal')).hide();
        //     document.getElementById('locationInput').value = '';
        // }

        // function addCategory() {
        //     new bootstrap.Modal(document.getElementById('addCategoryModal')).show();
        // }

        // function saveCategory() {
        //     let name = document.getElementById('categoryInput').value;
        //     if (name) {
        //         categories.push(name);
        //         renderList('categoryList', categories);
        //         renderSidebarCategories();
        //     }
        //     bootstrap.Modal.getInstance(document.getElementById('addCategoryModal')).hide();
        //     document.getElementById('categoryInput').value = '';
        // }

        // function addRole() {
        //     new bootstrap.Modal(document.getElementById('addRoleModal')).show();
        // }

        // function saveRole() {
        //     let name = document.getElementById('roleName').value;
        //     let level = document.getElementById('roleLevel').value;
        //     if (name && level) {
        //         roles.push({
        //             name,
        //             level,
        //             badge: 'bg-secondary',
        //             icon: 'user-shield'
        //         });
        //         renderAdminHierarchy();
        //         renderSidebarAdmin();
        //     }
        //     bootstrap.Modal.getInstance(document.getElementById('addRoleModal')).hide();
        //     document.getElementById('roleName').value = '';
        //     document.getElementById('roleLevel').value = '';
        // }

        // function renderList(listId, items) {
        //     let list = document.getElementById(listId);
        //     list.innerHTML = '';
        //     items.forEach((item, i) => {
        //         let li = document.createElement('li');
        //         li.className = 'list-group-item d-flex justify-content-between align-items-center';
        //         li.innerHTML =
        //             `${item} <button class="btn btn-sm btn-outline-danger" onclick="removeItem('${listId}', ${i})">Remove</button>`;
        //         list.appendChild(li);
        //     });
        // }

        // function removeItem(listId, index) {
        //     if (confirm('Remove this item?')) {
        //         if (listId === 'areaList') {
        //             locations.splice(index, 1);
        //             renderList('areaList', locations);
        //             renderSidebarAreas();
        //         }
        //         if (listId === 'categoryList') {
        //             categories.splice(index, 1);
        //             renderList('categoryList', categories);
        //             renderSidebarCategories();
        //         }
        //     }
        // }

        // function renderSidebarAreas() {
        //     let areaUl = document.getElementById('collapseAreas');
        //     areaUl.innerHTML = '';
        //     locations.forEach((loc) => {
        //         let li = document.createElement('li');
        //         li.className = 'nav-item';
        //         li.innerHTML = `<a href="#" class="nav-link ps-5">${loc}</a>`;
        //         areaUl.appendChild(li);
        //     });
        // }

        // function renderSidebarCategories() {
        //     let catUl = document.getElementById('collapseCategories');
        //     catUl.innerHTML = '';
        //     categories.forEach((cat) => {
        //         let li = document.createElement('li');
        //         li.className = 'nav-item';
        //         li.innerHTML = `<a href="#" class="nav-link ps-5">${cat}</a>`;
        //         catUl.appendChild(li);
        //     });
        // }

        // function renderAdminHierarchy() {
        //     let list = document.getElementById('adminHierarchy');
        //     list.innerHTML = '';
        //     roles.forEach((role, i) => {
        //         let li = document.createElement('li');
        //         li.className = 'list-group-item d-flex justify-content-between align-items-center';
        //         li.innerHTML =
        //             `${role.name} <span class="role-badge ${role.badge}">${role.level}</span> <button class="btn btn-sm btn-outline-dark" onclick="manageRole('${role.name}')">Manage</button> <button class="btn btn-sm btn-outline-danger" onclick="removeRole(${i})">Remove</button>`;
        //         list.appendChild(li);
        //     });
        // }

        // function removeRole(index) {
        //     if (confirm('Remove this role?')) {
        //         roles.splice(index, 1);
        //         renderAdminHierarchy();
        //         renderSidebarAdmin();
        //     }
        // }

        // function renderSidebarAdmin() {
        //     let adminUl = document.getElementById('collapseAdminHierarchy');
        //     adminUl.innerHTML = '';
        //     roles.forEach((role) => {
        //         let li = document.createElement('li');
        //         li.className = 'nav-item';
        //         li.innerHTML = `<a href="#" class="nav-link ps-4">
        //         <h6><i class="fas fa-${role.icon} me-2"></i>${role.name} <small class="text-muted">${role.level}</small></h6>
        //     </a>`;
        //         adminUl.appendChild(li);
        //     });
        // }

        /* Admin Role Management */
        // function manageRole(role) {
        //     alert(`Managing ${role} (simulate assignments, AI leads, etc.)`);
        // }

        /* AI Auto-Assign Simulation */
        // document.getElementById('aiAssignBtn').addEventListener('click', () => {
        //     alert("AI auto-assignment of leads to managers/sellers simulated!");
        // });

        /* Initial Renders */
        // renderAdminHierarchy();
        // renderSidebarAdmin();
        // renderSidebarAreas();
        // renderSidebarCategories();
    </script>
    @yield('scripts')
</body>

</html>
