@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Payments</h1>

    <a href="{{ route('payments.create') }}" class="btn btn-success mb-3">Add New Payment</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Staff</th>
                <th>Rental</th>
                <th>Amount</th>
                <th>Payment Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
                <tr>
                    <td>{{ $payment->customer->first_name }} {{ $payment->customer->last_name }}</td>
                    <td>{{ $payment->staff->first_name }} {{ $payment->staff->last_name }}</td>
                    <td>
                        @if($payment->rental)
                            ID: {{ $payment->rental->rental_id }}
                        @else
                            —
                        @endif
                    </td>
                    <td>${{ number_format($payment->amount, 2) }}</td>
                    <td>{{ $payment->payment_date->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('payments.edit', ['id' => $payment->payment_id]) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('payments.destroy', $payment->payment_id) }}" method="POST" style="display:inline;">
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
