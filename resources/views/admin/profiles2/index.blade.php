@extends('layouts.admin2')

@section('title')
    {{ ucfirst($type ?? ($status ?? 'All')) }} Profiles
@endsection

@section('content')
    <div class="mt-5 pt-4">

        <!-- Page Header -->
        <div class="section-card">
            <div class="card-header bg-primary text-white p-4 d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-users me-2"></i>
                    {{ ucfirst($type ?? ($status ?? 'All')) }} User Profiles
                </h5>

                <div class="btn-group flex-wrap gap-1">
                    <a href="{{ route('admin.profiles.index') }}"
                        class="btn btn-sm {{ !$type && !$status ? 'btn-light' : 'btn-outline-light' }}">All</a>
                    <a href="{{ route('admin.profiles.index', ['type' => 'seller']) }}"
                        class="btn btn-sm {{ $type == 'seller' ? 'btn-light' : 'btn-outline-light' }}">Sellers</a>
                    <a href="{{ route('admin.profiles.index', ['type' => 'user']) }}"
                        class="btn btn-sm {{ $type == 'user' ? 'btn-light' : 'btn-outline-light' }}">Buyers</a>
                    <a href="{{ route('admin.profiles.index', ['status' => 'verified']) }}"
                        class="btn btn-sm {{ ($status ?? '') == 'verified' ? 'btn-light' : 'btn-outline-light' }}">Verified</a>
                    <a href="{{ route('admin.profiles.index', ['status' => 'unverified']) }}"
                        class="btn btn-sm {{ ($status ?? '') == 'unverified' ? 'btn-light' : 'btn-outline-light' }}">Pending</a>
                </div>
            </div>

            <div class="card-body p-4">

                @if ($users->count() > 0)
                    <div class="table-responsive">
                        <table class="table align-middle table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Email</th>
                                    <th>City</th>
                                    <th>Status</th>
                                    <th>Joined</th>
                                    <th width="10">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $index => $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                @if($user->profile_photo)
                                                <img src="{{ asset($user->profile_photo) }}"
                                                     onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=36&background=0ea5e9&color=fff'"
                                                     class="rounded-circle" width="36" height="36" style="object-fit:cover">
                                                @else
                                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                                     style="width:36px;height:36px;font-size:13px;font-weight:700;flex-shrink:0">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                                @endif
                                                <div>
                                                    <strong>{{ $user->name }}</strong>
                                                    @if($user->designation ?? $user->title ?? false)
                                                    <div class="text-muted small">{{ $user->designation ?? $user->title }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge {{ $user->type === 'seller' ? 'bg-primary' : ($user->type === 'admin' ? 'bg-dark' : 'bg-secondary') }}">
                                                {{ ucfirst($user->type === 'user' ? 'buyer' : $user->type) }}
                                            </span>
                                        </td>
                                        <td class="small text-muted">{{ $user->email }}</td>
                                        <td class="small">{{ $user->city ?? '—' }}</td>
                                        <td>
                                            <span class="badge {{ $user->status ? 'bg-success' : 'bg-warning text-dark' }}">
                                                {{ $user->status ? 'Verified' : 'Pending' }}
                                            </span>
                                        </td>
                                        <td class="small text-muted">{{ $user->created_at?->format('M d, Y') }}</td>
                                        {{-- <td>
                                        @if ($user->type === 'admin')
                                            <span class="text-muted">N/A</span>
                                        @else
                                            @if ($user->status)
                                                <a href="{{ route('admin.profiles.edit', $user->id) }}"
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('admin.profiles.edit', $user->id) }}"
                                                   class="btn btn-sm btn-outline-success">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            @endif

                                            <form action="{{ route('admin.profiles.destroy', $user->id) }}"
                                                  method="POST"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger"
                                                        onclick="return confirm('Are you sure?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td> --}}
                                        <td>
                                            @if ($user->type === 'admin')
                                                <span class="text-muted">N/A</span>
                                            @else
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-light" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </button>

                                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">

                                                        @if ($user->status)
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.profiles.edit', $user->id) }}">
                                                                    <i class="fas fa-edit me-2 text-primary"></i> Edit
                                                                </a>
                                                            </li>
                                                        @else
                                                            <li>
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.profiles.edit', $user->id) }}">
                                                                    <i class="fas fa-check me-2 text-success"></i> Verify
                                                                </a>
                                                            </li>
                                                        @endif

                                                        <li>
                                                            <hr class="dropdown-divider">
                                                        </li>

                                                        <li>
                                                            <form action="{{ route('admin.profiles.destroy', $user->id) }}"
                                                                method="POST" onsubmit="return confirm('Delete user: ' + {{ @json($user->name) }} + '?')">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="dropdown-item text-danger">
                                                                    <i class="fas fa-trash me-2"></i> Delete
                                                                </button>
                                                            </form>
                                                        </li>

                                                    </ul>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-user-slash fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No profiles found.</p>
                    </div>
                @endif

            </div>
        </div>

    </div>
@endsection
