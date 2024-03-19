@extends('layouts.master')
@section('title')

@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/wishlist.css')}}" type="text/css">
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
    <div class="cart-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if (session('message'))
                        <div class="alert alert-info mt-2">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if(count($wishlistItems) > 0)
                        <div class="table-wishlist">
                            <a href="{{route('clear.wishlist')}}">
                                <button class="btn btn-danger mb-2">Clear wishlist</button>
                            </a>
                            <table>
                                <thead>
                                <tr>
                                    <th width="20%">Product</th>
                                    <th width="20%">Name</th>
                                    <th width="20%">Price</th>
                                    <th width="20%"></th>
                                    <th width="20%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($wishlistItems as $item)
                                    <tr>
                                        <td width="20%">
                                            <div class="display-flex align-center">
                                                <div class="img-product">
                                                    <img src="{{asset('storage/uploads/'.$item->options['image'])}}"
                                                         alt="#" class="mCS_img_loaded">
                                                </div>
                                            </div>
                                        </td>
                                        <td width="20%" class="price">
                                            <div class="name-product">
                                                <a href="{{route('product.detail',$item->id)}}">
                                                    @if(session('lang') == "uz")
                                                        {{$item->name_uz}}
                                                    @elseif(session('lang') == "ru")
                                                        {{$item->name_ru}}
                                                    @else
                                                        {{$item->name_en}}
                                                    @endif
                                                </a>
                                            </div>
                                        </td>
                                        <td width="20%" class="price">{{$item->price}} so'm</td>
                                        <td width="20%">
                                            @php
                                                $product = App\Models\Product::find($item->id);
                                            @endphp
                                            @if(count($product->getProductSize()) <= 1 && count($product->getProductShoeSize()) <= 1 && count($product->getProductColor()) <= 1)
                                                <button class="round-black-btn small-btn" onclick="document.getElementById('addToCartForm').submit()">
                                                    Add to Cart
                                                </button>
                                                <form id="addToCartForm" action="{{route('addToCart',$item->id)}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_count" value="1">
                                                </form>
                                            @else
                                                <button class="round-black-btn small-btn js-show-modal{{$item->id}}">
                                                    Add to Cart
                                                </button>
                                            @endif
                                        </td>
                                        <td width="20%">
                                            <a href="{{route('removeItem.wishlist',$item->rowId)}}">
                                                <button class="btn btn-dark">x</button>
                                            </a>
                                        </td>
                                    </tr>
                                    @include('products.filters.modal')
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="container d-flex justify-center">
                            <img src="{{asset('images/empty_wishlist.png')}}" alt="wishlist">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        @foreach($wishlistItems as $item)
        $('.js-show-modal{{$item->id}}').on('click', function (e) {
            e.preventDefault();
            $('.js-modal{{$item->id}}').addClass('show-modal1');
        });

        $('.js-hide-modal{{$item->id}}').on('click', function () {
            $('.js-modal{{$item->id}}').removeClass('show-modal1');
        });
        @endforeach
    </script>
@endpush
