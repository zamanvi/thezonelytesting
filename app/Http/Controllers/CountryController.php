<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountryRequest;
use App\Models\Country;
use Illuminate\Support\Str;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $countries = Country::paginate(10);
        return view('admin.locations.countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::paginate(10);
        return view('admin.locations.countries.index', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
    {
        $data = $request->validated();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        Country::create($data);
        return redirect()->back()->with('success', 'Country created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        $countries = Country::paginate(10);
        return view('admin.locations.countries.show', compact('countries', 'country'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        $countries = Country::paginate(10);
        return view('admin.locations.countries.edit', compact('countries', 'country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, Country $country)
    {
        $data = $request->validated();
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        $country->update($data);
        return redirect()->back()->with('success', 'Country updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->back()->with('success', 'Country deleted successfully.');
    }
}
