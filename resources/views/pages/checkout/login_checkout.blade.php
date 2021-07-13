@extends('layout_single')
@section('content_single')

<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="login-form"><!--login form-->
                    <h2>Đăng nhập tài khoản</h2>
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {!! session()->get('message') !!}
                        </div>
                    @elseif(session()->has('error'))
                            <div class="alert alert-danger">
                            {!! session()->get('error') !!}
                        </div>
                    @endif
                    <form action="{{URL::to('/login-customer')}}" method="POST">
                        {{ csrf_field() }}
                        <input type="email" name="customer_email" placeholder="Email"
                        class="form-control @error('customer_email') is-invalid @enderror" value="{{old('customer_email')}}"/>
                        @error('customer_email')
                            <span class="invalid-feedback" role="alert">
                                {{$message}}
                            </span>
                        @enderror
                        <input type="password" name="customer_password" placeholder="Mật khẩu"
                        class="form-control @error('customer_password') is-invalid @enderror" value="{{old('customer_password')}}"/>
                        @error('customer_password')
                            <span class="invalid-feedback" role="alert">
                                {{$message}}
                            </span>
                        @enderror
                        <div class="remember">
                            <span>
                                <input type="checkbox" class="checkbox">
                                Lưu mật khẩu
                            </span>

                            <a href="{{URL::to('/register-customer')}}">Đăng ký tài khoản</a>
                        </div>

                        <button type="submit" name="login_customer" class="btn btn-default">Đăng nhập</button>
                    </form>
                </div><!--/login form-->
            </div>
        </div>
    </div>
</section><!--/form-->

@endsection
