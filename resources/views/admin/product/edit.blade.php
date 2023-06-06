@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm sản phẩm
        </div>
        <div class="card-body">
            <form action="{{url('admin/product/update_product', $product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="name">Tên sản phẩm</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{$product->name}}">
                            @error('name')
                            <small style="color:red; font-size: 15px;">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price">Giá Hiện Tại</label>
                            <input class="form-control" type="text" name="price" id="name" value="{{$product->price}}">
                            @error('price')
                            <small style="color:red; font-size: 15px;">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="price_old">Giá Cũ</label>
                            <input class="form-control" type="text" name="price_old" id="name" value="{{$product->price_old}}">
                            @error('price_old')
                            <small style="color:red; font-size: 15px;">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="intro">Mô tả sản phẩm</label>
                            <textarea name="intro" class="form-control" id="intro" cols="30" rows="5">{{$product->intro}}</textarea>
                            @error('intro')
                            <small style="color:red; font-size: 15px;">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="detail">Chi tiết sản phẩm</label>
                    <textarea name="detail" class="form-control" id="detail" cols="30" rows="5">{{$product->detail}}</textarea>
                    @error('detail')
                    <small style="color:red; font-size: 15px;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="images" style="font-weight:bold;">** Hình Ảnh Sản Phẩm Cũ</label> <br>
                    <div id="images" style="max-width:300px; border:2px solid grey; min-height:135px;overflow:hidden;" title="Hiển Thị Ảnh !">
                        <img style="height:150px; width:150px;" src="{{url($product->images_product)}}" alt="">
                    </div> <br><br><br>
                    <label for="images" style="font-weight:bold;">** Upload Ảnh Sản Phẩm Mới</label> <br>
                    <input type="file" name="images_product" id="file-uploader" class="form-control-file  mb-0" accept=".jpg, .jpeg, .png"> <br>
                    <div id="image-grid" style="width:300px; border:2px solid grey; min-height:135px;overflow:hidden;" title="Hiển Thị Ảnh !">

                    </div>
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
                <button type="submit" class="btn btn-primary">Cập Nhật</button>
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
<script>
    const fileUploader = document.getElementById('file-uploader');
    const reader = new FileReader();
    const imageGrid = document.getElementById('image-grid');

    fileUploader.addEventListener('change', (event) => {
        const files = event.target.files;
        const file = files[0];
        reader.readAsDataURL(file);

        reader.addEventListener('load', (event) => {
            const img = document.createElement('img');
            imageGrid.appendChild(img);
            img.src = event.target.result;
            img.alt = file.name;
        });
    });
</script>
@endsection