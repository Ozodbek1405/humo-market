@extends('layouts.master')
@section('title')
    SHOP
@endsection

@push('styles')
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
@endpush
@section('content')

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            @if (session('message'))
                <div class="alert alert-info">
                    {{ session('message') }}
                </div>
            @endif
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb__links">
                            <a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a>
                            <a href="{{route('product.category.all')}}">Categories</a>
                            <a href="{{route('product.category',$category->slug)}}">{{$category->name}}</a>
                            <a href="{{route('product.category.parent',['slugName' => $category->slug,'parentSlug'=>$parent_category->slug])}}">
                                {{$parent_category->getTranslatedAttribute('name')}}
                            </a>
                            <span>{{$child_category->getTranslatedAttribute('name')}}</span>
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
                        @include('products.filters.childCategoryFilter')
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    @include('products.filters.products')
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
@endsection
@push('scripts')
    @include('products.filters.scriptFilter')
@endpush
