@extends('layouts.admin')
@section('content')
<div class="container-fluid py-5">
    <div class="row">
        <div class="col">
            <a href="{{url('admin/list/successful/order')}}">
                <div class="card text-white bg-primary mb-3" style="max-width: 18rem; height:200px;">
                    <div class="card-header">ĐƠN HÀNG THÀNH CÔNG</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$count_complete}}</h5>
                        <p class="card-text">Đơn hàng giao dịch thành công</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{url('admin/list/processing/order')}}">
                <div class="card text-white bg-danger mb-3" style="max-width: 18rem;height:200px;">
                    <div class="card-header">ĐANG XỬ LÝ</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$count_completesss}}</h5>
                        <p class="card-text">Số lượng đơn hàng đang xử lý</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col">
            <div class="card text-white bg-success mb-3" style="max-width: 18rem;height:200px;">
                <div class="card-header">DOANH SỐ</div>
                <div class="card-body">
                    @if($revenue < 1) <h5 class="card-title">0<span>Đ</span></h5>
                        @elseif($revenue < 999) <h5 class="card-title">{{number_format($revenue, 0, ',', '.')}}.000.000 <span>VND</span></h5>
                            @else
                            <h5 class="card-title">{{number_format($revenue, 0, ',', '.')}}.000.000<span>VND</span></h5>
                            @endif
                            <p class="card-text">Doanh số hệ thống</p>
                </div>
            </div>
        </div>
        <div class="col">
            <a href="{{url('admin/list/being_transported/order')}}">
                <div class="card text-white mb-3" style="max-width: 18rem; background-color:blueviolet;height:200px;">
                    <div class="card-header">ĐƠN HÀNG ĐANG VẬN CHUYỂN</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$count_completes}}</h5>
                        <p class="card-text">Số đơn đang vận chuyển ISMART</p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col" style="padding-left:0px;">
            <a href="{{url('admin/list/cancel/order')}}">
                <div class="card text-white bg-dark mb-3" style="max-width: 18rem;height:200px;">
                    <div class="card-header">ĐƠN HÀNG HỦY</div>
                    <div class="card-body">
                        <h5 class="card-title">{{$count_completess}}</h5>
                        <p class="card-text">Số đơn bị hủy trong hệ thống</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <!-- end analytic  -->
    <div class="card">
        <div class="card-header font-weight-bold">
            @if($shows->total() > 0)
            THÔNG TIN KHÁCH HÀNG ĐÃ MUA SẢN PHẨM
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
                    @foreach($shows as $show)
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
                        @if ($show->status == 'Hoàn Tất')
                        <td class="">
                            <span class="badge badge-success p-1">{{ $show->status }}</span>
                        </td>
                        @elseif($show->status == 'Đang Xử Lý')
                        <td><span class="badge badge-warning p-1">{{$show->status}}</span></td>
                        @elseif ($show->status == 'Đang Vận Chuyển')
                        <td class="text-success"><span class="p-1 badge badge-info">{{ $show->status }}</span></td>
                        @elseif ($show->status == 'Hủy Đơn Hàng')
                        <td class="text-success"><span class="p-1 badge badge-dark">{{ $show->status }}</span></td>
                        @endif
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
            {{$shows->links()}}
        </div>
    </div>
    @else
    <P>không có thông tin khách hàng </P>
    @endif

</div>
@endsection