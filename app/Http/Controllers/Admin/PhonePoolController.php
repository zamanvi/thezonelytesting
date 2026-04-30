<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CallLog;
use App\Models\Lead;
use App\Models\TwilioNumber;
use App\Models\User;
use Illuminate\Http\Request;

class PhonePoolController extends Controller
{
    public function index()
    {
        $numbers  = TwilioNumber::with('seller')->orderBy('status')->orderBy('number')->get();
        $available = $numbers->where('status', 'available')->count();
        $assigned  = $numbers->where('status', 'assigned')->count();
        return view('admin.phone_pool.index', compact('numbers', 'available', 'assigned'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'number'        => 'required|string|unique:twilio_numbers,number',
            'friendly_name' => 'nullable|string|max:50',
            'twilio_sid'    => 'nullable|string|max:50',
        ]);

        TwilioNumber::create([
            'number'        => $request->number,
            'friendly_name' => $request->friendly_name ?? $request->number,
            'twilio_sid'    => $request->twilio_sid,
            'status'        => 'available',
        ]);

        return back()->with('success', 'Number added to pool.');
    }

    public function assign(Request $request, $id)
    {
        $request->validate(['seller_id' => 'required|exists:users,id']);

        $number = TwilioNumber::findOrFail($id);
        $seller = User::where('type', 'seller')->findOrFail($request->seller_id);

        // Release any existing number for this seller
        TwilioNumber::where('seller_id', $seller->id)->each(fn($n) => $n->release());

        $number->assign($seller->id);

        return back()->with('success', "{$number->number} assigned to {$seller->name}.");
    }

    public function release($id)
    {
        $number = TwilioNumber::findOrFail($id);
        $name   = $number->seller?->name ?? 'unassigned';
        $number->release();
        return back()->with('success', "Number released from {$name} → back to pool.");
    }

    public function destroy($id)
    {
        TwilioNumber::findOrFail($id)->delete();
        return back()->with('success', 'Number removed from pool.');
    }

    public function callLogs()
    {
        $logs = CallLog::with('seller:id,name', 'lead:id,service')
            ->latest('called_at')
            ->paginate(30);

        $stats = [
            'total'     => CallLog::count(),
            'today'     => CallLog::whereDate('called_at', today())->count(),
            'completed' => CallLog::where('status', 'completed')->count(),
            'missed'    => CallLog::whereIn('status', ['no-answer', 'busy', 'failed'])->count(),
        ];

        return view('admin.phone_pool.call_logs', compact('logs', 'stats'));
    }
}
