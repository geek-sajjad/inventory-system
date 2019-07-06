@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8 mx-auto">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product name</th>
                            <th scope="col">qty</th>
                            <th scope="col">comment</th>
                            <th scope="col">created at</th>
                            <th scope="col">status</th>
                        </tr>
                        </thead>
                        <tbody>
{{--                        <tr>--}}
{{--                            <th scope="row">1</th>--}}
{{--                            <td>Product one</td>--}}
{{--                            <td>12</td>--}}
{{--                            <td>Hello How are u bob ?</td>--}}
{{--                            <td>2019/02/15</td>--}}
{{--                            <td>checking by stock</td>--}}
{{--                        </tr>--}}
                        @foreach($order->orderItems as $index=>$orderItem)
                            <tr>
                                <th scope="row">{{++$index}}</th>
                                <td>{{$orderItem->product->name}}</td>
                                <td>{{$orderItem->qty}}</td>
                                <td>{{$orderItem->comment}}</td>
                                <td>{{$orderItem->created_at}}</td>
                                <td class="{{ ($orderItem->status=='Approved')?"text-success":(($orderItem->status=='Canceled') ? "text-danger" : "text-info")}}" >{{$orderItem->status}}</td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
            </div>


        </div>
    </div>

@endsection