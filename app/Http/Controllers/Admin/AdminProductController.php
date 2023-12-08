<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Models\{Brand, Category, ChildCategory, Company, ParentCategory, Product, Color, ShoeSize, Size};
use Illuminate\Http\Request;

class AdminProductController extends Controller
{

    protected Product $product;
    protected Brand $brand;
    protected Color $color;
    protected Company $company;
    protected Size $size;
    protected ShoeSize $shoeSize;
    protected Category $categories;
    protected ParentCategory $parent_categories;
    protected ChildCategory $child_categories;

    public function __construct()
    {
        $this->product = new Product();
        $this->brand = new Brand();
        $this->color = new Color();
        $this->company = new Company();
        $this->size = new Size();
        $this->shoeSize = new ShoeSize();
        $this->categories = new Category();
        $this->parent_categories = new ParentCategory();
        $this->child_categories = new ChildCategory();
    }


    public function index()
    {
        $products = Product::query()->get();
        return view('vendor.voyager.products.browse',compact('products'));
    }

    public function create()
    {
        $product_colors = $this->color->get();
        $product_sizes = $this->size->get();
        $product_shoe_sizes = $this->shoeSize->get();
        $categories = $this->categories->get();
        $companies = $this->company->get();
        $form_route = route('products.store');

        return view('vendor.voyager.products.create',[
            'product_colors' => $product_colors,
            'product_sizes' => $product_sizes,
            'product_shoe_sizes' => $product_shoe_sizes,
            'categories' => $categories,
            'companies' => $companies,
            'form_route' => $form_route
        ]);
    }

    public function productStore(ProductStoreRequest $request)
    {
        $data = $request->validated();
        $product = $this->product->create([
            'name' => $data['name'],
            'price' => $data['price'],
            'discount' => $data['discount']??null,
            'description' => $data['description'],
            'title' =>  $data['title'],
            'brand_id' =>  $data['brand_id'],
            'category_id' =>  $data['category_id'],
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

    public function edit($product_id)
    {
        $product_colors = $this->color->get();
        $product_sizes = $this->size->get();
        $product_shoe_sizes = $this->shoeSize->get();
        $product = $this->product->where('id',$product_id)->first();
        $companies = $this->company->get();
        $categories = $this->categories->get();
        $form_route = route('product.update',$product->id);

        return view('vendor.voyager.products.create',[
            'product_colors' => $product_colors,
            'product_sizes' => $product_sizes,
            'product_shoe_sizes' => $product_shoe_sizes,
            'categories' => $categories,
            'product' => $product,
            'companies' => $companies,
            'form_route' => $form_route
        ]);
    }

    public function update(ProductStoreRequest $request, $product_id)
    {
        $data = $request->validated();
        $product = $this->product->find($product_id);
        $product->update([
            'name' => $data['name'],
            'price' => $data['price'],
            'discount' => $data['discount']??null,
            'description' => $data['description'],
            'title' =>  $data['title'],
            'brand_id' =>  $data['brand_id'],
            'category_id' =>  $data['category_id'],
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

    public function productDelete($product_id)
    {

        $product = $this->product->find($product_id);
        $product->delete();
        return redirect()->back()->with('success','Deleted successfully');
    }

    public function getParentCategory(Request $request)
    {
        $category_id = $request->category_id;
        $data = $this->parent_categories->where('category_id',$category_id)->get();
        return ['data' => $data];
    }

    public function getChildCategory(Request $request)
    {
        $parent_id = $request->parent_id;
        $data = $this->child_categories->where('parent_id',$parent_id)->get();
        return ['data' => $data];
    }

    public function getBrands(Request $request)
    {
        $parent_id = $request->parent_id;
        $data = $this->brand->whereHas('parent',function ($query) use ($parent_id){
            $query->where('parent_id',$parent_id);
        })->get();
        return ['data' => $data];
    }

}
