<?php

namespace App\Http\Controllers;


class BlogController extends Controller
{
    public function blog()
    {
        return view('pages.blog');
    }

    public function blog_detail()
    {
        return view('pages.blog-detail');
    }
}
