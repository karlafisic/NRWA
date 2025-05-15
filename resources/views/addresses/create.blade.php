@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Add New Address</h1>

    <form action="{{ route('addresses.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="address" class="form-label">Address Line 1:</label>
            <input type="text" id="address" name="address" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="address2" class="form-label">Address Line 2 (optional):</label>
            <input type="text" id="address2" name="address2" class="form-control">
        </div>

        <div class="mb-3">
            <label for="district" class="form-label">District:</label>
            <input type="text" id="district" name="district" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="city_id" class="form-label">City:</label>
            <select id="city_id" name="city_id" class="form-select" required>
                @foreach($cities as $city)
                    <option value="{{ $city->city_id }}">{{ $city->city }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="postal_code" class="form-label">Postal Code:</label>
            <input type="text" id="postal_code" name="postal_code" class="form-control">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone:</label>
            <input type="text" id="phone" name="phone" class="form-control" required>
        </div>

        <!-- Ovo polje možete prilagoditi za unos geometry podataka -->
        <div class="mb-3">
            <label for="longitude" class="form-label">Longitude:</label>
            <input type="text" id="longitude" name="longitude" class="form-control" required 
                   value="{{ old('longitude', $address->longitude ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="latitude" class="form-label">Latitude:</label>
            <input type="text" id="latitude" name="latitude" class="form-control" required 
                   value="{{ old('latitude', $address->latitude ?? '') }}">
        </div>

        <button type="submit" class="btn btn-success">Add Address</button>
        <a href="{{ route('addresses.index') }}" class="btn btn-secondary ms-2">Back to Addresses</a>
    </form>
</div>
@endsection