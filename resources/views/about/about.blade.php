@extends('layouts.master')
@section('title')
    ABOUT
@endsection

@section('content')

    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url({{asset('images/bg-02.jpg')}});">
        <h2 class="ltext-105 cl0 txt-center">
            About
        </h2>
    </section>

    <!-- Content page -->
    <section class="bg0 p-t-75 p-b-120">
        <div class="container">
            @foreach($abouts as $about)
                <div class="row p-b-148">
                    <div class="col-md-7 col-lg-8">
                        <div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
                            <h3 class="mtext-111 cl2 p-b-16">
                                {{$about->getTranslatedAttribute('title')}}
                            </h3>
                            <p class="stext-113 cl6 p-b-26">
                                {{$about->getTranslatedAttribute('text')}}
                            </p>
                        </div>
                    </div>

                    <div class="col-11 col-md-5 col-lg-4 m-lr-auto">
                        <div class="how-bor1 ">
                            <div class="hov-img0">
                                <img src="{{ asset('storage/'.$about->image) }}" alt="IMG">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

@endsection
