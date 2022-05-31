@extends('admin.layouts.app')
@section('content')
<form action="{{url('/admin/brand/addbrand')}}" method='post' class="form-horizontal m-t-30">
    @csrf
    <div class="form-group">
        <label>Brand</label>
        <input type="text" class="form-control" name="brand">
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-success">Add Brand</button>
        </div>
    </div>
</form>
@endsection