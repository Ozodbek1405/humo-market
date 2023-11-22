<?php

namespace App\Http\Controllers;


use App\Models\{Brand, ChildCategory, ParentCategory, Product, ProductColor, ProductSize, Review};

class ProductController extends Controller
{

    protected Product $product;
    protected Review $review;

    public function __construct()
    {
        $this->product = new Product();
        $this->review = new Review();
    }

    public function product()
    {
        $brands = Brand::query()->get();
        $product_colors = ProductColor::query()->get();
        $product_sizes = ProductSize::query()->get();
        $parent_categories = ParentCategory::query()->get();
        $child_categories = ChildCategory::query()->get();
        $products = $this->product->paginate(15);
        return view('pages.product',compact('products','brands','product_colors','product_sizes','parent_categories','child_categories'));
    }

    public function product_detail($product_id)
    {
        $reviews = $this->review->where('product_id',$product_id)->get();
        $product = $this->product->find($product_id);
        $related_products = $this->product
            ->where('id','!=',$product->id)
            ->where('parent_category_id',$product->parent_category_id)
            ->where('child_category_id',$product->child_category_id)
            ->take(10)->get();
        return view('pages.product-detail',compact('reviews','product','related_products'));
    }
}
