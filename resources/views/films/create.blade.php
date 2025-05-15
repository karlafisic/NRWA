@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Add New Film</h1>

    <form action="{{ route('films.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Film Title:</label>
            <input type="text" id="title" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea id="description" name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label for="release_year" class="form-label">Release Year:</label>
            <input type="number" id="release_year" name="release_year" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="language_id" class="form-label">Language:</label>
            <select id="language_id" name="language_id" class="form-select" required>
                @foreach($languages as $language)
                    <option value="{{ $language->language_id }}">{{ $language->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="rental_duration" class="form-label">Rental Duration (Days):</label>
            <input type="number" id="rental_duration" name="rental_duration" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="rental_rate" class="form-label">Rental Rate:</label>
            <input type="number" step="0.01" id="rental_rate" name="rental_rate" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="length" class="form-label">Length (Minutes):</label>
            <input type="number" id="length" name="length" class="form-control">
        </div>

        <div class="mb-3">
            <label for="replacement_cost" class="form-label">Replacement Cost:</label>
            <input type="number" step="0.01" id="replacement_cost" name="replacement_cost" class="form-control">
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Rating:</label>
            <input type="text" id="rating" name="rating" class="form-control">
        </div>

        <div class="mb-3">
            <label for="special_features" class="form-label">Special Features:</label>
            <textarea id="special_features" name="special_features" class="form-control"></textarea>
        </div>
        {{-- Dodano: Odabir više kategorija --}}
        <div class="mb-3">
            <label class="form-label">Categories:</label>
            @foreach($categories as $category)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->category_id }}" id="category{{ $category->category_id }}">
                    <label class="form-check-label" for="category{{ $category->category_id }}">
                    {{ $category->name }}
                    </label>
                </div>
            @endforeach
        </div>


        <button type="submit" class="btn btn-success">Add Film</button>
        <a href="{{ route('films.index') }}" class="btn btn-secondary ms-2">Back to Films</a>
    </form>
</div>
@endsection
