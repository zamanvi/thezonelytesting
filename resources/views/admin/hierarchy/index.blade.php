@extends('layouts.admin2')
@section('title', 'Staff Hierarchy')

@section('content')
<div class="mt-5 pt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 fw-bold">Staff Hierarchy</h4>
            <p class="text-muted small mb-0">Manage the Area → City → District → Country Manager chain of command.</p>
        </div>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addStaffModal">
            <i class="fas fa-plus me-1"></i> Add Staff
        </button>
    </div>

    {{-- Chain of Command Visual --}}
    <div class="section-card mb-4">
        <div class="card-body p-4">
            <h6 class="fw-bold mb-3 text-muted text-uppercase" style="font-size:11px;letter-spacing:.08em">Chain of Command</h6>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                @php
                    $chain = [
                        ['role'=>'area_manager',     'label'=>'Area Manager',     'icon'=>'fa-map-pin',     'color'=>'#0ea5e9'],
                        ['role'=>'city_manager',      'label'=>'City Manager',     'icon'=>'fa-city',        'color'=>'#8b5cf6'],
                        ['role'=>'district_manager',  'label'=>'District Manager', 'icon'=>'fa-map',         'color'=>'#f59e0b'],
                        ['role'=>'country_manager',   'label'=>'Country Manager',  'icon'=>'fa-flag-usa',    'color'=>'#ef4444'],
                        ['role'=>null,                'label'=>'Founder / CEO',    'icon'=>'fa-crown',       'color'=>'#10b981'],
                    ];
                @endphp
                @foreach($chain as $i => $tier)
                <div class="d-flex align-items-center gap-2">
                    <div class="text-center px-3 py-2 rounded-3 border {{ $role === $tier['role'] ? 'text-white' : '' }}"
                         style="background:{{ $role===$tier['role'] ? $tier['color'] : 'transparent' }};border-color:{{ $tier['color'] }}!important;min-width:120px">
                        <div style="color:{{ $role===$tier['role']?'#fff':$tier['color'] }};font-size:18px">
                            <i class="fas {{ $tier['icon'] }}"></i>
                        </div>
                        <div class="fw-bold small mt-1" style="color:{{ $role===$tier['role']?'#fff':$tier['color'] }};font-size:11px">
                            {{ $tier['label'] }}
                        </div>
                        @if($tier['role'])
                        <div class="badge mt-1" style="background:{{ $role===$tier['role']?'rgba(255,255,255,.25)':$tier['color'] }};font-size:9px">
                            {{ $counts[$tier['role']] ?? 0 }} staff
                        </div>
                        @endif
                    </div>
                    @if(!$loop->last)
                    <i class="fas fa-chevron-right text-muted"></i>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Stats Strip --}}
    <div class="kpi-grid mb-4" style="grid-template-columns:repeat(auto-fit,minmax(160px,1fr))">
        @php
            $roleColors = ['area_manager'=>'#0ea5e9','city_manager'=>'#8b5cf6','district_manager'=>'#f59e0b','country_manager'=>'#ef4444'];
        @endphp
        @foreach(\App\Models\StaffProfile::ROLES as $rKey => $rLabel)
        <div class="kpi-card" style="border-left-color:{{ $roleColors[$rKey] }}">
            <h3>{{ $counts[$rKey] }}</h3>
            <p style="font-size:12px">{{ $rLabel }}s</p>
        </div>
        @endforeach
        <div class="kpi-card" style="border-left-color:#10b981">
            <h3>{{ $totalActive }}</h3>
            <p style="font-size:12px"><i class="fas fa-check-circle text-success"></i> Active</p>
        </div>
        <div class="kpi-card" style="border-left-color:#10b981">
            <h3>${{ number_format($totalRevenue,0) }}</h3>
            <p style="font-size:12px"><i class="fas fa-dollar-sign text-success"></i> Total Revenue</p>
        </div>
    </div>

    {{-- Tab Navigation --}}
    <div class="section-card">
        <div class="card-header bg-dark text-white p-0">
            <div class="d-flex align-items-center justify-content-between px-4 pt-3">
                <h5 class="mb-0 pb-3">
                    <i class="fas fa-sitemap me-2"></i>
                    Staff — {{ \App\Models\StaffProfile::ROLES[$role] ?? $role }}
                </h5>
                <input type="text" id="staffSearch" class="form-control form-control-sm mb-3"
                       placeholder="Search staff..." style="min-width:200px"
                       oninput="filterStaff(this.value)">
            </div>
            <ul class="nav nav-tabs px-4 border-0">
                @foreach(\App\Models\StaffProfile::ROLES as $rKey => $rLabel)
                <li class="nav-item">
                    <a href="{{ route('admin.hierarchy', ['role' => $rKey]) }}"
                       class="nav-link text-white {{ $role === $rKey ? 'active text-dark' : 'border-0 opacity-75' }}">
                        {{ $rLabel }}
                        <span class="badge ms-1" style="background:{{ $roleColors[$rKey] }};font-size:10px">{{ $counts[$rKey] }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>

        <div class="card-body p-0">
            @if($staff->count())
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="staffTable">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name / Contact</th>
                            <th>Assigned Area</th>
                            <th>Reports To</th>
                            <th class="text-center">Salary</th>
                            <th class="text-center">Commission</th>
                            <th class="text-center">Sellers</th>
                            <th class="text-center">Revenue</th>
                            <th class="text-center">Dispute %</th>
                            <th class="text-center">Status</th>
                            <th>Joined</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($staff as $i => $s)
                        @php
                            $statusColor = match($s->status) {
                                'active'    => 'bg-success',
                                'inactive'  => 'bg-secondary',
                                'probation' => 'bg-warning text-dark',
                                default     => 'bg-secondary',
                            };
                        @endphp
                        <tr>
                            <td class="text-muted small">{{ $i+1 }}</td>

                            {{-- Name --}}
                            <td>
                                <div class="fw-bold small">{{ $s->user?->name ?? '—' }}</div>
                                <div class="text-muted" style="font-size:11px">{{ $s->user?->email }}</div>
                                @if($s->user?->phone)
                                <div class="text-muted" style="font-size:11px">
                                    <i class="fas fa-phone fa-xs me-1"></i>{{ $s->user->phone }}
                                </div>
                                @endif
                            </td>

                            {{-- Area --}}
                            <td>
                                <div class="small">{{ $s->assigned_area ?: '—' }}</div>
                                @if($s->assigned_state)
                                <div class="text-muted" style="font-size:11px">{{ $s->assigned_state }}</div>
                                @endif
                            </td>

                            {{-- Reports To --}}
                            <td>
                                @if($s->parent)
                                <div class="small fw-semibold">{{ $s->parent->user?->name ?? '—' }}</div>
                                <div class="text-muted" style="font-size:11px">{{ \App\Models\StaffProfile::ROLES[$s->parent->role] ?? '' }}</div>
                                @else
                                <span class="text-muted small">{{ $role === 'country_manager' ? 'Founder / CEO' : '—' }}</span>
                                @endif
                            </td>

                            {{-- Salary --}}
                            <td class="text-center fw-bold small">${{ number_format($s->base_salary,0) }}</td>

                            {{-- Commission --}}
                            <td class="text-center small">{{ $s->commission_rate }}%</td>

                            {{-- Sellers onboarded / active --}}
                            <td class="text-center">
                                <div class="small fw-bold">{{ $s->sellers_onboarded }}</div>
                                <div class="text-muted" style="font-size:10px">{{ $s->active_sellers }} active</div>
                            </td>

                            {{-- Revenue --}}
                            <td class="text-center fw-bold small text-success">${{ number_format($s->revenue_generated,0) }}</td>

                            {{-- Dispute Rate --}}
                            <td class="text-center">
                                <span class="badge {{ $s->dispute_rate > 10 ? 'bg-danger' : ($s->dispute_rate > 5 ? 'bg-warning text-dark' : 'bg-success') }}">
                                    {{ $s->dispute_rate }}%
                                </span>
                            </td>

                            {{-- Status --}}
                            <td class="text-center">
                                <span class="badge {{ $statusColor }}">{{ ucfirst($s->status) }}</span>
                            </td>

                            {{-- Joined --}}
                            <td class="small text-muted">{{ $s->joined_at?->format('M d, Y') ?? '—' }}</td>

                            {{-- Actions --}}
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                        <li>
                                            <button class="dropdown-item" type="button"
                                                    data-update-url="{{ route('admin.hierarchy.update', $s->id) }}"
                                                    onclick="openEditModal({{ $s->id }}, this.dataset.updateUrl, {{ json_encode(['assigned_area'=>$s->assigned_area,'assigned_state'=>$s->assigned_state,'base_salary'=>$s->base_salary,'commission_rate'=>$s->commission_rate,'joined_at'=>$s->joined_at,'sellers_onboarded'=>$s->sellers_onboarded,'active_sellers'=>$s->active_sellers,'dispute_rate'=>$s->dispute_rate,'revenue_generated'=>$s->revenue_generated,'notes'=>$s->notes,'parent_id'=>$s->parent_id]) }})">
                                                <i class="fas fa-edit me-2 text-primary"></i> Edit
                                            </button>
                                        </li>
                                        <li>
                                            @php $toggleAction = $s->status === 'active' ? 'Deactivate' : 'Activate'; @endphp
                                            <form method="POST" action="{{ route('admin.hierarchy.status', $s->id) }}"
                                                  onsubmit="return confirm('{{ $toggleAction }} {{ e($s->user?->name ?? 'this staff member') }}?')">
                                                @csrf
                                                <button type="submit" class="dropdown-item text-warning">
                                                    <i class="fas fa-toggle-on me-2"></i>
                                                    {{ $s->status === 'active' ? 'Deactivate' : 'Activate' }}
                                                </button>
                                            </form>
                                        </li>
                                        @if($s->notes)
                                        <li>
                                            <button class="dropdown-item text-info" type="button"
                                                    data-bs-toggle="modal" data-bs-target="#notesModal{{ $s->id }}">
                                                <i class="fas fa-sticky-note me-2"></i> View Notes
                                            </button>
                                        </li>
                                        @endif
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <form method="POST" action="{{ route('admin.hierarchy.destroy', $s->id) }}"
                                                  onsubmit="return confirm('Remove this staff member? Their user account will remain.')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="fas fa-trash me-2"></i> Remove
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                        {{-- Notes modal --}}
                        @if($s->notes)
                        <div class="modal fade" id="notesModal{{ $s->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Notes — {{ $s->user?->name }}</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="mb-0">{{ $s->notes }}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center py-5 text-muted">
                <i class="fas fa-sitemap fa-3x mb-3 opacity-25"></i>
                <p class="mb-0">No {{ \App\Models\StaffProfile::ROLES[$role] ?? $role }}s yet.</p>
                <small>Click "Add Staff" to assign a manager to this level.</small>
            </div>
            @endif
        </div>
    </div>

    {{-- SOP Reference Card --}}
    <div class="section-card mt-4">
        <div class="card-header bg-dark text-white p-4">
            <h5 class="mb-0"><i class="fas fa-book me-2"></i>Compensation Reference (SOP)</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Role</th>
                            <th>Territory</th>
                            <th>Base Salary</th>
                            <th>Commission / Override</th>
                            <th>Reports To</th>
                            <th>Manages</th>
                        </tr>
                    </thead>
                    <tbody class="small">
                        <tr>
                            <td><span class="badge" style="background:#0ea5e9">Area Manager</span></td>
                            <td>ZIP code cluster</td>
                            <td>$300–$600/mo</td>
                            <td>5–10% per lead</td>
                            <td>City Manager</td>
                            <td>Sellers in ZIP area</td>
                        </tr>
                        <tr>
                            <td><span class="badge" style="background:#8b5cf6">City Manager</span></td>
                            <td>City / metro</td>
                            <td>$800–$1,500/mo</td>
                            <td>2–4% revenue override</td>
                            <td>District Manager</td>
                            <td>3–8 Area Managers</td>
                        </tr>
                        <tr>
                            <td><span class="badge" style="background:#f59e0b">District Manager</span></td>
                            <td>3–10 cities</td>
                            <td>$1,800–$3,000/mo</td>
                            <td>1–2% revenue share</td>
                            <td>Country Manager</td>
                            <td>3–6 City Managers</td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-danger">Country Manager</span></td>
                            <td>National (USA)</td>
                            <td>$4,000–$7,000/mo</td>
                            <td>0.5–1.5% revenue share</td>
                            <td>Founder / CEO</td>
                            <td>3–5 District Managers</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- Add Staff Modal --}}
<div class="modal fade" id="addStaffModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Add Staff Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.hierarchy.store') }}" id="addStaffForm">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">User Account <span class="text-danger">*</span></label>
                            <select name="user_id" class="form-select" required>
                                <option value="">-- Select User --</option>
                                @foreach($availableUsers as $u)
                                <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                                @endforeach
                            </select>
                            <div class="form-text">Only users without a staff profile are listed.</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Role <span class="text-danger">*</span></label>
                            <select name="role" class="form-select" required id="addRoleSelect" onchange="updateParentOptions(this.value)">
                                <option value="">-- Select Role --</option>
                                @foreach(\App\Models\StaffProfile::ROLES as $rKey => $rLabel)
                                <option value="{{ $rKey }}" {{ $role === $rKey ? 'selected' : '' }}>{{ $rLabel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Assigned Area / ZIP</label>
                            <input type="text" name="assigned_area" class="form-control" placeholder="e.g. Downtown, ZIP 90210">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Assigned State</label>
                            <input type="text" name="assigned_state" class="form-control" placeholder="e.g. California">
                        </div>
                        <div class="col-md-12" id="parentSelectWrapper">
                            <label class="form-label fw-semibold">Reports To (Parent Manager)</label>
                            <select name="parent_id" class="form-select" id="parentSelect">
                                <option value="">-- None / Founder CEO --</option>
                                @foreach($potentialParents as $p)
                                <option value="{{ $p->id }}">{{ $p->user?->name }} ({{ \App\Models\StaffProfile::ROLES[$p->role] ?? $p->role }} — {{ $p->assigned_area ?: $p->assigned_state ?: 'no area' }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Base Salary ($/mo)</label>
                            <input type="number" name="base_salary" class="form-control" value="0" step="0.01" min="0">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Commission Rate (%)</label>
                            <input type="number" name="commission_rate" class="form-control" value="0" step="0.01" min="0" max="100">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Joined Date</label>
                            <input type="date" name="joined_at" class="form-control">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Notes</label>
                            <textarea name="notes" class="form-control" rows="2" placeholder="Internal notes..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Add Staff Member
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Edit Staff Modal --}}
<div class="modal fade" id="editStaffModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-edit me-2"></i>Edit Staff Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" id="editStaffForm">
                @csrf @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Assigned Area / ZIP</label>
                            <input type="text" name="assigned_area" id="edit_assigned_area" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Assigned State</label>
                            <input type="text" name="assigned_state" id="edit_assigned_state" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Reports To (Parent Manager)</label>
                            <select name="parent_id" id="edit_parent_id" class="form-select">
                                <option value="">-- None / Founder CEO --</option>
                                @foreach($potentialParents as $p)
                                <option value="{{ $p->id }}">{{ $p->user?->name }} ({{ \App\Models\StaffProfile::ROLES[$p->role] ?? $p->role }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Base Salary ($/mo)</label>
                            <input type="number" name="base_salary" id="edit_base_salary" class="form-control" step="0.01" min="0">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Commission Rate (%)</label>
                            <input type="number" name="commission_rate" id="edit_commission_rate" class="form-control" step="0.01" min="0" max="100">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Joined Date</label>
                            <input type="date" name="joined_at" id="edit_joined_at" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Sellers Onboarded</label>
                            <input type="number" name="sellers_onboarded" id="edit_sellers_onboarded" class="form-control" min="0">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Active Sellers</label>
                            <input type="number" name="active_sellers" id="edit_active_sellers" class="form-control" min="0">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Dispute Rate (%)</label>
                            <input type="number" name="dispute_rate" id="edit_dispute_rate" class="form-control" step="0.01" min="0" max="100">
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Revenue Generated ($)</label>
                            <input type="number" name="revenue_generated" id="edit_revenue_generated" class="form-control" step="0.01" min="0">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Notes</label>
                            <textarea name="notes" id="edit_notes" class="form-control" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function filterStaff(q) {
    q = q.toLowerCase();
    document.querySelectorAll('#staffTable tbody tr').forEach(row => {
        if (row.closest('.modal')) return;
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
}

function openEditModal(id, url, data) {
    const form = document.getElementById('editStaffForm');
    form.action = url;

    document.getElementById('edit_assigned_area').value    = data.assigned_area    || '';
    document.getElementById('edit_assigned_state').value   = data.assigned_state   || '';
    document.getElementById('edit_base_salary').value      = data.base_salary      || 0;
    document.getElementById('edit_commission_rate').value  = data.commission_rate  || 0;
    document.getElementById('edit_joined_at').value        = data.joined_at        || '';
    document.getElementById('edit_sellers_onboarded').value= data.sellers_onboarded|| 0;
    document.getElementById('edit_active_sellers').value   = data.active_sellers   || 0;
    document.getElementById('edit_dispute_rate').value     = data.dispute_rate     || 0;
    document.getElementById('edit_revenue_generated').value= data.revenue_generated|| 0;
    document.getElementById('edit_notes').value            = data.notes            || '';

    const parentSel = document.getElementById('edit_parent_id');
    if (parentSel && data.parent_id) {
        parentSel.value = data.parent_id;
    }

    const modal = new bootstrap.Modal(document.getElementById('editStaffModal'));
    modal.show();
}

// Dynamic parent dropdown: fetch managers of the level above selected role
const roleParentMap = @json(\App\Models\StaffProfile::ROLE_REPORTS_TO);

function updateParentOptions(role) {
    const parentRole = roleParentMap[role];
    const wrapper    = document.getElementById('parentSelectWrapper');
    const select     = document.getElementById('parentSelect');

    if (!parentRole) {
        wrapper.style.display = 'none';
        return;
    }
    wrapper.style.display = '';

    fetch(`{{ route('admin.hierarchy.parents') }}?role=${parentRole}`, {
        headers: {'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json'}
    })
    .then(r => r.json())
    .then(managers => {
        select.innerHTML = '<option value="">-- None / Founder CEO --</option>';
        managers.forEach(m => {
            const opt = document.createElement('option');
            opt.value = m.id;
            opt.textContent = `${m.user_name} (${m.assigned_area || m.assigned_state || 'no area'})`;
            select.appendChild(opt);
        });
    })
    .catch(err => {
        console.error('Failed to load parent managers:', err);
        select.innerHTML = '<option value="">-- Error loading managers --</option>';
    });
}

// Pre-select role tab on modal open
document.getElementById('addStaffModal').addEventListener('show.bs.modal', function() {
    const roleSelect = document.getElementById('addRoleSelect');
    if (roleSelect.value) updateParentOptions(roleSelect.value);
});
</script>
@endsection
