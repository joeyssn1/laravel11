<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store()
    {
        // Get cart data from session or wherever stored
        $quantities = session()->get('quantities', []);

        if (empty($quantities)) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        // Create new order
        $order = Order::create([
            'user_id' => Auth::id(),
            'status' => 'pending',
        ]);

        // Add order details
        $totalAmount = 0;
        foreach ($quantities as $menuId => $quantity) {
            $menu = Menu::findOrFail($menuId);
            $subtotal = $menu->price * $quantity;

            OrderDetail::create([
                'order_id' => $order->id,
                'menu_id' => $menu->id,
                'quantity' => $quantity,
                'subtotal' => $subtotal,
            ]);

            $totalAmount += $subtotal;
        }

        // Clear session cart after checkout
        session()->forget('quantities');

        return redirect()->route('order.show', $order->id)->with('success', 'Order placed successfully!');
    }

    public function show($id)
    {
        $order = Order::with('details.menu')->where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        return view('orders.show', compact('order'));
    }
}
