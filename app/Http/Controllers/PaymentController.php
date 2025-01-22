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
        $order = Order::where('user_id', Auth::id())->first(); // Get the order for the authenticated use
    
        // Get the order details for the specific order
        $order_details = OrderDetail::where('order_id', $order->id)->get();
    
        $pagetitle = "Total Payment";
    
        return view('payment', compact('order_details', 'pagetitle', 'order'));
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

