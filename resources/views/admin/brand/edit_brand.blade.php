@extends('admin_layout');
@section('admin_content')
    <div class="form-w3layouts">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Cập nhật thương hiệu sản phẩm
                    </header>
                    <div class="panel-body">
                        <div class="position-center">
                            <?php
                            $message = Session::get('message');
                            if ($message) {
                            echo $message;
                            Session::put('message', null);
                            }
                            ?>
                            <form role="form" method="POST"
                                action="{{ URL::to('/update-brand/' . $edit_brand->brand_id) }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên thương hiệu</label>
                                    <input type="text" name="brand_name" value="{{ $edit_brand->brand_name }}"
                                        class="form-control" id="exampleInputEmail1" placeholder="Tên thương hiệu">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none" rows="5" type="text" name="brand_desc"
                                        class="form-control" id="brand_ckeditor1" placeholder="Mô tả">
                                        {{ $edit_brand->brand_desc }}
                                    </textarea>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="brand_status" class="form-control input-sm m-bot15">
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div> --}}
                                <button type="submit" name="update_brand" class="btn btn-info">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
