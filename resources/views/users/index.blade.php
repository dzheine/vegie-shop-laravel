@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Users') }}

                <!-- <a class="btn btn-success" href="{{route('products.create')}}">Create Product</a> -->
                </div>

                <div class="card-body">

                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message}}</p>
                    </div>
                    @endif
                    <form action="{{route('user.index')}}" method="GET">
                        <label for="by_name">Show user by name</label>
                        <input name="by_name" type="checkbox" value="by_name">
                        <input type="submit" value="Filter">

                    </form>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Orders made</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->orders->count()}}</td>
                                    <td>
                                    @if($user->orders->count()===0)
                                    <form class="d-inline-block" action="{{ route('user.destroy', $user->id) }}" method="POST">
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
