@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>My Orders</h3>
    </div>
    <div class="card-body">
        @if($orders->isEmpty())
            <p>You have no orders yet.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                        <td>${{ number_format($order->total_price, 2) }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td><a href="{{ route('orders.show', $order->id) }}">View</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>
@endsection
