@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Category</h1>

    <form action="{{ route('categories.update', ['id' => $category->category_id]) }}" method="POST" class="mb-3">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label">Category Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $category->name }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>

    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to Categories</a>
</div>
@endsection
