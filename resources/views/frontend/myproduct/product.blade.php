@extends('frontend.layouts.account')
@section('content')
<div class="col-sm-9">
    <div class="table-responsive cart_info">
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu">
                    <th>id</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Action</th>
                    <th></th>
                </tr>                    
            </thead>
            <tbody>
                @foreach ($getProducts as $product)                
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>                
                    <?php $img = json_decode($product->image) ?>
                    <td><img src="{{asset('upload/product/'.$id.'/hinhnho_'.$img[1])}}" alt=""></td>                
                    <td>{{$product->price}}</td>
                    <td><a href="{{url('/myproduct/editproduct/'.$product->id)}}"><button>Edit</button></a></td>
                    <td><a href="{{url('/myproduct/delete/'.$product->id)}}"><button>Delete</button></a></td>
                </tr>                
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="10">
                        <a href="{{url('/myproduct/addproduct')}}"><button class="btn btn-primary">Thêm sản phẩm mới</button></a>
                    </td>
                </tr>          
            </tfoot>
        </table>
    </div>
    
</div>
@endsection