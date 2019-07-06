@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto text-center">
                @include('includes.success_alert')
                @include('includes.error_alert')
                <h4>all products</h4>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">qty</th>
                        <th scope="col">category</th>
                        <th scope="col">edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <th scope="row">{{$product->id}}</th>
                            <td>{{$product->name}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->category->name}}</td>
                            <td><a href="{{route('stock.editPage.product', $product->id)}}">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$products->links()}}
                <hr>
                <h4>add new product</h4>

                <form action="{{route('stock.products.new')}}" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleFormControlInput1">product name</label>
                        <input type="text" placeholder="product name" name="product_name" class="form-control" id="exampleFormControlInput1">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput2">product Quantity</label>
                        <input type="number" min="1" placeholder="Quantity" name="Quantity" class="form-control" id="exampleFormControlInput2">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlFile1">image file input</label>
                        <input type="file" name="image[]" class="form-control-file" id="exampleFormControlFile1" multiple>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Category select</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="category">
                            @foreach($categories as $category)
                                <option value="{{$category->name}}">{{$category->name}}</option>
                            @endforeach

                        </select>
                    </div>
                    @csrf
                    <input type="submit" value="Add" class="btn btn-block btn-lg btn-success">
                </form>



            </div>
        </div>
    </div>
@endsection