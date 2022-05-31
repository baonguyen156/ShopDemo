@extends('frontend.layouts.form')
@section('content')
<div class="col-sm-4 col-sm-offset-1">
    <div class="login-form"><!--login form-->
        <h2>Login to your account</h2>
        <form action="" method="post">
            @csrf
            <input type="text" name="email" placeholder="Email Address" />
            <input type="password" name="password" placeholder="Password" />
            <span>
                <input type="checkbox" name="remember_me" class="checkbox"> 
                Keep me signed in
            </span>
            <button type="submit" class="btn btn-default">Login</button>
        </form>
        <p></p>
        <p>If you dont have account <a href="{{url('/member-register')}}">Click here</a> to register</p>
        @if($errors->any())
        <div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div><!--/login form-->
</div>
@endsection