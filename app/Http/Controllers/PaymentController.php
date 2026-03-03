<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Policy;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class PaymentController extends Controller
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
public function create(Vehicle $vehicle, Policy $policy)
    {
        return view('admin.payments2.create', compact('vehicle', 'policy'));
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request, Vehicle $vehicle, Policy $policy)
    {
        $request->validate([
            'payment_date' => 'required|date',
            'amount' => 'required|numeric',
            'method' => 'required|in:cash,bank,card,mobile,online',
            'reference_number' => 'required|string|max:255',
            'status' => 'required|in:completed,pending,failed,refunded',
        ]);

        $policy->payments()->create($request->all());

        return redirect()->route('admin.vehicles.show', $vehicle->id)
                         ->with('success', 'Payment added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle, Policy $policy, Payment $payment)
    {
        return view('admin.payments2.edit', compact('vehicle', 'policy', 'payment'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Vehicle $vehicle, Policy $policy, Payment $payment)
    {
        $request->validate([
            'payment_date' => 'required|date',
            'amount' => 'required|numeric',
            'method' => 'required|in:cash,bank,card,mobile,online',
            'reference_number' => 'required|string|max:255',
            'status' => 'required|in:completed,pending,failed,refunded',
        ]);

        $payment->update($request->all());

        return redirect()->route('admin.vehicles.show', $vehicle->id)
                         ->with('success', 'Payment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
 public function destroy(Vehicle $vehicle, Policy $policy, Payment $payment)
    {
        $payment->delete();

        return redirect()->route('admin.vehicles.show', $vehicle->id)
                         ->with('success', 'Payment deleted successfully.');
    }
}
