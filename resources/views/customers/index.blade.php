@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Customers</h1>

    <a href="{{ route('customers.create') }}" class="btn btn-success mb-3">Add New Customer</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Store</th>
                <th>Address</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                    <td>{{ $customer->email ?? 'N/A' }}</td>
                    <td>Store {{ $customer->store->store_id }}</td>
                    <td>
                        {{ $customer->address->address }}<br>
                        {{ $customer->address->postal_code ?? '' }} {{ $customer->address->city->city ?? '' }}
                    </td>
                    <td>
                        @if($customer->active)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-secondary">Inactive</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('customers.edit', ['id' => $customer->customer_id]) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <form action="{{ route('customers.destroy', $customer->customer_id) }}" method="POST" style="display:inline;">
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