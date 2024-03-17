<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\CheckoutDetail;
use App\Models\CheckoutProduct;

class CartController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function addToCart($id)
    {
        $cart = Session::get('cart', []);
        $cart[$id] = [
            'name' => 'Product ' . $id,
            'price' => ($id == 1) ? 10 : 20,
            'quantity' => isset($cart[$id]['quantity']) ? $cart[$id]['quantity'] + 1 : 1,
        ];
        Session::put('cart', $cart);

        return redirect()->route('cart.view');
    }

    public function viewCart()
    {
        $cart = Session::get('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $grandTotal = $subtotal; // For simplicity, assuming no taxes or shipping fees
        return view('cart', compact('cart', 'subtotal', 'grandTotal'));
    }

    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        Session::put('cart', $cart);

        return redirect()->back();
    }

    public function checkout()
    {
        $cart = Session::get('cart', []);
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $grandTotal = $subtotal; // For simplicity, assuming no taxes or shipping fees
        return view('checkout', compact('cart', 'subtotal', 'grandTotal'));
    }

    public function saveCheckoutDetails(Request $request)
    {
        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'products' => 'required|array',
            'products.*.name' => 'required|string|max:255',
            'products.*.price' => 'required|numeric|min:0',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.subtotal' => 'required|numeric|min:0',
        ]);

        // Save checkout details to the database
        $checkoutDetail = new CheckoutDetail();
        $checkoutDetail->name = $validatedData['name'];
        $checkoutDetail->email = $validatedData['email'];
        $checkoutDetail->address = $validatedData['address'];
        // Set additional fields here
        $checkoutDetail->save();

        // Save products associated with the checkout detail
        foreach ($validatedData['products'] as $productData) {
            $checkoutProduct = new CheckoutProduct();
            $checkoutProduct->checkout_detail_id = $checkoutDetail->id; // Assuming the relationship is defined
            $checkoutProduct->name = $productData['name'];
            $checkoutProduct->price = $productData['price'];
            $checkoutProduct->quantity = $productData['quantity'];
            $checkoutProduct->subtotal = $productData['subtotal'];
            // Set additional fields here
            $checkoutProduct->save();
        }

        return redirect()->back()->with('info','submit success');
    }
}
