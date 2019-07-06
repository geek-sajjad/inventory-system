@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto text-center">
                @include('includes.success_alert')
                @include('includes.error_alert')
                <h4>edit product</h4>

                <form action="{{route('stock.edit.product', $product->id)}}" method="post" enctype="multipart/form-data">
                    <div class="my-4 d-flex justify-content-around">
                        @forelse($product->images as $image)
                            <img src="/images/{{$image->image}}" class="img-thumbnail" width="200" height="200" alt="product image">
                        @empty
                            <strong class="text-danger">No image !</strong>
                        @endforelse
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1">product name</label>
                        <input type="text" placeholder="product name" value="{{$product->name}}" name="product_name" class="form-control" id="exampleFormControlInput1">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput2">product Quantity</label>
                        <input type="number" value="{{$product->quantity}}" min="1" placeholder="Quantity" name="Quantity" class="form-control" id="exampleFormControlInput2">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">add image</label>
                        <input type="file" name="image[]" class="form-control-file" id="exampleFormControlFile1" multiple>
                    </div>

{{--                    <div class="form-group">--}}
{{--                        <label for="exampleFormControlSelect1">Category select</label>--}}
{{--                        <select class="form-control" id="exampleFormControlSelect1" name="category">--}}
{{--                            @foreach($categories as $category)--}}
{{--                                <option value="{{$category->name}}">{{$category->name}}</option>--}}
{{--                            @endforeach--}}

{{--                        </select>--}}
{{--                    </div>--}}
                    @csrf
                    <input type="submit" value="Update" class="btn btn-block btn-lg btn-success">
                </form>
            </div>
        </div>
    </div>

@endsection