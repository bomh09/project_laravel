@extends('admin_layout');
@section('admin_content')
    <div class="form-w3layouts">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Thêm mã giảm giá
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {!! session()->get('message') !!}
                                </div>
                            @elseif(session()->has('error'))
                                    <div class="alert alert-danger">
                                    {!! session()->get('error') !!}
                                </div>
                            @endif
                            <form role="form" method="POST" action="{{ URL::to('/save-coupon') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                    <input type="text" name="coupon_name" class="form-control @error('coupon_name') is-invalid @enderror"
                                    id="exampleInputEmail1" placeholder="Tên mã giảm giá">
                                    @error('coupon_name')
                                        <span class="invalid-feedback" role="alert">
                                            {{$message}}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã giảm giá</label>
                                    <input type="text" name="coupon_code" class="form-control @error('coupon_code') is-invalid @enderror"
                                    id="exampleInputEmail1" placeholder="Mã giảm giá">
                                    @error('coupon_code')
                                        <span class="invalid-feedback" role="alert">
                                            {{$message}}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng</label>
                                    <input type="text" name="coupon_qty" class="form-control @error('coupon_qty') is-invalid @enderror"
                                    id="exampleInputEmail1" placeholder="Số lượng">
                                    @error('coupon_qty')
                                        <span class="invalid-feedback" role="alert">
                                            {{$message}}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tính năng mã</label>
                                    <select name="coupon_condition" class="form-control input-sm m-bot15">
                                        <option value="1">Giảm theo %</option>
                                        <option value="2">Giảm theo tiền</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nhập số % hoặc số tiền giảm</label>
                                    <input type="text" name="coupon_number" class="form-control @error('coupon_number') is-invalid @enderror"
                                    id="exampleInputEmail1" placeholder="Nhập số % hoặc số tiền giảm">
                                    @error('coupon_number')
                                        <span class="invalid-feedback" role="alert">
                                            {{$message}}
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" name="add_coupon" class="btn btn-info">Thêm</button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
