<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Gloudemans\Shoppingcart\Facades\Cart;

class OrderController extends Controller
{
    public function order()
    {
        $regions = Region::query()->get();
        $cartItems = Cart::instance('cart')->content();
        if (count($cartItems)<1){
            return redirect()->route('home');
        }
        return view('orders.order', compact('regions','cartItems'));
    }

    public function payment()
    {
        return view('orders.payment');
    }

}
