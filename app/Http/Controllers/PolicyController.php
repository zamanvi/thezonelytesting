<?php

namespace App\Http\Controllers;

use App\Models\Policy;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
public function create(Vehicle $vehicle)
    {
        return view('admin.policies2.create', compact('vehicle'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Vehicle $vehicle)
    {
        $request->validate([
            'policy_number' => 'required|unique:policies,policy_number',
            'insurance_company' => 'required|string|max:255',
            'policy_type' => 'required|in:Liability,Comprehensive,Full Coverage',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'premium_amount' => 'required|string|max:255',
            'coverage_amount' => 'required|string|max:255',
            'deductible' => 'nullable|string|max:255',
            'status' => 'required|in:Active,Expired,Cancelled',
            'notes' => 'nullable|string',
        ]);

        $vehicle->policies()->create($request->all());

        return redirect()->route('admin.vehicles.show', $vehicle->id)
                         ->with('success', 'Policy added successfully!');
    }

    /**
     * Display the specified resource.
     */
 public function show(Vehicle $vehicle, Policy $policy)
    {
        return view('admin.policies2.show', compact('vehicle', 'policy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle, Policy $policy)
    {
        return view('admin.policies2.edit', compact('vehicle', 'policy'));
    }

    /**
     * Update the specified resource in storage.
     */
 public function update(Request $request, Vehicle $vehicle, Policy $policy)
    {
        $request->validate([
            'policy_number' => 'required|unique:policies,policy_number,' . $policy->id,
            'insurance_company' => 'required|string|max:255',
            'policy_type' => 'required|in:Liability,Comprehensive,Full Coverage',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'premium_amount' => 'required|string|max:255',
            'coverage_amount' => 'required|string|max:255',
            'deductible' => 'nullable|string|max:255',
            'status' => 'required|in:Active,Expired,Cancelled',
            'notes' => 'nullable|string',
        ]);

        $policy->update($request->all());

        return redirect()->route('admin.vehicles.show', $vehicle->id)
                         ->with('success', 'Policy updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle, Policy $policy)
    {
        $policy->delete();
        return redirect()->route('admin.vehicles.show', $vehicle->id)
                         ->with('success', 'Policy deleted successfully!');
    }
}
