<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Inventory;
use App\Models\Customer;
use App\Models\Staff;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $rentals = Rental::with(['inventory', 'customer', 'staff'])->get();
        return view('rentals.index', compact('rentals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $inventories = Inventory::all();
        $customers = Customer::all();
        $staffs = Staff::all();

        return view('rentals.create', compact('inventories', 'customers', 'staffs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'rental_date' => 'required|date',
            'inventory_id' => 'required|integer|exists:inventory,inventory_id',
            'customer_id' => 'required|integer|exists:customer,customer_id',
            'return_date' => 'nullable|date|after_or_equal:rental_date',
            'staff_id' => 'required|integer|exists:staff,staff_id',
        ]);

        Rental::create([
            'rental_date' => $request->rental_date,
            'inventory_id' => $request->inventory_id,
            'customer_id' => $request->customer_id,
            'return_date' => $request->return_date,
            'staff_id' => $request->staff_id,
            'last_update' => now(),
        ]);

        return redirect('/rentals')->with('success', 'Rental created successfully.');
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
        $rental = Rental::findOrFail($id);
        $inventories = Inventory::all();
        $customers = Customer::all();
        $staffs = Staff::all();

        return view('rentals.edit', compact('rental', 'inventories', 'customers', 'staffs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'rental_date' => 'required|date',
            'inventory_id' => 'required|integer|exists:inventory,inventory_id',
            'customer_id' => 'required|integer|exists:customer,customer_id',
            'return_date' => 'nullable|date|after_or_equal:rental_date',
            'staff_id' => 'required|integer|exists:staff,staff_id',
        ]);

        $rental = Rental::findOrFail($id);

        $rental->update([
            'rental_date' => $request->rental_date,
            'inventory_id' => $request->inventory_id,
            'customer_id' => $request->customer_id,
            'return_date' => $request->return_date,
            'staff_id' => $request->staff_id,
            'last_update' => now(),
        ]);

        return redirect('/rentals')->with('success', 'Rental updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $rental = Rental::findOrFail($id);
        $rental->delete();

        return redirect('/rentals')->with('success', 'Rental deleted successfully.');
    }
}
