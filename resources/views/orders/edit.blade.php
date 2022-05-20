@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit order') }}</div>

                <div class="card-body">

            
                    <form method="POST" action="{{ route('order.update'), ['id'=> $orders->id]) }}">
                        @csrf
                        
                                <div class="row mb-3">
                                    <select class="form-select" name="product[]" id="product" multiple>
                                        @foreach ($products as $product)
                                        <option value="{{$product->id}}">{{$product->name}}, {{$product->price}}</option>
                                        @endforeach
                                    </select>

                                    <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __(' Update Order') }}
                                        </button>
                                    </div>
                                </div>
                                
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
