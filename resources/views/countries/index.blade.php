@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Countries</h1>

    <a href="{{ route('countries.create') }}" class="btn btn-success mb-3">Add New Country</a>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Country Name</th>
                <th>Last Update</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($countries as $country)
                <tr>
                    <td>{{ $country->country }}</td>
                    <td>{{ $country->last_update }}</td>
                    <td>
                        <a href="{{ route('countries.edit', ['id' => $country->country_id]) }}" class="btn btn-primary btn-sm">Edit</a>

                        <form action="{{ route('countries.destroy', $country->country_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this country?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
