<div class="sidebar__categories">
    <div class="section-title">
        <h4>Categories</h4>
    </div>
    <div class="categories__accordion">
        <div class="accordion" id="accordionExample">
            @foreach($categories as $category)
                <div class="card">
                    <div class="text-lg font-semibold">
                        <a href="{{route('product.category',$category->slug)}}">
                            {{$category->name}}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<div class="sidebar__sizes">
    <div class="section-title">
        <h4>Shop Brands</h4>
    </div>
    <div class="size__list" >
        @foreach($brands as $brand)
            <label for="#{{$brand->name}}">
                {{$brand->name}}
                <input type="checkbox" @if(in_array($brand->id, explode(',',$q_brands))) checked="checked" @endif
                id="#{{$brand->name}}" name="brands" value="{{$brand->id}}" onchange="productByFilterBrands()">
                <span class="checkmark"></span>
            </label>
        @endforeach
    </div>
</div>

<div class="sidebar__filter">
    <div class="section-title">
        <h4>Shop by price</h4>
    </div>
    <div class="filter-range-wrap">
        <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
             data-min="{{$minPrice ?? 2000}}" data-max="{{$maxPrice ?? 2000000}}"></div>
        <div class="range-slider">
            <div class="price-input">
                <p>Price:</p>
                <input type="number" id="minamount" class="border py-1 px-2" name="minamount">
                <input type="number" id="maxamount" class="border py-1 px-2" name="maxamount">
            </div>
        </div>
    </div>
</div>
<div class="sidebar__color">
    <div class="section-title">
        <h4>Shop by Color</h4>
    </div>
    <div class="size__list" id="content">
        @foreach($product_colors as $product_color)
            <label for="{{$product_color->name}}">
                {{$product_color->name}}
                <input type="checkbox" @if(in_array($product_color->id, explode(',',$q_colors))) checked="checked" @endif
                id="{{$product_color->name}}" name="product_color" value="{{$product_color->id}}"
                       onchange="productByFilterColors()">
                <span class="checkmark"></span>
            </label>
        @endforeach
    </div>
</div>
<div>
    <a href="{{route('product.category.all')}}">
        <button type="button" class="btn btn-danger">Clear</button>
    </a>
</div>
<form id="productFilter" action="{{route('product.category.all')}}" method="GET">
    <input type="hidden" name="sort" id="sortable" value="0">
    <input type="hidden" name="brands" id="brands" value="{{$q_brands}}">
    <input type="hidden" name="colors" id="colors" value="{{$q_colors}}">
    <input type="hidden" name="q_min" id="q_min" value="{{$q_min}}">
    <input type="hidden" name="q_max" id="q_max" value="{{$q_max}}">
    <button type="submit" name="productFilter"></button>
</form>
