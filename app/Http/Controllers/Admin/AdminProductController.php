<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Brand;
use App\Models\ChildCategory;
use App\Models\Company;
use App\Models\ParentCategory;
use App\Models\Product;
use App\Models\Color;
use App\Models\ShoeSize;
use App\Models\Size;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->get();
        return view('vendor.voyager.products.browse',compact('products'));
    }

    public function create()
    {
        $brands = Brand::query()->get();
        $product_colors = Color::query()->get();
        $product_sizes = Size::query()->get();
        $product_shoe_sizes = ShoeSize::query()->get();
        $parent_categories = ParentCategory::query()->get();
        $child_categories = ChildCategory::query()->get();
        $companies = Company::query()->get();

        return view('vendor.voyager.products.create',[
            'brands' => $brands,
            'product_colors' => $product_colors,
            'product_sizes' => $product_sizes,
            'product_shoe_sizes' => $product_shoe_sizes,
            'parent_categories' => $parent_categories,
            'child_categories' => $child_categories,
            'companies' => $companies,
        ]);
    }

    public function getChildCategory(Request $request)
    {
        $parent_id = $request->parent_id;
        $data = ChildCategory::query()->where('parent_id',$parent_id)->get();
        return ['data' => $data];
    }

    public function productStore(ProductStoreRequest $request)
    {
        $data = $request->validated();
        $product = Product::query()->create([
            'name' => $data['name'],
            'price' => $data['price'],
            'discount' => $data['discount']??null,
            'description' => $data['description'],
            'title' =>  $data['title'],
            'brand_id' =>  $data['brand_id'],
            'parent_category_id' =>  $data['parent_category_id'],
            'child_category_id' =>  $data['child_category_id'],
            'count' =>  $data['count'],
            'dimensions' =>  $data['dimensions']??null,
            'weight' =>  $data['weight']??null,
            'materials' =>  $data['materials']??null,
            'company_id' =>  $data['company_id']??null,
        ]);
        $product->size()->detach();
        if(isset($data['size_id'])){
            $product->size()->attach($data['size_id']);
        }
        $product->shoe_size()->detach();
        if(isset($data['shoe_size_id'])){
            $product->shoe_size()->attach($data['shoe_size_id']);
        }
        $product->product_color()->detach();
        if(isset($data['color_id'])){
            $product->product_color()->attach($data['color_id']);
        }
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $uploadedImage) {
                $fileName = time() . '_' . $uploadedImage->getClientOriginalName();
                $uploadedImage->move(public_path("storage/uploads/"), $fileName);
                $imgData[] = $fileName;
            }
            $product->images = json_encode($imgData);
            $product->save();
        }
        return redirect()->route('product.admin.view');
    }

    public function productDelete($product_id)
    {

        $product = Product::find($product_id);
        $product->delete();
        return redirect()->back()->with('success','Deleted successfully');
    }

    public function edit($product_id)
    {
        $brands = Brand::query()->get();
        $product_colors = Color::query()->get();
        $product_sizes = Size::query()->get();
        $product_shoe_sizes = ShoeSize::query()->get();
        $parent_categories = ParentCategory::query()->get();
        $child_categories = ChildCategory::query()->get();
        $product = Product::query()->where('id',$product_id)->first();
        $companies = Company::query()->get();

        return view('vendor.voyager.products.edit',[
            'brands' => $brands,
            'product_colors' => $product_colors,
            'product_sizes' => $product_sizes,
            'product_shoe_sizes' => $product_shoe_sizes,
            'parent_categories' => $parent_categories,
            'child_categories' => $child_categories,
            'product' => $product,
            'companies' => $companies
        ]);
    }

    public function update(ProductStoreRequest $request, $product_id)
    {
        $data = $request->validated();
        $product = Product::find($product_id);
        $product->update([
            'name' => $data['name'],
            'price' => $data['price'],
            'discount' => $data['discount']??null,
            'description' => $data['description'],
            'title' =>  $data['title'],
            'brand_id' =>  $data['brand_id'],
            'parent_category_id' =>  $data['parent_category_id'],
            'child_category_id' =>  $data['child_category_id'],
            'count' =>  $data['count'],
            'dimensions' =>  $data['dimensions']??null,
            'weight' =>  $data['weight']??null,
            'materials' =>  $data['materials']??null,
            'company_id' =>  $data['company_id']??null,
        ]);
        $product->size()->detach();
        if(isset($data['size_id'])){
            $product->size()->attach($data['size_id']);
        }
        $product->shoe_size()->detach();
        if(isset($data['shoe_size_id'])){
            $product->shoe_size()->attach($data['shoe_size_id']);
        }
        $product->product_color()->detach();
        if(isset($data['color_id'])){
            $product->product_color()->attach($data['color_id']);
        }
        if (isset($data['images'])){
           $product->images = null;
           $product->save();
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $uploadedImage) {
                    $fileName = time() . '_' . $uploadedImage->getClientOriginalName();
                    $uploadedImage->move(public_path("storage/uploads/"), $fileName);
                    $imgData[] = $fileName;
                }
                $product->images = json_encode($imgData);
                $product->save();
            }
        }

        return redirect()->route('product.admin.view');
    }

}
