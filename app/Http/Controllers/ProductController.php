<?php

namespace App\Http\Controllers;


use App\Models\Review;

class ProductController extends Controller
{
    public function product()
    {
        return view('pages.product');
    }

    public function product_detail()
    {
        $reviews = Review::query()->get();
        return view('pages.product-detail',compact('reviews'));
    }
}
