@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Add New Staff Member</h1>

    <form action="{{ route('staff.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="first_name" class="form-label">First Name:</label>
                <input type="text" id="first_name" name="first_name" class="form-control" required maxlength="45">
            </div>

            <div class="col-md-6 mb-3">
                <label for="last_name" class="form-label">Last Name:</label>
                <input type="text" id="last_name" name="last_name" class="form-control" required maxlength="45">
            </div>
        </div>

        <div class="mb-3">
            <label for="address_id" class="form-label">Address:</label>
            <select id="address_id" name="address_id" class="form-select" required>
                @foreach($addresses as $address)
                    <option value="{{ $address->address_id }}">
                        {{ $address->address }}, {{ $address->city->city ?? 'N/A' }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="picture" class="form-label">Picture (Base64):</label>
            <textarea id="picture" name="picture" class="form-control" rows="3"></textarea>
            <small class="text-muted">Optional - paste base64 encoded image data</small>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" maxlength="50">
        </div>

        <div class="mb-3">
            <label for="store_id" class="form-label">Store:</label>
            <select id="store_id" name="store_id" class="form-select" required>
                @foreach($stores as $store)
                    <option value="{{ $store->store_id }}">Store #{{ $store->store_id }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="active" name="active" value="1" checked>
                <label class="form-check-label" for="active">Active</label>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required maxlength="16">
            </div>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-success">Add Staff Member</button>
            <a href="{{ route('staff.index') }}" class="btn btn-secondary ms-2">Back to Staff</a>
        </div>
    </form>
</div>
@endsection