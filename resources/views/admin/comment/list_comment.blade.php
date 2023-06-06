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
            <h5 class="m-0 ">Danh sách comment và đánh giá sản phẩm</h5> <br>
            <div class="form-search form-inline">
                <form action="#" class="d-flex">
                    <input type="text" class="form-control form-search" placeholder="Tìm kiếm" name="keyword" value="{{request()->input('keyword')}}">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn" style="background-color:blue; color:#fff;">
                </form>
            </div>
        </div>
        <div id="notifly_comment_success" class="mt-2">

        </div>
        <div id="delete_comment_success" class="mt-2">

        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="" readonly="readonly" class="text-primary">Phê Duyệt Comment<span class="text-muted">({{$count_pending_comment}})</span></a>
                <a href="" readonly="readonly" class="text-primary">Chờ Duyệt Comment<span class="text-muted">({{$count_danger_comment}})</span></a>
                <a href="" readonly="readonly" class="text-primary">Thùng Rác<span class="text-muted">(0)</span></a>
            </div>
            <form action="">
                <div class="form-action form-inline py-3">
                    <input type="button" name="btn-search" value="DANH SÁCH COMMENT ĐÁNH GIÁ SẢN PHẨM TẠI ISMART" class="btn btn-primary" style=" background:blue; width:100%;">
                </div>
                @if($comments->total()>0)
                <table class="table table-striped table-checkall table-hover">
                    <thead>
                        <tr>
                            <style>
                                th {
                                    font-size: 14px;
                                    ;
                                }
                            </style>
                            <th scope="col">
                                <input name="checkall" type="checkbox">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Duyệt</th>
                            <th scope="col">Tên Người Đánh Giá</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Bình Luận</th>
                            <th scope="col">Ngày Đánh Giá</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $stt=0;
                        @endphp
                        @foreach ($comments as $key => $comment)
                        @php
                        $stt++;
                        @endphp
                        <tr class="">
                            <td>
                                <input type="checkbox" name="list_check[]" value="">
                            </td>
                            <td>{{$stt}}</td>
                            @if($comment->comment_status == 1)
                            <td><input type="button" data-comment_status="0" data-comment_id="{{$comment->id}}" style="font-size:13px;" id="{{$comment->comment_product_id}}" class="btn btn-success btn-xs comment_duyet_btn" value="Phê Duyệt"></td>
                            @else
                            <td> <input type="button" data-comment_status="1" data-comment_id="{{$comment->id}}" style="font-size:13px;" id="{{$comment->comment_product_id}}" class="btn btn-danger btn-xs comment_duyet_btn" value="Bỏ Duyệt">
                            </td>
                            @endif
                            <td><a href="#" style="font-size:14px;">{{$comment->comment_name}}</a></td>
                            <td><a href="{{url('san-pham/'.$comment->product->slug.'/'.$comment->product->name)}}" style="font-size:14px;" target="blank" style="font-size:15px;text-decoration: underline;">{{$comment->product->name}}</a></td>
                            <td><a href="" style="color:black; font-weight:bold; font-size:14px;">{{$comment->comment}}</a> <br>
                                <style>
                                    ul {
                                        margin-bottom: 0px;
                                    }

                                    ul li {
                                        list-style-type: decimal;
                                        margin-left: 20px;
                                        color: blue;
                                    }
                                </style>
                                <ul>
                                    @foreach($comment_rep as $key => $comment_reply)
                                    @if($comment_reply->comment_parent_comment == $comment->id)
                                    Đã phản hồi:
                                    <li>
                                        {{$comment_reply->comment}}
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
                                @if($comment->comment_status == 0)
                                <br>
                                <input type="text" class="p-2 reply_comment_{{$comment->id}}" style="border: 2px solid coral;outline: none; width:100%; font-size:14px;border-radius:10px;">
                                <br>
                                <button type="button" class="text-success font-weight-bold btn-reply-comment" style="cursor:pointer;border: none;outline: none;font-size:14px;padding: 0px;" data-comment_id="{{$comment->id}}" data-product_id="{{$comment->comment_product_id}}">Trả lời bình luận</button>
                                @endif
                            </td>
                            <td><a href="">{{$comment->created_at}}</a></td>
                            @if($comment->comment_status == 1)
                            <td><span class="badge badge-danger">Đang Chờ Duyệt</span></td>
                            @else
                            <td> <span class="badge badge-success">Đã Phê Duyệt</span>
                                @endif
                                @if($comment->comment_status == 0)
                            <td class="">
                                <a href="{{url('delete-comment', $comment->id)}}" class="btn btn-danger btn-sm rounded-0 text-white delete" type="button" data-toggle="tooltip" data-placement="top" title="Xóa Bình Luận Client"><i class="fa-solid fa-xmark"></i></a>
                            </td>
                            @elseif($comment->comment_status == 1)
                            <td class="">
                                <a href="{{url('delete-comment', $comment->id)}}" class="btn btn-danger btn-sm rounded-0 text-white delete" type="button" data-toggle="tooltip" data-placement="top" title="Xóa Bình Luận Client"><i class="fa-solid fa-xmark"></i></a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <style>
                    ul li {
                        margin: 0px;
                        overflow: hidden;
                    }
                </style>
                {{$comments->links()}}
                @else
                <p class="alert alert-danger">Không Tìm Thấy Bản Ghi Nào Trên Hệ Thống !</p>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection