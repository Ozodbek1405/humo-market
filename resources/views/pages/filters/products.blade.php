<div class="dropdown mb-4">
    <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
        Sort by
    </button>
    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="triggerId">
        <button class="dropdown-item" id="latest">
            Latest
        </button>
        <button class="dropdown-item" id="popular">
            Popularity
        </button>
        <button class="dropdown-item" id="rating">
            Best Rating
        </button>
    </div>
</div>
<div class="row">
    @foreach($products as $product)
        <div class="col-lg-4 col-md-6">
            <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="{{asset('storage/uploads/'.$product->formatted_images[0])}}">
                    <ul class="product__hover">
                        <li><a href="{{asset('storage/uploads/'.$product->formatted_images[0])}}" class="image-popup"><i class="zmdi zmdi-eye"></i></a></li>
                        <li>
                            <a href="javascript:void(0)" onclick="event.preventDefault();document.getElementById('addToCart{{$product->name}}').submit()">
                                <i class="zmdi zmdi-shopping-cart"></i>
                            </a>
                        </li>
                        <li><a href="{{route('addWishlist',$product->id)}}"><i class="zmdi zmdi-favorite-outline"></i></a></li>
                    </ul>
                </div>
                <div class="product__item__text">
                    <h6>
                        <a href="{{route('product.detail',$product->id)}}" class="hover:text-gray-700">
                            {{$product->name}}
                        </a>
                    </h6>
                    <div class="flex-row inline-flex my-1" id="stars{{$product->id}}"></div>
                    <div class="product__price">
                        {{$product->formatted_price}} so'm <br><span> {{$product->formatted_discount}} so'm</span>
                    </div>
                </div>
            </div>
        </div>
        <form id="addToCart{{$product->name}}" action="{{route('addToCart',$product->id)}}" method="POST" class="hidden">
            @csrf
            <input type="number" name="product_count" value="1">
        </form>
    @endforeach
</div>
<div class="container d-flex justify-center">
    {{ $products->withQueryString()->links() }}
</div>
