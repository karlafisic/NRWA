@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Languages</h1>

    <a href="{{ route('languages.create') }}" class="btn btn-success mb-3">Add New Language</a>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Name</th>
                <th>Last Update</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($languages as $language)
                <tr>
                    <td>{{ $language->name }}</td>
                    <td>{{ $language->last_update }}</td>
                    <td>
                        <a href="{{ route('languages.edit', ['id' => $language->language_id]) }}" class="btn btn-primary btn-sm">Edit</a>

                        <form action="{{ route('languages.destroy', $language->language_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this language?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
