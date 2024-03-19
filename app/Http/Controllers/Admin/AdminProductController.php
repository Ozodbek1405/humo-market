<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Models\{Brand,
    Category,
    Characteristic,
    ChildCategory,
    Company,
    ParentCategory,
    Product,
    Color,
    ShoeSize,
    Size};
use Illuminate\Http\Request;

class AdminProductController extends Controller
{

    protected Product $product;
    protected Brand $brand;
    protected Color $color;
    protected Characteristic $characteristic;
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
        $this->characteristic = new Characteristic();
        $this->company = new Company();
        $this->size = new Size();
        $this->shoeSize = new ShoeSize();
        $this->categories = new Category();
        $this->parent_categories = new ParentCategory();
        $this->child_categories = new ChildCategory();
    }


    public function index()
    {
        $user = auth()->user();
        if ($user->role_id == 1){
            $products = Product::query()->get();
        }else{
            $products = Product::query()->where('company_id',$user->company_id)->get();
        }
        return view('vendor.voyager.products.browse',compact('products'));
    }

    public function create()
    {
        $product_colors = $this->color->get();
        $characteristics = $this->characteristic->get();
        $product_sizes = $this->size->get();
        $product_shoe_sizes = $this->shoeSize->get();
        $categories = $this->categories->get();
        $companies = $this->company->get();
        $form_route = route('products.store');

        return view('vendor.voyager.products.create',[
            'product_colors' => $product_colors,
            'characteristics' => $characteristics,
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
            'name_uz' => $data['name_uz'],
            'name_en' => $data['name_en'],
            'name_ru' => $data['name_ru'],
            'price' => $data['price'],
            'discount' => $data['discount']??null,
            'desc_en' => $data['desc_en'],
            'desc_uz' => $data['desc_uz'],
            'desc_ru' => $data['desc_ru'],
            'title_uz' =>  $data['title_uz'],
            'title_en' =>  $data['title_en'],
            'title_ru' =>  $data['title_ru'],
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
        $product->product_characteristic()->detach();
        if(isset($data['characteristic_id'])){
            $product->product_characteristic()->attach($data['characteristic_id']);
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
        $characteristics = $this->characteristic->get();
        $form_route = route('product.update',$product->id);

        return view('vendor.voyager.products.create',[
            'product_colors' => $product_colors,
            'product_sizes' => $product_sizes,
            'product_shoe_sizes' => $product_shoe_sizes,
            'categories' => $categories,
            'product' => $product,
            'characteristics' => $characteristics,
            'companies' => $companies,
            'form_route' => $form_route
        ]);
    }

    public function update(ProductStoreRequest $request, $product_id)
    {
        $data = $request->validated();
        $product = $this->product->find($product_id);
        $product->update([
            'name_en' => $data['name_en'],
            'name_uz' => $data['name_uz'],
            'name_ru' => $data['name_ru'],
            'price' => $data['price'],
            'discount' => $data['discount']??null,
            'desc_uz' => $data['desc_uz'],
            'desc_en' => $data['desc_en'],
            'desc_ru' => $data['desc_ru'],
            'title_uz' =>  $data['title_uz'],
            'title_en' =>  $data['title_en'],
            'title_ru' =>  $data['title_ru'],
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
        $product->product_characteristic()->detach();
        if(isset($data['characteristic_id'])){
            $product->product_characteristic()->attach($data['characteristic_id']);
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
        $category_id = $request->category_id;
        $data = $this->brand->whereHas('category',function ($query) use ($category_id){
            $query->where('category_id',$category_id);
        })->get();
        return ['data' => $data];
    }

}
