@extends('layouts.master')
@section('title')
    {{$product->name}}
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/raty/3.1.1/jquery.raty.min.css"/>
@endpush
@section('content')

    <!-- breadcrumb -->
    <div class="container">
        @if (session('message'))
            <div class="alert alert-info mt-2">
                {{ session('message') }}
            </div>
        @endif
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{route('home')}}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{route('product.view',['category' => $product->child_category->id])}}" class="stext-109 cl8 hov-cl1 trans-04">
                {{$product->child_category->name}}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
				{{$product->name}}
			</span>
        </div>
    </div>


    <!-- Product Detail -->
    <section class="sec-product-detail bg0 p-t-65 p-b-60">
        <div class="container">
            @include('components.productFigure')

            <div class="bor10 m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                <div class="tab01">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item p-b-10">
                            <a class="nav-link active" data-toggle="tab" href="#reviews" role="tab">Reviews ({{count($reviews)}})</a>
                        </li>
                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#description" role="tab">Product about</a>
                        </li>
                        <li class="nav-item p-b-10">
                            <a class="nav-link" data-toggle="tab" href="#information" role="tab">Additional information</a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-t-43">
                        <!-- - -->
                        <div class="tab-pane fade show active" id="reviews" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <div class="p-b-30 m-lr-15-sm">
                                        <!-- Review -->
                                        @foreach($reviews as $review)
                                            <div class="flex-w flex-t border p-4 my-2">
                                                <div class="size-207">
                                                    <div class="flex-w flex-sb-m p-b-17">
													<span class="mtext-107 cl2 p-r-20">
														{{$review->name}}
													</span>
                                                    <div class="flex-row" id="stars{{$review->id}}"></div>
                                                    </div>
                                                    <p class="stext-102 cl6">
                                                        {{$review->text}}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        <!-- Add review -->
                                        <form action="{{route('review')}}" method="POST" class="w-full">
                                            @csrf
                                            <h5 class="mtext-108 cl2 p-b-7">
                                                Add a review
                                            </h5>
                                            <p class="stext-102 cl6">
                                                Your phone number will not be published.
                                            </p>
                                            <div class="flex-w flex-m p-t-50 p-b-23">
												<span class="stext-102 cl3 m-r-16">
													Your Rating
												</span>
                                                <span class="wrap-rating fs-18 cl11 pointer">
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<i class="item-rating pointer zmdi zmdi-star-outline"></i>
													<input class="dis-none" type="number" name="rate">
												</span>
                                                @error('rate')
                                                    <p class="text-red-600">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="row p-b-25">
                                                <div class="col-12 p-b-5">
                                                    <label class="stext-102 cl3" for="review">Your review</label>
                                                    <textarea class="size-110 bor8 stext-102 cl2 p-lr-20 p-tb-10" id="review" name="text" required></textarea>
                                                    @error('text')
                                                    <p class="text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-sm-6 p-b-5">
                                                    <label class="stext-102 cl3" for="name">Name</label>
                                                    <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="name"
                                                           type="text" name="name" required value="{{old('name')}}">
                                                    @error('name')
                                                    <p class="text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="col-sm-6 p-b-5">
                                                    <label class="stext-102 cl3" for="phone">Phone</label>
                                                    <input class="size-111 bor8 stext-102 cl2 p-lr-20" id="phone"
                                                           type="text" name="phone" required value="{{old('phone')}}">
                                                    @error('phone')
                                                    <p class="text-red-600">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <button type="submit" class="flex-c-m stext-101 cl0 size-112 bg7 bor11 hov-btn3 p-lr-15 trans-04 m-b-10">
                                                Submit
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- - -->
                        <div class="tab-pane fade" id="description" role="tabpanel">
                            <div class="how-pos2 p-lr-15-md">
                                <p class="stext-102 cl6">
                                    {!! $product->description !!}
                                </p>
                            </div>
                        </div>

                        <!-- - -->
                        <div class="tab-pane fade" id="information" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-10 col-md-8 col-lg-6 m-lr-auto">
                                    <ul class="p-lr-28 p-lr-15-sm">
                                        @isset($product->weight)
                                            <li class="flex-w flex-t p-b-7">
                                                <span class="stext-102 cl3 size-205">
                                                    Weight
                                                </span>
                                                <span class="stext-102 cl6 size-206">
                                                    {{$product->weight}} kg
                                                </span>
                                            </li>
                                        @endisset
                                        @isset($product->dimensions)
                                            <li class="flex-w flex-t p-b-7">
                                                <span class="stext-102 cl3 size-205">
                                                    Dimensions
                                                </span>
                                                <span class="stext-102 cl6 size-206">
                                                    {{$product->dimensions}}
                                                </span>
                                            </li>
                                        @endisset
                                        @isset($product->materials)
                                            <li class="flex-w flex-t p-b-7">
                                                <span class="stext-102 cl3 size-205">
                                                    Materials
                                                </span>
                                                <span class="stext-102 cl6 size-206">
                                                    {{$product->materials}}
                                                </span>
                                            </li>
                                        @endisset
                                        @if(count($product->getProductColor())>0)
                                            <li class="flex-w flex-t p-b-7">
                                                <span class="stext-102 cl3 size-205">
                                                    Color
                                                </span>
                                                <span class="stext-102 cl6 size-206">
												@foreach($product->getProductColor() as $item)
                                                     {{$item->color->name}},
                                                @endforeach
											    </span>
                                            </li>
                                        @endif
                                        @if(count($product->getProductSize())>0)
                                            <li class="flex-w flex-t p-b-7">
                                                <span class="stext-102 cl3 size-205">
                                                    Size
                                                </span>
                                                <span class="stext-102 cl6 size-206">
												 @foreach($product->getProductSize() as $item)
                                                     {{$item->size->name}},
                                                 @endforeach
											    </span>
                                            </li>
                                        @endisset
                                        @if(count($product->getProductShoeSize())>0)
                                            <li class="flex-w flex-t p-b-7">
                                                <span class="stext-102 cl3 size-205">
                                                    Shoe Size
                                                </span>
                                                <span class="stext-102 cl6 size-206">
                                                     @foreach($product->getProductShoeSize() as $item)
                                                         {{$item->shoe_size->name}},
                                                     @endforeach
                                                </span>
                                            </li>
                                        @endisset
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Related Products -->
    <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-45">
                <h3 class="ltext-106 cl5 txt-center">
                    Related Products
                </h3>
            </div>

            <!-- Slide2 -->
            <div class="wrap-slick2">
                <div class="slick2">
                    @foreach($related_products as $related_product)
                        <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <img style="width: 290px; height: 395px" src="{{asset('storage/uploads/'.$related_product->formatted_images[0])}}" alt="IMG-PRODUCT">

                                    <a href="{{route('product.detail',$related_product->id)}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                        Quick View
                                    </a>
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="{{route('product.detail',$related_product->id)}}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                            {{$related_product->name}}
                                        </a>
                                        <span class="stext-105 cl3">
										    {{$related_product->formatted_price}} so'm
									    </span>
                                    </div>

                                    <div class="block2-txt-child2 flex-r p-t-3">
                                        @if($related_product->IssetWishlist())
                                            <a href="{{route('removeItem.wishlist',$related_product->IssetWishlist()->rowId)}}">
                                                <i class="fa fa-heart" style="color: red"></i>
                                            </a>
                                        @else
                                            <a href="{{route('addWishlist',$related_product->id)}}">
                                                <i class="fa fa-heart-o"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/jquery-raty-js@2.8.0/lib/jquery.raty.min.js"></script>
    <script>
        @foreach ($reviews as $review)
        $("#stars{{$review->id}}").raty({
            path: 'https://cdn.jsdelivr.net/npm/jquery-raty-js@2.8.0/lib/images',
            readOnly: true,
            score: {{$review->rate ?? 0}},
            size: 12
        });
        @endforeach
    </script>
@endpush
