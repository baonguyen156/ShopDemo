@extends('frontend.layouts.app')
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Features Items</h2>
    @foreach ($getProducts as $product)
    <?php $img = json_decode($product->image) ?>
    <div class="col-sm-4 home">
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <img src="{{asset('upload/product/'.$product->iduser.'/hinhnho_'.$img[1])}}" alt="" />
                    <h2>${{$product->price}}</h2>
                    <p>{{$product->name}}</p>
                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                </div>
                <div class="product-overlay">
                    <div class="overlay-content">
                        <h2>${{$product->price}}</h2>
                        <p>{{$product->name}}</p>
                        <a id="{{$product->id}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </div>
                </div>
            </div>
            <div class="choose">
                <ul class="nav nav-pills nav-justified">
                    <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    <li><a href="{{url('/product-detail/'.$product->id)}}"><i class="fa fa-plus-square"></i>Detail</a></li>
                </ul>
            </div>
        </div>
    </div>    
    @endforeach
</div>
<div class="pagination-area">
    {{ $getProducts->links() }}
</div>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('a.add-to-cart').click(function(){
            var idproduct = $(this).attr('id')
            console.log(idproduct)
            alert('thêm sản phẩm vào giỏ hàng thành công')
            $.ajax({
                type: "POST",
                url: "{{url('/shop/shopajax')}}",
                data: {
                    idproduct: idproduct
                },
                success: function(response){
                    console.log(respone);
                }
            })
        })
        $('div.slider-track').click(function(e){
            e.preventDefault();
			var price = $('.tooltip-inner').text();
			console.log(price)
			$.ajax({
                type: "POST",
                url: "{{url('/shop/priceajax')}}",
                data: {
                    price: price
                },
                success: function(data){
                    if (data.result) {
                        var result = data.result;
                        var html = '';
                        $.map(result,function(value, index){
                            var arrImg = JSON.parse(value['image']);
                            var img = "{{ url('upload/product/') }}";
                            var href = "{{ url('/shop/product-detail') }}";          
                            html+=
                                    '<div class="col-sm-4">' +
                                        '<div class="product-image-wrapper">' +
                                            '<div class="single-products">' +
                                                '<div class="productinfo text-center">'+ 
                                                    '<img src='+ img + '/' + value['iduser'] + '/hinhvua_' + arrImg[0] + '/>'+
                                                    '<h2>$' + value['price'] + '</h2>'+
                                                    '<p>'+value['name']+'</p>' + 
                                                    '<a href="#" class="btn btn-default add-to-cart">'+
                                                        '<i class="fa fa-shopping-cart"></i>Add to cart' +
                                                    '</a>'+
                                                '</div>'+
                                                '<div class="product-overlay">'+
                                                    '<div class="overlay-content">'+
                                                        '<h2>$'+value['price']+ '</h2>'+
                                                        '<p>'+value['name']+'</p>' + 
                                                        '<a href="#" class="btn btn-default add-to-cart">'+
                                                        '<i class="fa fa-shopping-cart"></i>Add to cart</a>'+
                                                    '</div>'+ 
                                                '</div>'+
                                            '</div>'+
                                            '<div class="choose">'+
                                                '<ul class="nav nav-pills nav-justified">'+
                                                    '<li>'+
                                                        '<a href="#">'+
                                                        '<i class="fa fa-plus-square"></i>Add to compare</a>'+
                                                    '</li>'+
                                                    '<li>'+
                                                        '<a href='+href+'/'+value['id']+'>'+
                                                        '<i class="fa fa-plus-square"></i>Detail</a>'+
                                                    '</li>'+
                                                '</ul>' +
                                            '</div>'+
                                        '</div>'+
                                    '</div>';
                        }) 
                        $('.home').hide();
                        $('.features_items').html(html);  
                    } else {
                        $('.home').hide();
                        $('.features_items').text("No result");
                    }
                }
            })
		})	
    })
</script>
@endsection