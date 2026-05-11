<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::with('user:id,name,email,slug', 'category:id,title')
            ->latest();

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($sub) use ($q) {
                $sub->where('title', 'like', "%$q%")
                    ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%$q%"));
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $services = $query->paginate(25)->withQueryString();

        $stats = [
            'total'    => Service::count(),
            'active'   => Service::where('is_active', true)->count(),
            'inactive' => Service::where('is_active', false)->count(),
        ];

        return view('admin.services.index', compact('services', 'stats'));
    }

    public function toggleActive(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update(['is_active' => !$service->is_active]);
        return back()->with('success', '"' . $service->title . '" ' . ($service->is_active ? 'activated' : 'deactivated') . '.');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $name = $service->title;
        $service->delete();
        return back()->with('warning', 'Service "' . $name . '" deleted.');
    }
}
