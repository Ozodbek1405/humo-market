<?php

namespace App\Http\Controllers;


use App\Models\ChildCategory;
use App\Models\ParentCategory;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Review;

class ProductController extends Controller
{
    public function product()
    {
        $product_colors = ProductColor::query()->get();
        $product_sizes = ProductSize::query()->get();
        $parent_categories = ParentCategory::query()->get();
        $child_categories = ChildCategory::query()->get();
        return view('pages.product',compact('product_colors','product_sizes','parent_categories','child_categories'));
    }

    public function product_detail()
    {
        $reviews = Review::query()->get();
        return view('pages.product-detail',compact('reviews'));
    }
}
