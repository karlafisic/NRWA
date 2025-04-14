@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Language</h1>

    <form action="{{ route('languages.update', ['id' => $language->language_id]) }}" method="POST" class="mb-3">
        @csrf
        @method('PATCH') <!-- PATCH metoda za ažuriranje -->

        <div class="mb-3">
            <label for="name" class="form-label">Language Name:</label>
            <input type="text" id="name" name="name" value="{{ $language->name }}" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Language</button>
    </form>

    <a href="{{ route('languages.index') }}" class="btn btn-secondary">Back to Languages</a>
</div>
@endsection
