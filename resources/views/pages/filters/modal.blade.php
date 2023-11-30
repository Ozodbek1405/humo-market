<!-- Modal1 -->
<div class="wrap-modal1 js-modal{{$product->id}} p-t-60 p-b-20">
    <div class="overlay-modal1 js-hide-modal{{$product->id}}"></div>

    <div class="container">
        <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
            <button class="how-pos3 hov3 trans-04 js-hide-modal{{$product->id}}">
                <img src="{{asset('images/icons/icon-close.png')}}" alt="CLOSE">
            </button>
            @include('components.productFigure')
        </div>
    </div>
</div>
