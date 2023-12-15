@extends('layouts.master')
@section('title')
    ORDER
@endsection

@section('content')
    <div class="container">
        <div class="pt-5 text-center">
            <p class="lead">
                Оформление заказа
            </p>
        </div>

        <div class="row py-5">
            <div class="col-md-8">
                <form class="needs-validation">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="phone">Phone number</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="fullname">F.I.O</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" value="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="region">Viloyat</label>
                            <select class="custom-select d-block w-100" id="region" name="region_id" required>
                                <option value="">Tanlang...</option>
                                @foreach($regions as $region)
                                    <option value="{{$region->region_id}}">{{$region->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="district">Tuman</label>
                            <select class="custom-select d-block w-100" id="district" name="district_id" required>
                                <option value="">Tanlang...</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="village">Aholi punkti</label>
                        <select class="custom-select d-block w-100" id="village" name="village_id" required>
                            <option value="">Tanlang...</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="address">Manzil</label>
                        <input type="text" class="form-control" name="address" id="address" placeholder="manzil" required>
                    </div>

                    <div class="mb-3">
                        <label for="address2">Qo'shimcha manzil</label>
                        <input type="text" class="form-control" name="address2" id="address2" placeholder="qo'shimcha manzil">
                    </div>

                    <button class="btn btn-primary btn-lg btn-block my-3" type="submit">Continue to checkout</button>
                </form>
            </div>

            <div class="col-md-4 mt-4">
                <div>

                </div>
                <div class="bor14 border-2 mx-4 text-center p-6 bg-gray-100">
                    <h4 class="text-xl font-semibold text-blue-500 p-b-30 text-2xl">
                        Savatda {{count($cartItems)}} ta mahsulot bor
                    </h4>
                    <div class="flex-col text-md">
                        <h1 class="font-semibold">Mahsulotning narxi : </h1>
                        <h2 class="my-2 text-purple-600">{{Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->subtotal()}} so'm</h2>
                    </div>
                    <div class="flex-col text-md">
                        <h1 class="font-semibold">Yetkazib berish narxi : </h1>
                        <h2 class="my-2 text-purple-600">20000 so'm</h2>
                    </div>
                    <div class="flex-col text-md">
                        <h1 class="font-semibold">Umumiy qiymat : </h1>
                        <h2 class="my-2 text-purple-600 text-xl">2,420,000.00 so'm</h2>
                    </div>
                    @foreach($cartItems as $cartItem)
                        <div class="flex my-3">
                            <div class="col-md-4">
                                <img src="{{asset('storage/uploads/'.$cartItem->options['image'])}}" alt="#"
                                     style="width: 70px;height: 70px;border-radius: 10px">
                            </div>
                            <div class="col-md-8 text-center">
                                <p class="text-gray-600">{{$cartItem->name}}</p>
                                <p class="">{{$cartItem->qty}} ta</p>
                                <h1 class="product_proce">{{$cartItem->price}} so'm</h1>
                            </div>
                        </div>
                        <a href="{{route('removeItem',$cartItem->rowId)}}">
                            <i class="fa fa-trash"></i><span class="mx-2">o'chirish</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#region').on('change', function() {
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
                    getRegions(data);
                },
                error: function() {
                    console.log('Error retrieving data.');
                }
            });
        }
        function getRegions(data) {
            var districts = $('#district');
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
