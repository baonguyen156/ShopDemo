@extends('admin.layouts.app')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Category</h4>
            <h6 class="card-subtitle">Category</h6>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $category)
                    <tr>
                        <th scope="row">{{$category->id}}</th>
                        <td>{{$category->category}} </td>
                        <td><a href="{{url('/admin/category/delete/'.$category->id)}}">Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button class="btn btn-success"><a href="{{ asset ('/admin/category/addcategory') }}">Add Category</a></button>
            </div>
        </div>
    </div>
</div>
@endsection