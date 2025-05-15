@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Edit Inventory Item</h1>

    <form action="{{ route('inventories.update', ['id' => $inventory->inventory_id]) }}" method="POST">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="film_id" class="form-label">Film:</label>
            <select id="film_id" name="film_id" class="form-select" required>
                @foreach($films as $film)
                    <option value="{{ $film->film_id }}" 
                        @if($inventory->film_id == $film->film_id) selected @endif>
                        {{ $film->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="store_id" class="form-label">Store:</label>
            <select id="store_id" name="store_id" class="form-select" required>
                @foreach($stores as $store)
                    <option value="{{ $store->store_id }}" 
                        @if($inventory->store_id == $store->store_id) selected @endif>
                        {{ $store->store_id }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Inventory</button>
        <a href="{{ route('inventories.index') }}" class="btn btn-secondary ms-2">Back to Inventory</a>
    </form>
</div>
@endsection