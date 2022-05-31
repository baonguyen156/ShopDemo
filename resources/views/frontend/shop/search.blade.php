@extends('frontend.layouts.layoutsearch')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Items</h2>
    
    @if(!empty($data))
    @foreach ($data as $product)
    <?php $img = json_decode($product['image']) ?>
    <div class="col-sm-4">
        <div class="product-image-wrapper">
            <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{asset('upload/product/'.$product['iduser'].'/hinhnho_'.$img[1])}}" alt="" />
                        <h2>${{$product['price']}}</h2>
                        <p>{{$product['name']}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>${{$product['price']}}</h2>
                            <p>{{$product['name']}}</p>
                            <a id="{{$product['id']}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        </div>
                    </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href="{{url('frontend/shop/product-detail/'.$product['id'])}}"><i class="fa fa-plus-square"></i>Detail</a></li>
                </ul>
            </div>
        </div>
    </div>    
    @endforeach
    @endif
</div>

@endsection