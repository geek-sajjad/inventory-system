@extends('layouts.app')
@section('content')
    <div class="container">
        @include('includes.success_alert')
        @include('includes.error_alert')
        <div class="row">

            @foreach($products as $product)
                <div class="col-4 my-2">
                    <div class="card">
                        <div class="card-body">
                             Product Name : {{$product->name}}
                            <div class="d-flex">
                                @forelse($product->images as $image)
                                    <img width="100" class="mx-1" height="100" src="{{"/images/".$image->image}}" alt="product images">
                                @empty
                                    <img width="100" class="mx-1" height="100" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAOEAAADhCAMAAAAJbSJIAAAAJ1BMVEXt7e3V1dXW1tbm5ubs7Ozg4ODc3NzS0tLw8PDo6OjZ2dnj4+Pe3t5T9WAhAAAEmklEQVR4nO2ciXKsIBBFsQUB9f+/9+EuKjPEpe2X3FOVSTJlAmdaWRpUKQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP8Pbnh9mr4Uza+nnSpbChTTy0M/hNfKeNeXyIshW/BReaVZ4+h8zSY3lESG008rz+a30LIqFpbYDa1huxC1qovQDHAbUuG5DF3Tl8cmORdTs/Ua9VxuzUHXaA+WnsnQD90EUa1ZPlRtChoMuRobs5w0PLiGphJ5YlgNxVnGHrgeTlOuIkdD4imtx/B+qKNhzThOLF8xJE5D+4ohT2k9MLwZGD4ADG8Ghg8Aw5uB4QPINRxqdH14J9awmyG7summ5tfqJthQO1NY21wtUrKh7zJW9mqWTLLhcPDV9INYQ6XHqhXGXaqcXEM1L2/4S2k5qYbaNfP61LXEnFRDpWhJize/MIbrEAau1E6qoV75FfZKwlqmoVYmWiWmUp1ex5VpqKIQdhdkOG9/l2EcwuDYnu4UZRrq7frihSVOgYahKm2xUzw9eBNoqJy3O8Pi9CRDoqGqhv0+UQzpbKco0bAs9iEMVOeKlGeoVWpH0bnBmzxD5VMbbuhUJQUapkJI9tR5Ks+w+bBnqnRxXqr7razMx30d8gzTu4nI1nE1O8HWfkl0SDN0TXq7lKUwyYgqqrvDw9uftq1JM9RftoP57eF09PYaYYbOpNRG6vUIXLtqrH6bPk+FGX4LYdcpLripVSJbupSjMMNvISyiwZsu5sFdOlsly1Afa8Xn6Xzw9N96geTAXJShazMMi3I4WOsmejtlIMowbws4jRmbOOA2tV1dkGFoGbMMu9O0q24VZzpSSziCDKfttV8iSGOSv9wODRKjVkGGrs7Z/G0b1w/XdDy6Cz/b8rBIQYal3U7sj6j70WhoR+12AEt02CVKMdTpWVNk0TeZ4as5SgM0R8NTIYZDnTMYL7bjjpOO8uJCDFVeCKebX1Kt7tEcQ4xhXgjH/dPJgw96DCmGuyz3MdQ1pc4nj632QRRi+HXWNNJNghvz4cPwO0Uhht9nTeMfhqp+PGCf0BBimBnC8a8/fRzNdpFKhmFuCDOoZcYwa9aUyXZFXIThrTfO0qbHeN1QL+/exKbHeN1QZc6a8tnMMV431GHWdPM9s3W07/Z1Q+XKgxXfS8RZqfcN84bcP4LW6zfvG2YOuX9EGwavk9HrhvqBEEYbNt82/LTWdIFVVuptwweuwp6l23/bUD/zHJfVbsa3Df3nmcJpltP0bcPwziNR9GJaGqUbU91LG1g9BeN9w2v3GiSR0x8+9AAQSWOap4Hhzfx6Q1eNzxdiKU1F6yFshn0ILdPjcPoUCU2GLGVOeVG2p4u5aZWK68Lw/Vkavswdt/jmFDiN7A9WNB5hSf3WhoPpFKXrd9tmCi63irA8sI3mb+f2F58xvDF/n6VIwytXCFW/2Y7zyZ6TJVv3pPpnxPGzW655Ere9a+tpqLAVp2D/BNOa1TG54+1JfMXW4JDhDeCM9r5kwL+k92d4/vNFBAEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD4Y/wDpoY2HBKwqLIAAAAASUVORK5CYII=" alt="rthrh">
                                @endforelse

                            </div>

                            <form action="{{route('suppliant.addProduct' , $product->id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="qty">your need qty</label>
                                    <input class="form-control" type="number" name="qty" id="qty" min="1">
                                </div>
                                <button type="submit" class="btn btn-secondary">select this</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach



        </div>
        <div class="row">
            <div class="col-6 mx-auto">
                @if($orderItems)
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product name</th>
                        <th scope="col">need qty</th>
                        <th scope="col">delete</th>
                    </tr>
                    </thead>
                    <tbody>
{{--                        <tr>--}}
{{--                            <th scope="row">1</th>--}}
{{--                            <td>Product one</td>--}}
{{--                            <td>12</td>--}}
{{--                            <td>Hello How are u bob ?</td>--}}
{{--                            <td>2019/02/15</td>--}}
{{--                            <td>checking by stock</td>--}}
{{--                        </tr>--}}

                        @forelse($orderItems as $orderItem)
                            <tr>
                                <th scope="row">1</th>
                                <td>{{$orderItem->product->name}}</td>
                                <td>{{$orderItem->qty}}</td>
                                <td><a href="{{route('suppliant.delete.orderItem', $orderItem->id)}}">delete</a></td>

                            </tr>
                        @empty
                            <p>nothing</p>
                        @endforelse


                    </tbody>
                </table>
                @endif

            </div>
        </div>
    </div>

@endsection