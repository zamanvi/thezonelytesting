<?php

namespace App\Http\Controllers;

use App\Http\Requests\CityRequest;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Str;

class CityController extends Controller
{
    /**
     * Display a listing of cities for a state.
     */
    public function index(State $state)
    {
        $cities = $state->cities()->paginate(10);
        return view('admin.locations.cities.index', compact('cities', 'state'));
    }

    /**
     * Show the form for creating a new city for a state.
     */
    public function create(State $state)
    {
        $cities = $state->cities()->paginate(10);
        return view('admin.locations.cities.index', compact('cities', 'state'));
    }

    /**
     * Store a newly created city in storage.
     */
    public function store(CityRequest $request, State $state)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Assign parent state
        $data['state_id'] = $state->id;

        City::create($data);

        return redirect()->route('admin.states.cities.index', $state)
                         ->with('success', 'City created successfully');
    }

    /**
     * Display a specific city.
     */
    public function show(State $state, City $city)
    {
        $cities = $state->cities()->paginate(10);
        return view('admin.locations.cities.show', compact('cities', 'city', 'state'));
    }

    /**
     * Show the form for editing a city.
     */
    public function edit(State $state, City $city)
    {
        $cities = $state->cities()->paginate(10);
        return view('admin.locations.cities.edit', compact('cities', 'city', 'state'));
    }

    /**
     * Update a city in storage.
     */
    public function update(CityRequest $request, State $state, City $city)
    {
        $data = $request->validated();

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $city->update($data);

        return redirect()->route('admin.states.cities.index', $state)
                         ->with('success', 'City updated successfully');
    }

    /**
     * Remove a city from storage.
     */
    public function destroy(State $state, City $city)
    {
        $city->delete();

        return redirect()->route('admin.states.cities.index', $state)
                         ->with('success', 'City deleted successfully');
    }
}