<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Address;
use App\Models\Staff;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $stores = Store::with(['manager', 'address.city', 'staffMembers'])->get();
        return view('stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $addresses = Address::with('city')->get();
        $staffMembers = Staff::whereNotIn('staff_id', Store::pluck('manager_staff_id'))->get();
    
        return view('stores.create', compact('addresses', 'staffMembers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'manager_staff_id' => 'required|integer|exists:staff,staff_id',
            'address_id' => 'required|integer|exists:address,address_id',
        ]);

        Store::create([
            'manager_staff_id' => $request->manager_staff_id,
            'address_id' => $request->address_id,
            'last_update' => now(),
        ]);

        return redirect('/stores')->with('success', 'Store created successfully.');
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
        $store = Store::with(['manager', 'address'])->findOrFail($id);
        $addresses = Address::with('city')->get();
        $staffMembers = Staff::all();

        return view('stores.edit', [
            'store' => $store,
            'addresses' => $addresses,
            'staffMembers' => $staffMembers,
            'currentManagerId' => $store->manager_staff_id,
            'currentAddressId' => $store->address_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'manager_staff_id' => 'required|integer|exists:staff,staff_id',
            'address_id' => 'required|integer|exists:address,address_id',
        ]);

        $store = Store::findOrFail($id);
        $store->update([
            'manager_staff_id' => $request->manager_staff_id,
            'address_id' => $request->address_id,
            'last_update' => Carbon::now(),
        ]);

        return redirect('/stores')->with('success', 'Store updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $store = Store::findOrFail($id);
        
        // Provjera da li menadžer može biti obrisan
        if($store->manager) {
            return back()->with('error', 'Cannot delete store because the manager is still assigned.');
        }

        $store->delete();
        return redirect('/stores')->with('success', 'Store deleted successfully.');
    }
}
