@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Add New City</h1>

    <form action="{{ route('cities.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="city" class="form-label">City Name:</label>
            <input type="text" id="city" name="city" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="country_id" class="form-label">Country:</label>
            <select id="country_id" name="country_id" class="form-select" required>
                @foreach($countries as $country)
                    <option value="{{ $country->country_id }}">{{ $country->country }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Add City</button>
        <a href="{{ route('cities.index') }}" class="btn btn-secondary ms-2">Back to Cities</a>
    </form>
</div>
@endsection
