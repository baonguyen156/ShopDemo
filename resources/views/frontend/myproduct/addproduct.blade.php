@extends('frontend.layouts.account')
@section('content')
<div class="col-sm-4">
    <h3>Create Product</h3>
    <div class="signup-form">
        <form action="" method = "post" enctype="multipart/form-data">
            @csrf
            <input type="text" name ="name" placeholder="Name"/>
            <input type="text" name ="price" placeholder="Price"/> 
            <select name="idcategory" id="">
                <option value="">Please choose category</option>
                @foreach ($category as $category)
                <option value="{{$category->id}}">{{$category->category}}</option>
                @endforeach
            </select>
            <select name="idbrand" id="">
                <option value="">Please choose category</option>
                @foreach ($brand as $brand)
                <option value="{{$brand->id}}">{{$brand->brand}}</option>
                @endforeach
            </select>  
            <select name="status" id="sale">
                <option value="">New or Sale</option>
                <option id="nosale" value="0">New</option>
                <option id="hassale" value="1">Sale</option>
            </select>            
                <input id="sl" type="hidden" name="sale" value="0" placeholder="%"/>                 
            <input type="text" name ="company" placeholder="Company profile"/>    
            <input type="file" name ="image[]" multiple>
            <textarea name="detail" placeholder="Detail" cols="30" rows="10"></textarea>
            <button type="submit" class="btn btn-default" name="Add">Add</button>
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
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#sale').change(function(){
            var selectoption = $('#sale').val()
            if(selectoption==1){
                $('#sl').attr('type','text').show()
            } else {
                $('#sl').attr('type','hidden').hide()
            }
        })
    })
</script>
@endsection