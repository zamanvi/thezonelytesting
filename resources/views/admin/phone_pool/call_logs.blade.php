@extends('layouts.admin2')
@section('title', 'Call Logs')

@section('content')
<div class="mt-5 pt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="mb-0 fw-bold"><i class="fas fa-list text-primary me-2"></i>Call Logs</h4>
            <p class="text-muted small mb-0">All inbound calls via Twilio tracking numbers</p>
        </div>
        <a href="{{ route('admin.phone-pool.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Phone Pool
        </a>
    </div>

    {{-- Stats --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-3">
            <div class="section-card text-center p-3">
                <p class="fs-3 fw-black text-primary mb-0">{{ $stats['total'] }}</p>
                <p class="small text-muted mb-0">Total Calls</p>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="section-card text-center p-3">
                <p class="fs-3 fw-black text-info mb-0">{{ $stats['today'] }}</p>
                <p class="small text-muted mb-0">Today</p>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="section-card text-center p-3">
                <p class="fs-3 fw-black text-success mb-0">{{ $stats['completed'] }}</p>
                <p class="small text-muted mb-0">Completed</p>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="section-card text-center p-3">
                <p class="fs-3 fw-black text-danger mb-0">{{ $stats['missed'] }}</p>
                <p class="small text-muted mb-0">Missed</p>
            </div>
        </div>
    </div>

    <div class="section-card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th class="ps-4">Caller</th>
                            <th>Seller</th>
                            <th>Tracking #</th>
                            <th>Status</th>
                            <th>Duration</th>
                            <th>Lead</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($logs as $log)
                    <tr>
                        <td class="ps-4 font-monospace fw-semibold">{{ $log->caller_number }}</td>
                        <td>
                            <div class="small fw-semibold">{{ $log->seller?->name ?? '—' }}</div>
                        </td>
                        <td class="font-monospace small text-muted">{{ $log->twilio_number }}</td>
                        <td>
                            @php
                                $badge = match($log->status) {
                                    'completed'  => 'bg-success',
                                    'in-progress'=> 'bg-info',
                                    'no-answer'  => 'bg-warning text-dark',
                                    'busy'       => 'bg-warning text-dark',
                                    'failed'     => 'bg-danger',
                                    default      => 'bg-secondary',
                                };
                            @endphp
                            <span class="badge {{ $badge }}">{{ ucfirst($log->status) }}</span>
                        </td>
                        <td class="small">
                            @if($log->duration > 0)
                                {{ gmdate('i:s', $log->duration) }}
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            @if($log->lead_id)
                            <a href="{{ route('admin.leads') }}" class="badge bg-primary text-decoration-none">
                                Lead #{{ $log->lead_id }}
                            </a>
                            @else
                            <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td class="small text-muted">{{ $log->called_at->format('M d, g:i A') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5 text-muted">No calls logged yet.</td>
                    </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @if($logs->hasPages())
            <div class="p-4">{{ $logs->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
