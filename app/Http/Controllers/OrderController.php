<?php

namespace App\Http\Controllers;


class OrderController extends Controller
{
    public function order()
    {
        return view('orders.order');
    }

}
