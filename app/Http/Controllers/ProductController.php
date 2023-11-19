<?php

namespace App\Http\Controllers;


use App\Models\Brand;
use App\Models\ChildCategory;
use App\Models\ParentCategory;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Review;

class ProductController extends Controller
{
    public function product()
    {
        $brands = Brand::query()->get();
        $product_colors = ProductColor::query()->get();
        $product_sizes = ProductSize::query()->get();
        $parent_categories = ParentCategory::query()->get();
        $child_categories = ChildCategory::query()->get();
        $products = Product::all();
        return view('pages.product',compact('products','brands','product_colors','product_sizes','parent_categories','child_categories'));
    }

    public function product_detail($product_id)
    {
        $reviews = Review::query()->where('product_id',$product_id)->get();
        $product = Product::find($product_id);
        return view('pages.product-detail',compact('reviews','product'));
    }
}
