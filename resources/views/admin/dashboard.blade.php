@extends('admin_layout');
@section('admin_content')
    <div class="market-updates">
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-2">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-shopping-cart"> </i>
                </div>
                <div class="col-md-8 market-update-left">
                <h4>Sản phẩm</h4>
                <h3>{{count($all_product)}}</h3>
                <p>Thống kê sản phẩm</p>
            </div>
            <div class="clearfix"> </div>
            </div>
        </div>
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-1">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-users" ></i>
                </div>
                <div class="col-md-8 market-update-left">
                <h4>Khách hàng</h4>
                    <h3>{{count($all_customer)}}</h3>
                    <p>Thống kê khách hàng</p>
                </div>
            <div class="clearfix"> </div>
            </div>
        </div>
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-3">
                <div class="col-md-3 market-update-right">
                    <i class="fa fa-usd"></i>
                </div>
                <div class="col-md-9 market-update-left">
                    <h4>Doanh thu</h4>
                    <h3>
                        @php
                            $revenue = 0;
                        @endphp
                        @foreach($all_order as $key => $order)
                            @php
                                $revenue += $order->order_total;
                            @endphp
                        @endforeach
                        {{number_format($revenue, 0, ',', '.')}} đ
                    </h3>
                    <p>Thống kê doanh thu</p>
                </div>
            <div class="clearfix"> </div>
            </div>
        </div>
        <div class="col-md-3 market-update-gd">
            <div class="market-update-block clr-block-4">
                <div class="col-md-4 market-update-right">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </div>
                <div class="col-md-8 market-update-left">
                    <h4>Đơn đặt hàng</h4>
                    <h3>{{count($all_order)}}</h3>
                    <p>Thống kê đơn đặt hàng</p>
                </div>
            <div class="clearfix"> </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
@endsection
