@extends('admin.layouts.app')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Blog</h4>
            <h6 class="card-subtitle">Blog</h6>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Title</th>
                        <th scope="col">Image</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $data)
                    <tr>
                        <th scope="row">{{$data->id}}</th>
                        <td>{{$data->title}}</td>
                        <td>{{$data->image}}</td>
                        <td>{{$data->description}}</td>
                        <td><a href="{{url('/admin/blog/edit/'.$data->id)}}">Edit</a>
                        <a href="{{url('/admin/blog/delete/'.$data->id)}}">Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button class="btn btn-success"><a href="{{ asset ('/admin/blog/add') }}">Add Blog</a></button>
            </div>
        </div>
    </div>
</div>
@endsection