@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Inventory</h1>

    <a href="{{ route('inventories.create') }}" class="btn btn-success mb-3">Add New Inventory Item</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Film</th>
                <th>Store</th>
                <th>Last Update</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventories as $inventory)
                <tr>
                    <td>{{ $inventory->film->title }}</td>
                    <td>{{ $inventory->store->store_id }}</td>
                    <td>{{ $inventory->last_update }}</td>
                    <td>
                        <a href="{{ route('inventories.edit', ['id' => $inventory->inventory_id]) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <form action="{{ route('inventories.destroy', $inventory->inventory_id) }}" method="POST" style="display:inline;">
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