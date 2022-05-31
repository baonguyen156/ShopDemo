@extends('admin.layouts.app')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Blog</h4>
            <h6 class="card-subtitle">Blog</h6>
        </div>
        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal form-material">
            @csrf
            <div class="form-group">
                <label class="col-md-12">Title</label>
                <div class="col-md-12">
                    <input type="text" value="{{$data->title}}" name="title" class="form-control form-control-line">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12">Image</label>
                <div class="col-md-12">
                    <input type="file" class="form-control form-control-line" name="file">
                </div>
            </div>  
            <div class="form-group">
                <label class="col-md-12">Description</label>
                <div class="col-md-12">
                    <input type="text" value="{{$data->description}}" name="description" class="form-control form-control-line">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12">Content</label>
                <div class="col-md-12">
                    <textarea name="content" id="demo" class="form-control">{{$data->content}}</textarea>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-12">
                    <button class="btn btn-success" type="submit">Edit Blog</button>
                </div>
            </div>
        </form>
        @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
            {{session('success')}}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
            <ul>
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
@endsection