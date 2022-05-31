@extends('admin.layouts.app')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Country</h4>
            <h6 class="card-subtitle">Country</h6>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">id</th>
                        <th scope="col">Country</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($country as $country)
                    <tr>
                        <th scope="row">{{$country->id}}</th>
                        <td>{{$country->name}} </td>
                        <td><a href="{{url('/admin/country/delete/'.$country->id)}}">Delete</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button class="btn btn-success"><a href="{{ asset ('/admin/country/addcountry') }}">Add Country</a></button>
            </div>
        </div>
    </div>
</div>
@endsection