@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-10 mx-auto text-center" >
                @include('includes.success_alert')
                @include('includes.error_alert')
                @if($order)
                    <p>order id : {{$order->id}}</p>
                    <p>order status : {{$order->status}}</p>
                    <p>user image : <img src="{{"/images/".$order->user->avatar}}" width="50" height="50" alt="user avatar"></p>
                    <p>order user name : {{$order->user->name}}</p>
                @endif
                <hr color="red">
                @if($orderItems)
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">product name</th>
                            <th scope="col">qty</th>
                            <th scope="col">qty in stock</th>
                            <th scope="col">status</th>
                            <th scope="col">comment</th>
                            <th scope="col">created at</th>
                            <th scope="col">confirm/cancel</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($orderItems as $index=>$orderItem)
                                <tr>
                                    <th scope="row">{{++$index}}</th>
                                    <td>{{$orderItem->product->name}}</td>
                                    <td>{{$orderItem->qty}}</td>
                                    <td>{{$orderItem->product->quantity}}</td>
                                    <td>{{$orderItem->status}}</td>
                                    <td>
                                        <form action="{{route('order.submit.comment', $orderItem->id)}}" method="post">
                                            @csrf
                                            <textarea name="comment">{{$orderItem->comment}}</textarea>
                                            <button type="submit">send comment</button>
                                        </form></td>
                                    <td>{{$orderItem->created_at}}</td>
                                    <td>
                                        @if($orderItem->status=='Approved')
                                            Confirmed
                                        @elseif(($orderItem->status=='Checking By Deputy') )
                                            added to the buying list
                                        @elseif(($orderItem->status=='Canceled') )
                                            Canceled
                                        @elseif($orderItem->status=='Checking By Logistic')
                                           approved by deputy , waiting for buying by logistic
                                        @elseif($orderItem->qty <= $orderItem->product->quantity)
                                            <a href="{{route('stock.order.confirm', $orderItem->id)}}" class="btn btn-success">Confirm</a>
                                            <a href="{{route('stock.order.cancel', $orderItem->id)}}" class="btn btn-danger">Cancel</a>
                                        @else
                                            <a href="{{route('stock.order.request', $orderItem->id)}}" class="btn btn-dark">Request for buying</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

{{--                            @if($orderItem->qty <= $orderItem->product->quantity)--}}
{{--                                <p><a href="#" class="btn btn-success">Confirm</a></p>--}}
{{--                            @else--}}
{{--                                <p><a href="#" class="btn btn-dark">Request for buying</a></p>--}}
{{--                            @endif--}}


                        <hr>

                @endif
            </div>
        </div>
    </div>

@endsection