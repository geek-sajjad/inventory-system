@extends('layouts.app')


@section('content')

    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <h3 class="my-3 text-center">profile</h3>
                    <div class="card-body">
                        <div>
{{--                            @if ($message = Session::get('success'))--}}

{{--                                <div class="alert alert-success alert-block">--}}

{{--                                    <button type="button" class="close" data-dismiss="alert">×</button>--}}

{{--                                    <strong>{{ $message }}</strong>--}}

{{--                                </div>--}}

{{--                            @endif--}}
                            @include('includes.success_alert')

{{--                            @if (count($errors) > 0)--}}
{{--                                <div class="alert alert-danger">--}}
{{--                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>--}}
{{--                                    <ul>--}}
{{--                                        @foreach ($errors->all() as $error)--}}
{{--                                            <li>{{ $error }}</li>--}}
{{--                                        @endforeach--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            @endif--}}
                            @include('includes.error_alert')


                            <form action="{{route('image.upload')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="file" name="image_input">
                                <input type="submit" value="submit" >
                            </form>
                        </div>
                        <div class="my-4">
                            @if (auth()->user()->avatar!= "user.jpg")
                                <img src="/images/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                            @else
                                <img src="https://www.lewesac.co.uk/wp-content/uploads/2017/12/default-avatar.jpg" alt="avatar image" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                            @endif
                        </div>
                        @if (auth()->user()->avatar!= "user.jpg")
                            <a href="{{route('delete_photo')}}" class="btn btn-danger">Delete my photo</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection