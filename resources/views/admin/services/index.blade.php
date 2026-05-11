@extends('layouts.admin2')
@section('title', 'Services')

@section('content')
<div class="mt-5 pt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 fw-bold">All Services</h4>
            <p class="text-muted small mb-0">Services listed by sellers on their public profiles.</p>
        </div>
    </div>

    {{-- Stats --}}
    <div class="kpi-grid mb-4">
        @foreach([
            ['val'=>$stats['total'],    'label'=>'Total Services',    'icon'=>'fa-briefcase',    'color'=>'#0ea5e9'],
            ['val'=>$stats['active'],   'label'=>'Active',            'icon'=>'fa-circle-check', 'color'=>'#10b981'],
            ['val'=>$stats['inactive'], 'label'=>'Inactive',          'icon'=>'fa-circle-xmark', 'color'=>'#94a3b8'],
        ] as $s)
        <div class="kpi-card" style="border-left-color:{{ $s['color'] }}">
            <h3>{{ $s['val'] }}</h3>
            <p><i class="fas {{ $s['icon'] }}"></i> {{ $s['label'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Services Table --}}
    <div class="section-card">
        <div class="card-header bg-dark text-white p-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
            <h5 class="mb-0"><i class="fas fa-briefcase me-2"></i>Services</h5>
            <form method="GET" class="d-flex gap-2 flex-wrap">
                <input type="text" name="search" value="{{ request('search') }}"
                       class="form-control form-control-sm" placeholder="Search title or seller..." style="min-width:200px">
                <select name="status" class="form-select form-select-sm" style="min-width:130px">
                    <option value="">All Status</option>
                    <option value="active"   {{ request('status')==='active'   ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status')==='inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                <button class="btn btn-sm btn-light">Filter</button>
                @if(request('search') || request('status'))
                <a href="{{ route('admin.services.index') }}" class="btn btn-sm btn-outline-light">Clear</a>
                @endif
            </form>
        </div>

        <div class="card-body p-0">
            @if($services->count())
            <div class="table-responsive">
                <table class="table align-middle table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Service</th>
                            <th>Seller</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th width="80">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                        <tr>
                            <td class="text-muted small">{{ $loop->iteration + ($services->currentPage()-1)*$services->perPage() }}</td>
                            <td>
                                <div>
                                    <strong class="d-block">{{ $service->title }}</strong>
                                    @if($service->description)
                                    <span class="text-muted small">{{ Str::limit($service->description, 60) }}</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($service->user)
                                <div>
                                    <span class="d-block small fw-semibold">{{ $service->user->name }}</span>
                                    <span class="text-muted" style="font-size:11px">{{ $service->user->email }}</span>
                                </div>
                                @else
                                <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td class="small">{{ $service->category?->title ?? '—' }}</td>
                            <td class="small">
                                @if($service->price)
                                ${{ number_format($service->price, 2) }}
                                @if($service->pricing_type)
                                <span class="text-muted">/{{ $service->pricing_type }}</span>
                                @endif
                                @else
                                <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge {{ $service->is_active ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $service->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="small text-muted">{{ $service->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <form method="POST" action="{{ route('admin.services.toggle', $service->id) }}">
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-sm {{ $service->is_active ? 'btn-outline-warning' : 'btn-outline-success' }}"
                                                title="{{ $service->is_active ? 'Deactivate' : 'Activate' }}">
                                            <i class="fas {{ $service->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.services.destroy', $service->id) }}"
                                          onsubmit="return confirm('Delete this service?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if($services->hasPages())
            <div class="p-3 border-top d-flex justify-content-between align-items-center flex-wrap gap-2">
                <span class="text-muted small">
                    Showing {{ $services->firstItem() }}–{{ $services->lastItem() }} of {{ $services->total() }}
                </span>
                {{ $services->links() }}
            </div>
            @endif

            @else
            <div class="text-center py-5 text-muted">
                <i class="fas fa-briefcase fa-3x mb-3 opacity-25"></i>
                <p>No services found.</p>
            </div>
            @endif
        </div>
    </div>

</div>
@endsection
