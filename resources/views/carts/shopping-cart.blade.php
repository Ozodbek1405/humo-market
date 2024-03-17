@extends('layouts.master')
@section('title')
    SHOPPING CART
@endsection

@section('content')
    <!-- breadcrumb -->
    <div class="container">
        @if (session('message'))
            <div class="alert alert-info mt-2">
                {{ session('message') }}
            </div>
        @endif
        <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
            <a href="{{route('home')}}" class="stext-109 cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="stext-109 cl4">
				Shoping Cart
			</span>
        </div>
    </div>


    <!-- Shoping Cart -->
    <div class="bg0 p-t-40 p-b-85">
        <div class="container">
            <div class="row">
                @if($cartItems->count() > 0)
                    <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                        <div class="m-r--38 m-lr-0-xl">
                            <a href="{{route('clearCart')}}">
                                <button class="btn btn-danger mb-3">Clear products</button>
                            </a>
                            <div class="wrap-table-shopping-cart">
                                <table class="table-shopping-cart">
                                    <tr class="table_head">
                                        <th class="column-1">Product</th>
                                        <th class="column-2"></th>
                                        <th class="column-3">Price</th>
                                        <th class="column-4">Quantity</th>
                                        <th class="column-5">Total</th>
                                        <th class="column-6">Action</th>
                                    </tr>
                                    @foreach($cartItems as $cartItem)
                                        <tr class="table_row text-center">
                                            <td class="column-1">
                                                <div class="how-itemcart1">
                                                    <img src="{{asset('storage/uploads/'.$cartItem->options['image'])}}" alt="IMG">
                                                </div>
                                            </td>
                                            <td class="column-2">
                                                <a href="{{route('product.detail',$cartItem->id)}}">
                                                    @if(session('lang') == "uz")
                                                        {{$cartItem->name_uz}}
                                                    @else
                                                        {{$cartItem->name_en}}
                                                    @endif
                                                </a>
                                            </td>
                                            <td class="column-3">{{$cartItem->price}} so'm</td>
                                            <td class="column-4">
                                                <div class="wrap-num-products flex-w m-l-auto m-r-0">
                                                    <input class="mtext-104 cl3 text-center num-products" data-rowid="{{$cartItem->rowId}}"
                                                           onchange="updateData(this)" type="number" name="num-product1" value="{{$cartItem->qty}}">
                                                </div>
                                            </td>
                                            <td class="column-5">{{$cartItem->subtotal()}} so'm</td>
                                            <td class="column-6">
                                                <a href="{{route('removeItem',$cartItem->rowId)}}">
                                                    <button class="btn btn-dark">x</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50 mt-5">
                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                            <h4 class="mtext-109 cl2 p-b-30">
                                Cart Totals
                            </h4>
                            <div class="flex-w flex-t p-b-18">
                                <h1 class="text-xl text-gray-800">Savatda {{count($cartItems)}} ta tovar bor</h1>
                            </div>

                            <div class="flex-w flex-t bor12 p-b-13">
                                <div class="size-208">
								<span class="stext-110 cl2">
									Umumiy qiymati:
								</span>
                                </div>
                                <div class="size-209">
								<span class="mtext-110 cl2">
									{{Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->subtotal()}} so'm
								</span>
                                </div>
                            </div>

                            <a href="{{route('orders.view')}}" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 trans-04 pointer mt-5">
                                Buyurtma
                            </a>
                        </div>
                    </div>
                @else
                    <div class="container-fluid  mt-100">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <h1 class="font-bold text-blue-500">Your cart is empty!</h1>
                                <img style="width: 500px;height: 500px" src="{{asset('/images/empty-cart.png')}}" alt="empty-cart">
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <form action="{{route('updateCart')}}" method="POST" class="hidden" id="updateCart">
        @csrf
        @method('put')
        <input type="hidden" name="rowId" id="rowId">
        <input type="hidden" name="quantity" id="quantity">
    </form>
@endsection
@push('scripts')
    <script>
        function updateData(qty)
        {
            $('#rowId').val($(qty).data('rowid'))
            $('#quantity').val($(qty).val())
            $('#updateCart').submit();
        }
    </script>
@endpush
