@extends('admin.layouts.app')
@section('content')

@if($errors->any())
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
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
                    <input type="text" name="title" class="form-control form-control-line">
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
                    <input type="text" name="description" class="form-control form-control-line">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-12">Content</label>
                <div class="col-md-12">
                    <textarea name="content" id="demo" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <button class="btn btn-success" type="submit">Create Blog</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection