@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit City</h1>

    <form action="{{ route('cities.update', ['id' => $city->city_id]) }}" method="POST">
        @csrf
        @method('PATCH') <!-- Use PATCH method for updating -->

        <div class="mb-3">
            <label for="city" class="form-label">City Name:</label>
            <input type="text" id="city" name="city" class="form-control" value="{{ $city->city }}" required>
        </div>

        <div class="mb-3">
            <label for="country_id" class="form-label">Country:</label>
            <select id="country_id" name="country_id" class="form-select" required>
                @foreach($countries as $country)
                    <option value="{{ $country->country_id }}" 
                        @if($city->country_id == $country->country_id) selected @endif>
                        {{ $country->country }}
                    </option>
                @endforeach
            </select>
        </div>


        <button type="submit" class="btn btn-primary">Update City</button>
        <a href="{{ route('cities.index') }}" class="btn btn-secondary ms-2">Back to Cities</a>
    </form>
</div>
@endsection
