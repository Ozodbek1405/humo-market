<?php

namespace App\Http\Controllers;


use App\Services\ProductFilterService;
use App\Models\{Brand, Category, ChildCategory, ParentCategory, Product, Color, ShoeSize, Size, Review};
use Illuminate\Http\Request;

class ProductController extends Controller
{

    protected Product $product;
    protected Review $review;
    protected Brand $brand;
    protected Color $color;
    protected Size $size;
    protected ShoeSize $shoeSize;
    protected Category $category;
    protected ParentCategory $parent_categories;
    protected ChildCategory $child_categories;
    protected ProductFilterService $product_filter_service;

    public function __construct()
    {
        $this->product = new Product();
        $this->review = new Review();
        $this->brand = new Brand();
        $this->color = new Color();
        $this->size = new Size();
        $this->shoeSize = new ShoeSize();
        $this->category = new Category();
        $this->parent_categories = new ParentCategory();
        $this->child_categories = new ChildCategory();
        $this->product_filter_service = new ProductFilterService();
    }

    public function productAll(Request $request)
    {
        $q_brands = $request->query('brands');
        $q_colors = $request->query('colors');
        $q_sort = $request->query('sort');
        $q_min = $request->query('q_min');
        $q_max = $request->query('q_max');
        $search = $request->query('search');
        $products = $this->product;
        $products = $this->product_filter_service->filters($products,$q_sort,$q_brands,$q_colors,$q_min,$q_max,null,null,$search);
        $products = $products->paginate(21);
        $brands = $this->brand->get();
        $product_colors = $this->color->get();
        $categories = $this->category->get();

        return view('products.allProduct',[
            'products' => $products,
            'brands' => $brands,
            'product_colors' => $product_colors,
            'categories' => $categories,
            'q_brands' => $q_brands,
            'q_colors' => $q_colors,
            'q_min' => $q_min,
            'q_max' => $q_max,
        ]);
    }

    public function categoryProduct(Request $request, $slugName)
    {
        $q_brands = $request->query('brands');
        $q_colors = $request->query('colors');
        $q_sizes = $request->query('q_sizes');
        $q_shoe_sizes = $request->query('q_shoe_sizes');
        $q_sort = $request->query('sort');
        $q_min = $request->query('q_min');
        $q_max = $request->query('q_max');
        $category = $this->category->where('slug',$slugName)->first();
        $parent_categories = $this->parent_categories->where('category_id',$category->id)->get();
        $products = $this->product;
        $products = $this->product_filter_service->filters($products,$q_sort,$q_brands,$q_colors,$q_min,$q_max,$q_sizes,$q_shoe_sizes,null);
        $products = $products->where('category_id',$category->id);
        $products = $products->paginate(21);
        $category_id = $category->id;
        $brands = $this->brand->whereHas('category',function ($query) use ($category_id){
            $query->where('category_id',$category_id)->orWhereRaw("'".$category_id."'=''");
        })->get();
        $product_colors = $this->color->get();
        $product_sizes = $this->size->get();
        $product_shoe_sizes = $this->shoeSize->get();

        return view('products.categoryProduct',[
            'products' => $products,
            'brands' => $brands,
            'parent_categories' => $parent_categories,
            'product_colors' => $product_colors,
            'product_sizes' => $product_sizes,
            'product_shoe_sizes' => $product_shoe_sizes,
            'category' => $category,
            'q_brands' => $q_brands,
            'q_colors' => $q_colors,
            'q_sizes' => $q_sizes,
            'q_shoe_sizes' => $q_shoe_sizes,
            'q_min' => $q_min,
            'q_max' => $q_max,
        ]);
    }

    public function parentProduct(Request $request, $slugName, $parentSlug)
    {
        $q_brands = $request->query('brands');
        $q_colors = $request->query('colors');
        $q_sort = $request->query('sort');
        $q_sizes = $request->query('q_sizes');
        $q_shoe_sizes = $request->query('q_shoe_sizes');
        $q_min = (int)$request->query('q_min');
        $q_max = (int)$request->query('q_max');

        $category = $this->category->where('slug',$slugName)->first();
        $parent_category = $this->parent_categories->where('slug',$parentSlug)->first();
        $child_categories = $this->child_categories->where('parent_id',$parent_category->id)->get();
        $products = $this->product;
        $products = $this->product_filter_service->filters($products,$q_sort,$q_brands,$q_colors,$q_min,$q_max,$q_sizes,$q_shoe_sizes,null);
        $products = $products
            ->where('category_id',$category->id)
            ->where('parent_category_id',$parent_category->id)
            ->paginate(15);
        $category_id = $category->id;
        $brands = $this->brand->whereHas('category',function ($query) use ($category_id){
            $query->where('category_id',$category_id)->orWhereRaw("'".$category_id."'=''");
        })->get();
        $product_colors = $this->color->get();
        $product_sizes = $this->size->get();
        $product_shoe_sizes = $this->shoeSize->get();

        return view('products.parentProduct',[
            'products' => $products,
            'brands' => $brands,
            'product_colors' => $product_colors,
            'product_sizes' => $product_sizes,
            'product_shoe_sizes' => $product_shoe_sizes,
            'category' => $category,
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

    public function childProduct(Request $request, $parentSlug, $childSlug)
    {
        $q_brands = $request->query('brands');
        $q_colors = $request->query('colors');
        $q_sort = $request->query('sort');
        $q_sizes = $request->query('q_sizes');
        $q_shoe_sizes = $request->query('q_shoe_sizes');
        $q_min = (int)$request->query('q_min');
        $q_max = (int)$request->query('q_max');

        $child_category = $this->child_categories->where('slug',$childSlug)->first();
        $parent_category = $this->parent_categories->where('slug',$parentSlug)->first();
        $category = $this->category->where('id',$parent_category->category_id)->first();
        $products = $this->product;
        $products = $this->product_filter_service->filters($products,$q_sort,$q_brands,$q_colors,$q_min,$q_max,$q_sizes,$q_shoe_sizes,null);
        $products = $products
            ->where('parent_category_id',$parent_category->id)
            ->where('child_category_id',$child_category->id)
            ->paginate(15);
        $category_id = $category->id;
        $brands = $this->brand->whereHas('category',function ($query) use ($category_id){
            $query->where('category_id',$category_id)->orWhereRaw("'".$category_id."'=''");
        })->get();
        $product_colors = $this->color->get();
        $product_sizes = $this->size->get();
        $product_shoe_sizes = $this->shoeSize->get();

        return view('products.childProduct',[
            'products' => $products,
            'brands' => $brands,
            'product_colors' => $product_colors,
            'product_sizes' => $product_sizes,
            'product_shoe_sizes' => $product_shoe_sizes,
            'parent_category' => $parent_category,
            'child_category' => $child_category,
            'category' => $category,
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
            ->where('category_id',$product->category_id)
            ->where('parent_category_id',$product->parent_category_id)
            ->where('child_category_id',$product->child_category_id)
            ->take(10)->get();
        return view('products.product-detail',compact('reviews','product','related_products'));
    }
}
