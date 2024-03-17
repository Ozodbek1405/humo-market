<div class="sidebar__categories">
    <div class="section-title">
        <h4>Categories</h4>
    </div>
    <div class="categories__accordion">
        <div class="accordion">
            <div class="mb-3 text-xl font-bold text-gray-800">
                <a href="{{route('product.category.all')}}">Barcha kategoriyalar</a>
            </div>
            <div class="mb-3 text-xl font-bold text-gray-800">
                <a href="{{route('product.category',$category->slug)}}">
                    {{$category->getTranslatedAttribute('name')}}
                </a>
            </div>
            <div class="mb-3 text-xl font-bold text-gray-800">
                <a href="{{route('product.category.parent',['slugName' => $category->slug,'parentSlug'=>$parent_category->slug])}}">
                    {{$parent_category->getTranslatedAttribute('name')}}
                </a>
            </div>
            <div class="card ml-3">
                <div class="text-md font-semibold">
                    <p>{{$child_category->getTranslatedAttribute('name')}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@include('products.filters.filter')
<div>
    <a href="{{route('product.category.child',['parentSlug'=>$parent_category->slug,'childSlug' => $child_category->slug])}}">
        <button type="button" class="btn btn-danger">Clear</button>
    </a>
</div>
<form id="productFilter"
      action="{{route('product.category.child',['parentSlug'=>$parent_category->slug,'childSlug' => $child_category->slug])}}"
      method="GET">
    <input type="hidden" name="sort" id="sortable" value="0">
    <input type="hidden" name="brands" id="brands" value="{{$q_brands}}">
    <input type="hidden" name="colors" id="colors" value="{{$q_colors}}">
    @if($category->dress_size == 1)
        <input type="hidden" name="q_sizes" id="q_sizes" value="{{$q_sizes}}">
    @endif
    @if($category->shoe_size == 1)
        <input type="hidden" name="q_shoe_sizes" id="q_shoe_sizes" value="{{$q_shoe_sizes}}">
    @endif
    <input type="hidden" name="q_min" id="q_min" value="{{$q_min}}">
    <input type="hidden" name="q_max" id="q_max" value="{{$q_max}}">
    <input type="hidden" name="characteristics" id="characteristics" value="{{$q_characteristic}}">
</form>
