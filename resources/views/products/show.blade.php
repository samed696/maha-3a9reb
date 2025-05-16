@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <!-- Product Details -->
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <!-- Image (à adapter selon ton modèle) -->
                        <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded-3 mb-3" style="max-height: 300px;">
                        <h2 class="card-title">{{ $product->name }}</h2>
                        <p class="text-muted">{{ $product->description }}</p>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                        <h4 class="text-primary">{{ $product->price }} €</h4>
                        <p class="text-muted">Stock: {{ $product->stock ?? 'Non disponible' }}</p>
                    </div>

                    @auth
                        @if(!Auth::user()->is_admin)
                            <a href="{{ route('cart.add', $product->id) }}" class="btn btn-success w-100 mb-3">🛒 Ajouter au panier</a>

                            <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="mb-3">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger w-100">❤️ Ajouter à la wishlist</button>
                            </form>

                            <!-- Review Form -->
                            <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="border p-3 rounded bg-light">
                                @csrf
                                <h5 class="mb-3">Laisser un avis</h5>
                                <div class="mb-3">
                                    <label for="rating">Note :</label>
                                    <select name="rating" id="rating" class="form-select">
                                        @for($i = 1; $i <= 5; $i++)
                                            <option value="{{ $i }}">{{ $i }} ⭐</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="comment">Commentaire :</label>
                                    <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">📩 Envoyer</button>
                            </form>
                        @endif
                    @endauth
                </div>

                <!-- User Reviews Section -->
                <div class="px-4 pb-4">
                    <h4 class="mt-4 mb-3">🗣️ Avis des utilisateurs</h4>

                    @php $averageRating = $product->reviews->avg('rating'); @endphp

                    @if($product->reviews->count())
                        <p>
                            <strong>Moyenne :</strong>
                            <span class="text-warning">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="bi {{ $i <= round($averageRating) ? 'bi-star-fill' : 'bi-star' }}"></i>
                                @endfor
                            </span>
                            ({{ number_format($averageRating, 1) }}/5 – {{ $product->reviews->count() }} avis)
                        </p>

                        @foreach($product->reviews as $review)
                            <div class="border rounded p-3 mb-3 bg-white shadow-sm">
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong>{{ $review->user->name ?? 'Utilisateur' }}</strong>
                                    <span class="text-warning">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="bi {{ $i <= $review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endfor
                                    </span>
                                </div>
                                <p class="mb-1 mt-2">{{ $review->comment }}</p>
                                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                            </div>
                        @endforeach
                    @else
                        <p class="text-muted">Aucun avis pour ce produit pour le moment.</p>
                    @endif
                </div>

                <!-- Admin Buttons -->
                @if(Auth::check() && Auth::user()->is_admin)
                    <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between">
                        <a href="{{ route('products.index') }}" class="btn btn-secondary">Retour</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Supprimer ce produit ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
