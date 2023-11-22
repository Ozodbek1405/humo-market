<?php

namespace App\Http\Controllers;


use App\Models\{Brand, ChildCategory, ParentCategory, Product, Color, Size, Review};
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected Product $product;
    protected Review $review;

    public function __construct()
    {
        $this->product = new Product();
        $this->review = new Review();
    }

    public function product(Request $request)
    {
        $q_brands = $request->query('brands');
        $q_colors = $request->query('colors');
        $q_sort = $request->query('sort');
        $products = $this->product;
        $products = match ((int)$q_sort) {
            1 => $products->latest(),
            2 => $products->orderByDesc('views'),
            3 => $products->orderByDesc('rate'),
            default => $products->orderBy('created_at'),
        };
        $products = $products->where(function ($query) use ($q_brands){
            $query->whereIn('brand_id',explode(',',$q_brands))->orWhereRaw("'".$q_brands."'=''");
        });
        $products = $products->where(function ($query) use ($q_colors){
            $query->whereIn('color_id',explode(',',$q_colors))->orWhereRaw("'".$q_colors."'=''");
        });
        $products = $products->paginate(15);
        $brands = Brand::query()->get();
        $product_colors = Color::query()->get();
        $product_sizes = Size::query()->get();
        $parent_categories = ParentCategory::query()->get();
        $child_categories = ChildCategory::query()->get();

        return view('pages.product',[
            'products' => $products,
            'brands' => $brands,
            'product_colors' => $product_colors,
            'product_sizes' => $product_sizes,
            'parent_categories' => $parent_categories,
            'child_categories' => $child_categories,
            'q_brands' => $q_brands,
            'q_colors' => $q_colors,
        ]);
    }

    public function product_detail($product_id)
    {
        $reviews = $this->review->where('product_id',$product_id)->get();
        $product = $this->product->find($product_id);
        $product->views++;
        $product->save();
        $related_products = $this->product
            ->where('id','!=',$product->id)
            ->where('parent_category_id',$product->parent_category_id)
            ->where('child_category_id',$product->child_category_id)
            ->take(10)->get();
        return view('pages.product-detail',compact('reviews','product','related_products'));
    }
}
