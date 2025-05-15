<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Film;
use App\Models\Store;
use Illuminate\Http\Request;
use Carbon\Carbon;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $inventories = Inventory::with(['film', 'store'])->get();
        return view('inventories.index', compact('inventories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $films = Film::all(); 
        $stores = Store::all();

        return view('inventories.create', compact('films', 'stores'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'film_id' => 'required|integer|exists:film,film_id',
            'store_id' => 'required|integer|exists:store,store_id',
        ]);

        Inventory::create([
            'film_id' => $request->film_id,
            'store_id' => $request->store_id,
            'last_update' => now(),
        ]);

        return redirect('/inventories')->with('success', 'Inventory item created successfully.');
        
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
        $inventory = Inventory::findOrFail($id);
        $films = Film::all();
        $stores = Store::all();

        return view('inventories.edit', compact('inventory', 'films', 'stores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'film_id' => 'required|integer|exists:film,film_id',
            'store_id' => 'required|integer|exists:store,store_id',
        ]);

        $inventory = Inventory::findOrFail($id);
        $inventory->update([
            'film_id' => $request->film_id,
            'store_id' => $request->store_id,
            'last_update' => Carbon::now(),
        ]);

        return redirect('/inventories')->with('success', 'Inventory item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $inventory = Inventory::findOrFail($id);

        // Provjera da li postoje povezani rentals
        if($inventory->rentals()->exists()) {
            return redirect('/inventories')
                ->with('error', 'Cannot delete inventory item because it has associated rentals.');
        }

        $inventory->delete();

        return redirect('/inventories')->with('success', 'Inventory item deleted successfully.');
    }
}
