@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <form action="#" method="post">
                    @csrf
                    <input type="text" name="product" value="product one" class="form-control">
                    <input type="number" name="qty" class="form-control" id="numberInput" min="1">
                    <input type="submit" value="request">
                </form>
            </div>
        </div>
    </div>
@endsection