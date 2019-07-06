@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto">
                    @include('includes.success_alert')
                    @include('includes.error_alert')

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">products count</th>
                            <th scope="col">edit</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{$category->products->count()}}</td>
                                <td><a href="{{route('stock.editPage.category', $category->id)}}">edit</a></td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{$categories->links()}}

                <div class="card my-3 p-3">
                    <h4 class="text-center">add new category</h4>
                    <form method="post" action="{{route('stock.new.category')}}">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">category name</label>
                            <input type="text" class="form-control" name="category" id="exampleFormControlInput1" placeholder="category name">
                        </div>

                        @csrf
                        <input type="submit" value="Add" class="btn btn-block btn-lg btn-success">

                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection