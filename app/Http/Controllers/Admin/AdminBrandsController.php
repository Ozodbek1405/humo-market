<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandStoreRequest;
use App\Models\Brand;
use App\Models\ParentCategory;

class AdminBrandsController extends Controller
{
    public function brands()
    {
        $brands = Brand::query()->get();
        return view('vendor.voyager.brands.browse',compact('brands'));
    }

    public function create()
    {
        $parent_categories = ParentCategory::query()->get();
        return view('vendor.voyager.brands.create',compact('parent_categories'));
    }

    public function store(BrandStoreRequest $request)
    {
        $data = $request->validated();
        $brand = Brand::query()->create([
            'name' => $data['name'],
            'order' => $data['order'],
            'slug' => $data['slug'],
        ]);
        $brand->parent()->detach();
        if(isset($data['parent_id'])){
            $brand->parent()->attach($data['parent_id']);
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
        $parent_categories = ParentCategory::query()->get();
        return view('vendor.voyager.brands.edit',compact('parent_categories','brand'));
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
        $brand->parent()->detach();
        if(isset($data['parent_id'])){
            $brand->parent()->attach($data['parent_id']);
        }
        return redirect()->route('brands.admin.view');
    }



}
