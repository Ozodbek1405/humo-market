<div class="sidebar__categories">
    <div class="section-title">
        <h4>Categories</h4>
    </div>
    <div class="mb-2">
        <a href="{{route('product.category.all')}}">Barcha kategoriyalar</a>
    </div>
    <div class="categories__accordion">
        <div class="accordion" id="accordionExample">
            <div class="card">
                <div class="card-heading active">
                    <a data-toggle="collapse" data-target="#collapseOne">
                        {{$parent_category->name}}
                    </a>
                </div>
                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                    <div class="card-body">
                        <ul>
                            @foreach($child_categories as $child_category)
                                @if($parent_category->id == $child_category->parent_id)
                                    <li>
                                        <a href="{{route('product.view',['category' => $child_category->id])}}">
                                            {{$child_category->name}}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
             data-min="{{$parent_category->min}}" data-max="{{$parent_category->max}}"></div>
        <div class="range-slider">
            <div class="price-input">
                <p>Price:</p>
                <input type="number" id="minamount" class="border py-1 px-2" name="minamount">
                <input type="number" id="maxamount" class="border py-1 px-2" name="maxamount">
            </div>
        </div>
    </div>
</div>
@if($parent_category->dress_size == 1)
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

@if($parent_category->shoe_size == 1)
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
<form id="productFilter" action="{{route('product.view')}}" method="GET">
    <input type="hidden" name="sort" id="sortable" value="0">
    <input type="hidden" name="category" id="category" value="{{request()->category}}">
    <input type="hidden" name="brands" id="brands" value="{{$q_brands}}">
    <input type="hidden" name="colors" id="colors" value="{{$q_colors}}">
    <input type="hidden" name="q_sizes" id="q_sizes" value="{{$q_sizes}}">
    <input type="hidden" name="q_shoe_sizes" id="q_shoe_sizes" value="{{$q_shoe_sizes}}">
    <input type="hidden" name="q_min" id="q_min" value="{{$q_min}}">
    <input type="hidden" name="q_max" id="q_max" value="{{$q_max}}">
</form>
