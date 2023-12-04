@extends('layouts.master')
@section('title')
    PAYMENT
@endsection

@section('content')

    <div class="container my-8">
        <h1 class="text-center mtext-110 font-bold mb-8">To'lov qilish</h1>
        <div class="bor11 p-6 mx-auto bg-blue-100" style="width: 60%">
            <div class="my-3">
                <h1 class="text-2xl text-gray-800 font-bold">B323231 оплатите заказ!</h1>
                <p class="text-2xl text-gray-800">Сумма платежа : 8 748 000.00 сум</p>
            </div>
            <div class="mb-3">
                <label for="card_number">Card number</label>
                <input type="text" class="form-control" id="card_number" name="card_number" value="" required>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="month">Oy</label>
                    <select class="custom-select d-block w-100" id="month" name="month" required>
                        <option value="">01</option>
                        <option value="">02</option>
                        <option value="">03</option>
                        <option value="">04</option>
                        <option value="">05</option>
                        <option value="">06</option>
                        <option value="">07</option>
                        <option value="">08</option>
                        <option value="">09</option>
                        <option value="">10</option>
                        <option value="">11</option>
                        <option value="">12</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="year">Yil</label>
                    <select class="custom-select d-block w-100" id="year" name="year" required>
                        <option value="">23</option>
                        <option value="">24</option>
                        <option value="">25</option>
                        <option value="">26</option>
                        <option value="">27</option>
                        <option value="">28</option>
                        <option value="">29</option>
                        <option value="">30</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="code">code</label>
                    <input type="number" class="form-control" id="code" name="code" value="" required>
                </div>
            </div>
            <div class="mx-auto">
                <button class="btn btn-primary">
                    To'lov qilish
                </button>
            </div>
        </div>
    </div>

@endsection
