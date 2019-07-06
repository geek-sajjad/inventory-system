@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto">
                @if(count($orders))
                    <table class="table">
                        <thead>

                        <tr>
                            <th scope="col">id</th>
                            <th scope="col">Status</th>
                            <th scope="col">view</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as  $index =>$order)

                            <tr>
                                <th scope="row">{{++$index}}</th>
                                <td class="{{($order->status == 'open') ? "text-success" : "text-danger"}}">{{ucfirst($order->status)}}</td>
                                <td><a href="{{route('suppliant.order', $order->id)}}">view more</a></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{$orders->links()}}
                @else
                    <p class="text-center">empty</p>
                @endif
            </div>
        </div>
    </div>

@endsection