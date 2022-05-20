@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Products') }}

                <a class="btn btn-success" href="{{route('products.create')}}">Create Product</a>
                </div>

                <div class="card-body">

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message}}</p>
                    </div>
                    @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Ordered</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->orders->count()}}</td>
                                    <td><a href="{{route('product.edit', $product->id)}}"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <!-- <a href="{{route('product.destroy', $product->id)}}"><i class="fa-solid fa-trash-can"></i></a></td>  -->
                                    <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
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
