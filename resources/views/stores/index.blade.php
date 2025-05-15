@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Stores</h1>

    <a href="{{ route('stores.create') }}" class="btn btn-success mb-3">Add New Store</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Store ID</th>
                <th>Manager</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stores as $store)
                <tr>
                    <td>{{ $store->store_id }}</td>
                    <td>
                        @if($store->manager)
                            {{ $store->manager->first_name }} {{ $store->manager->last_name }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if($store->address)
                            {{ $store->address->address }}, 
                            {{ $store->address->city->city }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('stores.edit', ['id' => $store->store_id]) }}" 
                           class="btn btn-warning btn-sm">Edit</a>
                        
                        <form action="{{ route('stores.destroy', $store->store_id) }}" method="POST" style="display:inline;">
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