@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Films</h1>

    <a href="{{ route('films.create') }}" class="btn btn-success mb-3">Add New Film</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Title</th>
                <th>Language</th>
                <th>Categories</th>
                <th>Release Year</th>
                <th>Rental Rate</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($films as $film)
                <tr>
                    <td>{{ $film->title }}</td>
                    <td>{{ $film->language->name }}</td>
                    <td>
                        @foreach($film->categories as $category)
                            <span class="badge bg-secondary">{{ $category->name }}</span>
                        @endforeach
                    </td>
                    <td>{{ $film->release_year }}</td>
                    <td>{{ $film->rental_rate }}</td>
                    <td>
                        <a href="{{ route('films.edit', ['id' => $film->film_id]) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <form action="{{ route('films.destroy', $film->film_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
