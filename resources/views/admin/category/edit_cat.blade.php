@extends('admin_layout');
@section('admin_content')
    <div class="form-w3layouts">
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                <section class="panel">
                    <header class="panel-heading">
                        Cập nhật danh mục sản phẩm
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
                            <form role="form" method="POST" action="{{ URL::to('/update-cat/' . $edit_cat->cat_id) }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" name="cat_name" value="{{ $edit_cat->cat_name }}"
                                        class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none" rows="5" type="text" name="cat_desc" class="form-control"
                                        id="cat_ckeditor1" placeholder="Mô tả">
                                            {{ $edit_cat->cat_desc }}
                                        </textarea>
                                </div>
                                {{-- <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="cat_status" class="form-control input-sm m-bot15">
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    </select>
                                </div> --}}
                                <button type="submit" name="update_cat" class="btn btn-info">Cập nhật</button>
                            </form>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
