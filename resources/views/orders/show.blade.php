@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Order Details - Order #{{ $order->id }}</h3>
    </div>
    <div class="card-body">
        <p><strong>Order Date:</strong> {{ $order->created_at->format('Y-m-d H:i') }}</p>
        <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
        <p><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>

        <h4>Items</h4>
        @if($order->items->isEmpty())
            <p>No items found for this order.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name ?? 'Product not found' }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>${{ number_format($item->price, 2) }}</td>
                        <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <a href="{{ route('user.orders') }}" class="btn btn-primary">Back to Orders</a>
    </div>
</div>
@endsection
