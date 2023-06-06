@extends('layouts.admin')
@section('content')
<div id="wp-content" style="padding:0rem !important;">
    <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-md-12 text-center">
                <p class="btn btn-success pt-2 pb-2 form-control">Quản Lý Menu User</p>
            </div>
        </div>
    </div>
    <div class="row container-fluid">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name_menu"> (*)Tên Menu</label>
                <input type="text" placeholder="Tên menu" id="name_menu" name="name_menu" class="form-control">
            </div>
            <div class="form-group">
                <label for="name_slug"> (*)Tên Đường dẫn</label>
                <input type="text" placeholder="Tên đường dẫn" name="name_slug" id="name_slug" class="form-control">
            </div>
            <div class="form-group">
                <div class="section-detail clearfix">
                    <div id="list-menu" class="fl-left">
                        <div class="form-group clearfix">
                            <label class="d-block">(*)Trang</label>
                            <select name="page_slug" class="form-control d-block">
                                <option value="0">-- Chọn --</option>
                                <option value="lien-he">Liên hệ</option>
                                <option value="giai-dap">Giải đáp</option>
                                <option value="gioi-thieu">Giới thiệu</option>
                                <option value="bai-viet-moi">Bài viết mới</option>
                                <option value="san-pham">Sản phẩm</option>
                            </select>
                            <small>Trang liên kết đến menu</small>
                        </div>
                        <div class="form-group clearfix">
                            <label class="d-block">(*)Danh mục sản phẩm</label>
                            <select name="product_id" class="d-block form-control">
                                <option value="0">-- Chọn --</option>
                                <option value="1">Liên hệ</option>
                                <option value="giai-dap">Giải đáp</option>
                                <option value="gioi-thieu">Giới thiệu</option>
                                <option value="2">Hướng dẫn giao hàng</option>
                            </select>
                            <small>Danh mục sản phẩm liên kết đến menu</small>
                        </div>
                        <div class="form-group clearfix">
                            <label class="d-block">(*)Danh mục bài viết</label>
                            <select name="post_id" class="d-block form-control">
                                <option value="0">-- Chọn --</option>
                                <option value="lien-he">Liên hệ</option>
                                <option value="giai-dap">Giải đáp</option>
                                <option value="gioi-thieu">Giới thiệu</option>
                                <option value="bai-viet-moi">Bài viết mới</option>
                                <option value="2">Hướng dẫn giao hàng</option>
                            </select>
                            <small>Danh mục bài viết liên kết đến menu</small>
                        </div>
                        <div class="form-group clearfix">
                            <label class="d-block">(*)Danh mục cha</label>
                            <select name="parent_id" class="d-block form-control">
                                <option value="0">-- Chọn --</option>
                            </select>
                            <small>Danh mục sản phẩm liên kết đến menu</small>
                        </div>
                        <div class="form-group">
                            <label for="menu-order">(*)Thứ tự</label>
                            <input type="text" name="menu_order" id="menu-order" class="form-control">
                        </div>
                        <p class="mess_error"></p>
                        <div class="form-group">
                            <button type="submit" name="sm_add" id="btn-save-list" class="p-2 btn btn-success form-control demo">Lưu danh mục</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <table class="table table-hover">
                <thead>
                    <tr class="">
                        <td>
                            <input type="checkbox" name="list_check[]" value="">
                        </td>
                        <th scope="col">STT</th>
                        <th scope="col">Tên menu </th>
                        <th scope="col">Slug</th>
                        <th scope="col">Thứ tự</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
            </table>
            <small class="alert alert-danger mt-2 d-block">Đội Ngũ Chúng Tôi Sẽ Hoàn Thiện Thêm Chức Năng Này Cảm ơn Bạn đã ghé thăm !</small>
        </div>
    </div>
</div>
@endsection('content')