@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header font-weight-bold">
        @if($list_success_orders->total() > 0)
        DANH SÁCH KHÁCH HÀNG ĐANG XỬ LÝ VẬN CHUYỂN
    </div>
    <div class="card-body">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Mã Khách hàng</th>
                    <th scope="col">Khách hàng</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Tổng Giá</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Thời gian</th>
                    <th scope="col">Chi Tiết</th>
                    <th scope="col">Tác vụ</th>
                </tr>
            </thead>
            <tbody>
                @php
                $stt=0;
                @endphp
                @foreach($list_success_orders as $show)
                @php
                $stt++;
                @endphp
                <tr>
                    <th scope="row">{{$stt}}</th>
                    <td><a href="{{url('admin/order/order_detail', $show->id)}}" style="text-transform:uppercase; color:black;">{{$show->MaKH}}</a></td>
                    <td>
                        {{$show->fullname}}
                    </td>
                    <td>{{$show->phone}}</td>
                    <td>{{$show->sub_total}}đ</td>
                    <td class="">
                        <span class="badge badge-warning p-1">{{ $show->status }}</span>
                    </td>
                    <td>{{$show->created_at}}</td>
                    <td class="pl-4">
                        <a href="{{url('admin/order/order_detail', $show->id)}}" style="border: 1px solid royalblue;padding:6px; background:aliceblue; border-radius:10px;" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-ellipsis-h" style="color:blue;" aria-hidden="true"></i></a>

                    </td>
                    <td class="pl-4">
                        <a style="width:30px;" href="{{url('admin/order/delete', $show->id)}}" onclick="return confirm('Bạn Có Chắc Muốn Xóa Bản Ghi Này !')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{$list_success_orders->links()}}
    </div>
    @else
    <p class="text-danger"> HIỆN TẠI CHƯA CÓ KHÁCH HÀNG NÀO ĐANG XỬ LÝ !</p>
    @endif
</div>
@endsection