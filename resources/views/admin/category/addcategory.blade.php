@extends('admin.layouts.app')
@section('content')
<form action="{{url('/admin/category/addcategory')}}" method='post' class="form-horizontal m-t-30">
    @csrf
    <div class="form-group">
        <label>Category</label>
        <input type="text" class="form-control" name="category">
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <button type="submit" class="btn btn-success">Add Category</button>
        </div>
    </div>
</form>
@endsection