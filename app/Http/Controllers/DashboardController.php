<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
{
    $orders = Order::with('user')->latest()->get();
    $totalMenu = Menu::count();
    $totalOrders = Order::count();
    $ordersProcessed = Order::where('is_confirmed', true)->count();

    $ordersCompleted = Order::where('is_confirmed', true)->where('is_ready', true)->count();

    return view('dashboard', compact(
        'orders',
        'totalMenu',
        'totalOrders',
        'ordersProcessed',
        'ordersCompleted' // ✅ tambahkan ini
    ));
}

public function confirmOrder($id)
{
    $order = Order::findOrFail($id);
    $order->is_confirmed = true;
    $order->save();

    return redirect()->back()->with('success', 'Pesanan berhasil dikonfirmasi!');
}
}
