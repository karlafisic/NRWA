@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Addresses</h1>

    <a href="{{ route('addresses.create') }}" class="btn btn-success mb-3">Add New Address</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Address</th>
                <th>District</th>
                <th>City</th>
                <th>Postal Code</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($addresses as $address)
                <tr>
                    <td>
                        {{ $address->address }}<br>
                        @if($address->address2)
                            <small class="text-muted">{{ $address->address2 }}</small>
                        @endif
                    </td>
                    <td>{{ $address->district }}</td>
                    <td>{{ $address->city->city }}</td>
                    <td>{{ $address->postal_code ?? 'N/A' }}</td>
                    <td>{{ $address->phone }}</td>
                    <td>
                        <a href="{{ route('addresses.edit', ['id' => $address->address_id]) }}" 
                           class="btn btn-warning btn-sm">Edit</a>
                        
                        <form action="{{ route('addresses.destroy', $address->address_id) }}" method="POST" style="display:inline;">
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