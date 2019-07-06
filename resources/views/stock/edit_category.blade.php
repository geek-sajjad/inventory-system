@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto">
                @include('includes.success_alert')
                @include('includes.error_alert')
                <div class="card my-3 p-3">
                    <h4 class="text-center">edit category</h4>
                    <form method="post" action="{{route('stock.edit.category', $category->id)}}">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">category name</label>
                            <input type="text" class="form-control" value="{{$category->name}}" name="category" id="exampleFormControlInput1" placeholder="category name">
                        </div>

                        @csrf
                        <input type="submit" value="Update" class="btn btn-block btn-lg btn-outline-info">

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection