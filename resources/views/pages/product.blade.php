@extends('layouts.master')
@section('title')
    SHOP
@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
@endpush
@section('content')

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="shop__sidebar">
                        <div class="sidebar__categories">
                            <div class="section-title">
                                <h4>Categories</h4>
                            </div>
                            <div class="categories__accordion">
                                <div class="accordion" id="accordionExample">
                                    @foreach($parent_categories as $parent_category)
                                        <div class="card">
                                            <div class="card-heading">
                                                <a data-toggle="collapse" data-target="#collapse{{$parent_category->id}}">{{$parent_category->name}}</a>
                                            </div>
                                            <div id="collapse{{$parent_category->id}}" class="collapse" data-parent="#accordionExample">
                                                <div class="card-body">
                                                    <ul>
                                                        @foreach($child_categories as $child_category)
                                                            @if($parent_category->id == $child_category->parent_id)
                                                                <li><a href="#">{{$child_category->name}}</a></li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @include('pages.filters.productFilter')
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="dropdown mb-4">
                        <button class="btn border dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                            Sort by
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                            <a class="dropdown-item" href="#">Latest</a>
                            <a class="dropdown-item" href="#">Popularity</a>
                            <a class="dropdown-item" href="#">Best Rating</a>
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
                                            <li><a href="#"><i class="zmdi zmdi-favorite-outline"></i></a></li>
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
                                            {{$product->formatted_price}} so'm <br><span> {{$product->formatted_discount}}</span>
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
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
@endsection
@push('scripts')
    <!-- Js Plugins -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('js/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('js/product.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-raty-js@2.8.0/lib/jquery.raty.min.js"></script>
    <script>
        @foreach ($products as $product)
        $("#stars{{$product->id}}").raty({
            path: 'https://cdn.jsdelivr.net/npm/jquery-raty-js@2.8.0/lib/images',
            readOnly: true,
            score: {{$product->rate ?? 0}},
            size: 12
        });
        @endforeach
    </script>
@endpush
