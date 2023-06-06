@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm bài viết
        </div>
        <div class="card-body">
            <form action="{{url('admin/post/update', $post->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Tiêu đề bài viết</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{$post->name}}">
                    @error('name')
                    <small style="color:red; font-size: 15px;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Nội dung bài viết</label>
                    <textarea name="content" class="form-control" id="content" cols="30" rows="5">{{$post->content}}</textarea>
                    @error('content')
                    <small style="color:red; font-size: 15px;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Chi Tiết bài viết</label>
                    <textarea name="detail" class="form-control" id="content" cols="30" rows="5">{{$post->detail}}</textarea>
                    @error('detail')
                    <small style="color:red; font-size: 15px;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="images"style="font-weight:bold;">** Hình Ảnh bài viết Cũ</label>
                    <div id="image" style="max-width:300px; border:2px solid grey; min-height:135px;overflow:hidden;" title="Hiển Thị Ảnh !">
                        <img style="height:150px; width:500px;" src="{{url($post->images)}}" alt="">
                    </div> <br><br><br>
                    <label for="images"style="font-weight:bold;">** Upload Hình Ảnh bài viết Mới</label>
                    <input type="file" name="images" id="file-uploader" class="form-control-file  mb-0" accept=".jpg, .jpeg, .png"  value="{{$post->images}}">
                  <br>  <div id="image-grid" style="width:300px; border:2px solid grey; min-height:135px;overflow:hidden;" title="Hiển Thị Ảnh !">

                    </div>
                    @error('images')
                    <small style="color:red; font-size: 15px;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Danh mục</label>
                    <select class="form-control" id="" name="cat_id" value="{{$post->cat_id}}">
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
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="Chờ Duyệt" checked>
                        <label class="form-check-label" for="exampleRadios1">
                            Chờ duyệt
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="Công Khai">
                        <label class="form-check-label" for="exampleRadios2">
                            Công khai
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