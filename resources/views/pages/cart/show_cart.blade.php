@extends('layout_single')
@section('content_single')
    <section id="cart_items">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
                <li class="active">Giỏ hàng</li>
            </ol>
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
                                    <img src="{{ URL::to('/public/uploads/product/'.$cart['product_image']) }}" width="80px" alt="">
                                </td>
                                <td class="cart_description">
                                    <h4>
                                        {{ $cart['product_name'] }}
                                        {{-- <a href="{{ URL::to('/product-details/'.$cart['product_id']) }}">
                                        </a> --}}
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
                                <a class="btn btn-default check_out" href="{{ URL::to('/delete-all-cart')}}" style="margin: 20px">Xóa giỏ hàng</a>
                            </td>
                        </tr>
                    </form>
                    <tr>
                        <td colspan="2">
                            <div class="total_area">
                                <ul>
                                    <li>Tổng đơn hàng <span><?= number_format($total,0,',','.') . ' đ' ?></span></li>
                                    {{-- <li>Thuế <span>Miễn phí</span></li>
                                    <li>Phí vận chuyển <span>Miễn phí</span></li> --}}
                                    @if (Session::has('coupon'))
                                    <li>Mã giảm giá
                                        <span>
                                            @if(Session::has('coupon'))
                                                @foreach(Session::get('coupon') as $key => $cou)
                                                    @if($cou['coupon_condition'] === 1)
                                                        - {{$cou['coupon_number']}} %
                                                        @php
                                                            echo '<li>Tiền giảm <span>'.
                                                                number_format(($total*$cou['coupon_number'])/100,0,',','.')
                                                            .' đ</span></li>';

                                                             echo '<li>Tổng thanh toán <span>'.
                                                                number_format($total - ($total*$cou['coupon_number'])/100,0,',','.')
                                                            .' đ</span></li>';
                                                        @endphp
                                                    @elseif($cou['coupon_condition'] === 2)
                                                        @if($cou['coupon_number'] <= $total)
                                                        - {{number_format($cou['coupon_number'],0,',','.')}} đ
                                                        @php
                                                            echo '<li>Tổng thanh toán <span>'.
                                                                number_format($total - $cou['coupon_number'],0,',','.')
                                                            .' đ</span></li>';
                                                        @endphp
                                                        @else
                                                        - {{number_format($cou['coupon_number'],0,',','.')}} đ
                                                        <li>Tổng thanh toán <span> 0 đ</span></li>
                                                        @endif
                                                    @else
                                                        @php
                                                            echo '<li>Tổng thanh toán <span>'.
                                                                number_format($total,0,',','.')
                                                            .' đ</span></li>';
                                                        @endphp
                                                    @endif
                                                @endforeach
                                            @endif
                                        </span>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </td>
                        <td colspan="4">
                            <form action="{{URL::to('/check-coupon')}}" method="post">
                                @csrf
                                <input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá" value="{{old('coupon')}}">
                                <input type="submit" class="btn btn-default check_out" name="check_coupon" value="Tính mã giảm giá">
                                @if(Session::has('coupon'))
                                    <a href="{{URL::to('/unset-coupon')}}" class="btn btn-default check_out">Xóa mã giảm giá</a>
                                @endif
                            </form>
                                <?php
                                    if (Session::has('customer_id') && Session::has('shipping_id')) { ?>
                                    <a class="btn btn-default check_out" href="{{ URL::to('/payment') }}">Thanh toán</a>
                                    <?php } elseif (Session::has('customer_id') && Session::missing('shipping_id')) { ?>
                                    <a class="btn btn-default check_out" href="{{ URL::to('/show-checkout') }}">Thanh toán</a>
                                    <?php } else { ?>
                                    <a class="btn btn-default check_out" href="{{ URL::to('/login-checkout') }}">Thanh toán</a>
                                    <?php }
                                ?>
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
    </section>
    <!--/#cart_items-->
@endsection
