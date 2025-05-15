@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Rental</h1>

    <form action="{{ route('rentals.update', ['id' => $rental->rental_id]) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="rental_date" class="form-label">Rental Date:</label>
            <input type="datetime-local" id="rental_date" name="rental_date" class="form-control" 
                   value="{{ \Carbon\Carbon::parse($rental->rental_date)->format('Y-m-d\TH:i') }}" required>
        </div>

        <div class="mb-3">
            <label for="inventory_id" class="form-label">Inventory:</label>
            <select id="inventory_id" name="inventory_id" class="form-select" required>
                @foreach($inventories as $inventory)
                    <option value="{{ $inventory->inventory_id }}"
                        @if($rental->inventory_id == $inventory->inventory_id) selected @endif>
                        {{ $inventory->inventory_id }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="customer_id" class="form-label">Customer:</label>
            <select id="customer_id" name="customer_id" class="form-select" required>
                @foreach($customers as $customer)
                    <option value="{{ $customer->customer_id }}"
                        @if($rental->customer_id == $customer->customer_id) selected @endif>
                        {{ $customer->first_name }} {{ $customer->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="return_date" class="form-label">Return Date:</label>
            <input type="datetime-local" id="return_date" name="return_date
