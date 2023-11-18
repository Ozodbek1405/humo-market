@extends('voyager::master')


@section('content')

    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
                        @if (session('success'))
                            <div class="alert alert-danger">
                                {{ session('success') }}
                            </div>
                        @endif
                        <h2>Manage <b>Products</b></h2>
                        <a href="{{route('product.create')}}" class="btn btn-success">
                            <span class="icon voyager-plus"> Add New Product</span>
                        </a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Title</th>
                    <th>Product count</th>
                    <th>Dimensions</th>
                    <th>Weight</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->discount}}</td>
                        <td>{{$product->title}}</td>
                        <td>{{$product->count}}</td>
                        <td>{{$product->dimensions}}</td>
                        <td>{{$product->weight}}</td>
                        <td>
                            <a href="{{route('product.edit',$product->id)}}" class="edit">
                                <span class="icon voyager-edit"></span>
                            </a>
                            <a href="#" class="delete">
                                <span class="icon voyager-trash" data-toggle="modal" data-target="#deleteModal{{$product->id}}"></span>
                            </a>
                        </td>
                    </tr>
                    <!--Delete Modal -->
                    <div class="modal fade" id="deleteModal{{$product->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    Haqiqatdan ham o'chirmoqchimisiz
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Yo'q</button>
                                    <button type="button" class="btn btn-danger">
                                        <a href="{{route('products.delete',$product->id)}}">Ha</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>

@endsection
