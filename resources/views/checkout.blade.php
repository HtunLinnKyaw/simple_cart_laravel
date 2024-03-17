<div class="container mt-5">
    @if (session('info'))
       <p> {{session('info')}}</p>
    @endif
    <h2 class="mb-4">Checkout Summary</h2>
    <form action="{{ route('checkout.save') }}" method="POST">
        @csrf
        @foreach($cart as $id => $item)
            name
            <input type="text" name="products[{{ $id }}][name]" value="{{ $item['name'] }}">
            price
            <input type="text" name="products[{{ $id }}][price]" value="{{ $item['price'] }}">
            qty
            <input type="text" name="products[{{ $id }}][quantity]" value="{{ $item['quantity'] }}">
            total
            <input type="text" name="products[{{ $id }}][subtotal]" value="{{ $item['price'] * $item['quantity'] }}"> <br>
        @endforeach


        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <textarea id="address" name="address" class="form-control" required></textarea>
        </div>
        <!-- Include other checkout fields as needed -->
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
