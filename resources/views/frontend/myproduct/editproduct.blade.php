@extends('frontend.layouts.account')
@section('content')
<div class="col-sm-4">
    <h3>Edit Product</h3>
    <div class="signup-form">
        <form action="" method = "post" enctype="multipart/form-data">
            @csrf
            <input type="text" name ="name" value="{{$getProduct->name}}"/>
            <input type="text" name ="price" value="{{$getProduct->price}}"/> 
            <select name="idcategory" id="">
                <option value="">Please choose category</option>
                @foreach ($category as $category)
                @if ($getProduct->idcategory == $category->id) ?
                <option value="{{$category->id}}" selected>{{$category->category}}</option> :
                <option value="{{$category->id}}">{{$category->category}}</option>
                @endif
                @endforeach
            </select>
            <select name="idbrand" id="">
                <option value="">Please choose brand</option>
                @foreach ($brand as $brand)
                @if ($getProduct->idbrand == $brand->id) 
                <option value="{{$brand->id}}" selected>{{$brand->brand}}</option> 
                @else
                <option value="{{$brand->id}}">{{$brand->brand}}</option>
                @endif
                @endforeach
            </select>  
            <select name="status" id="sale">
                <option value="">New or Sale</option>
                @if ($getProduct->status == 0) 
                <option value="{{$getProduct->status}}" selected>New</option>
                <option value="1">Sale</option>
                @else
                <option value="{{$getProduct->status}}" selected>Sale</option>
                <option value="0">New</option>
                @endif
            </select>   
                @if ($getProduct->status ==1)      
                <input id="sl" type="text" name="sale" value="{{$getProduct->sale}}"/>
                @else
                <input id="sl" type="hidden" name="sale" value="0" placeholder="%"/>
                @endif
            <input type="text" name ="company" value="{{$getProduct->company}}"/>    
            <input type="file" name ="image[]" multiple>
            @foreach ($getArrImage as $key => $value)
            <ul style="display: inline-block;">
                <li style="display: inline-block;"><img src="{{url('/upload/product/'.$iduser.'/'.'hinhnho_'.$value)}}"></li>
                <input type="checkbox" name="image_delete[]" value="{{$value}}">
            </ul>
            @endforeach
            <textarea name="detail" cols="30" rows="10">{{$getProduct->detail}}</textarea>
            <button type="submit" class="btn btn-default" name="Edit">Edit</button>
        </form>
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
        @if(session('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
        {{session('success')}}
    </div>
    @endif
    </div>   
</div>
<script>
    $(document).ready(function(){
        $('#sale').change(function(){
            var selectoption = $('#sale').val()
            if(selectoption==1){
                $('#sl').attr('type','text')
            } else {
                $('#sl').attr('type','hidden')
            }
        })
    })
</script>
@endsection