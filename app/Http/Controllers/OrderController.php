<?php

namespace App\Http\Controllers;


use App\Models\Region;

class OrderController extends Controller
{
    public function order()
    {
        $regions = Region::query()->get();
        return view('orders.order', compact('regions'));
    }

    public function payment()
    {
        return view('orders.payment');
    }

}
