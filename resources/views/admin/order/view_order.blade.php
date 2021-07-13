@extends('admin_layout');
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin khách hàng
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th style="width:20px;">
                                <label class="i-checks m-b-none">
                                    <input type="checkbox"><i></i>
                                </label>
                            </th>
                            <th>Tên khách hàng</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label>
                            </td>
                            <td>{{ $customer->customer_name }}</td>
                            <td>{{ $customer->customer_email }}</td>
                            <td>{{ $customer->customer_phone }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin vận chuyển
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th style="width:20px;">
                                <label class="i-checks m-b-none">
                                    <input type="checkbox"><i></i>
                                </label>
                            </th>
                            <th>Tên người đặt</th>
                            <th>Email</th>
                            <th>Địa chỉ giao hàng</th>
                            <th>Số điện thoại</th>
                            <th>Ghi chú</th>
                            <th>Hình thức thanh toán</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>{{ $shipping->shipping_name }}</td>
                            <td>{{ $shipping->shipping_email }}</td>
                            <td>{{ $shipping->shipping_address }}</td>
                            <td>{{ $shipping->shipping_phone }}</td>
                            <td>{{ $shipping->shipping_note }}</td>
                            <td>
                                @if($shipping->payment_method == 0)
                                    Nhận hàng thanh toán
                                @else
                                    Chuyển khoản ATM
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Chi tiết đơn hàng
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th style="width:20px;">
                                <label class="i-checks m-b-none">
                                    <input type="checkbox"><i></i>
                                </label>
                            </th>
                            <th>Mã đơn hàng</th>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Mã giảm giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach($order_details_pro as $key => $details)
                        @php
                            $subtotal = $details->products->product_price * $details->product_sales_qty;
                            $total += $subtotal;
                        @endphp
                        <tr>
                            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
                            <td>{{ $details->order_code }}</td>
                            <td>{{ $details->products->product_name }}</td>
                            <td><img src="{{ url('/public/uploads/product/'.$details->products->product_image) }}" width="70px" height="70px" alt=""></td>
                            <td>{{ number_format($details->products->product_price, 0, ',', '.') }} đ</td>
                            <td>{{ $details->product_sales_qty }}</td>
                            <td>
                                @if($details->coupon_code != 0)
                                    {{ $details->coupon_code }}
                                @else
                                    Không có
                                @endif
                            </td>
                            <td>
                                {{ number_format($subtotal, 0, ',', '.') }} đ
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="8">
                                <div class="payment_details">
                                    <ul>
                                        <li>
                                            Tổng đơn hàng: <span>{{ number_format($total, 0, ',', '.') }} đ</span>
                                        </li>
                                        <li>
                                            Mã giảm giá:
                                            @if($coupon_condition == 1)
                                                <span>-{{ number_format($coupon_number, 0, ',', '.') }} %</span>
                                                @php
                                                    $discount = $total*$coupon_number/100;
                                                @endphp
                                            @else
                                                <span>-{{ number_format($coupon_number, 0, ',', '.') }} đ</span>
                                                @php
                                                    $discount = $coupon_number;
                                                @endphp
                                            @endif
                                        </li>
                                        <li>
                                            Phí vận chuyển:
                                            @php
                                                $fee_ship = $details->fee_shipping
                                            @endphp
                                            <span>{{ number_format($fee_ship, 0, ',', '.') }} đ</span>
                                        </li>
                                        @if($discount <= $total)
                                        <li>
                                            Tổng thanh toán:
                                            @php
                                                $alltotal = $total-$discount+$fee_ship;
                                            @endphp
                                            <span>{{ number_format($alltotal, 0, ',', '.') }} đ</span>
                                        </li>
                                        @else
                                            <li>
                                                Tổng thanh toán:
                                                 @php
                                                    $alltotal = $fee_ship;
                                                @endphp
                                                <span>{{ number_format($alltotal, 0, ',', '.') }} đ</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
