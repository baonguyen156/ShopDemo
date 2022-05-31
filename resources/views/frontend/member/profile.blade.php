@extends('frontend.layouts.account')
@section('content')
<div class="col-sm-4">
    <div class="signup-form"><!--sign up form-->
        <h2>User UPDATE!</h2>
        <form action="#" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" name="name" value="{{$data->name}}"/>
            <input type="email" name="email" value="{{$data->email}}"/>
            <input type="password" name="password" placeholder="Password"/>
            <input type="text" name="phone" value="{{$data->phone}}"/>
            <input type="text" name="address" value="{{$data->address}}"/>
            <input type="text" name="country" value="{{$data->country}}"/>
            <input type="file" name="avatar">
            <button type="submit" class="btn btn-default" name="update">Update</button>
        </form>
    </div>
</div>
@endsection