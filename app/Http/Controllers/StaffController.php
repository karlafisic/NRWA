<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Store;
use App\Models\Address;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffMembers = Staff::with(['store', 'address'])->get();
        return view('staff.index', compact('staffMembers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stores = Store::all();
        $addresses = Address::all();
        
        return view('staff.create', compact('stores', 'addresses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:45',
            'last_name' => 'required|string|max:45',
            'address_id' => 'required|integer|exists:address,address_id',
            'picture' => 'nullable',
            'email' => 'nullable|email|max:50',
            'store_id' => 'required|integer|exists:store,store_id',
            'active' => 'required|boolean',
            'username' => 'required|string|max:16|unique:staff,username',
        ]);

        $staff = Staff::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address_id' => $request->address_id,
            'picture' => $request->picture,
            'email' => $request->email,
            'store_id' => $request->store_id,
            'active' => $request->active,
            'username' => $request->username,
            'last_update' => Carbon::now(),
        ]);

        return redirect('/staff')->with('success', 'Staff member created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $staff = Staff::findOrFail($id);
        $stores = Store::all();
        $addresses = Address::all();

        return view('staff.edit', compact('staff', 'stores', 'addresses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required|string|max:45',
            'last_name' => 'required|string|max:45',
            'address_id' => 'required|integer|exists:address,address_id',
            'picture' => 'nullable',
            'email' => 'nullable|email|max:50',
            'store_id' => 'required|integer|exists:store,store_id',
            'active' => 'required|boolean',
            'username' => 'required|string|max:16|unique:staff,username,'.$id.',staff_id',
        ]);

        $staff = Staff::findOrFail($id);
        
        $updateData = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address_id' => $request->address_id,
            'picture' => $request->picture,
            'email' => $request->email,
            'store_id' => $request->store_id,
            'active' => $request->active,
            'username' => $request->username,
            'last_update' => Carbon::now(),
        ];

        $staff->update($updateData);

        return redirect('/staff')->with('success', 'Staff member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $staff = Staff::findOrFail($id);

        // Check if staff is managing any store
        if ($staff->managedStore()->exists()) {
            return back()->with('error', 'Cannot delete staff member because they are managing a store.');
        }

        $staff->delete();
        return redirect('/staff')->with('success', 'Staff member deleted successfully.');
    }
}