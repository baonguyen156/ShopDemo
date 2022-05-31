@extends('admin.layouts.app')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Brand</h4>
            <h6 class="card-subtitle">Brand</h6>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brand as $brand)
                    <tr>
                        <th scope="row">{{$brand->id}}</th>
                        <td>{{$brand->brand}} </td>
                        <td><a href="{{url('/admin/brand/delete/'.$brand->id)}}">Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button class="btn btn-success"><a href="{{ url ('/admin/brand/addbrand') }}">Add Brand</a></button>
            </div>
        </div>
    </div>
</div>
@endsection