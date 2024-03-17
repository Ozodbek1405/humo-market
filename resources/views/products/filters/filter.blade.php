<div class="sidebar__sizes">
    <div class="section-title">
        <h4>Shop Brands</h4>
    </div>
    <div class="size__list">
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
             data-min="{{$minPrice}}" data-max="{{$maxPrice}}"></div>
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
        <h4>Shop by Characteristic</h4>
    </div>
    <div class="size__list" id="content">
        @foreach($characteristics as $characteristic)
            <label for="{{$characteristic->name}}">
                {{$characteristic->getTranslatedAttribute('name')}}
                <input type="checkbox" @if(in_array($characteristic->id, explode(',',$q_characteristic))) checked="checked" @endif
                id="{{$characteristic->name}}" name="characteristic" value="{{$characteristic->id}}"
                       onchange="productByCharacteristic()">
                <span class="checkmark"></span>
            </label>
        @endforeach
    </div>
</div>
@if($category->dress_size == 1)
    <div class="sidebar__sizes">
        <div class="section-title">
            <h4>Shop by size</h4>
        </div>
        <div class="size__list">
            @foreach($product_sizes as $product_size)
                <label for="#{{$product_size->id}}">
                    {{$product_size->name}}
                    <input type="checkbox" @if(in_array($product_size->id, explode(',',$q_sizes))) checked="checked" @endif
                    id="#{{$product_size->id}}" name="product_size" value="{{$product_size->id}}"
                           onchange="productByFilterSizes()">
                    <span class="checkmark"></span>
                </label>
            @endforeach
        </div>
    </div>
@endif
@if($category->shoe_size == 1)
    <div class="sidebar__sizes">
        <div class="section-title">
            <h4>Shop by shoe size</h4>
        </div>
        <div class="size__list">
            @foreach($product_shoe_sizes as $shoe_size)
                <label for="#{{$shoe_size->id}}">
                    {{$shoe_size->name}}
                    <input type="checkbox" @if(in_array($shoe_size->id, explode(',',$q_shoe_sizes))) checked="checked" @endif
                    id="#{{$shoe_size->id}}" name="product_shoe_size" value="{{$shoe_size->id}}"
                           onchange="productByFilterShoeSizes()">
                    <span class="checkmark"></span>
                </label>
            @endforeach
        </div>
    </div>
@endif
<div class="sidebar__color">
    <div class="section-title">
        <h4>Shop by Color</h4>
    </div>
    <div class="size__list">
        @foreach($product_colors as $product_color)
            <label for="{{$product_color->name}}">
                {{$product_color->getTranslatedAttribute('name')}}
                <input type="checkbox" @if(in_array($product_color->id, explode(',',$q_colors))) checked="checked" @endif
                id="{{$product_color->name}}" name="product_color" value="{{$product_color->id}}"
                       onchange="productByFilterColors()">
                <span class="checkmark"></span>
            </label>
        @endforeach
    </div>
</div>
