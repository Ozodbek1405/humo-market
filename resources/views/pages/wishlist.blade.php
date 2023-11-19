@extends('layouts.master')
@section('title')

@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
@endpush
@section('content')

    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{route('home')}}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4">
				Wishlist
			</span>
        </div>
    </div>


    <!-- Shoping Cart -->
    <div class="container bg0 p-t-75 p-b-85">
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="product__item" style="height: 360px;width: 262px">
                    <div class="product__item__pic set-bg" data-setbg="{{asset('images/shop-1.jpg')}}">
                        <ul class="product__hover">
                            <li><a href="{{asset('images/shop-1.jpg')}}" class="image-popup"><i class="zmdi zmdi-eye"></i></a></li>
                            <li><a href="#"><i class="zmdi zmdi-shopping-cart"></i></a></li>
                            <li><a href="#"><i class="zmdi zmdi-favorite-outline"></i></a></li>
                        </ul>
                    </div>
                    <div class="product__item__text">
                        <h6><a href="#">Furry hooded parka</a></h6>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <div class="product__price">$ 49.0 <span>$ 59.0</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
{{--    <script>--}}
{{--        @foreach ($products as $product)--}}
{{--        $("#stars{{$product->id}}").raty({--}}
{{--            path: 'https://cdn.jsdelivr.net/npm/jquery-raty-js@2.8.0/lib/images',--}}
{{--            readOnly: true,--}}
{{--            score: {{$product->rate ?? 0}},--}}
{{--            size: 12--}}
{{--        });--}}
{{--        @endforeach--}}
{{--    </script>--}}
@endpush
