<div class="container mt-5">
    <h2 class="mb-4">Shopping Cart</h2>
    @if(count($cart) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>${{ $item['price'] }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <p>Subtotal: ${{ $subtotal }}</p>
        <p>Grand Total: ${{ $grandTotal }}</p>
        <a href="{{ route('checkout') }}" class="btn btn-success">Proceed to Checkout</a>
    @else
        <p>Your shopping cart is empty.</p>
    @endif
</div>
