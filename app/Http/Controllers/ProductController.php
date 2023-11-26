<?php

namespace App\Http\Controllers;


use App\Models\{Brand, ChildCategory, ParentCategory, Product, Color, ShoeSize, Size, Review};
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected Product $product;
    protected Review $review;
    protected Brand $brand;
    protected Color $color;
    protected Size $size;
    protected ShoeSize $shoeSize;
    protected ParentCategory $parent_categories;
    protected ChildCategory $child_categories;

    public function __construct()
    {
        $this->product = new Product();
        $this->review = new Review();
        $this->brand = new Brand();
        $this->color = new Color();
        $this->size = new Size();
        $this->shoeSize = new ShoeSize();
        $this->parent_categories = new ParentCategory();
        $this->child_categories = new ChildCategory();
    }

    public function productAll(Request $request)
    {
        $q_brands = $request->query('brands');
        $q_colors = $request->query('colors');
        $q_sort = $request->query('sort');
        $q_min = $request->query('q_min');
        $q_max = $request->query('q_max');
        $products = $this->product;
        if (isset($q_sort)){
            $products = match ((int)$q_sort) {
                1 => $products->latest(),
                2 => $products->orderByDesc('views'),
                3 => $products->orderByDesc('rate'),
                default => $products->orderBy('created_at'),
            };
        }
        if (isset($q_brands)){
            $products = $products->where(function ($query) use ($q_brands){
                $query->whereIn('brand_id',explode(',',$q_brands))->orWhereRaw("'".$q_brands."'=''");
            });
        }
        if (isset($q_colors)){
            $products = $products->whereHas("product_color", function ($query) use ($q_colors){
                $query->whereIn('color_id',explode(',',$q_colors))->orWhereRaw("'".$q_colors."'=''");
            });
        }
        if ($q_min != null && $q_max != null){
            $products = $products->wherebetween('price',[$q_min,$q_max]);
        }
        $products = $products->paginate(21);
        $brands = $this->brand->get();
        $product_colors = $this->color->get();
        $parent_categories = $this->parent_categories->get();
        $child_categories = $this->child_categories->get();

        return view('pages.productAll',[
            'products' => $products,
            'brands' => $brands,
            'product_colors' => $product_colors,
            'parent_categories' => $parent_categories,
            'child_categories' => $child_categories,
            'q_brands' => $q_brands,
            'q_colors' => $q_colors,
            'q_min' => $q_min,
            'q_max' => $q_max,
        ]);
    }

    public function product(Request $request)
    {
        $child_id = $request->get('category');
        $q_brands = $request->query('brands');
        $q_colors = $request->query('colors');
        $q_sort = $request->query('sort');
        $q_sizes = $request->query('q_sizes');
        $q_shoe_sizes = $request->query('q_shoe_sizes');
        $q_min = (int)$request->query('q_min');
        $q_max = (int)$request->query('q_max');

        $child_category = $this->child_categories->find($child_id);
        $parent_category = $this->parent_categories->where('id',$child_category->parent_id)->first();
        $child_categories = $this->child_categories->where('parent_id',$child_category->parent_id)->get();
        $products = $this->product;
        if (isset($q_sort)){
            $products = match ((int)$q_sort) {
                1 => $products->latest(),
                2 => $products->orderByDesc('views'),
                3 => $products->orderByDesc('rate'),
                default => $products->orderBy('created_at'),
            };
        }
        if (isset($q_brands)){
            $products = $products->where(function ($query) use ($q_brands){
                $query->whereIn('brand_id',explode(',',$q_brands))->orWhereRaw("'".$q_brands."'=''");
            });
        }
        if (isset($q_colors)){
            $products = $products->whereHas("product_color", function ($query) use ($q_colors){
                $query->whereIn('color_id',explode(',',$q_colors))->orWhereRaw("'".$q_colors."'=''");
            });
        }
        if (isset($q_sizes)){
            $products = $products->whereHas('size',function ($query) use ($q_sizes){
                $query->whereIn('size_id',explode(',',$q_sizes))->orWhereRaw("'".$q_sizes."'=''");
            });
        }
        if (isset($q_shoe_sizes)){
            $products = $products->whereHas('shoe_size',function ($query) use ($q_shoe_sizes){
                $query->whereIn('shoe_size_id',explode(',',$q_shoe_sizes))->orWhereRaw("'".$q_shoe_sizes."'=''");
            });
        }
        if ($q_min != null && $q_max != null){
            $products = $products->wherebetween('price',[$q_min,$q_max]);
        }

        $products = $products
            ->where('parent_category_id',$child_category->parent_id)
            ->where('child_category_id',$child_id)
            ->paginate(15);
        $brands = $this->brand->get();
        $product_colors = $this->color->get();
        $product_sizes = $this->size->get();
        $product_shoe_sizes = $this->shoeSize->get();

        return view('pages.product',[
            'products' => $products,
            'brands' => $brands,
            'product_colors' => $product_colors,
            'product_sizes' => $product_sizes,
            'product_shoe_sizes' => $product_shoe_sizes,
            'parent_category' => $parent_category,
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
