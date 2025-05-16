<!-- resources/views/create_coupon.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Create Coupon</title>
</head>
<body>
    <h1>Create a New Coupon</h1>
    
    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('coupons.store') }}">
        @csrf
        <input type="text" name="code" placeholder="Code" required><br><br>

        <select name="type" required>
            <option value="fixed">Fixed</option>
            <option value="percent">Percent</option>
        </select><br><br>

        <input type="number" step="0.01" name="value" placeholder="Value" required><br><br>

        <input type="date" name="expiry_date"><br><br>

        <button type="submit">Create Coupon</button>
    </form>
</body>
</html>
