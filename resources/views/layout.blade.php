<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="{{ asset('public/frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('public/frontend/css/owl.theme.default.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{ asset('public/frontend/images/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head>
<!--/head-->

<body>
    <header id="header">
        <!--header-->
        <div class="header_top">
            <!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="tel:0335163902"><i class="fa fa-phone"></i> +8433 5163 902</a></li>
                                <li><a href="mailto:nguyenvanhoai1280@gmail.com"><i class="fa fa-envelope"></i> nguyenvanhoai1280@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header_top-->

        <div class="header-middle" id="header-menu">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-sm-12">
                        <div class="logo pull-left">
                            <a href="{{ URL::to('/') }}">
                                <img src="{{ asset('public/frontend/images/home/pnj.com.vn.png') }}" alt="" class="image-logo" />
                            </a>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <?php
                                $customer_id = Session::get('customer_id');
                                $shipping_id = Session::get('shipping_id');
                                $customer_name = Session::get('name');
                                ?>
                                <?php if (Session::has('customer_name')) { ?>
                                <li><a href="{{ URL::to('/customer-info') }}"><i class="fa fa-user"></i>
                                        {{ Session::get('customer_name') }}
                                    </a>
                                </li>
                                <?php } else { ?>
                                <li><a href="{{ URL::to('/login-checkout') }}">
                                    <i class="fa fa-user"></i> Tài khoản</a>
                                </li>
                                <?php } ?>
                                {{-- <li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li> --}}
                                <li><a href="{{ URL::to('/show-cart') }}">
                                    <i class="fa fa-shopping-cart"></i> Giỏ hàng
                                    <span class="number-sp">
                                        {{ Session::has('cart') ? count(Session::get('cart')) : 0 }}
                                    </span>
                                    </a>
                                </li>
                                <?php if ($customer_id != null && $shipping_id != null) { ?>
                                <li><a href="{{ URL::to('/payment') }}">
                                    <i class="fa fa-crosshairs"></i> Thanh toán</a>
                                </li>
                                <?php } elseif ($customer_id != null && $shipping_id == null) { ?>
                                <li><a href="{{ URL::to('/show-checkout') }}">
                                    <i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php } else { ?>
                                <li><a href="{{ URL::to('/login-checkout') }}">
                                    <i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php } ?>
                                <?php if ($customer_id != null) { ?>
                                <li><a href="{{ URL::to('/logout-checkout') }}">
                                    <i class="fa fa-unlock"></i> Đăng xuất</a></li>
                                <?php } else { ?>
                                <li><a href="{{ URL::to('/login-checkout') }}">
                                    <i class="fa fa-lock"></i> Đăng nhập</a>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->

        <div class="header-bottom">
            <!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ URL::to('/') }}" class="active">Trang chủ</a></li>
                                <li class="dropdown"><a href="#">Sản phẩm</a>
                                    {{-- <ul role="menu" class="sub-menu">
                                        <li><a href="#">Products</a></li>
                                    </ul> --}}
                                </li>
                                <li><a href="#">Tin tức</a></li>
                                <li><a href="{{ URL::to('/show-cart') }}">Giỏ hàng</a></li>
                                <li><a href="#">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <form action="{{ URL::to('/search') }}" method="POST">
                                @csrf
                                <input type="text" name="keywords_search" placeholder="Tìm kiếm" />
                                <button>
                                    <i class="fa fa-search fa-2x"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-bottom-->
    </header>
    <!--/header-->

    <section id="slider">
        <!--slider-->
        <div class="owl-carousel owl-theme owl-loaded owl-slider">
            <div class="owl-stage-outer">
                <div class="owl-stage">
                    <div class="owl-item">
                        <a href="#">
                            <img src="{{ asset('public/frontend/images/home/slider1.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="owl-item">
                        <a href="#">
                            <img src="{{ asset('public/frontend/images/home/slider2.jpg') }}" alt="">
                        </a>
                    </div>
                    <div class="owl-item">
                        <a href="#">
                            <img src="{{ asset('public/frontend/images/home/slider3.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--/slider-->

    <section id="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2">
                    <div class="left-sidebar">
                        <h2>Danh mục</h2>
                        <div class="panel-group category-products" id="accordian">
                            <!--category-productsr-->
                            @foreach ($cat as $key => $cat)
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a href="{{ URL::to('/cat/' . $cat->cat_slug) }}">
                                                {{ $cat->cat_name }}
                                                {{-- <span class="pull-right">( {{ $cat->products_count }} )</span> --}}
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!--/category-products-->

                        <div class="brands_products">
                            <!--brands_products-->
                            <h2>Thương hiệu</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach ($brand as $key => $bra)
                                        <li>
                                            <a href="{{ URL::to('/brand/' . $bra->brand_slug) }}">
                                                {{ $bra->brand_name }}
                                                {{-- <span class="pull-right">( {{ $bra->products_count }} )</span> --}}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!--/brands_products-->

                        {{-- <div class="price-range">
                            <!--price-range-->
                            <h2>Price Range</h2>
                            <div class="well text-center">
                                <input type="hidden" name="start_price" id="start_price">
                                <input type="hidden" name="end_price" id="end_price">
                                <input type="text" class="span2" value="" data-slider_min="{{$min_price}}" data-slider-max="{{$max_price}}"
                                    data-slider-step="10000" data-slider-value="[{{$min_price}},{{$max_price}}]" id="sl2"><br />
                                    <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
                                <b class="pull-left">{{number_format($min_price, 0, ',', '.')}} đ</b>
                                <b class="pull-right">{{number_format($max_price, 0, ',', '.')}} đ</b>
                            </div>
                        </div> --}}
                        <!--/price-range-->

                        <div class="shipping text-center">
                            <!--shipping-->
                            <img src="{{asset('public/frontend/images/home/banner3.png')}}" alt="" />
                        </div>
                        <div class="shipping text-center">
                            <!--shipping-->
                            <img src="{{asset('public/frontend/images/home/banner6.png')}}" alt="" />
                        </div>
                        <!--/shipping-->

                    </div>
                </div>

                <div class="col-sm-8 padding-right">
                    @yield('content')
                </div>

                <div class="col-md-2">
                    <div class="shipping text-center">
                        <img src="{{asset('public/frontend/images/home/banner2.jpg')}}" alt="" />
                    </div>
                    <div class="shipping text-center">
                        <img src="{{asset('public/frontend/images/home/banner4.png')}}" alt="" />
                    </div>
                    <div class="shipping text-center">
                        <img src="{{asset('public/frontend/images/home/banner7.png')}}" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="footer">
        <!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <a href="{{ URL::to('/') }}">
                                <img src="{{ asset('public/frontend/images/home/pnj.com.vn.png') }}" alt="" class="image-logo" />
                            </a>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('public/frontend/images/home/iframe1.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('public/frontend/images/home/iframe2.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('public/frontend/images/home/iframe3.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                <a href="#">
                                    <div class="iframe-img">
                                        <img src="{{asset('public/frontend/images/home/iframe4.png')}}" alt="" />
                                    </div>
                                    <div class="overlay-icon">
                                        <i class="fa fa-play-circle-o"></i>
                                    </div>
                                </a>
                                <p>Circle of Hands</p>
                                <h2>24 DEC 2014</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="{{asset('public/frontend/images/home/map.png')}}" alt="" />
                            <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="single-widget">
                            <h2>VỀ PNJ</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Thông tin về PNJ</a></li>
                                <li><a href="#">Quá trình phát triển</a></li>
                                <li><a href="#">Hệ thống cửa hàng</a></li>
                                <li><a href="#">Thành tựu</a></li>
                                <li><a href="#">Tuyển dụng</a></li>
                                <li><a href="#">Câu hỏi thường gặp</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-widget">
                            <h2>HỖ TRỢ MUA HÀNG</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Hướng dẫn mua hàng</a></li>
                                <li><a href="#">Mua hàng trả góp</a></li>
                                <li><a href="#">Hướng dẫn thanh toán</a></li>
                                <li><a href="#">Chính sách bảo hành thu đổi</a></li>
                                <li><a href="#">Hướng dẫn đo size trang sức</a></li>
                                <li><a href="#">Tích luỹ điểm khách hàng thân thiết</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-widget">
                            <h2>CẨM NANG SỬ DỤNG</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Trang sức theo tháng sinh</a></li>
                                <li><a href="#">Trang sức theo phong thuỷ</a></li>
                                <li><a href="#">Trang sức Kim Cương</a></li>
                                <li><a href="#">Trang sức Đá Quý</a></li>
                                <li><a href="#">Kiến thức trang sức</a></li>
                                <li><a href="#">Giá vàng hôm nay</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-widget">
                            <h2>SẢN PHẨM</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Trang sức Cưới</a></li>
                                <li><a href="#">Trang sức Vàng</a></li>
                                <li><a href="#">Trang sức Bạc</a></li>
                                <li><a href="#">Quà tặng doanh nghiệp</a></li>
                                <li><a href="#">Đồng Hồ</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank"
                                href="http://www.themeum.com">Themeum</a></span></p>
                </div>
            </div>
        </div>

    </footer>
    <!--/Footer-->

    <script src="{{ asset('public/frontend/js/jquery.js') }}"></script>
    <script src="{{ asset('public/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/price-range.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('public/frontend/js/main.js') }}"></script>
    <script src="{{ asset('public/frontend/js/sweetalert.js') }}"></script>
    <script src="{{ asset('public/frontend/js/owl.carousel.js') }}"></script>
    {{-- <script src="{{ asset('public/frontend/js/sweetalert.min.js') }}"></script> --}}

    {{-- add cart --}}
    <script type="text/javascript">
        $(document).ready(function(){
            $('.add-to-cart').click(function(){
                var id = $(this).data('id_product');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: '{{url('/add-cart-ajax')}}',
                    method: 'POST',
                    data: {
                        cart_product_id: cart_product_id,
                        cart_product_name: cart_product_name,
                        cart_product_image: cart_product_image,
                        cart_product_price: cart_product_price,
                        cart_product_qty: cart_product_qty,
                        _token: _token,
                    },
                    success: function(data){

                        swal({
                            title: 'Đã thêm sản phẩm vào giỏ hàng!',
                            text: 'Bạn có thể mua thêm hoặc tới giỏ hàng để tiến hành thanh toán',
                            showCancelButton: true,
                            cancelButtonText:'Mua thêm',
                            confirmButtonClass: 'btn-success',
                            confirmButtonText: 'Đến giỏ hàng',
                            closeOnConfirm: true
                        },
                        function(){
                            window.location.href = "{{url('/show-cart')}}";
                        });
                    },
                });
            });
        });
    </script>
    {{-- chọn tỉnh thành --}}
    <script type="text/javascript">
        $(document).ready(function(){
            $('.choose').change(function(){
                var action = $(this).attr('id');
                var province_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';

                if(action == 'province'){
                    result = 'district';
                }else{
                    result = 'ward';
                }

                $.ajax({
                    url: '{{url('/select-delivery-home')}}',
                    method: 'POST',
                    data: {
                        action: action,
                        province_id: province_id,
                        _token: _token
                    },
                    success: function(data){
                        $('#'+result).html(data);
                    }
                });
            });
        });
    </script>
    {{-- tính phí vận chuyển --}}
    <script type="text/javascript">
        $(document).ready(function(){
            $('.calculate_delivery').click(function(){
                var province_id = $('.province').val();
                var district_id = $('.district').val();
                var ward_id = $('.ward').val();
                var _token = $('input[name="_token"]').val();

                if(province_id == 0 || district_id == 0 || ward_id == 0){
                    swal("Thông báo!", "Vui lòng nhập đủ thông tin vận chuyển!", "info");
                }else{
                    $.ajax({
                        url: '{{url('/calculate-fee-shipping')}}',
                        method: 'POST',
                        data: {
                            province_id: province_id,
                            district_id: district_id,
                            ward_id: ward_id,
                            _token: _token
                        },
                        success: function(){
                            location.reload();
                        }
                    })
                }
            });
        });
    </script>
    {{-- order --}}
    <script type="text/javascript">
        $(document).ready(function(){
            $('.confirm_order').click(function(){
                swal({
                    title: "Xác nhận đặt hàng?",
                    text: "Sau khi xác nhận, đơn hàng của bạn sẽ không được hoàn trả!",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-success",
                    confirmButtonText: "Xác nhận",
                    cancelButtonText: "Hủy bỏ",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },function(isConfirm){
                    if(isConfirm){
                        var shipping_email = $('.shipping_email').val();
                        var shipping_name = $('.shipping_name').val();
                        var shipping_address = $('.shipping_address').val();
                        var shipping_phone = $('.shipping_phone').val();
                        var shipping_note = $('.shipping_note').val();
                        var payment_method = $('.payment_method').val();
                        var order_coupon = $('.order_coupon').val();
                        var order_fee_shipping = $('.order_fee_shipping').val();
                        var _token = $('input[name="_token"]').val();

                        $.ajax({
                            url: '{{url('/confirm-order')}}',
                            method: 'POST',
                            data: {
                                shipping_email: shipping_email,
                                shipping_name: shipping_name,
                                shipping_address: shipping_address,
                                shipping_phone: shipping_phone,
                                shipping_note: shipping_note,
                                payment_method: payment_method,
                                order_coupon: order_coupon,
                                order_fee_shipping: order_fee_shipping,
                                _token: _token
                            },
                            success: function(){
                                swal("Đã đặt hàng", "Đơn hàng của bạn đã được đặt thành công!", "success");
                            }
                        });
                        window.setTimeout(function(){
                            location.reload();
                        }, 1000);
                    }else{
                        swal("Đã hủy", "Đơn hàng chưa được đặt, hãy hoàn tất đơn hàng của bạn!", "error");
                    }
                });

            });
        });
    </script>

</body>

</html>
