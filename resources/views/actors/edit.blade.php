@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Film</h1>

    <form action="{{ route('actors.update', ['id' => $actor->actor_id]) }}" method="POST">
        @csrf
        @method('PATCH') <!-- Use PATCH method for updating -->

        <div class="mb-3">
            <label for="first_name" class="form-label">Actor First Name:</label>
            <input type="text" id="first_name" name="first_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Actor Last Name:</label>
            <input type="text" id="last_name" name="last_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Films:</label>
            @foreach($films as $film)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="films[]" value="{{ $film->film_id }}" id="film{{ $film->film_id }}">
                    <label class="form-check-label" for="film{{ $film->film_id }}">
                    {{ $film->title }}
                    </label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Update Actor</button>
        <a href="{{ route('actors.index') }}" class="btn btn-secondary ms-2">Back to Actors</a>
    </form>
</div>
@endsection
