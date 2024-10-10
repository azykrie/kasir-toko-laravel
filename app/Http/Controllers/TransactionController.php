<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function invoice($no_order)
    {
        $order = Order::with('orderProduct.product')->where('no_order', $no_order)->firstOrFail();
        return view('invoice.index', compact('order'));
    }
}