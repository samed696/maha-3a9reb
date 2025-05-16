<h1>Coupons</h1>
<ul>
    @foreach ($coupons as $coupon)
        <li>{{ $coupon->code }} - {{ $coupon->value }} - {{ $coupon->expiry_date }}</li>
    @endforeach
</ul>
