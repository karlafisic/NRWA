@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Film</h1>

    <form action="{{ route('films.update', ['id' => $film->film_id]) }}" method="POST">
        @csrf
        @method('PATCH') <!-- Use PATCH method for updating -->

        <div class="mb-3">
            <label for="title" class="form-label">Film Title:</label>
            <input type="text" id="title" name="title" class="form-control" value="{{ $film->title }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea id="description" name="description" class="form-control">{{ $film->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="release_year" class="form-label">Release Year:</label>
            <input type="number" id="release_year" name="release_year" class="form-control" value="{{ $film->release_year }}" required>
        </div>

        <div class="mb-3">
            <label for="language_id" class="form-label">Language:</label>
            <select id="language_id" name="language_id" class="form-select" required>
                @foreach($languages as $language)
                    <option value="{{ $language->language_id }}" 
                        @if($film->language_id == $language->language_id) selected @endif>
                        {{ $language->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="original_language_id" class="form-label">Original Language:</label>
            <select id="original_language_id" name="original_language_id" class="form-select" required>
                @foreach($languages as $language)
                    <option value="{{ $language->language_id }}" 
                        @if($film->original_language_id == $language->language_id) selected @endif>
                        {{ $language->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="rental_duration" class="form-label">Rental Duration (Days):</label>
            <input type="number" id="rental_duration" name="rental_duration" class="form-control" value="{{ $film->rental_duration }}" required>
        </div>

        <div class="mb-3">
            <label for="rental_rate" class="form-label">Rental Rate:</label>
            <input type="number" step="0.01" id="rental_rate" name="rental_rate" class="form-control" value="{{ $film->rental_rate }}" required>
        </div>

        <div class="mb-3">
            <label for="length" class="form-label">Length (Minutes):</label>
            <input type="number" id="length" name="length" class="form-control" value="{{ $film->length }}">
        </div>

        <div class="mb-3">
            <label for="replacement_cost" class="form-label">Replacement Cost:</label>
            <input type="number" step="0.01" id="replacement_cost" name="replacement_cost" class="form-control" value="{{ $film->replacement_cost }}">
        </div>

        <div class="mb-3">
            <label for="rating" class="form-label">Rating:</label>
            <input type="text" id="rating" name="rating" class="form-control" value="{{ $film->rating }}">
        </div>

        <div class="mb-3">
            <label for="special_features" class="form-label">Special Features:</label>
            <textarea id="special_features" name="special_features" class="form-control">{{ $film->special_features }}</textarea>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Categories:</label>
            @foreach($categories as $category)
                <div class="form-check">
                    <input 
                        class="form-check-input" 
                        type="checkbox" 
                        name="categories[]" 
                        value="{{ $category->category_id }}" 
                        id="category{{ $category->category_id }}"
                        @if($film->categories->contains('category_id', $category->category_id)) checked @endif
                    >
                    <label class="form-check-label" for="category{{ $category->category_id }}">
                        {{ $category->name }}
                    </label>
                </div>
            @endforeach
        </div>


        <button type="submit" class="btn btn-primary">Update Film</button>
        <a href="{{ route('films.index') }}" class="btn btn-secondary ms-2">Back to Films</a>
    </form>
</div>
@endsection
