@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm sản phẩm
        </div>
        <div class="card-body">
            <form action="{{url('admin/product/add_product')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input class="form-control" type="text" name="name" id="name">
                            @error('name')
                            <small style="color:red; font-size: 15px;">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Giá Hiện Tại</label>
                            <input class="form-control" type="text" name="price" id="name">
                            @error('price')
                            <small style="color:red; font-size: 15px;">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price_old">Giá Cũ</label>
                            <input class="form-control" type="text" name="price_old" id="name">
                            @error('price_old')
                            <small style="color:red; font-size: 15px;">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="intro">Mô tả sản phẩm</label>
                            <textarea name="intro" class="form-control" id="intro" cols="30" rows="5"></textarea>
                            @error('intro')
                            <small style="color:red; font-size: 15px;">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="detail">Chi tiết sản phẩm</label>
                    <textarea type="file" name="detail" class="form-control" id="detail" cols="30" rows="5"></textarea>
                    @error('detail')
                    <small style="color:red; font-size: 15px;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="images">Hình Ảnh Sản Phẩm</label> <br>
                    <input type="file" name="images_product" id="images_product"> <br>
                    @error('images_product')
                    <small style="color:red; font-size: 15px;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select class="form-control" id="" name="cat_id">
                        <option value="0">Chọn danh mục</option>
                        @php
                        $list_cat = showCats($category);
                        @endphp
                        @foreach($list_cat as $item)
                        <option value="{{$item->id}}">{{str_repeat('---', $item->level) . $item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Trạng thái</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="Còn Hàng" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Còn Hàng
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="Hết Hàng">
                        <label class="form-check-label" for="exampleRadios2">
                            Hết Hàng
                        </label>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Thêm mới</button>
            </form>
        </div>
    </div>
</div>
<?php
function showCats($category, $parent_id = 0, $level = 0)
{
    $result = [];
    foreach ($category as $item) {
        if ($item['parent_id'] == $parent_id) {
            $item['level'] = $level;
            $result[] = $item;
            $child = showCats($category, $item['id'], $level + 1);
            $result = array_merge($result, $child);
        }
    }
    return $result;
}
?>
@endsection