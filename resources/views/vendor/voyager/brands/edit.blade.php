@extends('voyager::master')

@section('content')
    <link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css" rel="stylesheet">
    <section class="container">
        <div style="margin-bottom: 30px">
            <h2>Edit <b>Brands</b></h2>
        </div>
        <form action="{{route('brands.admin.update',$brand->id)}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="order">Order</label>
                <input type="number" class="form-control" id="order" name="order" placeholder="order" value="{{old('order',$brand->order)}}">
                @error('order')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="name" value="{{old('name',$brand->name)}}">
                @error('name')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" class="form-control" id="slug" name="slug" placeholder="slug" value="{{old('slug',$brand->slug)}}">
                @error('slug')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="parent_id">Parent category ID</label>
                <select multiple class="form-control" id="parent_id" name="parent_id[]">
                    @foreach($parent_categories as $parent_category)
                        <option value="{{$parent_category->id}}" @selected(in_array($parent_category->id,$brand->getParentCategoryArray()))>
                            {{$parent_category->name}}
                        </option>
                    @endforeach
                </select>
                @error('parent_id')
                <p style="color: #f11313">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </section>
    @include('vendor.voyager.products.script')
@endsection
