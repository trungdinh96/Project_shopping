<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ BASE_URL }}Clients/css/bootstrap.min.css" rel="stylesheet">
<link href="{{ BASE_URL }}Clients/css/font-awesome.min.css" rel="stylesheet">
<link href="{{ BASE_URL }}Clients/css/prettyPhoto.css" rel="stylesheet">
<link href="{{ BASE_URL }}Clients/css/price-range.css" rel="stylesheet">
<link href="{{ BASE_URL }}Clients/css/animate.css" rel="stylesheet">
<link href="{{ BASE_URL }}Clients/css/main.css" rel="stylesheet">
<link href="{{ BASE_URL }}Clients/css/responsive.css" rel="stylesheet">
<link rel="shortcut icon" href="{{ BASE_URL }}Clients/images/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144"
    href="{{ BASE_URL }}Clients/{{ BASE_URL }}Clients/images/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114"
    href="{{ BASE_URL }}Clients/{{ BASE_URL }}Clients/images/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72"
    href="{{ BASE_URL }}Clients/{{ BASE_URL }}Clients/images/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed"
    href="{{ BASE_URL }}Clients/{{ BASE_URL }}Clients/images/ico/apple-touch-icon-57-precomposed.png">
</head>
<body>
    
    <section id="cart_items">
        <div class="container">
         
            @php $total = 0 @endphp
            
          
            <div class="card border-dark col-md-12">
                <div class="card-header">
                    <h5>Mã đơn hàng: DH{{$orders->customers->id}}</h5>
                    <h5>Họ và tên:{{$orders->customers->name}}</h5>
                    <h5>Email: {{$orders->customers->email}}</h5>
                    <h5>Số điện thoại: {{$orders->customers->number_phone}}</h5>
                    <h5>Địa chỉ: {{$orders->customers->address}}</h5>
                    <h5>Trạng thái: {{$orders->status== 0 ? 'Chưa thanh toán' : 'Đã thanh toán'}}</h5>
                </div>
                <div class="card-body text-dark">

                    <div class="table-responsive cart_info">
                        <table class="table table-condensed">
                            <thead>
                                <tr class="cart_menu">
                                    
                                    <td class="total">Product Image</td>
                                    <td class="total">Product name</td>
                                    <td class="total">Product price</td>
                                    <td class="total">Quantity</td>
                                    <td class="total">Total</td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                               @foreach ($orders->products as $orderProduct )
                               @php $total += $orderProduct->price * $orderProduct->pivot->quantity @endphp
                               
                               <tr >
                                    
                                <td class="cart_product"><img src="{{$orderProduct->feature_image_path}}" alt="" width="100"></td>
                                
                                <td class="cart_description">
                                    <h5>{{$orderProduct->name}}</h5>

                                </td>
                                
                                <td class="cart_price">{{number_format($orderProduct->price)}} VND</td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">

                                        <input class="cart_quantity_input" type="text" name="quantity"
                                            value="{{$orderProduct->pivot->quantity}}" disabled>

                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">
                                        {{number_format($orderProduct->price * $orderProduct->pivot->quantity)}}  VND
                                    </p>
                                </td>
                               
                                
                            </tr>
                               @endforeach
                                
                                  
                               

                                <tr>
                                    <td colspan="4">&nbsp;</td>
                                    <td colspan="2">
                                        <table class="table table-condensed total-result">

                                            <tr>
                                                <td>Total</td>
                                                <td><span>{{number_format($total)}}</span></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
          
      
           



        </div>
    </section>
    
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" ></script>
<script src="{{ BASE_URL }}Clients/js/bootstrap.min.js"></script>
<script src="{{ BASE_URL }}Clients/js/jquery.scrollUp.min.js"></script>
<script src="{{ BASE_URL }}Clients/js/price-range.js"></script>
<script src="{{ BASE_URL }}Clients/js/jquery.prettyPhoto.js"></script>
<script src="{{ BASE_URL }}Clients/js/main.js"></script>
</body>
</html>






 
