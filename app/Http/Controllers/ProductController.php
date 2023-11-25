<?php

namespace App\Http\Controllers;


use App\Models\{Brand, ChildCategory, ParentCategory, Product, Color, ShoeSize, Size, Review};
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected Product $product;
    protected Review $review;
    protected ParentCategory $parent_categories;
    protected ChildCategory $child_categories;

    public function __construct()
    {
        $this->product = new Product();
        $this->review = new Review();
        $this->parent_categories = new ParentCategory();
        $this->child_categories = new ChildCategory();
    }

    public function product(Request $request)
    {
        $q_brands = $request->query('brands');
        $q_colors = $request->query('colors');
        $q_sort = $request->query('sort');
        $q_sizes = $request->query('q_sizes');
        $q_shoe_sizes = $request->query('q_shoe_sizes');
        $q_min = (int)$request->query('q_min');
        $q_max = (int)$request->query('q_max');
        $products = $this->product;
        if (empty($request)){
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
            $products = $products->whereHas('size',function ($query) use ($q_sizes){
                $query->whereIn('size_id',explode(',',$q_sizes))->orWhereRaw("'".$q_sizes."'=''");
            });
            $products = $products->whereHas('shoe_size',function ($query) use ($q_shoe_sizes){
                $query->whereIn('shoe_size_id',explode(',',$q_shoe_sizes))->orWhereRaw("'".$q_shoe_sizes."'=''");
            });
            if ($q_min != null && $q_max != null){
                $products = $products->wherebetween('price',[$q_min,$q_max]);
            }
        }

        $products = $products->paginate(15);
        $brands = Brand::query()->get();
        $product_colors = Color::query()->get();
        $product_sizes = Size::query()->get();
        $product_shoe_sizes = ShoeSize::query()->get();
        $parent_categories = $this->parent_categories->get();
        $child_categories = $this->child_categories->get();

        return view('pages.product',[
            'products' => $products,
            'brands' => $brands,
            'product_colors' => $product_colors,
            'product_sizes' => $product_sizes,
            'product_shoe_sizes' => $product_shoe_sizes,
            'parent_categories' => $parent_categories,
            'child_categories' => $child_categories,
            'q_brands' => $q_brands,
            'q_colors' => $q_colors,
            'q_sizes' => $q_sizes,
            'q_shoe_sizes' => $q_shoe_sizes,
            'q_min' => $q_min,
            'q_max' => $q_max,
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
