@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Coupons</h1>

    @if($coupons->isEmpty())
        <div class="alert alert-info">No coupons available.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Expiry Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->code }}</td>
                        <td>{{ ucfirst($coupon->type) }}</td>
                        <td>
                            @if($coupon->type === 'percent')
                                {{ $coupon->value }}%
                            @else
                                ${{ number_format($coupon->value, 2) }}
                            @endif
                        </td>
                        <td>{{ $coupon->expiry_date ? \Carbon\Carbon::parse($coupon->expiry_date)->format('Y-m-d') : 'No expiry' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
