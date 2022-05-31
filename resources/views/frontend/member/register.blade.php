@extends('frontend.layouts.form')
@section('content')
<div class="col-sm-4">
    <div class="signup-form"><!--sign up form-->
        <h2>New User Signup!</h2>
        <form action="" method="post">
            @csrf
            <input type="text" name="name" placeholder="Name"/>
            <input type="email" name="email" placeholder="Email Address"/>
            <input type="password" name="password" placeholder="Password"/>
            <button type="submit" class="btn btn-default">Signup</button>
        </form>
    </div><!--/sign up form-->
</div>
@endsection