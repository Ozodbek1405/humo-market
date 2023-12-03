<?php

namespace App\Http\Controllers;


use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::query()->get();
        return view('faqs.faq',compact('faqs'));
    }

}
