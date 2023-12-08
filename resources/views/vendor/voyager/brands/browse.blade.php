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
                        <h2>Manage <b>Brands</b></h2>
                        <a href="{{route('brands.admin.create')}}" class="btn btn-success">
                            <span class="icon voyager-plus"> Add New Brands</span>
                        </a>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Order</th>
                    <th>Name</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($brands as $brand)
                    <tr>
                        <td>{{$brand->id}}</td>
                        <td>{{$brand->order}}</td>
                        <td>{{$brand->name}}</td>
                        <td>{{$brand->slug}}</td>
                        <td>
                            <a href="{{route('brands.admin.edit',$brand->id)}}" class="edit">
                                <span class="icon voyager-edit"></span>
                            </a>
                            <a href="#" class="delete">
                                <span class="icon voyager-trash" data-toggle="modal" data-target="#deleteModal{{$brand->id}}"></span>
                            </a>
                        </td>
                    </tr>
                    <!--Delete Modal -->
                    <div class="modal fade" id="deleteModal{{$brand->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    Haqiqatdan ham o'chirmoqchimisiz
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Yo'q</button>
                                    <button type="button" class="btn btn-danger">
                                        <a href="{{route('brands.admin.delete',$brand->id)}}">Ha</a>
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
