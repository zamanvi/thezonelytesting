@extends('layouts.admin2')
@section('title', 'Locations & Areas')

@section('content')
<div class="mt-5 pt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 fw-bold">Locations &amp; Areas</h4>
            <p class="text-muted small mb-0">Manage Countries → States → Cities → ZIP codes.</p>
        </div>
    </div>

    {{-- Stats --}}
    <div class="kpi-grid mb-4" style="grid-template-columns:repeat(auto-fit,minmax(150px,1fr))">
        <div class="kpi-card" style="border-left-color:#0ea5e9">
            <h3>{{ $stats['countries'] }}</h3>
            <p><i class="fas fa-flag text-primary"></i> Countries</p>
        </div>
        <div class="kpi-card" style="border-left-color:#8b5cf6">
            <h3>{{ $stats['states'] }}</h3>
            <p><i class="fas fa-map" style="color:#8b5cf6"></i> States</p>
        </div>
        <div class="kpi-card" style="border-left-color:#f59e0b">
            <h3>{{ $stats['cities'] }}</h3>
            <p><i class="fas fa-city text-warning"></i> Cities</p>
        </div>
        <div class="kpi-card" style="border-left-color:#10b981">
            <h3>{{ $stats['zips'] }}</h3>
            <p><i class="fas fa-map-pin text-success"></i> ZIP Codes</p>
        </div>
    </div>

    {{-- Tabs --}}
    <div class="section-card">
        <div class="card-header bg-dark text-white p-0">
            <ul class="nav nav-tabs px-4 pt-3 border-0" id="locationTabs">
                @foreach(['countries'=>'Countries','states'=>'States','cities'=>'Cities','zips'=>'ZIP Codes'] as $key=>$label)
                <li class="nav-item">
                    <a href="{{ route('admin.locations', ['tab'=>$key]) }}"
                       class="nav-link text-white {{ $tab===$key ? 'active text-dark' : 'border-0 opacity-75' }}">
                        {{ $label }}
                        <span class="badge ms-1" style="font-size:10px;background:{{ ['countries'=>'#0ea5e9','states'=>'#8b5cf6','cities'=>'#f59e0b','zips'=>'#10b981'][$key] }}">
                            {{ $stats[$key] }}
                        </span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>

        {{-- COUNTRIES TAB --}}
        @if($tab === 'countries')
        <div class="card-body p-0">
            {{-- Inline Add Form --}}
            <div class="p-4 border-bottom bg-light">
                <form method="POST" action="{{ route('admin.countries.store') }}" class="row g-2 align-items-end">
                    @csrf
                    <div class="col-md-4">
                        <label class="form-label fw-semibold small mb-1">Country Name</label>
                        <input type="text" name="title" class="form-control form-control-sm" required placeholder="e.g. United States">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small mb-1">Slug <span class="text-muted">(optional)</span></label>
                        <input type="text" name="slug" class="form-control form-control-sm" placeholder="united-states">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold small mb-1">Status</label>
                        <select name="status" class="form-select form-select-sm">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-auto">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Add Country
                        </button>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="countriesTable">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Country</th>
                            <th>Slug</th>
                            <th class="text-center">States</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($countries as $i => $c)
                        <tr>
                            <td class="text-muted small">{{ $i+1 }}</td>
                            <td class="fw-semibold">{{ $c->title }}</td>
                            <td><code class="small text-muted">{{ $c->slug }}</code></td>
                            <td class="text-center">
                                <a href="{{ route('admin.locations', ['tab'=>'states']) }}"
                                   class="badge bg-primary text-decoration-none">{{ $c->states_count }}</a>
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $c->status ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $c->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                        <li>
                                            <button class="dropdown-item" onclick="openInlineEdit('country',{{ $c->id }},'{{ addslashes($c->title) }}','{{ $c->slug }}',{{ $c->status }})">
                                                <i class="fas fa-edit me-2 text-primary"></i> Edit
                                            </button>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="POST" action="{{ route('admin.countries.destroy',$c->id) }}"
                                                  onsubmit="return confirm('Delete {{ addslashes($c->title) }}?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="fas fa-trash me-2"></i> Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">No countries yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        {{-- STATES TAB --}}
        @if($tab === 'states')
        <div class="card-body p-0">
            <div class="p-4 border-bottom bg-light">
                <form method="POST" action="{{ route('admin.countries.states.store', 0) }}" class="row g-2 align-items-end"
                      id="stateForm">
                    @csrf
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small mb-1">Country <span class="text-danger">*</span></label>
                        <select name="country_id" class="form-select form-select-sm" required id="stateCountrySelect"
                                onchange="document.getElementById('stateForm').action='/admin/countries/'+this.value+'/states'">
                            <option value="">-- Select Country --</option>
                            @foreach($countries as $c)
                            <option value="{{ $c->id }}">{{ $c->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small mb-1">State Name</label>
                        <input type="text" name="title" class="form-control form-control-sm" required placeholder="e.g. California">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold small mb-1">Slug</label>
                        <input type="text" name="slug" class="form-control form-control-sm" placeholder="california">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold small mb-1">Status</label>
                        <select name="status" class="form-select form-select-sm">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Add State
                        </button>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>State</th>
                            <th>Country</th>
                            <th>Slug</th>
                            <th class="text-center">Cities</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($states as $i => $s)
                        <tr>
                            <td class="text-muted small">{{ $i+1 }}</td>
                            <td class="fw-semibold">{{ $s->title }}</td>
                            <td class="small text-muted">{{ $s->country?->title }}</td>
                            <td><code class="small text-muted">{{ $s->slug }}</code></td>
                            <td class="text-center">
                                <span class="badge bg-primary">{{ $s->cities_count }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $s->status ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $s->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.countries.states.edit', [$s->country_id, $s->id]) }}">
                                                <i class="fas fa-edit me-2 text-primary"></i> Edit
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="POST" action="{{ route('admin.countries.states.destroy', [$s->country_id, $s->id]) }}"
                                                  onsubmit="return confirm('Delete {{ addslashes($s->title) }}?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="fas fa-trash me-2"></i> Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">No states yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        {{-- CITIES TAB --}}
        @if($tab === 'cities')
        <div class="card-body p-0">
            <div class="p-4 border-bottom bg-light">
                <form method="POST" action="{{ route('admin.states.cities.store', 0) }}" class="row g-2 align-items-end" id="cityForm">
                    @csrf
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small mb-1">State <span class="text-danger">*</span></label>
                        <select name="state_id" class="form-select form-select-sm" required
                                onchange="document.getElementById('cityForm').action='/admin/states/'+this.value+'/cities'">
                            <option value="">-- Select State --</option>
                            @foreach($states as $s)
                            <option value="{{ $s->id }}">{{ $s->title }} ({{ $s->country?->title }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small mb-1">City Name</label>
                        <input type="text" name="title" class="form-control form-control-sm" required placeholder="e.g. Los Angeles">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold small mb-1">Slug</label>
                        <input type="text" name="slug" class="form-control form-control-sm" placeholder="los-angeles">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold small mb-1">Status</label>
                        <select name="status" class="form-select form-select-sm">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Add City
                        </button>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Slug</th>
                            <th class="text-center">ZIPs</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cities as $i => $city)
                        <tr>
                            <td class="text-muted small">{{ $i+1 }}</td>
                            <td class="fw-semibold">{{ $city->title }}</td>
                            <td class="small text-muted">{{ $city->state?->title }}</td>
                            <td><code class="small text-muted">{{ $city->slug }}</code></td>
                            <td class="text-center">
                                <span class="badge bg-success">{{ $city->postal_codes_count }}</span>
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $city->status ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $city->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.states.cities.edit', [$city->state_id, $city->id]) }}">
                                                <i class="fas fa-edit me-2 text-primary"></i> Edit
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="POST" action="{{ route('admin.states.cities.destroy', [$city->state_id, $city->id]) }}"
                                                  onsubmit="return confirm('Delete {{ addslashes($city->title) }}?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="fas fa-trash me-2"></i> Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="7" class="text-center text-muted py-4">No cities yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        {{-- ZIP CODES TAB --}}
        @if($tab === 'zips')
        <div class="card-body p-0">
            <div class="p-4 border-bottom bg-light">
                <form method="POST" action="{{ route('admin.cities.postal-codes.store', 0) }}" class="row g-2 align-items-end" id="zipForm">
                    @csrf
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small mb-1">City <span class="text-danger">*</span></label>
                        <select name="city_id" class="form-select form-select-sm" required
                                onchange="document.getElementById('zipForm').action='/admin/cities/'+this.value+'/postal-codes'">
                            <option value="">-- Select City --</option>
                            @foreach($cities as $city)
                            <option value="{{ $city->id }}">{{ $city->title }} ({{ $city->state?->title }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small mb-1">ZIP / Postal Code</label>
                        <input type="text" name="title" class="form-control form-control-sm" required placeholder="e.g. 90210">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold small mb-1">Slug</label>
                        <input type="text" name="slug" class="form-control form-control-sm" placeholder="90210">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold small mb-1">Status</label>
                        <select name="status" class="form-select form-select-sm">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i> Add ZIP
                        </button>
                    </div>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>ZIP Code</th>
                            <th>City</th>
                            <th>Slug</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($zips as $i => $zip)
                        <tr>
                            <td class="text-muted small">{{ $i+1 }}</td>
                            <td class="fw-semibold font-monospace">{{ $zip->title }}</td>
                            <td class="small text-muted">{{ $zip->city?->title }}</td>
                            <td><code class="small text-muted">{{ $zip->slug }}</code></td>
                            <td class="text-center">
                                <span class="badge {{ $zip->status ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $zip->status ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.cities.postal-codes.edit', [$zip->city_id, $zip->id]) }}">
                                                <i class="fas fa-edit me-2 text-primary"></i> Edit
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="POST" action="{{ route('admin.cities.postal-codes.destroy', [$zip->city_id, $zip->id]) }}"
                                                  onsubmit="return confirm('Delete ZIP {{ addslashes($zip->title) }}?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="fas fa-trash me-2"></i> Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="6" class="text-center text-muted py-4">No ZIP codes yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endif

    </div>

</div>

{{-- Inline Edit Modal (Countries) --}}
<div class="modal fade" id="inlineEditModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inlineEditTitle">Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" id="inlineEditForm">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Name</label>
                        <input type="text" name="title" id="inlineTitle" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Slug</label>
                        <input type="text" name="slug" id="inlineSlug" class="form-control">
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" id="inlineStatus" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function openInlineEdit(type, id, title, slug, status) {
    const routeMap = {
        country: `/admin/countries/${id}`,
    };
    document.getElementById('inlineEditForm').action = routeMap[type] || `/admin/countries/${id}`;
    document.getElementById('inlineEditTitle').textContent = 'Edit ' + type.charAt(0).toUpperCase() + type.slice(1);
    document.getElementById('inlineTitle').value  = title;
    document.getElementById('inlineSlug').value   = slug;
    document.getElementById('inlineStatus').value = status;
    new bootstrap.Modal(document.getElementById('inlineEditModal')).show();
}
</script>
@endsection
