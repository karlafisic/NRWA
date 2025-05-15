@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Add New Customer</h1>

    <form action="{{ route('customers.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="first_name" class="form-label">First Name:</label>
                <input type="text" id="first_name" name="first_name" class="form-control" required>
            </div>

            <div class="col-md-6">
                <label for="last_name" class="form-label">Last Name:</label>
                <input type="text" id="last_name" name="last_name" class="form-control" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control">
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="store_id" class="form-label">Store:</label>
                <select id="store_id" name="store_id" class="form-select" required>
                    @foreach($stores as $store)
                        <option value="{{ $store->store_id }}">Store {{ $store->store_id }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="address_id" class="form-label">Address:</label>
                <select id="address_id" name="address_id" class="form-select" required>
                    @foreach($addresses as $address)
                        <option value="{{ $address->address_id }}">{{ $address->address }}, {{ $address->postal_code }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" id="active" name="active" class="form-check-input" value="1" checked>
            <label for="active" class="form-check-label">Active</label>
        </div>

        <button type="submit" class="btn btn-success">Add Customer</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary ms-2">Back to Customers</a>
    </form>
</div>
@endsection