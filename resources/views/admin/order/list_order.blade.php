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
            <h5 class="m-0 ">Danh Sách Khách Hàng</h5>
            <div class="form-search form-inline">
                <form action="#" class="d-flex">
                    <input type="" class="form-control form-search" placeholder="Tìm kiếm" name="keyword">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['status'=>'Complete'])}}" class="text-primary">Vận Chuyển Thành Công<span class="text-muted">({{$count_complete}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'Processing'])}}" class="text-primary">Đang Xử Lý<span class="text-muted">({{$count_completess}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'being_transported'])}}" class="text-primary">Đang Vận Chuyển<span class="text-muted">({{$count_completes}})</span></a>
            </div>
            <form action="{{url('admin/list_order/action')}}">
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" id="" name="act">
                        <option>Chọn</option>
                        @foreach($list_act as $k => $act)
                        <option value="{{$k}}">{{$act}}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                </div>
                @if($clients->total()>0)

                <table class="table table-striped table-checkall table-hover">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="checkall">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Mã Khách Hàng</th>
                            <th scope="col">Khách hàng</th>
                            <th scope="col">Số Điện Thoại</th>
                            <th scope="col">Tổng Tiền</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Thời gian</th>
                            <th scope="col" style="padding-left:2px;">Chi tiết</th>

                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $stt=0;
                        @endphp
                        @foreach($clients as $client)
                        @php
                        $stt++;
                        @endphp
                        <tr>
                            <td>
                                <input type="checkbox" name="list_check[]" value="{{$client->id}}">
                            </td>
                            <td>{{$stt}}</td>
                            <td style="font-weight:bold;text-transform: uppercase;"><a href="{{url('admin/order/order_detail', $client->id)}}" style="color:black;">{{$client->MaKH}}</a></td>
                            <td>
                                {{$client->fullname}}

                            </td>
                            <td><a href="#">{{$client->phone}}</a></td>
                            <td style="color:red;">{{$client->sub_total}}đ</td>
                            @if ($client->status == 'Hoàn Tất')
                            <td class="">
                                <span class="badge badge-success p-1">{{ $client->status }}</span>
                            </td>
                            @elseif($client->status == 'Đang Xử Lý')
                            <td><span class="badge badge-warning p-1">{{$client->status}}</span></td>
                            @else ($client->status == 'Đang Vận Chuyển')
                            <td class="text-success"><span class="p-1 badge badge-info">{{ $client->status }}</span></td>
                            @endif
                            <td class="">{{$client->created_at}}</td>
                            <td>
                                <a href="{{url('admin/order/order_detail', $client->id)}}" style="border: 1px solid royalblue;padding:6px; background:aliceblue; border-radius:10px;" class="" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-ellipsis-h" style="color:blue;" aria-hidden="true"></i></a>

                            </td>
                            <td>
                                <a style="width:30px;" href="{{url('admin/order/delete', $client->id)}}" onclick="return confirm('Bạn Có Chắc Muốn Xóa Bản Ghi Này !')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </table>
                @else
                <p class="alert alert-danger">Không Tìm Thấy Thông Tin Khách Hàng Nào Trên Hệ Thống !</p>
                @endif
                {{$clients->links()}}
            </form>
        </div>
    </div>
</div>
@endsection