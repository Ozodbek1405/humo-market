@extends('voyager::master')

@section('content')
    <link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css" rel="stylesheet">
    <section class="container">
        <div style="margin-bottom: 30px">
            <h2>@if(empty($product)) Create @else Edit @endif <b>Products</b></h2>
        </div>
        <form action="{{ $form_route }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name_uz">Name uz</label>
                <input type="text" class="form-control" id="name_uz" name="name_uz"
                       placeholder="name_uz" value="{{old('name_uz',$product->name_uz??null)}}">
                @error('name_uz')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="name_en">Name en</label>
                <input type="text" class="form-control" id="name_en" name="name_en"
                       placeholder="name_en" value="{{old('name_en',$product->name_en??null)}}">
                @error('name_en')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="name_ru">Name ru</label>
                <input type="text" class="form-control" id="name_ru" name="name_ru"
                       placeholder="name_ru" value="{{old('name_ru',$product->name_ru??null)}}">
                @error('name_ru')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="company_id">Company name</label>
                <select class="form-control" id="company_id" name="company_id">
                    <option value="">Tanlang</option>
                    @foreach($companies as $company)
                        <option value="{{$company->id}}" @selected(!empty($product) ? $product->company_id == $company->id : '')>
                            {{$company->name}}
                        </option>
                    @endforeach
                </select>
                @error('company_id')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="category">Categories</label>
                <select class="form-control" id="category" name="category_id">
                    <option value="">Tanlang</option>
                    @foreach($categories as $category)
                        <option  @selected(!empty($product) ? $product->category_id == $category->id : '') value="{{$category->id}}">
                            {{$category->name}}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="parent_category">Parent category</label>
                <select class="form-control" id="parent_category" name="parent_category_id">
                    <option value="">Tanlang</option>
                </select>
                @error('parent_category_id')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="child_category">Child category</label>
                <select class="form-control" id="child_category" name="child_category_id">
                    <option value="">Tanlang</option>
                </select>
                @error('child_category_id')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="price" value="{{old('price',$product->price??null)}}">
                @error('price')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="discount">Chegirma narxi</label>
                <input type="number" class="form-control" id="discount" name="discount" placeholder="discount"
                       value="{{old('discount',$product->discount??null)}}">
                @error('discount')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="title_uz">Title uz</label>
                <input type="text" class="form-control" id="title_uz" name="title_uz"
                       placeholder="title_uz" value="{{old('title_uz',$product->title_uz??null)}}">
                @error('title_uz')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">Title en</label>
                <input type="text" class="form-control" id="title_en" name="title_en"
                       placeholder="title_en" value="{{old('title_en',$product->title_en??null)}}">
                @error('title_en')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="title">Title ru</label>
                <input type="text" class="form-control" id="title_ru" name="title_ru"
                       placeholder="title_ru" value="{{old('title_ru',$product->title_ru ?? null)}}">
                @error('title_ru')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="desc_uz">Description uz</label>
                <textarea class="form-control" id="desc_uz" rows="3" name="desc_uz">{{$product->desc_uz??null}}</textarea>
                @error('desc_uz')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="desc_en">Description en</label>
                <textarea class="form-control" id="desc_en" rows="3" name="desc_en">{{$product->desc_en??null}}</textarea>
                @error('desc_en')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="desc_ru">Description ru</label>
                <textarea class="form-control" id="desc_ru" rows="3" name="desc_ru">{{$product->desc_ru??null}}</textarea>
                @error('desc_ru')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="weight">Weight (kg)</label>
                <input type="text" class="form-control" id="weight" name="weight" placeholder="weight"
                       value="{{old('weight',$product->weight??null)}}">
                @error('weight')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="dimensions">O'lchamlari (sm x sm x sm)</label>
                <input type="text" class="form-control" id="dimensions" name="dimensions" placeholder="dimensions"
                       value="{{old('dimensions',$product->dimensions??null)}}">
                @error('dimensions')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="materials">Materials</label>
                <input type="text" class="form-control" id="materials" name="materials" placeholder="materials"
                       value="{{old('materials',$product->materials??null)}}">
                @error('materials')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="product_color">Product color</label>
                <select multiple class="form-control product_multiple_select" id="product_color" name="color_id[]">
                    <option value="">Tanlang</option>
                    @foreach($product_colors as $product_color)
                        <option value="{{$product_color->id}}" @selected(!empty($product) ? in_array($product_color->id,$product->getProductColorArray()) : '')>
                            {{$product_color->name}}
                        </option>
                    @endforeach
                </select>
                @error('color_id')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="characteristic">Product characteristic</label>
                <select multiple class="form-control product_multiple_select" id="characteristic" name="characteristic_id[]">
                    <option value="">Tanlang</option>
                    @foreach($characteristics as $characteristic)
                        <option value="{{$characteristic->id}}" @selected(!empty($product) ? in_array($characteristic->id,$product->getProductCharacteristicArray()) : '')>
                            {{$characteristic->name}}
                        </option>
                    @endforeach
                </select>
                @error('characteristic_id')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="count">Product count</label>
                <input type="number" class="form-control" id="count" name="count" placeholder="count"
                       value="{{old('count',$product->count??null)}}">
                @error('count')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="product_size">Product size</label>
                <select multiple class="form-control product_multiple_select" id="product_size" name="size_id[]">
                    @foreach($product_sizes as $product_size)
                        <option @selected(!empty($product) ? in_array($product_size->id,$product->getProductSizeArray()) : '') value="{{$product_size->id}}">
                            {{$product_size->name}}
                        </option>
                    @endforeach
                </select>
                @error('size_id')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="product_shoe_size">Product shoe size</label>
                <select multiple class="form-control product_multiple_select" id="product_shoe_size" name="shoe_size_id[]">
                    @foreach($product_shoe_sizes as $shoe_size)
                        <option value="{{$shoe_size->id}}" @selected(!empty($product) ? in_array($shoe_size->id,$product->getProductShoeSizeArray()) : '')>
                            {{$shoe_size->name}}
                        </option>
                    @endforeach
                </select>
                @error('shoe_size_id')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="brand">Brands</label>
                <select class="form-control" id="brand" name="brand_id">
                    <option value="">Tanlang</option>
                </select>
                @error('brand_id')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="images">Images</label>
                <input class="form-control-file" name="images[]" type="file" id="images" multiple="multiple" accept=".jpg,.png,.jpeg">
                @error('images')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </section>
    @include('vendor.voyager.products.script')
@endsection
