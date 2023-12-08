<div class="sidebar__categories">
    <div class="section-title">
        <h4>Categories</h4>
    </div>
    <div class="categories__accordion">
        <div class="accordion">
            <div class="mb-2 text-xl font-bold text-gray-800">
                <a href="{{route('product.category.all')}}">Barcha kategoriyalar</a>
            </div>
            <div class="mb-3 text-xl font-bold text-gray-800">
                <p>{{$category->name}}</p>
            </div>
            @foreach($parent_categories as $parent_category)
                <div class="card ml-3">
                    <div class="text-md font-semibold">
                        <a href="{{route('product.category.parent',['slugName'=>$category->slug,'parentSlug'=>$parent_category->slug])}}">
                            {{$parent_category->name}}
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
             data-min="1000" data-max="20000000"></div>
        <div class="range-slider">
            <div class="price-input">
                <p>Price:</p>
                <input type="number" id="minamount" class="border py-1 px-2" name="minamount">
                <input type="number" id="maxamount" class="border py-1 px-2" name="maxamount">
            </div>
        </div>
    </div>
</div>
<div>
    <a href="{{route('product.category',$category->slug)}}">
        <button type="button" class="btn btn-danger">Clear</button>
    </a>
</div>
<form id="productFilter" action="{{route('product.category',$category->slug)}}" method="GET">
    <input type="hidden" name="sort" id="sortable" value="0">
    <input type="hidden" name="brands" id="brands" value="{{$q_brands}}">
    <input type="hidden" name="q_min" id="q_min" value="{{$q_min}}">
    <input type="hidden" name="q_max" id="q_max" value="{{$q_max}}">
    <button type="submit" name="productFilter"></button>
</form>
