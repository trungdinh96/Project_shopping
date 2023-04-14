@extends('Admin.layout.master')

@section('header_content', 'Order Detail')

@section('content')
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            {{-- @can('product-create')
        @endcan --}}
            <div class="col-md-12">
                <h5>Mã đơn hàng: <b>MHD{{$orderDetails->customers->id}}</b> </h5>
                <h5>Họ và tên: <b>{{$orderDetails->customers->name}}</b> </h5>
                <h5>Email: <b>{{$orderDetails->customers->email}}</b> </h5>
                <h5>Số điện thoại: <b>{{$orderDetails->customers->number_phone}}</b> </h5>
                <h5>Địa chỉ: <b>{{$orderDetails->customers->address}}</b> </h5>
                <h5>Trạng thái: <b>{{$orderDetails->status== 0 ? 'Chưa thanh toán' : 'Đã thanh toán'}}</b> </h5>
                <h5>Ngày đặt hàng: <b>{{$orderDetails->created_at}}</b> </h5>
            </div>

            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Product image</th>
                            <th scope="col">Product name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>


                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0 @endphp
                        @foreach ($orderDetails->products as $key => $order)
                        @php $total += $order->price * $order->pivot->quantity @endphp
                            <tr>
                                <th scope="row">{{ $key += 1 }}</th>
                                <td>
                                    <img src="{{ $order->feature_image_path }}" alt="" width="100">
                                </td>
                                <td>{{ $order->name }}</td>
                                <td>{{ number_format($order->price) }} VND</td>

                                <td>{{ $order->pivot->quantity }}</td>
                               
                                <td>{{ number_format($order->price * $order->pivot->quantity) }} VND</td>

                            </tr>
                            
                        @endforeach
                        <h5>Total : <b>{{number_format($total)}} VND</b></h5>
                    </tbody>
                </table>
            </div>
           

        </div>
        <!-- /.row -->
        <!-- Main row -->

        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
@endsection
