@extends('layouts.master')
@section('title')

@endsection


@section('content')

    <!-- breadcrumb -->
    <div class="container">
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{route('home')}}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="{{route('blog')}}" class="stext-109 cl8 hov-cl1 trans-04">
                Blog
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="stext-109 cl4">
				{{$blog->title}}
			</span>
        </div>
    </div>


    <!-- Content page -->
    <section class="bg0 p-t-52 p-b-20">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="p-r-45 p-r-0-lg">
                        <!--  -->
                        <div class="wrap-pic-w how-pos5-parent">
                            <img style="height: 450px; width: 900px" src="{{ asset('storage/'.$blog->image) }}" alt="IMG-BLOG">
                            <div class="flex-col-c-m size-123 bg9 how-pos5">
								<span class="ltext-107 cl2 txt-center">
									{{$blog->created_at->format('d')}}
								</span>
                                <span class="stext-109 cl3 txt-center">
									{{$blog->created_at->format('M Y')}}
								</span>
                            </div>
                        </div>

                        <div class="p-t-32">
                            <h4 class="ltext-109 cl2 p-b-28">
                                {{$blog->title}}
                            </h4>
                            <p class="stext-117 cl6 p-b-26">
                                {{$blog->text}}
                            </p>
                        </div>
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
                                            {{$product->name}}
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
