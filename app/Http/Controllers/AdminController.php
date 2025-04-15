<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminController extends Controller
{
    public function dashboard()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();
        

        return view('dashboard', compact('orders'));
    }

    public function confirmOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->is_confirmed = true;
        $order->save();

        return redirect()->back()->with('success', 'Pesanan dikonfirmasi!');
    }
}

