<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{
    // Add item to cart
    public function addToCart($id)
    {
        $menu = Menu::find($id);
        $userId = Auth::id(); // ambil user id
        $cartKey = 'cart_user_' . $userId; // session key unik per user

        $cart = session()->get($cartKey, []);

        if ($menu) {
            // Jika produk sudah ada di keranjang, tambahkan jumlahnya
            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    'id' => $menu->id,
                    'name' => $menu->name,
                    'price' => $menu->price,
                    'quantity' => 1,
                ];
            }

            session()->put($cartKey, $cart);
        }

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    // View cart
    public function viewCart()
    {
        $userId = Auth::id();
        $cartKey = 'cart_user_' . $userId;
        $cartItems = session()->get($cartKey, []);
        $totalPrice = 0;

        foreach ($cartItems as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        return view('customer.cart', compact('cartItems', 'totalPrice'));
    }

    // Remove item from cart
    public function removeCart($id)
    {
        $userId = Auth::id();
        $cartKey = 'cart_user_' . $userId;
        $cart = session()->get($cartKey, []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put($cartKey, $cart);

        return redirect()->route('customer.viewCart')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('customer.dashboard')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil cart dari session
        $cartKey = 'cart_user_' . $user->id;
        $cartItems = session()->get($cartKey, []);

        if (empty($cartItems)) {
            return redirect()->route('customer.dashboard')->with('error', 'Keranjang belanja kosong.');
        }

        // Hitung total price
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Simpan order
        $order = new \App\Models\Order();
        $order->user_id = $user->id;
        $order->total_price = $totalPrice;
        $order->status = 'pending';
        $order->order_date = now();
        $order->save();

        // Simpan order items
        foreach ($cartItems as $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Kosongkan cart session
        session()->forget($cartKey);

        return redirect()->route('customer.dashboard')->with('success', 'Checkout berhasil!');
    }


}

