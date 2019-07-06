@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <p>name : {{$user->name}}</p>
                @if($user->approved_at)
                    <img src="https://image.flaticon.com/icons/png/512/1893/1893646.png" alt="active image" width="50" height="50">
                @else
                    <img src="https://image.flaticon.com/icons/svg/291/291202.svg" width="50" height="50">
                @endif


                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">approved</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Ali</td>
                        <td>Ali@me.com</td>
                        <td>Yes</td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection