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


    <!-- Content page -->
    <section class="bg0 p-t-62 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="p-r-45 p-r-0-lg">
                        <!-- item blog -->
                        <div class="p-b-63">
                            <a href="blog-detail.html" class="hov-img0 how-pos5-parent">
                                <img src="images/blog-04.jpg" alt="IMG-BLOG">

                                <div class="flex-col-c-m size-123 bg9 how-pos5">
									<span class="ltext-107 cl2 txt-center">
										22
									</span>

                                    <span class="stext-109 cl3 txt-center">
										Jan 2018
									</span>
                                </div>
                            </a>

                            <div class="p-t-32">
                                <h4 class="p-b-15">
                                    <a href="blog-detail.html" class="ltext-108 cl2 hov-cl1 trans-04">
                                        8 Inspiring Ways to Wear Dresses in the Winter
                                    </a>
                                </h4>

                                <p class="stext-117 cl6">
                                    Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce eget dictum tortor. Donec dictum vitae sapien eu varius
                                </p>
                            </div>
                        </div>

                        <!-- item blog -->
                        <div class="p-b-63">
                            <a href="blog-detail.html" class="hov-img0 how-pos5-parent">
                                <img src="images/blog-05.jpg" alt="IMG-BLOG">

                                <div class="flex-col-c-m size-123 bg9 how-pos5">
									<span class="ltext-107 cl2 txt-center">
										18
									</span>

                                    <span class="stext-109 cl3 txt-center">
										Jan 2018
									</span>
                                </div>
                            </a>

                            <div class="p-t-32">
                                <h4 class="p-b-15">
                                    <a href="blog-detail.html" class="ltext-108 cl2 hov-cl1 trans-04">
                                        The Great Big List of Men’s Gifts for the Holidays
                                    </a>
                                </h4>

                                <p class="stext-117 cl6">
                                    Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce eget dictum tortor. Donec dictum vitae sapien eu varius
                                </p>
                            </div>
                        </div>

                        <!-- item blog -->
                        <div class="p-b-63">
                            <a href="blog-detail.html" class="hov-img0 how-pos5-parent">
                                <img src="images/blog-06.jpg" alt="IMG-BLOG">

                                <div class="flex-col-c-m size-123 bg9 how-pos5">
									<span class="ltext-107 cl2 txt-center">
										16
									</span>

                                    <span class="stext-109 cl3 txt-center">
										Jan 2018
									</span>
                                </div>
                            </a>

                            <div class="p-t-32">
                                <h4 class="p-b-15">
                                    <a href="blog-detail.html" class="ltext-108 cl2 hov-cl1 trans-04">
                                        5 Winter-to-Spring Fashion Trends to Try Now
                                    </a>
                                </h4>

                                <p class="stext-117 cl6">
                                    Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce eget dictum tortor. Donec dictum vitae sapien eu varius
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 p-b-80">
                    <div class="side-menu">
                        <h4 class="mtext-112 cl2 p-b-33">
                            Featured Products
                        </h4>

                        <ul>
                            <li class="flex-w flex-t p-b-30">
                                <a href="#" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
                                    <img src="images/product-min-01.jpg" alt="PRODUCT">
                                </a>

                                <div class="size-215 flex-col-t p-t-8">
                                    <a href="#" class="stext-116 cl8 hov-cl1 trans-04">
                                        White Shirt With Pleat Detail Back
                                    </a>

                                    <span class="stext-116 cl6 p-t-20">
											$19.00
										</span>
                                </div>
                            </li>

                            <li class="flex-w flex-t p-b-30">
                                <a href="#" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
                                    <img src="images/product-min-02.jpg" alt="PRODUCT">
                                </a>

                                <div class="size-215 flex-col-t p-t-8">
                                    <a href="#" class="stext-116 cl8 hov-cl1 trans-04">
                                        Converse All Star Hi Black Canvas
                                    </a>

                                    <span class="stext-116 cl6 p-t-20">
											$39.00
										</span>
                                </div>
                            </li>

                            <li class="flex-w flex-t p-b-30">
                                <a href="#" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
                                    <img src="images/product-min-03.jpg" alt="PRODUCT">
                                </a>

                                <div class="size-215 flex-col-t p-t-8">
                                    <a href="#" class="stext-116 cl8 hov-cl1 trans-04">
                                        Nixon Porter Leather Watch In Tan
                                    </a>

                                    <span class="stext-116 cl6 p-t-20">
											$17.00
										</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
