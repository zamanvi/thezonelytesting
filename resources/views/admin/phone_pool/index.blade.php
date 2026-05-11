@extends('layouts.admin2')
@section('title', 'Phone Number Pool')

@section('content')
<div class="mt-5 pt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 fw-bold"><i class="fas fa-phone-volume text-primary me-2"></i>Phone Number Pool</h4>
            <p class="text-muted small mb-0">Manage Twilio tracking numbers — one per seller</p>
        </div>
        <a href="{{ route('admin.phone-pool.call-logs') }}" class="btn btn-outline-primary btn-sm">
            <i class="fas fa-list me-1"></i> Call Logs
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif

    {{-- Stats --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-4">
            <div class="section-card text-center p-3">
                <p class="fs-3 fw-black text-primary mb-0">{{ $numbers->count() }}</p>
                <p class="small text-muted mb-0">Total Numbers</p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="section-card text-center p-3">
                <p class="fs-3 fw-black text-success mb-0">{{ $assigned }}</p>
                <p class="small text-muted mb-0">Assigned</p>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="section-card text-center p-3">
                <p class="fs-3 fw-black text-warning mb-0">{{ $available }}</p>
                <p class="small text-muted mb-0">Available in Pool</p>
            </div>
        </div>
    </div>

    <div class="row g-4">

        {{-- Add number form --}}
        <div class="col-lg-4">
            <div class="section-card">
                <div class="card-header bg-primary text-white p-3">
                    <h6 class="mb-0"><i class="fas fa-plus me-2"></i>Add Number to Pool</h6>
                </div>
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('admin.phone-pool.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Twilio Number <span class="text-danger">*</span></label>
                            <input type="text" name="number" class="form-control font-monospace"
                                   placeholder="+13475550001" required>
                            <div class="form-text">E.164 format: +1XXXXXXXXXX</div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Friendly Name</label>
                            <input type="text" name="friendly_name" class="form-control"
                                   placeholder="(347) 555-0001">
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Twilio SID <span class="text-muted fw-normal small">(optional)</span></label>
                            <input type="text" name="twilio_sid" class="form-control font-monospace"
                                   placeholder="PNxxxxxxxxxxxx">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-plus me-1"></i> Add to Pool
                        </button>
                    </form>

                    <hr class="my-4">
                    <div class="bg-light rounded-3 p-3 small text-muted">
                        <p class="fw-semibold text-dark mb-2"><i class="fas fa-circle-info me-1 text-primary"></i>Setup in Twilio:</p>
                        <ol class="ps-3 mb-0" style="line-height:2">
                            <li>Buy number in Twilio console</li>
                            <li>Set Voice webhook URL:<br>
                                <code class="text-danger">{{ route('twilio.webhook.voice') }}</code>
                            </li>
                            <li>Add number here</li>
                            <li>Assign to seller</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        {{-- Numbers table --}}
        <div class="col-lg-8">
            <div class="section-card">
                <div class="card-body p-0">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="ps-4">Tracking Number</th>
                                <th>Assigned Seller</th>
                                <th>Status</th>
                                <th>Since</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($numbers as $num)
                        <tr>
                            <td class="ps-4">
                                <div class="font-monospace fw-bold">{{ $num->number }}</div>
                                <div class="text-muted small">{{ $num->friendly_name }}</div>
                            </td>
                            <td>
                                @if($num->seller)
                                <div class="fw-semibold small">{{ $num->seller->name }}</div>
                                <div class="text-muted" style="font-size:11px">{{ $num->seller->email }}</div>
                                @else
                                <span class="text-muted small">— unassigned —</span>
                                @endif
                            </td>
                            <td>
                                @if($num->status === 'assigned')
                                <span class="badge bg-success">Assigned</span>
                                @elseif($num->status === 'available')
                                <span class="badge bg-warning text-dark">Available</span>
                                @else
                                <span class="badge bg-secondary">Released</span>
                                @endif
                            </td>
                            <td class="small text-muted">
                                {{ $num->assigned_at?->format('M d, Y') ?? '—' }}
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex gap-2 justify-content-end">
                                    @if($num->status === 'assigned')
                                    <form method="POST" action="{{ route('admin.phone-pool.release', $num->id) }}"
                                          onsubmit="return confirm('Release this number back to pool?')">
                                        @csrf
                                        <button class="btn btn-sm btn-outline-warning">
                                            <i class="fas fa-rotate-left me-1"></i>Release
                                        </button>
                                    </form>
                                    @else
                                    <button class="btn btn-sm btn-outline-success"
                                            data-bs-toggle="modal"
                                            data-bs-target="#assignModal"
                                            data-number-id="{{ $num->id }}"
                                            data-number="{{ $num->number }}"
                                            data-assign-url="{{ route('admin.phone-pool.assign', $num->id) }}">
                                        <i class="fas fa-user-plus me-1"></i>Assign
                                    </button>
                                    @endif
                                    <form method="POST" action="{{ route('admin.phone-pool.destroy', $num->id) }}"
                                          onsubmit="return confirm('Delete {{ $num->number }} from pool?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">No numbers in pool yet. Add one →</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Assign modal --}}
<div class="modal fade" id="assignModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Assign Number to Seller</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" id="assignForm">
                @csrf
                <div class="modal-body">
                    <p class="text-muted small mb-3">Assigning: <strong id="modalNumber" class="font-monospace"></strong></p>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Select Seller</label>
                        <select name="seller_id" class="form-select" required>
                            <option value="">— choose seller —</option>
                            @foreach(\App\Models\User::where('type','seller')->orderBy('name')->get() as $seller)
                            <option value="{{ $seller->id }}">
                                {{ $seller->name }} — {{ $seller->phone ?? 'no phone' }}
                                {{ $seller->twilioNumber ? '(has number)' : '' }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="alert alert-info small mb-0">
                        <i class="fas fa-circle-info me-1"></i>
                        If seller already has a number, it will be released back to pool automatically.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success"><i class="fas fa-check me-1"></i>Assign</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('assignModal').addEventListener('show.bs.modal', function(e) {
    const btn = e.relatedTarget;
    if (!btn) return;
    document.getElementById('modalNumber').textContent = btn.dataset.number || '';
    document.getElementById('assignForm').action = btn.dataset.assignUrl || '';
});
document.getElementById('assignForm').addEventListener('submit', function(e) {
    const num = document.getElementById('modalNumber').textContent;
    if (!confirm('Assign ' + num + ' to this seller?')) e.preventDefault();
});
</script>
@endsection
