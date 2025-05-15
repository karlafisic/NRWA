<?php

namespace App\Http\Controllers;
use App\Models\Country;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $countries = Country::all();
        return view('countries.index', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'country' => 'required|string|max:255',
        ]);

        // Laravel automatski upravlja created_at i updated_at vrijednostima
        Country::create([
            'country' => $request->country,
        ]);

        return redirect()->route('countries.index')->with('success', 'Country created successfully.');
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
        $country = Country::findOrFail($id);
        return view('countries.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'country' => 'required|max:255',
        ]);

        $country = Country::findOrFail($id);
        $country->update($request->all());

        return redirect()->route('countries.index')->with('success', 'Country updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $country = Country::findOrFail($id);
        $country->delete();

        return redirect('/countries')->with('success', 'Country deleted successfully');
    }
}
