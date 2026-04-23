@extends('frontend.layouts._app')
@section('title', 'Lead Dashboard')
@section('content')
<div class="min-h-screen bg-slate-50 pt-20 pb-6">

    {{-- Toast --}}
    <div id="toast" class="fixed bottom-24 left-1/2 -translate-x-1/2 bg-slate-900 text-white text-sm font-semibold px-5 py-2.5 rounded-full opacity-0 transition-all duration-300 z-50 pointer-events-none whitespace-nowrap"></div>

    <div class="max-w-4xl mx-auto px-4 py-6">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-xl font-bold text-slate-900">Lead Dashboard</h1>
                <p class="text-xs text-slate-500 mt-0.5 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 inline-block animate-pulse"></span>
                    Live · Powered by Twilio
                </p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('seller.schedule') }}" class="text-xs font-bold text-slate-500 border border-slate-200 bg-white px-3 py-2 rounded-xl hover:border-blue-300 hover:text-blue-600 transition">
                    <i class="fa-solid fa-calendar-days mr-1"></i> Schedule
                </a>
                <div class="w-9 h-9 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
            </div>
        </div>

        {{-- New Lead Alert --}}
        @if(session('new_lead'))
        <div class="bg-emerald-50 border border-emerald-200 rounded-2xl px-4 py-3.5 mb-5 flex items-center gap-3">
            <div class="w-9 h-9 bg-emerald-500 rounded-xl flex items-center justify-center shrink-0">
                <i class="fa-solid fa-phone text-white text-sm"></i>
            </div>
            <div class="flex-1">
                <p class="text-sm font-bold text-emerald-800">New Lead Incoming!</p>
                <p class="text-xs text-emerald-600">{{ session('new_lead') }}</p>
            </div>
            <button onclick="this.closest('div.bg-emerald-50').remove()" class="text-emerald-400 hover:text-emerald-600">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
        @endif

        {{-- Stats Strip --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-6">
            <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Total Leads</p>
                <p class="text-2xl font-black text-slate-900">{{ $stats['total'] ?? 0 }}</p>
                <p class="text-xs text-emerald-600 font-semibold mt-0.5">↑ This month</p>
            </div>
            <div class="bg-blue-600 rounded-2xl p-4 text-white shadow-sm">
                <p class="text-[10px] font-bold opacity-70 uppercase tracking-widest mb-1">Won</p>
                <p class="text-2xl font-black">{{ $stats['won'] ?? 0 }}</p>
                <p class="text-xs opacity-70 mt-0.5">Converted leads</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Pending</p>
                <p class="text-2xl font-black text-amber-500">{{ $stats['pending'] ?? 0 }}</p>
                <p class="text-xs text-slate-400 mt-0.5">Awaiting action</p>
            </div>
            <div class="bg-white rounded-2xl border border-slate-100 p-4 shadow-sm">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Unpaid Fees</p>
                <p class="text-2xl font-black text-red-500">{{ $stats['unpaid'] ?? 0 }}</p>
                <a href="{{ route('seller.billing') }}" class="text-xs text-red-500 font-semibold mt-0.5 block hover:underline">Pay now →</a>
            </div>
        </div>

        {{-- Lead List --}}
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm mb-6">

            {{-- Toolbar --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-4 border-b border-slate-100">
                <div class="flex gap-2 overflow-x-auto pb-1 scroll-hide">
                    <button onclick="filterLeads(this,'all')" class="filter-btn active-filter shrink-0 px-4 py-2 rounded-xl text-xs font-bold bg-blue-600 text-white whitespace-nowrap">All</button>
                    <button onclick="filterLeads(this,'won')" class="filter-btn shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-slate-50 border border-slate-200 text-slate-600 hover:bg-slate-100 whitespace-nowrap transition">Won</button>
                    <button onclick="filterLeads(this,'pending')" class="filter-btn shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-slate-50 border border-slate-200 text-slate-600 hover:bg-slate-100 whitespace-nowrap transition">Pending</button>
                    <button onclick="filterLeads(this,'lost')" class="filter-btn shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-slate-50 border border-slate-200 text-slate-600 hover:bg-slate-100 whitespace-nowrap transition">Lost</button>
                </div>
                <div class="flex gap-2 shrink-0">
                    <div class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
                        <input type="text" id="searchInput" oninput="searchLeads()" placeholder="Search..."
                            class="pl-8 pr-3 py-2 text-xs border border-slate-200 rounded-xl focus:outline-none focus:border-blue-400 w-36">
                    </div>
                    <button onclick="exportLeads()" class="px-3 py-2 rounded-xl border border-slate-200 text-xs font-bold text-slate-500 hover:bg-slate-50 transition">
                        <i class="fa-solid fa-download mr-1"></i>CSV
                    </button>
                </div>
            </div>

            {{-- Lead Cards --}}
            <div class="divide-y divide-slate-50" id="leadsList">

                @forelse($leads ?? [] as $lead)
                <div class="lead-card px-4 py-3.5 hover:bg-slate-50 transition cursor-pointer"
                     data-status="{{ $lead->status ?? 'pending' }}"
                     data-id="{{ $lead->id }}">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 font-black text-sm
                            {{ ($lead->status ?? '') === 'won' ? 'bg-emerald-100 text-emerald-600' : (($lead->status ?? '') === 'lost' ? 'bg-red-100 text-red-400' : 'bg-amber-100 text-amber-600') }}">
                            {{ strtoupper(substr($lead->phone ?? 'LD', -2)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2">
                                <p class="font-bold text-sm text-slate-900 truncate">{{ $lead->phone ?? '+1 (000) 000-0000' }}</p>
                                <span class="text-[10px] text-slate-400 shrink-0">{{ $lead->created_at?->diffForHumans() ?? 'Just now' }}</span>
                            </div>
                            <div class="flex items-center justify-between gap-2 mt-0.5">
                                <p class="text-xs text-slate-500 truncate">{{ $lead->service ?? 'General Inquiry' }} — "{{ Str::limit($lead->message ?? $lead->notes ?? 'No message', 40) }}"</p>
                                <span class="shrink-0 text-[10px] px-2 py-0.5 rounded-full font-bold
                                    {{ ($lead->status ?? '') === 'won' ? 'bg-emerald-100 text-emerald-700' : (($lead->status ?? '') === 'lost' ? 'bg-red-100 text-red-500' : 'bg-amber-100 text-amber-700') }}">
                                    {{ ucfirst($lead->status ?? 'pending') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    {{-- Action Buttons --}}
                    <div class="flex gap-2 mt-3 pl-13">
                        <button onclick="setStatus(this,'won')" class="action-btn flex-1 py-1.5 rounded-xl text-[11px] font-bold bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition">Won</button>
                        <button onclick="setStatus(this,'pending')" class="action-btn flex-1 py-1.5 rounded-xl text-[11px] font-bold bg-amber-50 text-amber-600 hover:bg-amber-100 transition">Pending</button>
                        <button onclick="setStatus(this,'lost')" class="action-btn flex-1 py-1.5 rounded-xl text-[11px] font-bold bg-red-50 text-red-400 hover:bg-red-100 transition">Lost</button>
                        <a href="tel:{{ $lead->phone ?? '' }}" class="flex-1 py-1.5 rounded-xl text-[11px] font-bold bg-blue-50 text-blue-600 hover:bg-blue-100 transition text-center">
                            <i class="fa-solid fa-phone mr-1"></i>Call
                        </a>
                    </div>
                </div>
                @empty
                {{-- Demo leads when no real data --}}
                @foreach([
                    ['init'=>'TK','phone'=>'+1 (347) 555-1289','service'=>'Tax Preparation','note'=>'Need help filing my taxes','time'=>'Today 11:32 AM','status'=>'won','fee'=>'paid'],
                    ['init'=>'MB','phone'=>'+1 (718) 555-3344','service'=>'Small Business Accounting','note'=>'Need monthly bookkeeping','time'=>'Yesterday 3:14 PM','status'=>'won','fee'=>'paid'],
                    ['init'=>'IR','phone'=>'+1 (929) 555-7812','service'=>'IRS Audit Assistance','note'=>'I received an IRS notice','time'=>'Apr 18 9:05 AM','status'=>'pending','fee'=>'unpaid'],
                    ['init'=>'LC','phone'=>'+1 (914) 555-9900','service'=>'LLC Formation','note'=>'Need to form an LLC this week','time'=>'Apr 17 4:48 PM','status'=>'pending','fee'=>'unpaid'],
                    ['init'=>'JR','phone'=>'+1 (646) 555-4421','service'=>'Personal Tax Return','note'=>'Went with H&R Block','time'=>'Apr 15 2:10 PM','status'=>'lost','fee'=>'paid'],
                ] as $demo)
                <div class="lead-card px-4 py-3.5 hover:bg-slate-50 transition" data-status="{{ $demo['status'] }}">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 font-black text-sm
                            {{ $demo['status'] === 'won' ? 'bg-emerald-100 text-emerald-600' : ($demo['status'] === 'lost' ? 'bg-red-100 text-red-400' : 'bg-amber-100 text-amber-600') }}">
                            {{ $demo['init'] }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2">
                                <p class="font-bold text-sm text-slate-900 truncate">{{ $demo['phone'] }}</p>
                                <span class="text-[10px] text-slate-400 shrink-0">{{ $demo['time'] }}</span>
                            </div>
                            <div class="flex items-center justify-between gap-2 mt-0.5">
                                <p class="text-xs text-slate-500 truncate">{{ $demo['service'] }} — "{{ $demo['note'] }}"</p>
                                <span class="shrink-0 text-[10px] px-2 py-0.5 rounded-full font-bold
                                    {{ $demo['fee'] === 'paid' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                    {{ ucfirst($demo['fee']) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-2 mt-3">
                        <button onclick="setStatus(this,'won')" class="action-btn flex-1 py-1.5 rounded-xl text-[11px] font-bold {{ $demo['status']==='won' ? 'bg-emerald-500 text-white' : 'bg-emerald-50 text-emerald-600 hover:bg-emerald-100' }} transition">Won</button>
                        <button onclick="setStatus(this,'pending')" class="action-btn flex-1 py-1.5 rounded-xl text-[11px] font-bold {{ $demo['status']==='pending' ? 'bg-amber-500 text-white' : 'bg-amber-50 text-amber-600 hover:bg-amber-100' }} transition">Pending</button>
                        <button onclick="setStatus(this,'lost')" class="action-btn flex-1 py-1.5 rounded-xl text-[11px] font-bold {{ $demo['status']==='lost' ? 'bg-red-500 text-white' : 'bg-red-50 text-red-400 hover:bg-red-100' }} transition">Lost</button>
                        <a href="tel:{{ $demo['phone'] }}" class="flex-1 py-1.5 rounded-xl text-[11px] font-bold bg-blue-50 text-blue-600 hover:bg-blue-100 transition text-center">
                            <i class="fa-solid fa-phone mr-1"></i>Call
                        </a>
                    </div>
                </div>
                @endforeach
                @endforelse

            </div>
        </div>

        {{-- Chat Section --}}
        <div class="bg-white rounded-3xl border border-slate-100 shadow-sm mb-6" id="chatSection">
            <div class="p-4 border-b border-slate-100">
                <h3 class="font-bold text-sm text-slate-900 flex items-center gap-2">
                    <i class="fa-solid fa-comments text-blue-600"></i> Lead Conversations
                    <span class="bg-amber-500 text-white text-[10px] font-black px-2 py-0.5 rounded-full">2 unpaid</span>
                </h3>
                <p class="text-xs text-slate-400 mt-0.5">Messages from leads via Twilio / WhatsApp</p>
            </div>

            {{-- Chat Tabs --}}
            <div class="flex gap-2 px-4 pt-3 pb-2 overflow-x-auto scroll-hide">
                <button onclick="filterChat(this,'recent')" class="chat-tab active-chat shrink-0 px-4 py-2 rounded-xl text-xs font-bold bg-blue-600 text-white whitespace-nowrap">Recent</button>
                <button onclick="filterChat(this,'week')" class="chat-tab shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-slate-50 border border-slate-200 text-slate-600 hover:bg-slate-100 whitespace-nowrap transition">This Week</button>
                <button onclick="filterChat(this,'paid')" class="chat-tab shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-slate-50 border border-slate-200 text-slate-600 hover:bg-slate-100 whitespace-nowrap transition">
                    <i class="fa-solid fa-circle-check text-emerald-500 mr-1"></i>Paid
                </button>
                <button onclick="filterChat(this,'unpaid')" class="chat-tab shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-white border border-amber-200 text-amber-600 hover:bg-amber-50 whitespace-nowrap transition">
                    <i class="fa-solid fa-clock text-amber-500 mr-1"></i>Unpaid
                </button>
            </div>

            <div id="chatPayNote" class="hidden mx-4 mb-3 bg-amber-50 border border-amber-200 rounded-xl px-4 py-3 text-xs text-amber-800">
                <i class="fa-solid fa-triangle-exclamation mr-1"></i>
                <strong>Unpaid leads</strong> = lead delivered but platform fee not paid yet.
                <a href="{{ route('seller.billing') }}" class="font-bold underline ml-1">Pay now →</a>
            </div>

            {{-- Chat List --}}
            <div class="divide-y divide-slate-50 pb-2" id="chatList">

                @foreach([
                    ['init'=>'TK','phone'=>'+1 (347) 555-1289','service'=>'Tax Preparation','preview'=>'I need help filing my taxes','time'=>'Today 11:32 AM','filter'=>'recent week paid','fee'=>'paid','msgs'=>[
                        ['side'=>'lead','time'=>'11:32 AM','text'=>'Hi, I need help filing my taxes for this year. Do you handle small business?'],
                        ['side'=>'you','time'=>'11:45 AM','text'=>'Yes! We specialize in small business. I\'ll send you our package options.'],
                        ['side'=>'lead','time'=>'11:50 AM','text'=>'Great, looking forward to it. Can we schedule a call?'],
                    ]],
                    ['init'=>'MB','phone'=>'+1 (718) 555-3344','service'=>'Small Business Accounting','preview'=>'Need monthly bookkeeping','time'=>'Yesterday 3:14 PM','filter'=>'week paid','fee'=>'paid','msgs'=>[
                        ['side'=>'lead','time'=>'3:14 PM','text'=>'Hi, I run a small LLC and need monthly bookkeeping. What are your rates?'],
                        ['side'=>'you','time'=>'3:28 PM','text'=>'Our monthly bookkeeping starts at $350/mo. Includes reconciliation & reports.'],
                        ['side'=>'lead','time'=>'3:35 PM','text'=>'Sounds good! Let\'s do it. Send me the contract.'],
                    ]],
                    ['init'=>'IR','phone'=>'+1 (929) 555-7812','service'=>'IRS Audit Assistance','preview'=>'I received an IRS notice','time'=>'Apr 18 9:05 AM','filter'=>'recent week unpaid','fee'=>'unpaid','amount'=>120,'msgs'=>[
                        ['side'=>'lead','time'=>'9:05 AM','text'=>'I received an IRS notice last week. Can you help me?'],
                    ]],
                    ['init'=>'LC','phone'=>'+1 (914) 555-9900','service'=>'LLC Formation','preview'=>'Need to form an LLC','time'=>'Apr 17 4:48 PM','filter'=>'week unpaid','fee'=>'unpaid','amount'=>200,'msgs'=>[
                        ['side'=>'lead','time'=>'4:48 PM','text'=>'I need to form an LLC before end of month. How fast can you do it?'],
                    ]],
                ] as $i => $chat)
                <div class="chat-item" data-chat-filter="{{ $chat['filter'] }}">
                    <div class="flex items-center gap-3 px-4 py-3.5 cursor-pointer hover:bg-slate-50 transition" onclick="toggleChat(this)">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 font-black text-sm
                            {{ $chat['fee']==='paid' ? 'bg-emerald-100 text-emerald-600' : 'bg-amber-100 text-amber-600' }}">
                            {{ $chat['init'] }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between gap-2">
                                <p class="font-bold text-sm text-slate-900 truncate">{{ $chat['phone'] }}</p>
                                <span class="text-[10px] text-slate-400 shrink-0">{{ $chat['time'] }}</span>
                            </div>
                            <div class="flex items-center justify-between gap-2 mt-0.5">
                                <p class="text-xs text-slate-500 truncate">{{ $chat['service'] }} — "{{ $chat['preview'] }}"</p>
                                <span class="shrink-0 text-[10px] px-2 py-0.5 rounded-full font-bold
                                    {{ $chat['fee']==='paid' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                    {{ ucfirst($chat['fee']) }}
                                </span>
                            </div>
                        </div>
                        <i class="fa-solid fa-chevron-down text-slate-300 text-xs shrink-0 chat-chevron transition-transform duration-200"></i>
                    </div>

                    <div class="chat-thread hidden border-t {{ $chat['fee']==='unpaid' ? 'border-amber-100 bg-amber-50' : 'border-slate-100 bg-slate-50' }} px-4 py-4 space-y-3">
                        @if($chat['fee']==='unpaid')
                        <div class="bg-amber-100 border border-amber-200 rounded-2xl px-4 py-3 flex items-start gap-3">
                            <i class="fa-solid fa-lock text-amber-600 mt-0.5 shrink-0"></i>
                            <div>
                                <p class="text-xs font-bold text-amber-800">Platform fee unpaid (${{ $chat['amount'] ?? 68 }})</p>
                                <p class="text-xs text-amber-700 mt-0.5">Pay Zonely to unlock full chat & keep receiving leads.</p>
                                <a href="{{ route('seller.billing') }}" class="mt-2 inline-block bg-amber-600 hover:bg-amber-700 text-white text-xs font-bold px-4 py-2 rounded-xl transition">
                                    Pay ${{ $chat['amount'] ?? 68 }} Now
                                </a>
                            </div>
                        </div>
                        @endif

                        @foreach($chat['msgs'] as $msg)
                        <div class="flex {{ $msg['side']==='you' ? 'justify-end' : 'justify-start' }}">
                            <div class="{{ $msg['side']==='you' ? 'bg-blue-600 rounded-2xl rounded-tr-sm' : 'bg-white border border-slate-200 rounded-2xl rounded-tl-sm' }} px-4 py-2.5 max-w-[80%]">
                                <p class="text-[10px] {{ $msg['side']==='you' ? 'text-blue-200' : 'text-slate-400' }} font-semibold mb-1">{{ $msg['side']==='you' ? 'You' : 'Lead' }} · {{ $msg['time'] }}</p>
                                <p class="text-sm {{ $msg['side']==='you' ? 'text-white' : 'text-slate-800' }}">{{ $msg['text'] }}</p>
                            </div>
                        </div>
                        @endforeach

                        @if($chat['fee']==='paid')
                        <div class="flex gap-2 pt-1">
                            <input type="text" placeholder="Reply via WhatsApp / SMS..."
                                   class="flex-1 text-sm bg-white border border-slate-200 rounded-xl px-4 py-2.5 focus:outline-none focus:border-blue-400 focus:ring-2 focus:ring-blue-50 transition">
                            <button onclick="showToast('Message sent via Twilio!')"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl text-xs font-bold transition shrink-0">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                        @else
                        <div class="flex gap-2 pt-1 opacity-40 pointer-events-none select-none">
                            <input type="text" placeholder="Pay to unlock reply..." class="flex-1 text-sm bg-white border border-slate-200 rounded-xl px-4 py-2.5">
                            <button class="bg-slate-300 text-white px-4 py-2.5 rounded-xl text-xs font-bold shrink-0">
                                <i class="fa-solid fa-paper-plane"></i>
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach

            </div>
        </div>

    </div>
</div>

<style>
    .scroll-hide { -ms-overflow-style:none; scrollbar-width:none; }
    .scroll-hide::-webkit-scrollbar { display:none; }
</style>

<script>
function filterLeads(btn, status) {
    document.querySelectorAll('.filter-btn').forEach(b => {
        b.className = 'filter-btn shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-slate-50 border border-slate-200 text-slate-600 hover:bg-slate-100 whitespace-nowrap transition';
    });
    btn.className = 'filter-btn active-filter shrink-0 px-4 py-2 rounded-xl text-xs font-bold bg-blue-600 text-white whitespace-nowrap';
    document.querySelectorAll('#leadsList .lead-card').forEach(card => {
        card.style.display = (status === 'all' || card.dataset.status === status) ? '' : 'none';
    });
}

function setStatus(btn, newStatus) {
    const card    = btn.closest('.lead-card');
    const leadId  = card.dataset.id;
    const colors  = { won:'bg-emerald-500 text-white', pending:'bg-amber-500 text-white', lost:'bg-red-500 text-white' };
    const defaults= { won:'bg-emerald-50 text-emerald-600 hover:bg-emerald-100', pending:'bg-amber-50 text-amber-600 hover:bg-amber-100', lost:'bg-red-50 text-red-400 hover:bg-red-100' };

    // Update UI immediately
    card.dataset.status = newStatus;
    card.querySelectorAll('.action-btn').forEach(b => {
        const s = b.textContent.trim().toLowerCase();
        b.className = `action-btn flex-1 py-1.5 rounded-xl text-[11px] font-bold transition ${s === newStatus ? colors[s] : defaults[s]}`;
    });

    // Persist to server (only for real leads that have an id)
    if (leadId) {
        fetch(`/seller/leads/${leadId}/status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({ status: newStatus }),
        }).then(r => {
            if (!r.ok) showToast('Failed to save status');
        }).catch(() => showToast('Network error'));
    }

    showToast('Lead marked as ' + newStatus.charAt(0).toUpperCase() + newStatus.slice(1));
}

function searchLeads() {
    const q = document.getElementById('searchInput').value.toLowerCase();
    document.querySelectorAll('.lead-card').forEach(card => {
        card.style.display = card.textContent.toLowerCase().includes(q) ? '' : 'none';
    });
}

function filterChat(btn, filter) {
    document.querySelectorAll('.chat-tab').forEach(b => {
        b.className = 'chat-tab shrink-0 px-4 py-2 rounded-xl text-xs font-semibold bg-slate-50 border border-slate-200 text-slate-600 hover:bg-slate-100 whitespace-nowrap transition';
    });
    btn.className = 'chat-tab active-chat shrink-0 px-4 py-2 rounded-xl text-xs font-bold bg-blue-600 text-white whitespace-nowrap';
    document.getElementById('chatPayNote').classList.toggle('hidden', filter !== 'unpaid');
    document.querySelectorAll('#chatList .chat-item').forEach(item => {
        const filters = (item.dataset.chatFilter || '').split(' ');
        item.style.display = filters.includes(filter === 'recent' ? 'recent' : filter) ? '' : 'none';
    });
}

function toggleChat(row) {
    const thread = row.nextElementSibling;
    const chevron = row.querySelector('.chat-chevron');
    const isOpen = !thread.classList.contains('hidden');
    document.querySelectorAll('.chat-thread').forEach(t => t.classList.add('hidden'));
    document.querySelectorAll('.chat-chevron').forEach(c => c.style.transform = '');
    if (!isOpen) {
        thread.classList.remove('hidden');
        chevron.style.transform = 'rotate(180deg)';
        setTimeout(() => thread.scrollIntoView({ behavior:'smooth', block:'nearest' }), 50);
    }
}

function exportLeads() {
    const rows = [['Phone','Service','Status','Time']];
    document.querySelectorAll('.lead-card').forEach(card => {
        const cells = card.querySelectorAll('p');
        rows.push([cells[0]?.textContent.trim(), cells[1]?.textContent.split('—')[0].trim(), card.dataset.status, cells[0]?.nextSibling?.textContent?.trim()]);
    });
    const csv = rows.map(r => r.join(',')).join('\n');
    const a = document.createElement('a');
    a.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv);
    a.download = 'Zonely_Leads.csv';
    a.click();
    showToast('Leads exported as CSV');
}

function showToast(msg) {
    const t = document.getElementById('toast');
    t.textContent = msg;
    t.style.opacity = '1';
    setTimeout(() => t.style.opacity = '0', 2500);
}
</script>
@endsection
