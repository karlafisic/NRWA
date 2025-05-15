@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Rentals</h1>

    <a href="{{ route('rentals.create') }}" class="btn btn-success mb-3">Add New Rental</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Rental Date</th>
                <th>Inventory ID</th>
                <th>Customer</th>
                <th>Return Date</th>
                <th>Staff</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rentals as $rental)
                <tr>
                    <td>{{ $rental->rental_date }}</td>
                    <td>{{ $rental->inventory->inventory_id }}</td>
                    <td>{{ $rental->customer->first_name }} {{ $rental->customer->last_name }}</td>
                    <td>{{ $rental->return_date ?? 'Not returned' }}</td>
                    <td>{{ $rental->staff->first_name }} {{ $rental->staff->last_name }}</td>
                    <td>
                        <a href="{{ route('rentals.edit', ['id' => $rental->rental_id]) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('rentals.destroy', $rental->rental_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure you want to delete this rental?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
