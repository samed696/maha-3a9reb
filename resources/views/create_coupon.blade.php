@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Create a New Coupon</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('coupons.store') }}">
        @csrf
        <div class="mb-3">
            <label for="code" class="form-label">Code</label>
            <input type="text" name="code" id="code" class="form-control" placeholder="Code" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select name="type" id="type" class="form-select" required>
                <option value="fixed">Fixed</option>
                <option value="percent">Percent</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="value" class="form-label">Value</label>
            <input type="number" step="0.01" name="value" id="value" class="form-control" placeholder="Value" required>
        </div>

        <div class="mb-3">
            <label for="expiry_date" class="form-label">Expiry Date</label>
            <input type="date" name="expiry_date" id="expiry_date" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Create Coupon</button>
    </form>
</div>
@endsection
