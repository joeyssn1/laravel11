<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\OrderDetail;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    public function getAllOrderDetail()
    {
        $order = Order::where('user_id', Auth::id())->first();
        $order_details = collect(); // Empty collection by default
        $pagetitle = "Total Payment";
        $menus = Menu::all(); // Add this line to get all menus

        if ($order) {
            $order_details = OrderDetail::where('order_id', $order->id)->get();
        }

        // Always return the view, even if empty
        return view('payment', compact('order_details', 'pagetitle', 'order', 'menus'));
    }
    

    public function getPaymentStatus()
    {
        $pagetitle = "Payment Status";
        $orders = Order::all();
        return view('paymentStatusAdmin', compact('pagetitle','orders'));
    }

    public function getPaymentMethod()
    {
        $pagetitle = "Payment Method";
        $paymentmethod = Order::where('user_id', Auth::id())->first();

        if ($paymentmethod) {
            $paymentmethod->update([
                'status' => 'paid'
            ]);
        }
        return view('paymentOption', compact('pagetitle'));

    }


    
}

