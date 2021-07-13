@extends('admin_layout');
@section('admin_content')
    <div class="form-w3layouts">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Thêm phí vận chuyển
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
                            <form>
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tỉnh thành phố</label>
                                    <select name="province" id="province" class="form-control input-sm m-bot15 choose province">
                                        <option value="0">---- Chọn tỉnh thành phố -----</option>
                                        @foreach($province as $key => $city)
                                             <option value="{{$city->province_id}}">{{$city->province_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Quận huyện</label>
                                    <select name="district" id="district" class="form-control input-sm m-bot15 choose district">
                                        <option value="0">---- Chọn quận huyện -----</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Xã phường</label>
                                    <select name="ward" id="ward" class="form-control input-sm m-bot15 ward">
                                        <option value="0">---- Chọn xã phường -----</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phí vận chuyển</label>
                                    <input type="text" name="fee_shipping" class="form-control fee_shipping" id="exampleInputEmail1"
                                        placeholder="Phí vận chuyển">
                                </div>
                                <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm phí vận chuyển</button>
                            </form>
                        </div>
                        <div id="load_delivery">
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
