@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Payment</h1>

    <form action="{{ route('payments.update', ['id' => $payment->payment_id]) }}" method="POST">
        @csrf
        @method('PATCH') <!-- Use PATCH method for updating -->

        <div class="mb-3">
            <label for="customer_id" class="form-label">Customer:</label>
            <select id="customer_id" name="customer_id" class="form-select" required>
                @foreach($customers as $customer)
                    <option value="{{ $customer->customer_id }}" 
                        @if($payment->customer_id == $customer->customer_id) selected @endif>
                        {{ $customer->first_name }} {{ $customer->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="staff_id" class="form-label">Staff:</label>
            <select id="staff_id" name="staff_id" class="form-select" required>
                @foreach($staffMembers as $staff)
                    <option value="{{ $staff->staff_id }}" 
                        @if($payment->staff_id == $staff->staff_id) selected @endif>
                        {{ $staff->first_name }} {{ $staff->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="rental_id" class="form-label">Rental:</label>
            <select id="rental_id" name="rental_id" class="form-select">
                <option value="" @if(!$payment->rental) selected @endif>No Rental</option>
                @foreach($rentals as $rental)
                    <option value="{{ $rental->rental_id }}" 
                        @if($payment->rental_id == $rental->rental_id) selected @endif>
                        Rental ID: {{ $rental->rental_id }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount:</label>
            <input type="number" id="amount" name="amount" class="form-control" value="{{ $payment->amount }}" required step="0.01">
        </div>

        <div class="mb-3">
            <label for="payment_date" class="form-label">Payment Date:</label>
            <input type="datetime-local" id="payment_date" name="payment_date" class="form-control" value="{{ $payment->payment_date->format('Y-m-d\TH:i') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Payment</button>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary ms-2">Back to Payments</a>
    </form>
</div>
@endsection
