@extends('layouts.app')

@section('content')
<h1>Ajouter un produit</h1>

<form action="{{ route('products.store') }}" method="POST">
    @csrf
    <label>Nom</label>
    <input type="text" name="name" class="form-control" required>

    <label>Description</label>
    <textarea name="description" class="form-control" required></textarea>

    <label>Prix</label>
    <input type="number" name="price" class="form-control" required>
    <div class="form-group">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control">
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ (isset($product) && $product->category_id == $category->id) ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn btn-success">Ajouter</button>
</form>
@endsection