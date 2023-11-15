<?php

namespace App\Http\Controllers;


use App\Models\Blog;

class BlogController extends Controller
{
    public function blog()
    {
        $blogs = Blog::query()->get();
        return view('pages.blog',compact('blogs'));
    }

    public function blog_detail($blog_id)
    {
        $blog = Blog::find($blog_id);
        return view('pages.blog-detail',compact('blog'));
    }
}
