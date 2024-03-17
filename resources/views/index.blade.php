<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
</head>
<body>
    <h2>Products</h2>
    <ul>
        <li>Product 1 - $10 <a href="{{ route('cart.add', 1) }}">Add to Cart</a></li>
        <li>Product 2 - $20 <a href="{{ route('cart.add', 2) }}">Add to Cart</a></li>
    </ul>
    <br>
    <a href="{{ route('cart.view') }}">View Cart</a>
</body>
</html>
