<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        $menus = Menu::where('status', 'tersedia')->latest()->get();
        $cart = session()->get('cart', []);

        // Hitung total harga di keranjang
        $totalPrice = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('customer.dashboard', compact('menus', 'cart', 'totalPrice', 'cart'));
    }

    public function beliMenu($id)
    {
        $menu = Menu::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id' => $menu->id,
                'name' => $menu->name,
                'quantity' => 1,
                'price' => $menu->price,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Menu ditambahkan ke keranjang!');
    }

    // public function checkout(Request $request)
    // {
    //     $user = auth()->user();
    //     $cart = session()->get('cart', []);

    //     if (empty($cart)) {
    //         return redirect()->route('customer.dashboard')->with('error', 'Keranjang kosong!');
    //     }

    //     DB::beginTransaction();

    //     try {
    //         $order = Order::create([
    //             'user_id' => $user->id,
    //             'order_date' => now(),
    //             'total_price' => collect($cart)->sum(function ($item) {
    //                 return $item['price'] * $item['quantity'];
    //             }),
    //             'status' => 'pending',
    //         ]);

    //         foreach ($cart as $item) {
    //             OrderItem::create([
    //                 'order_id' => $order->id,
    //                 'menu_id' => $item['id'],
    //                 'quantity' => $item['quantity'],
    //                 'price' => $item['price'],
    //             ]);
    //         }

    //         session()->forget('cart');
    //         DB::commit();

    //         return redirect()->route('customer.dashboard')->with('success', 'Checkout berhasil!');
    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->back()->with('error', 'Checkout gagal: ' . $e->getMessage());
    //     }
    // }

    public function hapusCart($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang!');
    }

    public function pesananSaya()
    {
        $user = Auth::user();

        // Ambil semua pesanan user beserta menu dari setiap item
        $orders = auth()->user()->orders()->with('orderItems.menu')->latest()->get();

        return view('customer.order', compact('orders'));
    }
}

