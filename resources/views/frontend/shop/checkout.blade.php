@extends('frontend.layouts.cart')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        <!-- <div class="step-one">
            <h2 class="heading">Step1</h2>
        </div>
        <div class="checkout-options">
            <h3>New User</h3>
            <p>Checkout options</p>
            <ul class="nav">
                <li>
                    <label><input type="checkbox"> Register Account</label>
                </li>
                <li>
                    <label><input type="checkbox"> Guest Checkout</label>
                </li>
                <li>
                    <a href=""><i class="fa fa-times"></i>Cancel</a>
                </li>
            </ul>
        </div>

        <div class="register-req">
            <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
        </div>/register-req -->

        <!-- <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-3">
                    <div class="shopper-info">
                        <p>Shopper Information</p>
                        <form>
                            <input type="text" placeholder="User Name">
                            <input type="text" placeholder="Email">
                            <input type="password" placeholder="Phone">
                        </form>
                        <a class="btn btn-primary" href="">Place Order</a>
                        <a class="btn btn-primary" href="">Continue</a>
                    </div>
                </div>
                <div class="col-sm-5 clearfix">
                    <div class="bill-to">
                        <p>Bill To</p>
                        <div class="form-one">
                            <form>
                                <input type="text" placeholder="Company Name">
                                <input type="text" placeholder="Email*">
                                <input type="text" placeholder="Title">
                                <input type="text" placeholder="First Name *">
                                <input type="text" placeholder="Middle Name">
                                <input type="text" placeholder="Last Name *">
                                <input type="text" placeholder="Address 1 *">
                                <input type="text" placeholder="Address 2">
                            </form>
                        </div>
                        <div class="form-two">
                            <form>
                                <input type="text" placeholder="Zip / Postal Code *">
                                <select>
                                    <option>-- Country --</option>
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>
                                <select>
                                    <option>-- State / Province / Region --</option>
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>
                                <input type="password" placeholder="Confirm password">
                                <input type="text" placeholder="Phone *">
                                <input type="text" placeholder="Mobile Phone">
                                <input type="text" placeholder="Fax">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="order-message">
                        <p>Shipping Order</p>
                        <textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
                        <label><input type="checkbox"> Shipping to bill address</label>
                    </div>	
                </div>					
            </div>
        </div> -->
        <div class="review-payment">
            <h2>Review & Payment</h2>
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
							<a href="{{url('frontend/shop/delete/'.$product['id'])}}" class='cart_quantity_delete'><i class='fa fa-times'></i></a> 
						</td>
                    </tr>
                    @endforeach
                    @endif
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Cart Sub Total</td>
                                    <td>$0</td>
                                </tr>
                                <tr>
                                    <td>Exo Tax</td>
                                    <td>$0</td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Shipping Cost</td>
                                    <td>Free</td>										
                                </tr>
                                <tr>
                                    <td>Total</td>
                                    <td><span>${{$tong}}</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-4">
            <div class="order-message">
                <p>Shipping Order</p>
                <textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="8"></textarea>
                <label><input type="checkbox"> Shipping to bill address</label>
            </div>	
        </div>
        <div class="col-sm-3">
            <div class="shopper-info">
                @if (Auth::check())
                <p>Shopper Information</p>
                <form method="POST">
                    @csrf
                    <input type="text" name="name" value="{{Auth::user()->name}}">
                    <input type="text" name="email" value="{{Auth::user()->email}}">
                    <input type="phone" name="phone" value="{{Auth::user()->phone}}">
                    <input type="hidden" name="iduser" value="{{Auth::id()}}">
                    <input type="hidden" name="price" value="{{$tong}}"> 
                    <button type="submit" class="btn btn-primary">Place Order</button>
                </form>
                @else 
                <p>Quick Register and Order</p>
                <form method="POST">
                    @csrf 
                    <input type="text" name="name" placeholder="User Name">
                    <input type="text" name="email" placeholder="Email">
                    <input type="phone" name="phone" placeholder="Phone">
                    <input type="text" name="address" placeholder="Address">
                    <input type="password" name="password" placeholder="Password">
                    <input type="hidden" name="price" value="{{$tong}}">  
                    <button type="submit" class="btn btn-primary">Register & Order</button>
                </form>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection