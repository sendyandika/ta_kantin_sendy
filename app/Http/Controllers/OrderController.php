<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function confirm(Order $order)
    {
        $order->is_confirmed = true;
        $order->status = 'terkonfirmasi'; // Update status juga
        $order->save();

        return redirect()->back()->with('success', 'Pesanan berhasil dikonfirmasi.');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->back()->with('success', 'Pesanan berhasil dihapus.');
    }

    public function markAsReady(Order $order)
    {
        $order->is_ready = true;
        $order->save();

        return redirect()->back()->with('success', 'Pesanan telah ditandai siap diambil.');
    }

}
