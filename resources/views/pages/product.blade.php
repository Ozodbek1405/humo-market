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
            @if (session('message'))
                <div class="alert alert-info">
                    {{ session('message') }}
                </div>
            @endif
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
                        @include('pages.filters.productFilter')
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    @include('pages.filters.products')
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

        /*-------------------
            Range Slider
        --------------------- */
        var rangeSlider = $(".price-range"),
            minamount = $("#minamount"),
            maxamount = $("#maxamount"),
            minPrice = rangeSlider.data('min'),
            maxPrice = rangeSlider.data('max');
        rangeSlider.slider({
            range: true,
            min: minPrice,
            max: maxPrice,
            @if($q_min !=null && $q_max!=null)
            values: [{{$q_min}}, {{$q_max}}],
            @else
            values: [minPrice, maxPrice],
            @endif
            slide: function (event, ui) {
                minamount.val( ui.values[0]);
                maxamount.val( ui.values[1]);
                $('#q_min').val(ui.values[0]);
                $('#q_max').val(ui.values[1]);
                setTimeout(()=>{
                    $('#productFilter').submit();
                },1000);
            }
        });
        minamount.val(rangeSlider.slider("values", 0));
        maxamount.val(rangeSlider.slider("values", 1));

        $('#minamount').on('change',function (){
            $('#q_min').val($(this).val());
            $('#productFilter').submit();
        })
        $('#maxamount').on('change',function (){
            $('#q_max').val($(this).val());
            $('#productFilter').submit();
        })
        /*------------------
            Single Product
        --------------------*/
        $('#latest').on('click',function (){
            $('#sortable').val(1);
            $('#productFilter').submit();
        });
        $('#popular').on('click',function (){
            $('#sortable').val(2);
            $('#productFilter').submit();
        });
        $('#rating').on('click',function (){
            $('#sortable').val(3);
            $('#productFilter').submit();
        });
        function productByFilterBrands(){
            let brands = "";
            $("input[name='brands']:checked").each(function (){
               if(brands === ""){
                   brands +=this.value;
               }else{
                   brands += "," + this.value;
               }
            });
            $('#brands').val(brands);
            $('#productFilter').submit();
        }
        function productByFilterColors(){
            let colors = "";
            $("input[name='product_color']:checked").each(function (){
                if(colors === ""){
                    colors += this.value;
                }else{
                    colors += "," + this.value;
                }
            });
            $('#colors').val(colors);
            $('#productFilter').submit();
        }
        function productByFilterSizes(){
            let sizes = "";
            $("input[name='product_size']:checked").each(function (){
                if(sizes === ""){
                    sizes += this.value;
                }else{
                    sizes += "," + this.value;
                }
            });
            $('#q_sizes').val(sizes);
            $('#productFilter').submit();
        }
        function productByFilterShoeSizes(){
            let shoeSizes = "";
            $("input[name='product_shoe_size']:checked").each(function (){
                if(shoeSizes === ""){
                    shoeSizes += this.value;
                }else{
                    shoeSizes += "," + this.value;
                }
            });
            $('#q_shoe_sizes').val(shoeSizes);
            $('#productFilter').submit();
        }
    </script>
@endpush
