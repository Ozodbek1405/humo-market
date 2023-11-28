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
    <div class="bg0 p-t-75 p-b-85">
        <div class="container">
            <div class="row">
                @if($cartItems->count() > 0)
                    <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                        <div class="m-l-25 m-r--38 m-lr-0-xl">
                            <a href="{{route('clearCart')}}">
                                <button class="btn btn-danger mb-2">Clear products</button>
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
                                                <a href="{{route('product.detail',$cartItem->id)}}">{{$cartItem->name}}</a>
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

                    <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                            <h4 class="mtext-109 cl2 p-b-30">
                                Cart Totals
                            </h4>
                            <div class="flex-w flex-t bor12 p-b-13">
                                <div class="size-208">
								<span class="stext-110 cl2">
									Subtotal:
								</span>
                                </div>
                                <div class="size-209">
								<span class="mtext-110 cl2">
									{{Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->subtotal()}} so'm
								</span>
                                </div>
                            </div>

                            <div class="flex-w flex-t bor12 p-t-15 p-b-30">
                                <div class="size-208 w-full-ssm">
								<span class="stext-110 cl2">
									Shipping:
								</span>
                                </div>

                                <div class="size-209 p-r-18 p-r-0-sm w-full-ssm">
                                    <p class="stext-111 cl6 p-t-2">
                                        There are no shipping methods available. Please double check your address, or contact us if you need any help.
                                    </p>
                                    <div class="p-t-15">
									<span class="stext-112 cl8">
										Calculate Shipping
									</span>
                                        <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                            <label for="region_id"></label>
                                            <select class="js-select2" name="region_id" id="region_id" required>
                                                <option value="">Tanlang</option>
                                                @foreach($regions as $region)
                                                    <option value="{{$region->region_id}}">{{$region->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs1-select2 rs2-select2 bor8 bg0 m-b-12 m-t-9">
                                            <label for="districts"></label>
                                            <select class="js-select2" name="district_id" id="districts" required>
                                                <option value="">Tanlang</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>

                                        <div class="flex-w">
                                            <div class="flex-c-m stext-101 cl2 size-115 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer">
                                                Update Totals
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="flex-w flex-t p-t-27 p-b-33">
                                <div class="size-208">
								<span class="mtext-101 cl2">
									Total:
								</span>
                                </div>

                                <div class="size-209 p-t-1">
								<span class="mtext-110 cl2">
									$79.65
								</span>
                                </div>
                            </div>

                            <button class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                                Proceed to Checkout
                            </button>
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
        $('#region_id').on('change', function() {
            var region_id = $(this).val();
            if (region_id !== "") {
                fetchData(region_id);
            }
        });
        function fetchData(region_id) {
            $.ajax({
                url: "{{route('cart.districts')}}",
                method: 'GET',
                data: { region_id: region_id },
                dataType: 'json',
                success: function(data) {
                    getChildCategories(data);
                },
                error: function() {
                    console.log('Error retrieving data.');
                }
            });
        }
        function getChildCategories(data) {
            var districts = $('#districts');
            districts.empty();
            for (var i = 0; i < data.data.length; i++) {
                var option = $('<option></option>').attr('value', data.data[i].district_id).text(data.data[i].name);
                districts.append(option);
            }
        }
        $(document).ready(function() {
            var region_id = $('#region_id').val();
            fetchData(region_id);
        });
    </script>
@endpush
