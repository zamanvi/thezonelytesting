@foreach (['success', 'error', 'warning', 'info'] as $msg)
    @if(Session::has($msg))
        @php
            $message = Session::get($msg);
            $colors = [
                'success' => 'bg-success text-white',
                'error' => 'bg-danger text-white',
                'warning' => 'bg-warning text-dark',
                'info' => 'bg-info text-white',
            ];
            $icons = [
                'success' => 'lar la-check-circle',
                'error' => 'ri-error-warning-line',
                'warning' => 'ri-alert-line',
                'info' => 'ri-information-line',
            ];
        @endphp

        <div class="row">
            <div class="col-lg-6 mx-auto">
                <div class="d-flex align-items-center alert {{ $colors[$msg] }} shadow-sm rounded p-2" role="alert">
                    <div class="iq-alert-icon mr-2">
                        <i class="{{ $icons[$msg] }}" style="font-size: 1.3rem;"></i>
                    </div>
                    <div class="iq-alert-text flex-grow-1">
                        <strong>{{ $message }}</strong>
                    </div>
                    <button type="button" class="close ml-2" data-dismiss="alert" aria-label="Close">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
            </div>
        </div>
    @endif
@endforeach

{{-- Optional: auto-dismiss after 5 seconds --}}
<script>
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => {
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500);
        });
    }, 5000);
</script>
