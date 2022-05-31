@extends('frontend.layouts.cart')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>                    
                    <?php $tong = 0; ?>
                    @if(!empty($product))                    
                    @foreach($product as $product)
                    <?php 
                        $total =  $product['price']*$product['qty'];
                        $tong += $total;
                    ?>
                    <?php $getArrImage = json_decode($product['image']); ?>
                    <tr>
                        <td><img src="{{asset('upload/product/'.$product['iduser'].'/hinhnho_'.$getArrImage[0])}}" alt=""></td>
                        <td class="cart_description">
                            <h4><a href="">{{ $product['name'] }}</a></h4>
                            <p class="idprd">{{ $product['id'] }}</p>
                        </td>
                        <td class="cart_price">
                            $<span class="price_product">{{ $product['price'] }}</span>
                        </td>
                        <td class="cart_quantity">
                            <div class='cart_quantity_button'>
								<a class='cart_quantity_up'>+</a>
								<input class='cart_quantity_input' type='text' name='quantity' value="{{$product['qty']}}" autocomplete='off' size='2'>
								<a class='cart_quantity_down'>-</a>
							</div>
                        </td>
                        <td class="cart_total">
                            <span class="cart_total_price">${{$product['price']*$product['qty']}}</span>
                        </td>
                        <td class='cart_delete'> 
							<a href="{{url('/shop/delete/'.$product['id'])}}" class='cart_quantity_delete'><i class='fa fa-times'></i></a> 
						</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section>
<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                            
                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                        
                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span></span></li>
                        <li>Eco Tax <span></span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>${{$tong}}</span></li>
                    </ul>
                        <a class="btn btn-default update" href="">Update</a>
                        <a class="btn btn-default check_out" href="{{url('/shop/checkout')}}">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('a.cart_quantity_up').click(function(){
            var qty = $(this).closest(".cart_quantity").find("input.cart_quantity_input").val()
            var tien = $(this).closest("tr").find("td.cart_price").text()
            var idproduct = $(this).closest("tr").find("p.idprd").text()
            console.log(idproduct)
            console.log(tien)
            tien = tien.replace('$','')
            qty = parseInt(qty) + 1
            var total = qty* tien
            console.log(qty)
            console.log(total)
            var nsl = $(this).closest("div.cart_quantity_button").find("input").attr("value",qty)
            var nt = $(this).closest("tr").find("span.cart_total_price").text("$"+total)
            
            $.ajax({
                type: "POST",
                url: "{{url('/shop/cartajax')}}",
                data: {
                    idproduct: idproduct,
                    qty: qty
                },
                success: function(response){
                    console.log(respone);
                }
            })
        })
        $("a.cart_quantity_down").click(function(){
            var qty = $(this).closest(".cart_quantity").find("input.cart_quantity_input").val()
            var tien = $(this).closest("tr").find("td.cart_price").text()
            var idproduct = $(this).closest("tr").find("p.idprd").text()
            tien = tien.replace('$','')
            console.log(tien)
            qty = parseInt(qty) - 1
            if(qty < 1){
                $(this).closest("tr").remove()
            }else{
                var total = qty * tien
            }				
            console.log(qty)
            var nsl = $(this).closest("div.cart_quantity_button").find("input").attr("value",qty)
            var nt = $(this).closest("tr").find("span.cart_total_price").text("$"+total)
            
            $.ajax({
                type: "POST",
                url: "{{url('/shop/cartajax')}}",
                data: {
                    idproduct: idproduct,
                    qty: qty
                },
                success: function(response){
                    console.log(respone);
                }
            })			
        })
    })
</script>
@endsection