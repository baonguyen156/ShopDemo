<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Chào bạn </h2>
    <p>Đây là đơn hàng của bạn</p>
    <div class="table-responsive cart_info">
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu">
                    <td class="image">Item</td>
                    <td class="price">Price</td>
                    <td class="quantity">Quantity</td>
                    <td class="total">Total</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>                    
                @foreach($cart as $product)
                <?php 
                    $tong = 0;
                    $total =  $product['price']*$product['qty'];
                    $tong += $total;
                ?>
                <tr>
                    <td class="cart_description">
                        <h4>{{ $product['name'] }}</h4>
                    </td>
                    <td class="cart_price">
                        $<span class="price_product">{{ $product['price'] }}</span>
                    </td>
                    <td class="cart_quantity">
                        <span class='cart_quantity_input'>{{$product['qty']}}</span>           
                    </td>
                    <td class="cart_total">
                        <span class="cart_total_price">${{$product['price']*$product['qty']}}</span>
                    </td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="4">&nbsp;</td>
                    <td colspan="2">
                        <table class="table table-condensed total-result">
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
</body>
</html>