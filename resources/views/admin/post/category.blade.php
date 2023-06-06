@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-4">
            <div class="card">
                @if(session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
                @endif
                <div class="card-header font-weight-bold">
                    Thêm danh mục
                </div>
                <div class="card-body">
                    <form action="{{url('admin/post/store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input class="form-control" type="text" name="name" id="name">
                            @error('name')
                            <small style="color:red; font-size: 15px;">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Đường dẫn slug</label>
                            <input class="form-control" type="text" name="slug" id="slug">
                            @error('slug')
                            <small style="color:red; font-size: 15px;">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="" name="parent_id">
                                <option value="0">Chọn danh mục</option>
                                @php
                                $list_cat = showCats($category);
                                @endphp
                                @foreach($list_cat as $item)
                                <option value="{{$item->id}}">{{str_repeat('---', $item->level) . $item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary form-control">Thêm mới</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh mục
                </div>
                @if($categorys>0)
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên Danh Mục</th>
                                <th scope="col">Link thân thiện</th>
                                <th scope="col">Người Tạo</th>
                                <th scope="col">Tác Vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $list_cat = showCats($category);
                            $stt = 0;
                            @endphp
                            @foreach($list_cat as $item)
                            @php
                            $stt++;
                            @endphp
                            <tr>
                                <th scope="row">{{$stt}}</th>
                                <td>{{str_repeat('---', $item->level) . $item->name}}</td>
                                <td>{{$item->slug}}</td>
                                <td>{{$item->user_create}}</td>
                                <td>
                                    <a href="{{url('admin/post/edit_cat', $item->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="{{url('admin/post/delete_cat', $item->id)}}" onclick="return confirm('Bạn Có Chắc Chắn Muốn Xóa Bản Ghi Này ?')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$category->links()}}
                </div>
                @else
                <p class="alert alert-danger">Không Tìm Thấy Bản Ghi Nào Trên Hệ Thống !</p>
                @endif
            </div>
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