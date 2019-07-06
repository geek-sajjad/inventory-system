@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6 mx-auto">

                @include('includes.success_alert')
                @include('includes.error_alert')
                <h3 class="my-4">all users here</h3>
{{--                <ul class="list-group">--}}
{{--                    @foreach($users as $user)--}}
{{--                        @continue(auth()->id() == $user->id)--}}
{{--                        <a href="{{route('userDetail', $user->id)}}" class="list-group-item list-group-item-action">{{$user->name}}</a>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}

                <table class="table table-dark">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">approved</th>
                        <th scope="col">Role</th>
                        <th scope="col">image</th>
                        <th scope="col">active</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)

                        @continue(auth()->id() == $user->id)
                        <tr>
                            <th scope="row">{{$user->id}}</th>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>

                            <td>{{($user->approved_at) ? "Yes" : "No "}}</td>

                            <td>{{$user->roles->first()['name']}}</td>
                            <td><img src="{{"/images/" . $user->avatar}}" alt="user image" width="50" height="50"></td>
                            <td>
                                @if(!$user->approved_at)
                                    <a href="{{route('approveUser', $user->id)}}">Approve</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach


                    </tbody>
                </table>


                <div class="my-4">
                    {{$users->links()}}
                </div>


            </div>
        </div>
    </div>


@endsection