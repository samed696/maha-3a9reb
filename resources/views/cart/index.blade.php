@extends('layouts.app')

@section('content')
    <h1>Panier</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('cart.applyCoupon') }}" method="POST" class="mb-4">
        @csrf
        <div class="input-group">
            <input type="text" name="coupon_code" class="form-control" placeholder="Enter coupon code">
            <button class="btn btn-primary">Apply</button>
        </div>
    </form>

    @if(!empty($cart))
        <table class="table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['price'] }} €</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>
                            <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger">Retirer</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @php
            $subtotal = 0;
            foreach($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }

            // Calculating the discount if a coupon is applied
            $discount = 0;
            if(session('applied_coupon')) {
                $discount = session('applied_coupon')->calculateDiscount($subtotal);
            }

            // Final total after applying discount
            $total = $subtotal - $discount;
        @endphp

        <div class="row mt-4">
            <div class="col-md-6">
                <!-- Order Summary -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Order Summary</h5>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Total before discount:</span>
                            <span>{{ number_format($subtotal, 2) }} €</span>
                        </div>
                        @if($discount > 0)
                            <div class="d-flex justify-content-between mb-2 text-success">
                                <span>Discount:</span>
                                <span>-{{ number_format($discount, 2) }} €</span>
                            </div>
                        @endif
                        <hr>
                        <div class="d-flex justify-content-between">
                            <strong>Total:</strong>
                            <strong>{{ number_format($total, 2) }} €</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Formulaire de commande --}}
        <form action="{{ route('order.store') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="btn btn-success">Passer la commande</button>
        </form>
    @else
        <p>Votre panier est vide.</p>
    @endif
@endsection
