@extends('layout')
@section('content')
    <div class="features_items">
        <!--features_items-->
        @foreach ($brand_name as $key => $brand_name)
            <h2 class="title text-center">{{ $brand_name->brand_name }}</h2>
        @endforeach
        @foreach ($product_by_brand as $key => $pro)
            <div class="col-sm-3">
                <div class="product-image-wrapper">
                    <div class="single-products">
                        <div class="productinfo text-center">
                            <form >
                                @csrf
                                <input type="hidden" class="cart_product_id_{{ $pro->product_id }}" value="{{ $pro->product_id }}">
                                <input type="hidden" class="cart_product_name_{{ $pro->product_id }}" value="{{ $pro->product_name }}">
                                <input type="hidden" class="cart_product_image_{{ $pro->product_id }}" value="{{ $pro->product_image }}">
                                <input type="hidden" class="cart_product_price_{{ $pro->product_id }}" value="{{ $pro->product_price }}">
                                <input type="hidden" class="cart_product_qty_{{ $pro->product_id }}" value="1">

                                <a href="{{ URL::to('/product-details/' . $pro->product_slug) }}">
                                    <img src="{{ URL::to('public/uploads/product/' . $pro->product_image) }}" width="250px"
                                    height="250px" alt="" />
                                </a>
                                <div class="product-text">
                                    <h2>{{ number_format($pro->product_price) . ' VNĐ' }}</h2>
                                    <p>{{ $pro->product_name }}</p>

                                    <button type="button" class="btn btn-default add-to-cart" data-id_product="{{ $pro->product_id }}" name="add-to-cart">
                                        <i class="fa fa-shopping-cart"></i> Thêm giỏ hàng
                                    </button>
                                </div>
                            </form>
                        </div>
                            {{-- <div class="product-overlay">
                            <div class="overlay-content">
                                <h2>{{$pro->product_price}}</h2>
                                <p>{{$pro->product_name}}</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </div>
                        </div> --}}
                    </div>
                    <div class="choose">
                        <ul class="nav nav-pills nav-justified">
                            <li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
                            <li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!--features_items-->

    <div class="recommended_items">
        <!--recommended_items-->
        <h2 class="title text-center">sản phẩm đề xuất</h2>

        <div class="owl-carousel owl-theme owl-loaded owl-drag">
            <div class="owl-stage-outer">
                <div class="owl-stage">
                    @foreach ($product->take(12) as $key => $pro)
                        <div class="owl-item">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <form >
                                            @csrf
                                            <input type="hidden" class="cart_product_id_{{ $pro->product_id }}" value="{{ $pro->product_id }}">
                                            <input type="hidden" class="cart_product_name_{{ $pro->product_id }}" value="{{ $pro->product_name }}">
                                            <input type="hidden" class="cart_product_image_{{ $pro->product_id }}" value="{{ $pro->product_image }}">
                                            <input type="hidden" class="cart_product_price_{{ $pro->product_id }}" value="{{ $pro->product_price }}">
                                            <input type="hidden" class="cart_product_qty_{{ $pro->product_id }}" value="1">

                                            <a href="{{ URL::to('/product-details/' . $pro->product_slug) }}">
                                                <img src="{{ URL::to('public/uploads/product/' . $pro->product_image) }}" width="250px"
                                                    height="250px" alt="" />
                                            </a>
                                            <div class="product-text">
                                                <h2>{{ number_format($pro->product_price) . ' VNĐ' }}</h2>
                                                <p>{{ $pro->product_name }}</p>

                                                <button type="button" class="btn btn-default add-to-cart" data-id_product="{{ $pro->product_id }}" name="add-to-cart">
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
@endsection
