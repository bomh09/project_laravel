@extends('layout_single')
@section('content_single')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Kết quả tìm kiếm có {{count($search_product)}} sản phẩm</h2>
    <?php   ?>
    @foreach ($search_product as $key=>$search)
        <div class="col-sm-3">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <form >
                            @csrf
                            <input type="hidden" class="cart_product_id_{{ $search->product_id }}" value="{{ $search->product_id }}">
                            <input type="hidden" class="cart_product_name_{{ $search->product_id }}" value="{{ $search->product_name }}">
                            <input type="hidden" class="cart_product_image_{{ $search->product_id }}" value="{{ $search->product_image }}">
                            <input type="hidden" class="cart_product_price_{{ $search->product_id }}" value="{{ $search->product_price }}">
                            <input type="hidden" class="cart_product_qty_{{ $search->product_id }}" value="1">

                            <a href="{{ URL::to('/product-details/' . $search->product_slug) }}">
                                <img src="{{ URL::to('public/uploads/product/' . $search->product_image) }}"  alt="" />
                            </a>
                            <div class="product-text">
                                <h2>{{ number_format($search->product_price) . ' VNĐ' }}</h2>
                                <p>{{ $search->product_name }}</p>

                                <button type="button" class="btn btn-default add-to-cart" data-id_product="{{ $search->product_id }}" name="add-to-cart">
                                    <i class="fa fa-shopping-cart"></i> Thêm giỏ hàng
                                </button>
                            </div>
                        </form>
                    </div>
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
</div><!--features_items-->
@endsection
