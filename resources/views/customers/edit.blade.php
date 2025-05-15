@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Customer</h1>

    <form action="{{ route('customers.update', ['id' => $customer->customer_id]) }}" method="POST">
        @csrf
        @method('PATCH') <!-- PATCH metoda za update -->

        <div class="mb-3">
            <label for="first_name" class="form-label">First Name:</label>
            <input type="text" id="first_name" name="first_name" class="form-control" 
                   value="{{ $customer->first_name }}" required>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name:</label>
            <input type="text" id="last_name" name="last_name" class="form-control" 
                   value="{{ $customer->last_name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email (optional):</label>
            <input type="email" id="email" name="email" class="form-control" 
                   value="{{ $customer->email }}">
        </div>

        <div class="mb-3">
            <label for="store_id" class="form-label">Store:</label>
            <select id="store_id" name="store_id" class="form-select" required>
                @foreach($stores as $store)
                    <option value="{{ $store->store_id }}" 
                        @if($customer->store_id == $store->store_id) selected @endif>
                        Store #{{ $store->store_id }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="address_id" class="form-label">Address:</label>
            <select id="address_id" name="address_id" class="form-select" required>
                @foreach($addresses as $address)
                    <option value="{{ $address->address_id }}" 
                        @if($customer->address_id == $address->address_id) selected @endif>
                        {{ $address->address }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" value="1" id="active" name="active"
                   {{ $customer->active ? 'checked' : '' }}>
            <label class="form-check-label" for="active">
                Active
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Update Customer</button>
        <a href="{{ route('customers.index') }}" class="btn btn-secondary ms-2">Back to Customers</a>
    </form>
</div>
@endsection
