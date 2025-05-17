@extends('layouts.app')

@section('content')
<h1>Ajouter un produit</h1>

<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Nom</label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Description</label>
        <textarea name="description" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Prix</label>
        <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required>
        @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="category_id">Category</label>
        <select name="category_id" id="category_id" class="form-control @error('category_id') is-invalid @enderror">
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </select>
        @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success">Ajouter</button>
</form>
@endsection
