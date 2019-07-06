@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto text-center" >
                <h2 class="mb-4">Stock Manager Panel</h2>
                <a href="{{route('stock.products')}}" class="btn btn-lg btn-block btn-primary">Add / Edit Products</a>
                <a href="{{route('stock.categories')}}" class="btn btn-lg btn-block btn-dark">Add / Edit Category</a>
                <a href="{{route('stock.orders')}}" class="btn btn-lg btn-block btn-success">manage orders</a>
{{--                <a href="#" class="btn btn-lg btn-block btn-warning">request for buying</a>--}}
            </div>
        </div>
    </div>

@endsection