@extends('layout_single')
@section('content_single')

<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="signup-form"><!--sign up form-->
                    <h2>Chỉnh sửa thông tin cá nhân</h2>
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @elseif(session()->has('error'))
                            <div class="alert alert-danger">
                            {!! session()->get('error') !!}
                        </div>
                    @endif
                    <form action="{{URL::to('/edit-customer/'. Session::get('customer_id'))}}" method="POST">
                        {{ csrf_field() }}
                        <input type="text" name="customer_name" placeholder="Họ tên*"
                        class="form-control @error('customer_name') is-invalid @enderror" value="{{Session::get('customer_name')}}"/>
                        @error('customer_name')
                            <span class="invalid-feedback" role="alert">
                                {{$message}}
                            </span>
                        @enderror
                        <input type="email" name="customer_email" placeholder="Email*"
                        class="form-control @error('customer_email') is-invalid @enderror" value="{{Session::get('customer_email')}}"/>
                        @error('customer_email')
                            <span class="invalid-feedback" role="alert">
                                {{$message}}
                            </span>
                        @enderror
                        <input type="password" name="customer_password" placeholder="Mật khẩu*"
                        class="form-control @error('customer_password') is-invalid @enderror" value="{{Session::get('customer_password')}}"/>
                        @error('customer_password')
                            <span class="invalid-feedback" role="alert">
                                {{$message}}
                            </span>
                        @enderror
                        <input type="text" name="customer_phone" placeholder="Số điện thoại*"
                        class="form-control @error('customer_email') is-invalid @enderror" value="{{Session::get('customer_phone')}}"/>
                        @error('customer_phone')
                            <span class="invalid-feedback" role="alert">
                                {{$message}}
                            </span>
                        @enderror
                        <button type="submit" name="add_customer" class="btn btn-default">Cập nhật</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->

@endsection
