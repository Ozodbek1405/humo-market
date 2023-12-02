<?php

namespace App\Http\Controllers;


use App\Models\About;

class AboutController extends Controller
{
    public function about()
    {
        $abouts = About::query()->get();
        return view('about.about',compact('abouts'));
    }
}
