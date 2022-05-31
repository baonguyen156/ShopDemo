@extends('frontend.layouts.app')
@section('content')
<div class="blog-post-area">
    <h2 class="title text-center">Latest From our Blog</h2>
    @foreach ($blogs as $blogData)
    <div class="single-blog-post">
        <h3>{{$blogData->title}}</h3>
        <div class="post-meta">
            <ul>
                <li><i class="fa fa-user"></i> Mac Doe</li>
                <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
            </ul>
            <span>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-half-o"></i>
            </span>
        </div>
        <a href="">
            <img src="{{ asset ('blog/'.$blogData->image) }}" width="847px" height="392px" >
        </a>
        <p>{{$blogData->description}}</p>
        <a  class="btn btn-primary" href="{{ url('/blog/blog-single/'.$blogData->id) }}">Read More</a>
    </div>
    @endforeach
    <div class="pagination-area">
        {{ $blogs->links() }}
    </div>
</div>
@endsection('content')