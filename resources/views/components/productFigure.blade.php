<div class="row">
    <div class="col-md-6 col-lg-7 p-b-30">
        <div class="p-l-25 p-r-30 p-lr-0-lg">
            <div class="wrap-slick3 flex-sb flex-w">
                <div class="wrap-slick3-dots"></div>
                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
                <div class="slick3 gallery-lb">
                    @foreach($product->formatted_images as $image)
                        <div class="border item-slick3" data-thumb="{{asset('storage/uploads/'.$image)}}">
                            <div class="wrap-pic-w pos-relative">
                                <img style="width: 550px;height: 600px" src="{{asset('storage/uploads/'.$image)}}" alt="IMG-PRODUCT">
                                <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="{{asset('storage/uploads/'.$image)}}">
                                    <i class="fa fa-expand"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-5 p-b-30">
        <div class="p-r-50 p-t-5 p-lr-0-lg">
            <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                {{$product->name}}
            </h4>
            <span class="mtext-106 cl2">
                {{$product->formatted_price}} so'm
            </span>
            <p class="stext-102 cl3 p-t-23">
                <span class="font-bold">Brand : </span> {{$product->brand->name}}
            </p>
            <p class="stext-102 cl3 p-t-23">
                {{$product->title}}
            </p>
            <div class="p-t-33">
                <form action="{{route('addToCart',$product->id)}}" method="POST">
                    @csrf
                    @if($product->category->dress_size == 1 && count($product->getProductSize())>0)
                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-203 flex-c-m respon6">
                                Size
                            </div>
                            <div class="size-204 respon6-next">
                                <div class="rs1-select2 bor8 bg0">
                                    <select class="js-select2" name="size" required>
                                        <option value="">Choose an option</option>
                                        @foreach($product->getProductSize() as $item)
                                            <option value="{{$item->size_id}}">Size {{$item->size->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                                @error('size')
                                <p style="color: #f11313">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    @endif
                    @if($product->category->shoe_size == 1 && count($product->getProductShoeSize())>0)
                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-203 flex-c-m respon6">
                                Shoe Size
                            </div>
                            <div class="size-204 respon6-next">
                                <div class="rs1-select2 bor8 bg0">
                                    <select class="js-select2" name="shoe_size" required>
                                        <option value="">Choose an option</option>
                                        @foreach($product->getProductShoeSize() as $item)
                                            <option value="{{$item->shoe_size_id}}">Size {{$item->shoe_size->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                                @error('shoe_size')
                                <p style="color: #f11313">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    @endif
                    @if(count($product->getProductColor())>0)
                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-203 flex-c-m respon6">
                                Color
                            </div>
                            <div class="size-204 respon6-next">
                                <div class="rs1-select2 bor8 bg0">
                                    <select class="js-select2" name="color" required>
                                        <option value="">Choose an option</option>
                                        @foreach($product->getProductColor() as $item)
                                            <option value="{{$item->color_id}}">{{$item->color->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                                @error('color')
                                <p style="color: #f11313">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    @endif
                    @if(count($product->getProductCharacteristic())>0)
                        <div class="flex-w flex-r-m p-b-10">
                            <div class="size-203 flex-c-m respon6">
                                Characteristic
                            </div>
                            <div class="size-204 respon6-next">
                                <div class="rs1-select2 bor8 bg0">
                                    <select class="js-select2" name="characteristic" required>
                                        <option value="">Choose an option</option>
                                        @foreach($product->getProductCharacteristic() as $item)
                                            <option value="{{$item->characteristic_id}}">{{$item->characteristic->name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="dropDownSelect2"></div>
                                </div>
                                @error('characteristic')
                                <p style="color: #f11313">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    @endif
                    <div class="flex-w flex-r-m p-b-10">
                        <div class="size-204 flex-w flex-m respon6-next">
                            <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                    <i class="fs-16 zmdi zmdi-minus"></i>
                                </div>
                                <input class="mtext-104 cl3 txt-center num-product" type="number" name="product_count" value="1">
                                <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                    <i class="fs-16 zmdi zmdi-plus"></i>
                                </div>
                            </div>
                            <button type="submit" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                Add to cart
                            </button>
                        </div>
                        @error('product_count')
                        <p style="color: #f11313">{{ $message }}</p>
                        @enderror
                    </div>
                </form>
            </div>

            <!--  -->
            <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                <div class="flex-m bor9 p-r-10 m-r-11">
                    @if($product->IssetWishlist())
                        <a href="{{route('removeItem.wishlist',$product->IssetWishlist()->rowId)}}">
                            <i class="fa fa-heart" style="color: red"></i>
                        </a>
                    @else
                        <a href="{{route('addWishlist',$product->id)}}">
                            <i class="fa fa-heart-o"></i>
                        </a>
                    @endif
                </div>
                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https://humo-market.uz/product/detail/{{$product->id}}" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Facebook">
                    <i class="fa fa-facebook"></i>
                </a>
                <a target="_blank" href="https://twitter.com/intent/tweet?text=https://humo-market.uz/product/detail/{{$product->id}}" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Twitter">
                    <i class="fa fa-twitter"></i>
                </a>
                <a target="_blank" href="https://t.me/share/url?url=https://humo-market.uz/product/detail/{{$product->id}}" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100" data-tooltip="Telegram">
                    <i class="fa fa-telegram"></i>
                </a>
            </div>
        </div>
    </div>
</div>
