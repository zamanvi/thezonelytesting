<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    protected $type;
    protected $model;

    /**
     * Create a new controller instance.
     */ 
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->type = getUserType(); 
            return $next($request);
        });
        $this->model = new Education();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $educations = $this->model->where('user_id', auth()->id())->paginate(10);
        return view('profile.educations.index', compact('educations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
