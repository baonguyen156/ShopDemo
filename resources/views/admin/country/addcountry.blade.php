@extends('admin.layouts.app')
@section('content')
<form action="{{url('/admin/country/addcountry')}}" method='post' class="form-horizontal m-t-30">
    @csrf
    <div class="form-group">
        <label>Country</label>
        <input type="text" class="form-control" name="country">
    </div>
    <div class="form-group">
        <div class="col-sm-12">
            <input type="submit" class="btn btn-success">Add Country</input>
        </div>
    </div>
</form>
@endsection