@extends('layouts.app')

@section('content')
<div class="container">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message}}</p>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My orders') }}</div>
                <a class= "btn btn-primary" href="{{route('order.create')}}">Create new order</a>

                <div class="card-body">
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Products</th>
                                <th>Ordered amount</th>
                                <th>Order created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>
                                        @foreach($order->products as $product)
                                        {{ $product->name }},
                                        @endforeach
                                    </td>
                                    <td>{{ $order->order_amount }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td><a href="{{route('order.edit', $order->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <a href="#"><i class="fa-solid fa-trash-can"></i></a></td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
