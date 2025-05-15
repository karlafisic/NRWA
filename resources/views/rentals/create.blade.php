@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Add New Rental</h1>

    <form action="{{ route('rentals.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="rental_date" class="form-label">Rental Date:</label>
            <input type="datetime-local" id="rental_date" name="rental_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="inventory_id" class="form-label">Inventory:</label>
            <select id="inventory_id" name="inventory_id" class="form-select" required>
                @foreach($inventories as $inventory)
                    <option value="{{ $inventory->inventory_id }}">ID: {{ $inventory->inventory_id }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="customer_id" class="form-label">Customer:</label>
            <select id="customer_id" name="customer_id" class="form-select" required>
                @foreach($customers as $customer)
                    <option value="{{ $customer->customer_id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="return_date" class="form-label">Return Date (optional):</label>
            <input type="datetime-local" id="return_date" name="return_date" class="form-control">
        </div>

        <div class="mb-3">
            <label for="staff_id" class="form-label">Staff:</label>
            <select id="staff_id" name="staff_id" class="form-select" required>
                @foreach($staffs as $staff)
                    <option value="{{ $staff->staff_id }}">{{ $staff->first_name }} {{ $staff->last_name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Add Rental</button>
        <a href="{{ route('rentals.index') }}" class="btn btn-secondary ms-2">Back to Rentals</a>
    </form>
</div>
@endsection
