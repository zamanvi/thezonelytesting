@extends('layouts.admin2')
@section('title', 'Affiliate Dashboard')

@section('content')
<div class="mt-5 pt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 fw-bold">Affiliate Dashboard</h4>
            <p class="text-muted small mb-0">Track referrals and manage commissions. $20 per referred seller's first lead.</p>
        </div>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCommissionModal">
            <i class="fas fa-plus me-1"></i> Add Commission
        </button>
    </div>

    {{-- Stats --}}
    <div class="kpi-grid mb-4" style="grid-template-columns:repeat(auto-fit,minmax(180px,1fr))">
        <div class="kpi-card" style="border-left-color:#0ea5e9">
            <h3>{{ $stats['total_referrers'] }}</h3>
            <p><i class="fas fa-share-nodes text-primary"></i> Active Referrers</p>
        </div>
        <div class="kpi-card" style="border-left-color:#8b5cf6">
            <h3>{{ $stats['total_referrals'] }}</h3>
            <p><i class="fas fa-user-plus" style="color:#8b5cf6"></i> Total Referrals</p>
        </div>
        <div class="kpi-card" style="border-left-color:#f59e0b">
            <h3>${{ number_format($stats['pending_amount'],2) }}</h3>
            <p><i class="fas fa-clock text-warning"></i> Pending ({{ $stats['pending_count'] }})</p>
        </div>
        <div class="kpi-card" style="border-left-color:#10b981">
            <h3>${{ number_format($stats['paid_amount'],2) }}</h3>
            <p><i class="fas fa-check-circle text-success"></i> Paid Out ({{ $stats['paid_count'] }})</p>
        </div>
    </div>

    <div class="row g-4">

        {{-- LEFT: Top Referrers --}}
        <div class="col-lg-5">
            <div class="section-card h-100">
                <div class="card-header bg-dark text-white p-4">
                    <h5 class="mb-0"><i class="fas fa-trophy me-2"></i>Top Referrers</h5>
                </div>
                <div class="card-body p-0">
                    @if($topReferrers->count())
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Seller</th>
                                <th class="text-center">Refs</th>
                                <th class="text-center">Earned</th>
                                <th class="text-center">Pending</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($topReferrers as $i => $seller)
                            <tr>
                                <td class="text-muted small">{{ $i+1 }}</td>
                                <td>
                                    <div class="fw-bold small">{{ $seller->name }}</div>
                                    <div class="text-muted" style="font-size:11px">{{ $seller->email }}</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-primary">{{ $seller->referrals_count }}</span>
                                </td>
                                <td class="text-center text-success fw-bold small">
                                    ${{ number_format($seller->earned_total ?? 0, 2) }}
                                </td>
                                <td class="text-center text-warning fw-bold small">
                                    ${{ number_format($seller->pending_total ?? 0, 2) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-share-nodes fa-3x mb-3 opacity-25"></i>
                        <p class="mb-0 small">No referrals yet.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- RIGHT: Commission List --}}
        <div class="col-lg-7">
            <div class="section-card">
                <div class="card-header bg-primary text-white p-4 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-dollar-sign me-2"></i>Commissions</h5>
                    <div class="btn-group btn-group-sm">
                        @foreach([''=>'All','pending'=>'Pending','paid'=>'Paid'] as $val=>$label)
                        <a href="{{ request()->fullUrlWithQuery(['filter'=>$val?:null,'page'=>1]) }}"
                           class="btn {{ request('filter',$val===''?'':null)===$val ? 'btn-light' : 'btn-outline-light' }}">
                            {{ $label }}
                        </a>
                        @endforeach
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($commissions->count())
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Referrer</th>
                                    <th>Referred User</th>
                                    <th class="text-center">Amount</th>
                                    <th class="text-center">Status</th>
                                    <th>Date</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($commissions as $c)
                                <tr>
                                    <td>
                                        <div class="fw-bold small">{{ $c->referrer?->name ?? '—' }}</div>
                                        <div class="text-muted" style="font-size:11px">{{ $c->referrer?->email }}</div>
                                    </td>
                                    <td>
                                        <div class="fw-semibold small">{{ $c->referredUser?->name ?? '—' }}</div>
                                        <div style="font-size:11px">
                                            <span class="badge {{ $c->referredUser?->status ? 'bg-success' : 'bg-warning text-dark' }} me-1">
                                                {{ $c->referredUser?->status ? 'Verified' : 'Pending' }}
                                            </span>
                                            <span class="text-muted">Joined {{ $c->referredUser?->created_at?->format('M d, Y') }}</span>
                                        </div>
                                    </td>
                                    <td class="text-center fw-bold">${{ number_format($c->amount,2) }}</td>
                                    <td class="text-center">
                                        <span class="badge {{ $c->status==='paid' ? 'bg-success' : 'bg-warning text-dark' }}">
                                            {{ ucfirst($c->status) }}
                                        </span>
                                        @if($c->paid_at)
                                        <div class="text-muted" style="font-size:10px">{{ $c->paid_at->format('M d, Y') }}</div>
                                        @endif
                                    </td>
                                    <td class="small text-muted">{{ $c->created_at?->format('M d, Y') }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light" type="button" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                                                @if($c->status === 'pending')
                                                <li>
                                                    <form method="POST" action="{{ route('admin.affiliate.commission.pay',$c->id) }}">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item text-success">
                                                            <i class="fas fa-check me-2"></i> Mark Paid
                                                        </button>
                                                    </form>
                                                </li>
                                                <li><hr class="dropdown-divider"></li>
                                                @endif
                                                <li>
                                                    <form method="POST" action="{{ route('admin.affiliate.commission.destroy',$c->id) }}"
                                                          onsubmit="return confirm('Delete this commission?')">
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @if($commissions->hasPages())
                    <div class="p-3 border-top">{{ $commissions->links() }}</div>
                    @endif
                    @else
                    <div class="text-center py-5 text-muted">
                        <i class="fas fa-dollar-sign fa-3x mb-3 opacity-25"></i>
                        <p class="mb-0 small">No commissions yet.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

    {{-- All Sellers referral links --}}
    <div class="section-card mt-4">
        <div class="card-header bg-dark text-white p-4 d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-link me-2"></i>All Seller Referral Links</h5>
            <input type="text" id="searchInput" class="form-control form-control-sm w-auto"
                   placeholder="Search seller..." style="min-width:200px"
                   oninput="filterTable(this.value)">
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="affiliateTable">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Seller</th>
                            <th>Location</th>
                            <th>Referral Link</th>
                            <th class="text-center">Referrals</th>
                            <th class="text-center">Status</th>
                            <th>Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topReferrers->merge(
                            \App\Models\User::where('type','seller')
                                ->withCount('referrals')
                                ->having('referrals_count',0)
                                ->get()
                        ) as $i => $seller)
                        @php $refLink = url('/user/register/seller?ref='.($seller->slug ?: $seller->id)); @endphp
                        <tr>
                            <td class="text-muted small">{{ $i+1 }}</td>
                            <td>
                                <div class="fw-bold small">{{ $seller->name }}</div>
                                <div class="text-muted" style="font-size:11px">{{ $seller->designation ?? $seller->title ?? $seller->email }}</div>
                            </td>
                            <td class="small text-muted">{{ $seller->city ?? '' }}{{ $seller->city && $seller->state?', ':'' }}{{ $seller->state ?? '—' }}</td>
                            <td>
                                <div class="input-group input-group-sm" style="min-width:220px;max-width:280px">
                                    <input type="text" class="form-control form-control-sm font-monospace"
                                           value="{{ $refLink }}" readonly style="font-size:11px">
                                    <button class="btn btn-outline-secondary btn-sm" type="button"
                                            onclick="copyLink(this,'{{ $refLink }}')" title="Copy">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge {{ ($seller->referrals_count??0)>0?'bg-primary':'bg-light text-dark border' }}">
                                    {{ $seller->referrals_count ?? 0 }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge {{ $seller->status?'bg-success':'bg-warning text-dark' }}">
                                    {{ $seller->status?'Verified':'Pending' }}
                                </span>
                            </td>
                            <td class="small text-muted">{{ $seller->created_at?->format('M d, Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

{{-- Add Commission Modal --}}
<div class="modal fade" id="addCommissionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-plus me-2"></i>Add Commission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.affiliate.commission.create') }}">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Referrer (Seller who referred)</label>
                        <select name="referrer_id" class="form-select" required>
                            <option value="">-- Select Referrer --</option>
                            @foreach(\App\Models\User::where('type','seller')->orderBy('name')->get() as $s)
                            <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Referred User (New seller they brought)</label>
                        <select name="referred_user_id" class="form-select" required>
                            <option value="">-- Select Referred User --</option>
                            @foreach(\App\Models\User::where('type','seller')->orderBy('name')->get() as $s)
                            <option value="{{ $s->id }}">{{ $s->name }} ({{ $s->email }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Commission Amount ($)</label>
                        <input type="number" name="amount" class="form-control" value="20" step="0.01" min="0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save Commission
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function copyLink(btn, url) {
    navigator.clipboard.writeText(url).then(() => {
        btn.innerHTML = '<i class="fas fa-check text-success"></i>';
        setTimeout(() => btn.innerHTML = '<i class="fas fa-copy"></i>', 2000);
    });
}
function filterTable(q) {
    q = q.toLowerCase();
    document.querySelectorAll('#affiliateTable tbody tr').forEach(row => {
        row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
}
</script>
@endsection
