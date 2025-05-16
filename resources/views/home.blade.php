@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <!-- Hero Section -->
    <div class="p-5 mb-4 bg-light rounded-3 shadow-sm">
        <div class="container py-5">
            <h1 class="display-5 fw-bold">Welcome to Our Online Store</h1>
            <p class="col-md-8 fs-4">Discover top-quality products at the best prices with excellent customer service and fast delivery.</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg me-2">
                <i class="fas fa-shopping-bag"></i> Browse Products
            </a>
            <a href="{{ route('cart.index') }}" class="btn btn-outline-secondary btn-lg">
                <i class="fas fa-shopping-cart"></i> View Cart
            </a>
        </div>
    </div>

    <!-- Featured Products (optional) -->
    @if(isset($products) && count($products) > 0)
        <h2 class="mb-4">Featured Products</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/'.$product->image) }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text">{{ Str::limit($product->description, 80) }}</p>
                            <p class="fw-bold text-primary">${{ $product->price }}</p>
                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye"></i> View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
    @endif
@endsection
