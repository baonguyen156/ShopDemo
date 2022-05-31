@extends('frontend.layouts.app')
@section('content')
<div class="product-details"><!--product-details-->   
    <div class="col-sm-5">
        
        <div class="view-product">
            <img id="big" src="{{asset('upload/product/'.$getDetail->iduser.'/hinhvua_'.$getArrImage[0])}}" alt="" />
            <a id="bigson" href="{{asset('upload/product/'.$getDetail->iduser.'/'.$getArrImage[0])}}" rel="prettyPhoto"><h3>ZOOM</h3></a>
        </div>
        
        <div id="similar-product" class="carousel slide" data-ride="carousel">          
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    @foreach ($getArrImage as $key => $value)
                    <a><img id="small" src="{{asset('upload/product/'.$getDetail->iduser.'/hinhnho_'.$value)}}" alt=""></a>
                    @endforeach
                    <!-- <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                    <a href=""><img src="images/product-details/similar3.jpg" alt=""></a> -->
                </div>
                <div class="item">
                    @foreach ($getArrImage as $key => $value)
                    <a><img class="small" src="{{asset('upload/product/'.$getDetail->iduser.'/hinhnho_'.$value)}}" alt=""></a>
                    @endforeach
                    <!-- <a href=""><img src="images/product-details/similar2.jpg" alt=""></a>
                    <a href=""><img src="images/product-details/similar3.jpg" alt=""></a> -->
                </div>               
            </div>
                <!-- Controls -->
                <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
                </a>
                <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
                </a>
        
        </div>
    </div>
    <div class="col-sm-7">
        <div class="product-information"><!--/product-information-->
            <img src="{{asset('frontend/images/product-details/new.jpg')}}" class="newarrival" alt="" />
            <h2>{{$getDetail->name}}</h2>
            <p>Web ID: {{$getDetail->id}}</p>
            <img src="{{url('frontend/images/product-details/rating.png')}}" alt="" />
            <span>
                <span>US ${{$getDetail->price}}</span>
                <label>Quantity:</label>
                <input type="text" value="1" />
                <button type="button" class="btn btn-fefault cart">
                    <i class="fa fa-shopping-cart"></i>
                    Add to cart
                </button>
            </span>
            <p><b>Availability:</b> In Stock</p>
            @if ($getDetail->status == 0)
            <p><b>Condition:</b>New</p>@else
            <p><b>Condition:</b>Sale</p>@endif
            <p><b>Brand:</b> {{$getDetail->brand}}</p>
            <a href=""><img src="{{asset('frontend/images/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
        </div><!--/product-information-->
    </div>   
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("a[rel^='prettyPhoto']").prettyPhoto();
        $('.small').click(function(){
            var get = $(this).attr('src')
            
            var get_org = get.replace('hinhnho_','')
            $('#big').attr('src' ,get_org)
            $('#bigson').attr('href' ,get_org)
            
        })
    })
</script>
@endsection