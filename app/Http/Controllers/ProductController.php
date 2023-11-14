<?php

namespace App\Http\Controllers;


class ProductController extends Controller
{
    public function product()
    {
        return view('pages.product');
    }

    public function product_detail()
    {
        return view('pages.product-detail');
    }
}
