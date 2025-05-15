@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Add New Store</h1>

    <form action="{{ route('stores.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="manager_staff_id" class="form-label">Manager:</label>
            <select id="manager_staff_id" name="manager_staff_id" class="form-select" required>
                <option value="">Select Manager</option>
                @foreach($staffMembers as $staff)
                    <option value="{{ $staff->staff_id }}" 
                        {{ old('manager_staff_id') == $staff->staff_id ? 'selected' : '' }}>
                        {{ $staff->first_name }} {{ $staff->last_name }}
                        @if($staff->email) ({{ $staff->email }}) @endif
                    </option>
                @endforeach
            </select>
            @error('manager_staff_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="address_id" class="form-label">Address:</label>
            <select id="address_id" name="address_id" class="form-select" required>
                <option value="">Select Address</option>
                @foreach($addresses as $address)
                    <option value="{{ $address->address_id }}">
                        {{ $address->address }}, {{ $address->district }}, {{ $address->city->city }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Add Store</button>
        <a href="{{ route('stores.index') }}" class="btn btn-secondary ms-2">Back to Stores</a>
    </form>
</div>
@endsection