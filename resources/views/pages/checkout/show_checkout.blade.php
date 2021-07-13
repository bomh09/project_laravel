@extends('layout_single')
@section('content_single')

<section id="cart_items">
    <div class="breadcrumbs">
        <ol class="breadcrumb">
            <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
            <li class="active">Check out</li>
        </ol>
    </div><!--/breadcrums-->

    <div class="register-req">
        <?php
            $customer_id = Session::get('customer_id');
            $shipping_id = Session::get('shipping_id');
        ?>
        <?php
            if($customer_id != null){ ?>
                <p>Nhập thông tin của bạn để mua hàng.</p>
        <?php }else{ ?>
                <p>Vui lòng đăng nhập hoặc đăng ký để thanh toán và xem lại lịch sử đặt hàng của bạn.</p>
        <?php } ?>

    </div><!--/register-req-->

    <div class="shopper-informations">
        <div class="row">
            <div class="col-sm-6">
                <div class="bill-to">
                    <p>Tính phí vận chuyển</p>
                    <div class="form-one">
                        <form>
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputPassword1">Tỉnh/Thành phố</label>
                                <select name="province" id="province" class="form-control input-sm m-bot15 choose province">
                                    <option value="0">---- Chọn tỉnh/thành phố -----</option>
                                    @foreach($province as $key => $city)
                                            <option value="{{$city->province_id}}">{{$city->province_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Quận/Huyện</label>
                                <select name="district" id="district" class="form-control input-sm m-bot15 choose district">
                                    <option value="0">---- Chọn quận/huyện -----</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Xã/Phường</label>
                                <select name="ward" id="ward" class="form-control input-sm m-bot15 ward">
                                    <option value="0">---- Chọn xã/phường -----</option>
                                </select>
                            </div>
                            <input type="button" class="btn btn-primary calculate_delivery" name="calculate_delivery" value="Tính phí vận chuyển">
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 clearfix">
                <div class="bill-to">
                    <p>Thông tin đặt hàng</p>
                    <div class="form-one">
                        <form>
                            @csrf
                            <input type="email" name="shipping_email" placeholder="Email*"
                            class="form-control @error('shipping_email') is-invalid @enderror shipping_email" value="{{old('shipping_email')}}">
                            @error('shipping_email')
                                <span class="invalid-feedback" role="alert">
                                    {{$message}}
                                </span>
                            @enderror
                            <input type="text" name="shipping_name" placeholder="Họ tên *"
                            class="form-control @error('shipping_name') is-invalid @enderror shipping_name" value="{{old('shipping_name')}}">
                            @error('shipping_name')
                                <span class="invalid-feedback" role="alert">
                                    {{$message}}
                                </span>
                            @enderror
                            <input type="text" name="shipping_address" placeholder="Địa chỉ *"
                            class="form-control @error('shipping_address') is-invalid @enderror shipping_address" value="{{old('shipping_address')}}">
                            @error('shipping_address')
                                <span class="invalid-feedback" role="alert">
                                    {{$message}}
                                </span>
                            @enderror
                            <input type="text" name="shipping_phone" placeholder="Số điện thoại *"
                            class="form-control @error('shipping_phone') is-invalid @enderror shipping_phone" value="{{old('shipping_phone')}}">
                            @error('shipping_phone')
                                <span class="invalid-feedback" role="alert">
                                    {{$message}}
                                </span>
                            @enderror
                            <textarea  name="shipping_note" class="shipping_note"  placeholder="Ghi chú đơn hàng của bạn" rows="5"></textarea><br>
                            <div class="form-group" style="margin-top: 15px">
                                <label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
                                <select name="payment_method" id="payment_method" class="form-control input-sm m-bot15 payment_method">
                                    <option value="0">Nhận hàng thanh toán</option>
                                    <option value="1">Chuyển khoản qua ATM</option>
                                </select>
                            </div>
                            @if(Session::has('fee'))
                                <input type="hidden" name="order_fee_shipping" class="order_fee_shipping" value="{{Session::get('fee')}}">
                            @endif

                            @if(Session::has('coupon'))
                                @foreach(Session::get('coupon') as $key => $cou)
                                    <input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
                                @endforeach
                            @else
                                <input type="hidden" name="order_coupon" class="order_coupon" value="0">
                            @endif
                            @if(Session::has('cart'))
                                <input class="btn btn-primary confirm_order" value="Xác nhận đặt hàng" name="confirm_order" type="button">
                            @else
                                <input class="btn btn-primary confirm_order" value="Xác nhận đặt hàng" name="confirm_order" type="button" disabled>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="review-payment">
        <h2>Xem lại giỏ hàng</h2>
    </div>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {!! session()->get('message') !!}
        </div>
    @elseif(session()->has('error'))
            <div class="alert alert-danger">
            {!! session()->get('error') !!}
        </div>
    @endif
    <div class="table-responsive cart_info">
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu">
                    <td class="image">Hình ảnh</td>
                    <td class="description">Tên sản phẩm</td>
                    <td class="price">Giá tiền</td>
                    <td class="quantity">Số lượng</td>
                    <td class="total">Thành tiền</td>
                    <td></td>
                </tr>
            </thead>
                <tbody>
                    @if(Session::has('cart'))
                    <form action="{{ URL::to('/update-cart')}}" method="post">
                        @csrf
                        <?php
                            $total = 0;
                        ?>
                    @foreach (Session::get('cart') as $key => $cart)
                        <?php
                            $subtotal = $cart['product_price'] * $cart['product_qty'];
                            $total += $subtotal;
                        ?>
                        <tr>
                            <td class="cart_product">
                                <a href="">
                                    <img src="{{ URL::to('/public/uploads/product/'.$cart['product_image']) }}" width="80px" alt="">
                                </a>
                            </td>
                            <td class="cart_description">
                                <h4>
                                    <a href="{{ URL::to('/product-details/'.$cart['product_id']) }}">
                                        {{ $cart['product_name'] }}
                                    </a>
                                </h4>
                                <p>Mã ID: {{ $cart['product_id'] }}</p>
                            </td>
                            <td class="cart_price" colspan="">
                                <p>{{ number_format($cart['product_price'],0,',','.') . ' đ' }}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <input class="cart_quantity_input" type="number" min="1" name="cart_qty[{{ $cart['session_id']}}]"
                                        value="{{ $cart['product_qty'] }}">
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    <?= number_format($subtotal,0,',','.') . ' đ'; ?>
                                </p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{ URL::to('/delete-cart/' . $cart['session_id']) }}">
                                    <i class="fa fa-times"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4">
                            <input class="btn btn-default update" type="submit" value="Cập nhật giỏ hàng" style="float: right; margin: 20px">
                        </td>
                        <td colspan="2">
                            <a class="btn btn-default check_out" href="{{ URL::to('/delete-all-cart') }}" style="margin: 20px">Xóa giỏ hàng</a>
                        </td>
                    </tr>
                </form>
                <tr>
                    <td colspan="2">
                        <div class="total_area">
                            <ul>
                                <li>Tổng đơn hàng <span><?= number_format($total,0,',','.') . ' đ' ?></span></li>
                                {{-- <li>Thuế <span>Miễn phí</span></li> --}}
                                @php
                                    $coupon = 0;
                                @endphp
                                @if(Session::has('coupon'))
                                    <li>Mã giảm giá
                                        <span>
                                            @foreach(Session::get('coupon') as $key => $cou)
                                                @if($cou['coupon_condition'] === 1)
                                                    - {{$cou['coupon_number']}} %
                                                    @php
                                                        $coupon = ($total*$cou['coupon_number'])/100;
                                                        // echo '<li>Tiền giảm <span>- '.
                                                        //     number_format($coupon,0,',','.')
                                                        // .' đ</span></li>';
                                                    @endphp
                                                @elseif($cou['coupon_condition'] === 2)
                                                    - {{number_format($cou['coupon_number'],0,',','.')}} đ
                                                    @php
                                                        $coupon = $cou['coupon_number'];
                                                    @endphp
                                                @else
                                                    @php
                                                        echo '<li>Tổng tiền <span>'.
                                                            number_format($total,0,',','.')
                                                        .' đ</span></li>';
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </span>
                                    </li>
                                @endif
                                @if(Session::has('fee'))
                                <li>
                                    <a class="cart_quantity_delete" href="{{ URL::to('/delete-fee-shipping')}}">
                                        <i class="fa fa-times"></i>
                                    </a>
                                    Phí vận chuyển <span>+ {{number_format(Session::get('fee'),0,',','.')}} đ</span>
                                </li>
                                @endif
                                @if($cou['coupon_number'] <= $total)
                                <li>Tổng thanh toán
                                    @php
                                        $alltotal = $total - $coupon + Session::get('fee') ;
                                        Session::put('total', $alltotal) ;
                                    @endphp
                                    <span>{{number_format($alltotal,0,',','.')}} đ</span>
                                </li>
                                @else
                                    @php
                                        $alltotal = Session::get('fee');
                                        Session::put('total', $alltotal) ;
                                    @endphp
                                    <li>Tổng thanh toán <span> {{number_format($alltotal,0,',','.')}} đ</span></li>
                                @endif
                            </ul>
                        </div>
                    </td>
                    <td colspan="4">
                        <form action="{{URL::to('/check-coupon')}}" method="post">
                            @csrf
                            <input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá">
                            <input type="submit" class="btn btn-default check_out" name="check_coupon" value="Tính mã giảm giá">
                            @if(Session::has('coupon'))
                                <a href="{{URL::to('/unset-coupon')}}" class="btn btn-default check_out">Xóa mã giảm giá</a>
                            @endif
                        </form>
                    </td>
                </tr>
                @else
                    <tr>
                        <td colspan="6">
                            <h3 class="text-center">Giỏ hàng trống</h3>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</section> <!--/#cart_items-->

@endsection
