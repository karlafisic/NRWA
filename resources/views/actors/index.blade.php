@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Actors</h1>

    <a href="{{ route('actors.create') }}" class="btn btn-success mb-3">Add New Actor</a>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Films</th>
                <th>Last Update</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($actors as $actor)
                <tr>
                    <td>{{ $actor->first_name }}</td>
                    <td>{{ $actor->last_name }}</td>
                    <td>
                        @foreach($actor->films as $film)
                            <span class="badge bg-secondary">{{ $film->title }}</span>
                        @endforeach
                    </td>
                    <td>{{ $actor->last_update }}</td>
                    <td>
                        <a href="{{ route('actors.edit', ['id' => $actor->actor_id]) }}" class="btn btn-primary btn-sm">Edit</a>

                        <form action="{{ route('actors.destroy', $actor->actor_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this actor?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
