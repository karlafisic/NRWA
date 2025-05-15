<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Store;
use App\Models\Address;
use Illuminate\Http\Request;
use Carbon\Carbon;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $customers = Customer::with(['store', 'address'])->get();
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $stores = Store::all();
        $addresses = Address::all();

        return view('customers.create', compact('stores', 'addresses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'store_id' => 'required|integer|exists:store,store_id',
            'address_id' => 'required|integer|exists:address,address_id',
            'active' => 'sometimes|boolean',
        ]);

        $customer = Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'store_id' => $request->store_id,
            'address_id' => $request->address_id,
            'active' => $request->active ?? true,
            'create_date' => now(),
            'last_update' => now(),
        ]);

        return redirect('/customers')->with('success', 'Customer created successfully.');
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
        $customer = Customer::findOrFail($id);
        $stores = Store::all();
        $addresses = Address::all();

        return view('customers.edit', compact('customer', 'stores', 'addresses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'store_id' => 'required|integer|exists:store,store_id',
            'address_id' => 'required|integer|exists:address,address_id',
            'active' => 'sometimes|boolean',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'store_id' => $request->store_id,
            'address_id' => $request->address_id,
            'active' => $request->active ?? $customer->active,
            'last_update' => now(),
        ]);

        return redirect('/customers')->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect('/customers')->with('success', 'Customer deleted successfully.');
    }
}
