@extends('layouts.master')
@section('title')

@endsection


@section('content')

    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url({{asset('images/bg-02.jpg')}});">
        <h2 class="ltext-105 cl0 txt-center">
            Blog
        </h2>
    </section>

{{--@dd($blogs)--}}
    <!-- Content page -->
    <section class="bg0 p-t-62 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="p-r-45 p-r-0-lg">
                        <!-- item blog -->
                        @foreach($blogs as $blog)
                            <div class="p-b-63">
                                <a href="{{route('blog.detail',$blog->id)}}" class="hov-img0 how-pos5-parent">
                                    <img style="width: 900px; height: 500px" src="{{ asset('storage/'.$blog->image) }}" alt="IMG-BLOG">
                                    <div class="flex-col-c-m size-123 bg9 how-pos5">
									<span class="ltext-107 cl2 txt-center">
										{{$blog->created_at->format('d')}}
									</span>
                                    <span class="stext-109 cl3 txt-center">
										{{$blog->created_at->format('M Y')}}
									</span>
                                    </div>
                                </a>
                                <div class="p-t-32">
                                    <h4 class="p-b-15">
                                        <a href="{{route('blog.detail',$blog->id)}}" class="ltext-108 cl2 hov-cl1 trans-04">
                                            {{$blog->getTranslatedAttribute('title')}}
                                        </a>
                                    </h4>
                                    <p class="stext-117 cl6">
                                        {{$blog->getTranslatedAttribute('desc')}}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 p-b-80">
                    <div class="side-menu">
                        <h4 class="mtext-112 cl2 p-b-33">
                            Featured Products
                        </h4>
                        <ul>
                            @foreach($products as $product)
                                <li class="flex-w flex-t p-b-30">
                                    <a href="{{route('product.detail',$product->id)}}" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
                                        <img style="height: 110px;width: 90px;" class="border" src="{{asset('storage/uploads/'.$product->formatted_images[0])}}" alt="PRODUCT">
                                    </a>
                                    <div class="size-215 flex-col-t p-t-8">
                                        <a href="{{route('product.detail',$product->id)}}" class="stext-116 cl8 hov-cl1 trans-04">
                                            @if(session('lang') == "uz")
                                                {{$product->name_uz}}
                                            @elseif(session('lang') == "ru")
                                                {{$product->name_ru}}
                                            @else
                                                {{$product->name_en}}
                                            @endif
                                        </a>
                                        <span class="stext-116 cl6 p-t-20">
											{{$product->formatted_price}} so'm
										</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
