@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Cities</h1>

    <a href="{{ route('cities.create') }}" class="btn btn-success mb-3">Add New City</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>City</th>
                <th>Country</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cities as $city)
                <tr>
                    <td>{{ $city->city }}</td>
                    <td>{{ $city->country->country }}</td>
                    <td>
                        <a href="{{ route('cities.edit', ['id' => $city->city_id]) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <form action="{{ route('cities.destroy', $city->city_id) }}" method="POST" style="display:inline;">
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
