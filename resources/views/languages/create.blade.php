@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Add New Language</h1>

    <form action="{{ route('languages.store') }}" method="POST" class="mb-3">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Language Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Language</button>
    </form>

    <a href="{{ route('languages.index') }}" class="btn btn-secondary">Back to Languages</a>
</div>
@endsection
