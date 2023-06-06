@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm bài viết
        </div>
        <div class="card-body">
            <form action="{{url('admin/post/add_post')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Tiêu đề bài viết</label>
                    <input class="form-control" type="text" name="name" id="name">
                    @error('name')
                    <small style="color:red; font-size: 15px;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Nội dung bài viết</label>
                    <textarea name="content" class="form-control" id="content" cols="30" rows="5"></textarea>
                    @error('content')
                    <small style="color:red; font-size: 15px;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Chi Tiết bài viết</label>
                    <textarea name="detail" class="form-control" id="content" cols="30" rows="5"></textarea>
                    @error('detail')
                    <small style="color:red; font-size: 15px;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="images">Hình Ảnh bài viết</label>
                    <input type="file" name="images" class="form-control-file">
                    @error('images')
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
@endsection