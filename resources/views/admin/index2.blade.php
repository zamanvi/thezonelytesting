@extends('layouts.admin2')

@section('title')
    {{ env('APP_NAME') }}
@endsection
@section('content')
    <div class="mt-5 pt-4">
        <!-- KPI Grid -->
        <div class="kpi-grid">
            <div class="kpi-card">
                <h3>1,248</h3>
                <p><i class="fas fa-user-tie text-primary"></i> Active Sellers</p>
            </div>
            <div class="kpi-card">
                <h3>89</h3>
                <p><i class="fas fa-shopping-cart text-success"></i> New Leads Today</p>
            </div>
            <div class="kpi-card">
                <h3>+18.4%</h3>
                <p><i class="fas fa-chart-line text-info"></i> Growth This Week</p>
            </div>
            <div class="kpi-card">
                <h3>97.2%</h3>
                <p><i class="fas fa-thumbs-up text-warning"></i> Satisfaction Rate</p>
            </div>
        </div>

        <!-- Users -->
        <div class="section-card" id="users">
            <div class="card-header bg-primary text-white p-4">
                <h5 class="mb-0"><i class="fas fa-users me-2"></i>A. Users</h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="p-3 border rounded text-center hover-shadow">
                            <i class="fas fa-user-friends fa-3x text-primary mb-3"></i>
                            <h6>Service Buyers</h6>
                            <p class="text-muted small">Customers searching and booking</p>
                            <button class="btn btn-outline-primary btn-sm" onclick="alert('Manage Buyers')">Manage
                                Buyers</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded text-center hover-shadow">
                            <i class="fas fa-tools fa-3x text-success mb-3"></i>
                            <h6>Service Sellers</h6>
                            <p class="text-muted small">Professionals offering services</p>
                            <button class="btn btn-outline-success btn-sm" onclick="alert('Manage Sellers')">Manage
                                Sellers</button>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 border rounded text-center hover-shadow">
                            <i class="fas fa-user-shield fa-3x text-warning mb-3"></i>
                            <h6>Admin Accounts</h6>
                            <p class="text-muted small">Internal management roles</p>
                            <button class="btn btn-outline-warning btn-sm" onclick="alert('Manage Admins')">Manage
                                Admins</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add (Setup) -->
        <div class="section-card" id="add-setup">
            <div class="card-header bg-success text-white p-4">
                <h5 class="mb-0"><i class="fas fa-cogs me-2"></i>B. Add (Setup)</h5>
            </div>
            <div class="card-body p-4">
                <div class="row">
                    <div class="col-lg-6 mb-4" id="areas">
                        <h6><i class="fas fa-map-marked-alt me-2"></i>Areas (Locations)</h6>
                        <ul class="list-group dynamic-list" id="areaList"></ul>
                        <button class="btn btn-sm btn-outline-success mt-2" onclick="addLocation()">Add
                            Location</button>
                    </div>
                    <div class="col-lg-6" id="service-categories">
                        <h6><i class="fas fa-tags me-2"></i>Categories (Services)</h6>
                        <ul class="list-group dynamic-list" id="categoryList"></ul>
                        <button class="btn btn-sm btn-outline-success mt-2" onclick="addCategory()">Add
                            Category</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Hierarchy -->
        <div class="section-card" id="admin-hierarchy">
            <div class="card-header bg-warning text-dark p-4">
                <h5 class="mb-0"><i class="fas fa-sitemap me-2"></i>C. Admin Hierarchy</h5>
            </div>
            <div class="card-body p-4">
                <ul class="list-group" id="adminHierarchy">
                    <!-- Dynamic roles -->
                </ul>
                <button class="btn btn-sm btn-outline-success mt-2" onclick="addRole()">Add New Role</button>
            </div>
        </div>
    </div>
@endsection
