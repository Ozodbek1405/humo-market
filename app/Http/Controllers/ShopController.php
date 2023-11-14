<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shopping_cart()
    {
        return view('pages.shopping-cart');
    }

    public function wishlist()
    {
        return view('pages.wishlist');
    }
}
