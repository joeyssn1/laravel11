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
        $menus = Menu::all();
        $order_details = OrderDetail::all();
        $pagetitle = "Total Payment";
        return view('payment', compact('order_details', 'menus', 'pagetitle'));
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

