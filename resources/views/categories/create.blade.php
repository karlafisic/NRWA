@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Add New Category</h1>

    <form action="{{ route('categories.store') }}" method="POST" class="mb-3">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Category Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Add Category</button>
    </form>

    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to Categories</a>
</div>
@endsection
