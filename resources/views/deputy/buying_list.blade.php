@extends('layouts.app')

@section('content')
    <div class="container">
        @include('includes.success_alert')
        @include('includes.error_alert')
        <div class="row">

            <div class="col-8 mx-auto">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">product name</th>
{{--                        <th scope="col">stock qty</th>--}}
                        <th scope="col">need qty</th>
                        <th scope="col">status</th>
                        <th scope="col">created at</th>
                        <th scope="col">approve/cancel</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($buyingLists as $buyingList)
                        <tr>
                            <th scope="row">{{$buyingList->id}}</th>
                            <td>{{$buyingList->product->name}}</td>
{{--                            <td>{{$buyingList->product->quantity}}</td>--}}
                            <td>{{$buyingList->need_qty}}</td>
                            <td>{{$buyingList->status}}</td>
                            <td>{{$buyingList->created_at}}</td>
                            @if($buyingList->status == 'Checking By Deputy')
                                <td><a href="{{route('deputy.buyingList.approve', $buyingList->id)}}" class="btn btn-success">approve</a>
                                    <a href="{{route('deputy.buyingList.cancel', $buyingList->id)}}" class="btn btn-danger">cancel</a></td>
                            @elseif($buyingList->status == 'Checking By Logistic')
                                <td>approved</td>
                            @else
                                <td>{{$buyingList->status}}</td>
                            @endif

                        </tr>
                    @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection