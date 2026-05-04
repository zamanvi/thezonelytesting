@extends('frontend.layouts._app')
@section('title', 'Notifications')
@section('content')
<div class="min-h-screen bg-slate-50 pt-20 pb-16 px-4">
    <div class="max-w-2xl mx-auto py-6">

        @include('frontend.seller._nav')
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-slate-900">Notifications</h1>
                <p class="text-sm text-slate-500 mt-0.5">Stay updated on leads, bookings and payments</p>
            </div>
            @if(isset($notifications) && $notifications->count())
            <button onclick="markAllRead()" class="text-sm font-bold text-blue-600 hover:underline shrink-0">Mark all read</button>
            @endif
        </div>

        <div class="flex gap-2 mb-5 overflow-x-auto scroll-hide pb-1">
            <button onclick="filterNotifs(this,'all')" class="notif-tab active-ntab shrink-0 px-4 py-2 rounded-xl text-xs font-bold bg-blue-600 text-white whitespace-nowrap">All</button>
            <button onclick="filterNotifs(this,'lead')" class="notif-tab shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 whitespace-nowrap transition">New Leads</button>
            <button onclick="filterNotifs(this,'booking')" class="notif-tab shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 whitespace-nowrap transition">Bookings</button>
            <button onclick="filterNotifs(this,'review')" class="notif-tab shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 whitespace-nowrap transition">Reviews</button>
            <button onclick="filterNotifs(this,'payment')" class="notif-tab shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 whitespace-nowrap transition">Payments</button>
        </div>

        <div class="space-y-2" id="notifList">
            @forelse($notifications ?? [] as $notif)
            <div class="notif-item bg-white rounded-2xl border {{ $notif->read_at ? 'border-slate-100' : 'border-blue-100' }} shadow-sm p-4 flex items-start gap-4"
                 data-type="{{ $notif->type ?? 'system' }}">
                @php
                    $iconMap = ['lead'=>'fa-user-plus text-emerald-600','booking'=>'fa-calendar text-blue-600','review'=>'fa-star text-amber-500','payment'=>'fa-credit-card text-purple-600'];
                    $bgMap   = ['lead'=>'bg-emerald-100','booking'=>'bg-blue-100','review'=>'bg-amber-100','payment'=>'bg-purple-100'];
                    $t = $notif->type ?? 'system';
                @endphp
                <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 {{ $bgMap[$t] ?? 'bg-slate-100' }}">
                    <i class="fa-solid {{ $iconMap[$t] ?? 'fa-bell text-slate-500' }} text-sm"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-slate-900">{{ $notif->title ?? 'Notification' }}</p>
                    <p class="text-sm text-slate-500 mt-0.5 leading-relaxed">{{ $notif->message ?? '' }}</p>
                    <p class="text-xs text-slate-400 mt-1.5">{{ $notif->created_at?->diffForHumans() }}</p>
                </div>
                @if(!$notif->read_at)
                <div class="w-2 h-2 bg-blue-600 rounded-full shrink-0 mt-1.5"></div>
                @endif
            </div>
            @empty
            {{-- Demo notifications --}}
            @foreach([
                ['type'=>'lead','title'=>'New Lead Received','msg'=>'Someone is looking for Tax Preparation services in your area. View and respond now.','time'=>'5 minutes ago','unread'=>true],
                ['type'=>'lead','title'=>'New Lead Received','msg'=>'New inquiry for LLC Formation. Lead fee: $68. Contact details available.','time'=>'1 hour ago','unread'=>true],
                ['type'=>'review','title'=>'New 5-Star Review','msg'=>'Maria Rodriguez left you a 5-star review. "Absolutely fantastic service — highly recommend!"','time'=>'3 hours ago','unread'=>true],
                ['type'=>'booking','title'=>'Booking Request','msg'=>'John D. wants to book an appointment for Apr 28 at 11:00 AM. Confirm or decline.','time'=>'1 day ago','unread'=>false],
                ['type'=>'payment','title'=>'Payment Reminder','msg'=>'You have $320 in unpaid lead fees. Pay now to keep receiving new leads.','time'=>'2 days ago','unread'=>false],
                ['type'=>'lead','title'=>'Lead Won','msg'=>'You marked the lead from +1 (646) 555-4421 as won. Great work!','time'=>'3 days ago','unread'=>false],
            ] as $n)
            <div class="notif-item bg-white rounded-2xl border {{ $n['unread'] ? 'border-blue-100' : 'border-slate-100' }} shadow-sm p-4 flex items-start gap-4"
                 data-type="{{ $n['type'] }}">
                @php
                    $iconMap2 = ['lead'=>'fa-user-plus text-emerald-600','booking'=>'fa-calendar text-blue-600','review'=>'fa-star text-amber-500','payment'=>'fa-credit-card text-purple-600'];
                    $bgMap2   = ['lead'=>'bg-emerald-100','booking'=>'bg-blue-100','review'=>'bg-amber-100','payment'=>'bg-purple-100'];
                @endphp
                <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 {{ $bgMap2[$n['type']] ?? 'bg-slate-100' }}">
                    <i class="fa-solid {{ $iconMap2[$n['type']] ?? 'fa-bell text-slate-500' }} text-sm"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold text-slate-900">{{ $n['title'] }}</p>
                    <p class="text-sm text-slate-500 mt-0.5 leading-relaxed">{{ $n['msg'] }}</p>
                    <p class="text-xs text-slate-400 mt-1.5">{{ $n['time'] }}</p>
                </div>
                @if($n['unread'])
                <div class="w-2 h-2 bg-blue-600 rounded-full shrink-0 mt-1.5"></div>
                @endif
            </div>
            @endforeach
            @endforelse
        </div>

    </div>
</div>

<script>
function filterNotifs(btn, type) {
    document.querySelectorAll('.notif-tab').forEach(b => {
        b.className = 'notif-tab shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 whitespace-nowrap transition';
    });
    btn.className = 'notif-tab active-ntab shrink-0 px-4 py-2 rounded-xl text-xs font-bold bg-blue-600 text-white whitespace-nowrap';
    document.querySelectorAll('.notif-item').forEach(el => {
        el.style.display = (type === 'all' || el.dataset.type === type) ? '' : 'none';
    });
}
function markAllRead() {
    document.querySelectorAll('.w-2.h-2.bg-blue-600.rounded-full').forEach(d => d.remove());
    fetch('/seller/notifications/read-all', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content || '' }
    });
}
</script>
@endsection
