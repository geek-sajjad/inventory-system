@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto text-center" >
                <a href="{{route('suppliant.order.new')}}" class="my-2 btn btn-lg btn-block btn-primary">New Order</a>
                <a href="{{route('suppliant.orders')}}" class="my-2 btn btn-lg btn-block btn-success">see all orders</a>
            </div>
        </div>
    </div>

@endsection