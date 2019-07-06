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
                        <th scope="col">need qty to buy</th>
                        <th scope="col">your bought qty</th>
                        <th scope="col">ok</th>
                        <th scope="col">cancel</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($buyingLists as $buyingList)
                        <tr>
                            <th scope="row">{{$buyingList->id}}</th>
                            <td>{{$buyingList->product->name}}</td>
                            <td>{{$buyingList->need_qty}}</td>
                            <td>
                                <form action="{{route('logistic.bought', $buyingList->id)}}" method="post">
                                    <label for="num_input">bought qty</label>
                                    <input class="form-control" type="number" id="num_input" min="1" name="bought_qty">
                                    @csrf
                                    <button type="submit" class="btn btn-success">ok</button>
                                </form>

                            </td>
                            <th><a class="btn btn-danger" href="{{route('logistic.cancel', $buyingList->id)}}">cancel</a></th>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection