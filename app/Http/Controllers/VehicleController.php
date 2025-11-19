<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new Vehicle();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicles = Vehicle::latest()->paginate(20);
        return view('admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.vehicles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'vin' => 'required|unique:vehicles,vin',
            'registration_number' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'manufacture_year' => 'required|string|max:10',
            'color' => 'nullable|string|max:255',
            'owner_name' => 'required|string|max:255',
            'owner_phone' => 'required|string|max:255',
            'owner_email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'aproximate_min' => 'required|string',
            'aproximate_max' => 'required|string',
        ]);

        Vehicle::create($request->all());

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle Created Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('admin.vehicles.show', compact('vehicle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('admin.vehicles.edit', compact('vehicle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'vin' => 'required|unique:vehicles,vin,' . $vehicle->id,
            'registration_number' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'manufacture_year' => 'required|string|max:10',
            'color' => 'nullable|string|max:255',
            'owner_name' => 'required|string|max:255',
            'owner_phone' => 'required|string|max:255',
            'owner_email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
            'aproximate_min' => 'required|string',
            'aproximate_max' => 'required|string',
        ]);

        $vehicle->update($request->all());

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle Deleted Successfully!');
    }
}
