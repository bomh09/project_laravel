@extends('layout_single')
@section('content_single')
    @foreach ($details_product as $key => $details)
        <div class="product-details">
            <!--product-details-->
            <div class="col-sm-4">
                <div class="view-product">
                    <img src="{{ URL::to('/public/uploads/product/' . $details->product_image) }}" alt="" />
                    <h3>ZOOM</h3>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="product-information">
                    <!--/product-information-->
                    <img src="{{asset('public/frontend/images/product-details/new.jpg')}}" class="newarrival" alt="" />
                    <h2>{{ $details->product_name }}</h2>
                    <p>Mã ID: {{ $details->product_id }}</p>
                    <img src="{{asset('public/frontend/images/product-details/rating.png')}}" alt="" />
                    <form >
                        @csrf
                        <input type="hidden" class="cart_product_id_{{ $details->product_id }}" value="{{ $details->product_id }}">
                        <input type="hidden" class="cart_product_name_{{ $details->product_id }}" value="{{ $details->product_name }}">
                        <input type="hidden" class="cart_product_image_{{ $details->product_id }}" value="{{ $details->product_image }}">
                        <input type="hidden" class="cart_product_price_{{ $details->product_id }}" value="{{ $details->product_price }}">
                        <input type="hidden" class="cart_product_qty_{{ $details->product_id }}" value="1">
                        <span>
                            <span>{{ number_format($details->product_price) . ' VNĐ' }}</span>
                            <label>Số lượng:</label>
                            <input name="qty" type="number" min="1" value="1" />
                            {{-- <input type="hidden" name="product_id_hidden" value="{{ $details->product_id }}"> --}}
                            {{-- <button type="submit" class="btn btn-fefault cart">
                                <i class="fa fa-shopping-cart"></i>
                                Thêm giỏ hàng
                            </button> --}}
                        </span>
                        <button type="button" class="btn btn-default add-to-cart" data-id_product="{{ $details->product_id }}" name="add-to-cart">
                            <i class="fa fa-shopping-cart"></i> Thêm giỏ hàng
                        </button>
                    </form>
                    <p><b>Tình trạng:</b> Còn hàng</p>
                    <p><b>Điều kiện:</b> Mới 100%</p>
                    <p><b>Thương hiệu:</b> {{ $details->brand_name }}</p>
                    <p><b>Danh mục:</b> {{ $details->cat_name }}</p>
                    <a href=""><img src="{{asset('public/frontend/images/product-details/share.png')}}" class="share img-responsive" alt="" /></a>
                </div>
                <!--/product-information-->
            </div>
        </div>
        <!--/product-details-->
        <div class="category-tab shop-details-tab">
            <!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab">Chi tiết</a></li>
                    {{-- <li><a href="#companyprofile" data-toggle="tab">Nhà sản xuất</a></li> --}}
                    <li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="details">
                    <div class="col-sm-12">
                        <ul>
                            <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                            <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                            <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                        </ul>
                        <p>{!! $details->product_desc !!}</p>
                    </div>
                </div>

                {{-- <div class="tab-pane fade" id="companyprofile">
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/gallery1.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/gallery3.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/gallery2.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="images/home/gallery4.jpg" alt="" />
                                    <h2>$56</h2>
                                    <p>Easy Polo Black Edition</p>
                                    <button type="button" class="btn btn-default add-to-cart"><i
                                            class="fa fa-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="tab-pane fade" id="reviews">
                    <div class="col-sm-12">
                        <ul>
                            <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                            <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                            <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in
                            voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        <p><b>Write Your Review</b></p>

                        <form action="#">
                            <span>
                                <input type="text" placeholder="Your Name" />
                                <input type="email" placeholder="Email Address" />
                            </span>
                            <textarea name=""></textarea>
                            <b>Rating: </b> <img src="{{asset('public/frontend/images/product-details/rating.png')}}" alt="" />
                            <button type="button" class="btn btn-default pull-right">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <!--/category-tab-->
    @endforeach
    <div class="recommended_items">
        <!--recommended_items-->
        <h2 class="title text-center">sản phẩm liên quan</h2>

        <div class="owl-carousel owl-theme owl-loaded owl-drag">
            <div class="owl-stage-outer">
                <div class="owl-stage">
                     @foreach ($related_product as $key => $related)
                        <div class="owl-item">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <form >
                                            @csrf
                                            <input type="hidden" class="cart_product_id_{{ $related->product_id }}" value="{{ $related->product_id }}">
                                            <input type="hidden" class="cart_product_name_{{ $related->product_id }}" value="{{ $related->product_name }}">
                                            <input type="hidden" class="cart_product_image_{{ $related->product_id }}" value="{{ $related->product_image }}">
                                            <input type="hidden" class="cart_product_price_{{ $related->product_id }}" value="{{ $related->product_price }}">
                                            <input type="hidden" class="cart_product_qty_{{ $related->product_id }}" value="1">

                                            <a href="{{ URL::to('/product-details/' . $related->product_slug) }}">
                                                <img src="{{ URL::to('public/uploads/product/' . $related->product_image) }}" width="250px"
                                                height="250px" alt="" />
                                            </a>
                                            <div class="product-text">
                                                <h2>{{ number_format($related->product_price) . ' VNĐ' }}</h2>
                                                <p>{{ $related->product_name }}</p>

                                                <button type="button" class="btn btn-default add-to-cart" data-id_product="{{ $related->product_id }}" name="add-to-cart">
                                                    <i class="fa fa-shopping-cart"></i> Thêm giỏ hàng
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!--/recommended_items-->
<!--features_items-->


@endsection
