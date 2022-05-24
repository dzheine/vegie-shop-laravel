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
                @if(Auth::user()->role_id === 1)    
                <form action="{{route('order.index')}}" method="GET">
                    <label for="all_orders">Show all orders</label>
                    <input name="all_orders" type="checkbox" value="all_orders">
                    <input type="submit" value="Filter">
                </form>
                @endif
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
                                    @if(Auth::user()->role_id === 1)  
                                    <form class="d-inline-block" action="{{ route('order.destroy', $order->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                    @endif
                                </td>
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
