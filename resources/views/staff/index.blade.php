@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Staff Members</h1>

    <a href="{{ route('staff.create') }}" class="btn btn-success mb-3">Add New Staff Member</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Store</th>
                <th>Status</th>
                <th>Last Update</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($staffMembers as $staff)
                <tr>
                    <td>{{ $staff->first_name }} {{ $staff->last_name }}</td>
                    <td>{{ $staff->username }}</td>
                    <td>{{ $staff->email ?? 'N/A' }}</td>
                    <td>Store #{{ $staff->store_id }}</td>
                    <td>
                        <span class="badge bg-{{ $staff->active ? 'success' : 'secondary' }}">
                            {{ $staff->active ? 'Active' : 'Inactive' }}
                        </span>
                        @if($staff->managedStore)
                            <span class="badge bg-primary ms-1">Manager</span>
                        @endif
                    </td>
                    <td>{{ $staff->last_update->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('staff.edit', $staff->staff_id) }}" class="btn btn-warning btn-sm">Edit</a>
                        
                        <form action="{{ route('staff.destroy', $staff->staff_id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" 
                                onclick="return confirm('Are you sure you want to delete this staff member?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection