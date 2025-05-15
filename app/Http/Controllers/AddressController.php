<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\City;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $addresses = Address::with('city')->get();
        return view('addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $cities = City::all();
        return view('addresses.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'address' => 'required|string|max:50',
            'address2' => 'nullable|string|max:50',
            'district' => 'required|string|max:20',
            'city_id' => 'required|integer|exists:city,city_id',
            'postal_code' => 'nullable|string|max:10',
            'phone' => 'required|string|max:20',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
        ]);

        // Kreiranje adrese s koordinatama
        $address = new Address([
            'address' => $validated['address'],
            'address2' => $validated['address2'],
            'district' => $validated['district'],
            'city_id' => $validated['city_id'],
            'postal_code' => $validated['postal_code'],
            'phone' => $validated['phone'],
            'last_update' => now(),
        ]);

        // Postavljanje lokacije preko mutatora
        $address->location = [
            'longitude' => $validated['longitude'],
            'latitude' => $validated['latitude']
        ];

        $address->save();

        return redirect('/addresses')->with('success', 'Address created successfully.');
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
        $address = Address::findOrFail($id);
        $cities = City::all();
        
        // Koristimo accessor za dobijanje koordinata
        $coordinates = $address->location;
        
        return view('addresses.edit', [
            'address' => $address,
            'cities' => $cities,
            'longitude' => $coordinates['longitude'],
            'latitude' => $coordinates['latitude']
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate([
            'address' => 'required|string|max:50',
            'address2' => 'nullable|string|max:50',
            'district' => 'required|string|max:20',
            'city_id' => 'required|integer|exists:city,city_id',
            'postal_code' => 'nullable|string|max:10',
            'phone' => 'required|string|max:20',
            'longitude' => 'required|numeric',
            'latitude' => 'required|numeric',
        ]);

        $address = Address::findOrFail($id);
        
        // Ažuriranje osnovnih podataka
        $address->update([
            'address' => $validated['address'],
            'address2' => $validated['address2'],
            'district' => $validated['district'],
            'city_id' => $validated['city_id'],
            'postal_code' => $validated['postal_code'],
            'phone' => $validated['phone'],
            'last_update' => Carbon::now(),
        ]);
    
        $address->location = [
            'longitude' => $validated['longitude'],
            'latitude' => $validated['latitude']
        ];
        
        $address->save();

        return redirect('/addresses')->with('success', 'Address updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $address = Address::findOrFail($id);
        $address->delete();
        return redirect('/addresses')->with('success', 'Address deleted successfully.');
    }
}
