<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    function admin_dashboard()
    {
        return view('admin.index');
    }
    public function clear_cache()
    {
        Artisan::call('optimize:clear');
        return back()->with('success', 'All cache cleared successfully.');
    }
}
