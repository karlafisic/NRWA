@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Add New Country</h1>

    <form action="{{ route('countries.store') }}" method="POST" class="mb-3">
        @csrf
        <div class="mb-3">
            <label for="country" class="form-label">Country Name:</label>
            <input type="text" id="country" name="country" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Country</button>
    </form>

    <a href="{{ route('countries.index') }}" class="btn btn-secondary">Back to Countries</a>
</div>
@endsection
