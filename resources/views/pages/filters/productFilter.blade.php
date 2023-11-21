<form action="{{route('product')}}">
    <div class="sidebar__sizes">
        <div class="section-title">
            <h4>Shop Brands</h4>
        </div>
        <div class="size__list">
            @foreach($brands as $brand)
                <label for="#{{$brand->name}}">
                    {{$brand->name}}
                    <input type="radio" @if(request('brands'))
                        @checked(in_array($brand->id,request('brands')))@endif
                    id="#{{$brand->name}}" name="brands[]" value="{{$brand->id}}">
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
                 data-min="0" data-max="10000000"></div>
            <div class="range-slider">
                <div class="price-input">
                    <p>Price:</p>
                    <input type="text" id="minamount" class="border py-1 px-2" name="minamount" value="{{request('minamount')}}">
                    <input type="text" id="maxamount" class="border py-1 px-2" name="maxamount" value="{{old('maxamount',request('maxamount'))}}">
                </div>
            </div>
        </div>
    </div>
    <div class="sidebar__sizes">
        <div class="section-title">
            <h4>Shop by size</h4>
        </div>
        <div class="size__list">
            @foreach($product_sizes as $product_size)
                <label for="#{{$product_size->id}}">
                    {{$product_size->name}}
                    <input type="checkbox" id="#{{$product_size->id}}" name="product_size[]" value="{{$product_size->id}}">
                    <span class="checkmark"></span>
                </label>
            @endforeach
        </div>
    </div>
    <div class="sidebar__color">
        <div class="section-title">
            <h4>Shop by Color</h4>
        </div>
        <div class="size__list color__list">
            @foreach($product_colors as $product_color)
                <label for="{{$product_color->name}}">
                    {{$product_color->name}}
                    <input type="radio" id="{{$product_color->name}}"
                           @if(request('product_color')) @checked(in_array($product_color->id,request('product_color')))@endif
                           name="product_color[]" value="{{$product_color->id}}">
                    <span class="checkmark"></span>
                </label>
            @endforeach
        </div>
    </div>
    <div>
        <button type="submit" class="btn btn-danger">Filter</button>
    </div>
</form>
