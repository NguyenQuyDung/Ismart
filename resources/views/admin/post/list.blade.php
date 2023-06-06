@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách bài viết</h5>
            <div class="form-search form-inline">
                <form action="#" class="d-flex">
                    <input type="text" class="form-control form-search" placeholder="Tìm kiếm" name="keyword" value="{{request()->input('keyword')}}">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['status'=>'active'])}}" class="text-primary">Kích Hoạt<span class="text-muted">({{$count[0]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'trash'])}}" class="text-primary">Vô Hiệu Hóa<span class="text-muted">({{$count[1]}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'Pending'])}}" class="text-primary">Công Khai<span class="text-muted">({{$count_Pending}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'public'])}}" class="text-primary">Chờ Duyệt<span class="text-muted">({{$count_public}})</span></a>
            </div>
            <form action="{{url('admin/post/action')}}">
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" id="" name="act">
                        <option>Chọn</option>
                        @foreach($list_act as $k => $act)
                        <option value="{{$k}}">{{$act}}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                </div>
                @if($posts->total()>0)
                <table class="table table-striped table-checkall table-hover">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input name="checkall" type="checkbox">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Trạng Thái</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Người Tạo</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $stt=0;
                        @endphp
                        @foreach ($posts as $post)
                        @php
                        $stt++;
                        @endphp
                        <tr>
                            <td>
                                <input type="checkbox" name="list_check[]" value="{{$post->id}}">
                            </td>
                            <td scope="row">{{$stt}}</td>

                            <td><img style="width:60px; height:60px;" src="{{url($post->images)}}" alt=""></td>

                            <td><a href="#">{{$post->name}}</a></td>
                            <td>{{$post->postcat->name}}</td>
                            <td>{{$post->status}}</td>
                            <td>{{$post->created_at}}</td>
                            <td>{{$post->user_create}}</td>
                            <td>
                                <a style="width:30px;" href="{{url('admin/post/edit', $post->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <a style="width:30px;" href="{{url('admin/post/delete', $post->id)}}" onclick="return confirm('Bạn Có Chắc Muốn Xóa Bản Ghi Này !')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="alert alert-danger">Không Tìm Thấy Bản Ghi Nào Trên Hệ Thống !</p>
                @endif
                {{$posts->links()}}
            </form>
        </div>
    </div>
</div>
@endsection