@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Add New Payment</h1>

    <form action="{{ route('payments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="customer_id" class="form-label">Customer:</label>
            <select id="customer_id" name="customer_id" class="form-select" required>
                @foreach($customers as $customer)
                    <option value="{{ $customer->customer_id }}">
                        {{ $customer->first_name }} {{ $customer->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="staff_id" class="form-label">Staff:</label>
            <select id="staff_id" name="staff_id" class="form-select" required>
                @foreach($staffs as $staff)
                    <option value="{{ $staff->staff_id }}">
                        {{ $staff->first_name }} {{ $staff->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="rental_id" class="form-label">Rental (optional):</label>
            <select id="rental_id" name="rental_id" class="form-select">
                <option value="">-- None --</option>
                @foreach($rentals as $rental)
                    <option value="{{ $rental->rental_id }}">
                        Rental ID: {{ $rental->rental_id }} - {{ $rental->rental_date }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount:</label>
            <input type="number" step="0.01" id="amount" name="amount" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="payment_date" class="form-label">Payment Date:</label>
            <input type="datetime-local" id="payment_date" name="payment_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Add Payment</button>
        <a href="{{ route('payments.index') }}" class="btn btn-secondary ms-2">Back to Payments</a>
    </form>
</div>
@endsection
