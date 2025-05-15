<?php

namespace App\Http\Controllers;
use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cities = City::with('country')->get();
        return view('cities.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $countries = Country::all();

        return view('cities.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'city' => 'required|string|max:255',
            'country_id' => 'required|integer|exists:country,country_id',
        ]);
        $city = City::create([
            'city' => $request->city,
            'country_id' => $request->country_id,
            'last_update' => now(), 
        ]);
        return redirect('/cities')->with('success', 'City created successfully.');
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
    public function edit(string $id)
    {
        //
        $city = City::findOrFail($id);
        $countries = Country::all(); 

        return view('cities.edit', compact('city', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'city' => 'required|string|max:255',
            'country_id' => 'required|integer|exists:country,country_id',
        ]);
        $city = City::findOrFail($id);
        $city->update([
            'city' => $request->city,
            'country_id' => $request->country_id,
            'last_update' => Carbon::now(), 
        ]);
        return redirect('/cities')->with('success', 'City updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $city = City::findOrFail($id);

        $city->delete();

        return redirect('/cities')->with('success', 'City deleted successfully.');
    }
}
