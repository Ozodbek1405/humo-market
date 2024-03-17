<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandStoreRequest;
use App\Models\Brand;
use App\Models\Category;

class AdminBrandsController extends Controller
{
    public function brands()
    {
        $brands = Brand::query()->get();
        if (auth()->user()->role_id == 1){
            return view('vendor.voyager.brands.browse',compact('brands'));
        }
        abort(404);
    }

    public function create()
    {
        $categories = Category::query()->get();
        $form_route = route('brands.admin.store');
        return view('vendor.voyager.brands.create',compact('categories','form_route'));
    }

    public function store(BrandStoreRequest $request)
    {
        $data = $request->validated();
        $brand = Brand::query()->create([
            'name' => $data['name'],
            'order' => $data['order'],
            'slug' => $data['slug'],
        ]);
        $brand->category()->detach();
        if(isset($data['category_id'])){
            $brand->category()->attach($data['category_id']);
        }
        return redirect()->route('brands.admin.view');
    }

    public function delete($brand_id)
    {
        $brand = Brand::find($brand_id);
        $brand->delete();
        return redirect()->back()->with('success','Deleted successfully');
    }

    public function edit($brand_id)
    {
        $brand = Brand::find($brand_id);
        $categories = Category::query()->get();
        $form_route = route('brands.admin.update',$brand_id);
        return view('vendor.voyager.brands.create',compact('categories','brand','form_route'));
    }

    public function update(BrandStoreRequest $request,$brand_id)
    {
        $data = $request->validated();
        $brand = Brand::find($brand_id);
        $brand->update([
            'name' => $data['name'],
            'order' => $data['order'],
            'slug' => $data['slug'],
        ]);
        $brand->category()->detach();
        if(isset($data['category_id'])){
            $brand->category()->attach($data['category_id']);
        }
        return redirect()->route('brands.admin.view');
    }



}
