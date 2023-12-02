<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;

class BlogController extends Controller
{
    public function blog()
    {
        $blogs = Blog::query()->get();
        $products = Product::query()->orderByDesc('rate')->take(5)->get();
        return view('blogs.blog',compact('blogs','products'));
    }

    public function blog_detail($blog_id)
    {
        $blog = Blog::find($blog_id);
        $products = Product::query()->orderByDesc('rate')->take(5)->get();
        return view('blogs.blog-detail',compact('blog','products'));
    }
}
