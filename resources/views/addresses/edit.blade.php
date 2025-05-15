@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Address</h1>

    <form action="{{ route('addresses.update', ['id' => $address->address_id]) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="address" class="form-label">Address Line 1:</label>
            <input type="text" id="address" name="address" class="form-control" 
                   value="{{ $address->address }}" required>
        </div>

        <div class="mb-3">
            <label for="address2" class="form-label">Address Line 2:</label>
            <input type="text" id="address2" name="address2" class="form-control" 
                   value="{{ $address->address2 }}">
        </div>

        <div class="mb-3">
            <label for="district" class="form-label">District:</label>
            <input type="text" id="district" name="district" class="form-control" 
                   value="{{ $address->district }}" required>
        </div>

        <div class="mb-3">
            <label for="city_id" class="form-label">City:</label>
            <select id="city_id" name="city_id" class="form-select" required>
                @foreach($cities as $city)
                    <option value="{{ $city->city_id }}" 
                        @if($address->city_id == $city->city_id) selected @endif>
                        {{ $city->city }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="postal_code" class="form-label">Postal Code:</label>
            <input type="text" id="postal_code" name="postal_code" class="form-control" 
                   value="{{ $address->postal_code }}">
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Phone:</label>
            <input type="text" id="phone" name="phone" class="form-control" 
                   value="{{ $address->phone }}" required>
        </div>

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

        <button type="submit" class="btn btn-primary">Update Address</button>
        <a href="{{ route('addresses.index') }}" class="btn btn-secondary ms-2">Back to Addresses</a>
    </form>
</div>
@endsection