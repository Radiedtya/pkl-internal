<?php
// app/Http/Controllers/CheckoutController.php

namespace App\Http\Controllers;

use App\Services\OrderService;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        // Pastikan keranjang tidak kosong
        $cart = auth()->user()->cart;
        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang kosong.');
        }

        return view('checkout.index', compact('cart'));
    }

    public function store(Request $request, OrderService $orderService)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        try {
            $order = $orderService->createOrder(auth()->user(), $request->only(['name', 'phone', 'address']));

            // Redirect ke halaman pembayaran (akan dibuat besok)
            // Untuk sekarang, redirect ke detail order
            return redirect()->route('orders.show', $order)
                ->with('success', 'Pesanan berhasil dibuat! Silahkan lakukan pembayaran.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    // Method untuk direct checkout sebuah produk tanpa menambah dulu ke keranjang
    public function direct(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi');
        }

        $user = Auth::user();

        //  AMBIL / BUAT CART
        $cart = $user->cart()->firstOrCreate([]);

        //  HAPUS ITEM LAMA (BIAR DIRECT CHECKOUT)
        $cart->items()->delete();

        //  MASUKKAN PRODUK KE CART_ITEMS
        $cart->items()->create([
            'product_id' => $product->id,
            'quantity'   => $request->quantity,
            'price'      => $product->price
        ]);

        //  LANGSUNG KE CHECKOUT
        return redirect()->route('checkout.index');
    }

}