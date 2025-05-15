@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Country</h1>

    <form action="{{ route('countries.update', ['id' => $country->country_id]) }}" method="POST" class="mb-3">
        @csrf
        @method('PATCH') <!-- PATCH metoda za ažuriranje -->

        <div class="mb-3">
            <label for="country" class="form-label">Country Name:</label>
            <input type="text" id="country" name="country" value="{{ $country->country }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Country</button>
    </form>

    <a href="{{ route('countries.index') }}" class="btn btn-secondary">Back to Countries</a>
</div>
@endsection
