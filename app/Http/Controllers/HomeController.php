<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $blogs = Blog::query()->get();
        $related_products = Product::query()->orderByDesc('rate')->take(10)->get();
        return view('home',compact('blogs','related_products'));
    }
}
