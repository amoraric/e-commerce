<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ShoppingCart;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cart = ShoppingCart::with('items.product')->where('user_id', $request->user()->id)->first();
        
        if (!$cart || $cart->items->isEmpty()) {
            return response()->json(['message' => 'Cart is empty'], 200);
        }

        return response()->json(['cart' => $cart]);
    }

    public function addToCart(Request $request)
    {
        $cart = ShoppingCart::firstOrCreate(['user_id' => $request->user()->id]);
        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return response()->json(['error' => 'Not enough stock available'], 400);
        }

        $cartItem = ShoppingCartItem::updateOrCreate(
            ['shopping_cart_id' => $cart->id, 'product_id' => $product->id],
            ['quantity' => $request->quantity]
        );

        return response()->json(['message' => 'Product added to cart', 'cartItem' => $cartItem], 200);
    }

    public function checkout(Request $request)
    {
        $cart = ShoppingCart::where('user_id', $request->user()->id)->first();
        if (!$cart || $cart->items->isEmpty()) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

        $total = 0;
        foreach ($cart->items as $item) {
            $total += $item->product->price * $item->quantity;
        }

        $order = Order::create([
            'user_id' => $request->user()->id,
            'total' => $total,
            'status' => 'Processing',
        ]);

        DiscountCode::create([
            'code' => 'DISCOUNT' . $order->id,
            'amount' => 5.00,
            'user_id' => $request->user()->id,
            'expiry_date' => now()->addMinutes(15),
        ]);

        $cart->items()->delete();

        return response()->json(['message' => 'Checkout successful!'], 200);
    }
}
