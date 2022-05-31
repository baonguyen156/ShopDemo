@extends('frontend.layouts.layoutsearch')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Items</h2>
    <div class="signup-form" style="width: 847.5px">
        <form method="POST">
            @csrf
            <ul class="nav navbar-nav">
                <li><input type="text" name="name" placeholder="Name"/></li>
                <li>
                    <select name="price" id="">
                        <option value="">Choose price</option>
                        <option value="1000-5000">1000-5000</option>
                        <option value="5000-10000">5000-10000</option>
                    </select>
                </li>
                <li>
                    <select name="idcategory" id="">
                        <option value="">Choose category</option>
                        @foreach ($category as $category)
                        <option value="{{$category->id}}">{{$category->category}}</option>
                        @endforeach
                    </select>
                </li>
                <li>
                    <select name="idbrand" id="">
                        <option value="">Choose brand</option>
                        @foreach ($brand as $brand)
                        <option value="{{$brand->id}}">{{$brand->brand}}</option>
                        @endforeach
                    </select>
                </li>
                <li><select name="status" id="">
                    <option value="">Choose status</option>
                    <option value="0">New</option>
                    <option value="1">Sale</option>
                </select></li>
                <li>
                    <button type="submit" class="btn btn-default">Search</button>
                </li>
            </ul>
        </form>
    </div>
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