<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Customer;
use App\Models\Rental;
use App\Models\Staff;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with(['customer', 'rental', 'staff'])->get();
        return view('payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $rentals = Rental::all();
        $staffs = Staff::all();

        return view('payments.create', compact('customers', 'rentals', 'staffs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|integer|exists:customer,customer_id',
            'staff_id' => 'required|integer|exists:staff,staff_id',
            'rental_id' => 'nullable|integer|exists:rental,rental_id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
        ]);

        Payment::create([
            'customer_id' => $request->customer_id,
            'staff_id' => $request->staff_id,
            'rental_id' => $request->rental_id,
            'amount' => $request->amount,
            'payment_date' => Carbon::parse($request->payment_date),
            'last_update' => now(),
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payment = Payment::findOrFail($id);
        $customers = Customer::all();
        $rentals = Rental::all();
        $staffs = Staff::all();

        return view('payments.edit', compact('payment', 'customers', 'rentals', 'staffs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'customer_id' => 'required|integer|exists:customer,customer_id',
            'staff_id' => 'required|integer|exists:staff,staff_id',
            'rental_id' => 'nullable|integer|exists:rental,rental_id',
            'amount' => 'required|numeric|min:0',
            'payment_date' => 'required|date',
        ]);

        $payment = Payment::findOrFail($id);
        $payment->update([
            'customer_id' => $request->customer_id,
            'staff_id' => $request->staff_id,
            'rental_id' => $request->rental_id,
            'amount' => $request->amount,
            'payment_date' => Carbon::parse($request->payment_date),
            'last_update' => now(),
        ]);

        return redirect()->route('payments.index')->with('success', 'Payment updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect()->route('payments.index')->with('success', 'Payment deleted successfully.');
    }
}
