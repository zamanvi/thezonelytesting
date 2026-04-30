<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function dashboard()
    {
        $user  = Auth::user();
        $staff = $user->staffProfile()->with(['user', 'parent.user', 'children.user'])->first();

        if (!$staff) {
            return redirect()->route('frontend.home')->with('error', 'No staff profile found.');
        }

        $sellers   = $this->getSellers($staff);
        $sellerIds = $sellers->pluck('id');

        $leads = Lead::whereIn('seller_id', $sellerIds)
            ->with('seller')
            ->latest()
            ->get();

        $paidLeads    = $leads->filter(fn($l) => $l->paid_at !== null);
        $unpaidLeads  = $leads->filter(fn($l) => $l->paid_at === null);

        $totalRevenue   = $paidLeads->sum('fee');
        $pendingRevenue = $unpaidLeads->sum('fee');

        $rate = $staff->commission_rate / 100;

        $commissionReceived = round($totalRevenue   * $rate, 2);
        $commissionPending  = round($pendingRevenue * $rate, 2);

        $monthly = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $key   = $month->format('M');
            $monthLeads = $leads->filter(fn($l) => $l->created_at && $l->created_at->isSameMonth($month));
            $monthly[$key] = [
                'leads'      => $monthLeads->count(),
                'revenue'    => $monthLeads->filter(fn($l) => $l->paid_at)->sum('fee'),
                'commission' => round($monthLeads->filter(fn($l) => $l->paid_at)->sum('fee') * $rate, 2),
            ];
        }

        return view('frontend.staff.dashboard', compact(
            'user', 'staff', 'sellers', 'leads',
            'paidLeads', 'unpaidLeads',
            'totalRevenue', 'pendingRevenue',
            'commissionReceived', 'commissionPending',
            'monthly'
        ));
    }

    private function getSellers($staff)
    {
        $query = User::activeSellers();

        match ($staff->role) {
            'area_manager'     => $query->where(function ($q) use ($staff) {
                                      if ($staff->assigned_area) {
                                          $q->where('zip_code', $staff->assigned_area)
                                            ->orWhere('city', 'like', '%'.$staff->assigned_area.'%');
                                      }
                                  }),
            'city_manager'     => $query->where(function ($q) use ($staff) {
                                      if ($staff->assigned_area) {
                                          $q->where('city', 'like', '%'.$staff->assigned_area.'%');
                                      }
                                  }),
            'district_manager',
            'country_manager'  => $query->where(function ($q) use ($staff) {
                                      if ($staff->assigned_state) {
                                          $q->where('state', 'like', '%'.$staff->assigned_state.'%');
                                      }
                                  }),
            default            => null,
        };

        return $query->latest()->get();
    }
}
