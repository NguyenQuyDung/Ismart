@extends('layouts.admin')
@section('content')
<div id="wp-content" style="padding:0rem !important;">
    <div id="content" class="container-fluid">
        <div class="card">
            @if(session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
            @endif
            <div class="card-header font-weight-bold d-flex align-items-center">
                <h5 class="m-0 mr-5"><a href="">Thông tin đơn hàng</a></h5>
            </div>
            <div class="card-body" id="detail-order">
                <h5>Thông tin khách hàng</h5>
                <table style="table-layout:auto; width:100%; font-size:14px;" border="1">
                    <thead>
                        <tr style="background-color: rgb(236 236 236);">
                            <th class="text-center p-2">Mã Khách Hàng</th>
                            <th class="text-center p-2">Họ và tên</th>
                            <th class="text-center p-2">Số điện thoại</th>
                            <th class="text-center p-2">Email</th>
                            <th class="text-center p-2">Địa chỉ</th>
                            <th class="text-center p-2">Thời gian đặt hàng</th>
                            <th class="text-center p-2">Ghi chú</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="width:14%;" class="text-center p-2"><a href="" style="text-transform:uppercase;">{{$detail_order_clients->MaKH}}</a></td>
                            <td style="width:10%;" class="text-center p-2">{{$detail_order_clients->fullname}}</td>
                            <td style="width:8%;" class="text-center p-2">{{$detail_order_clients->phone}}</td>
                            <td style="width:15%;" class="text-center p-2">{{$detail_order_clients->email}}</td>
                            <td style="width:30%;" class="text-center p-2">Thành Phố {{$detail_order_clients->province}} - {{$detail_order_clients->district}} - {{$detail_order_clients->ward}}</td>
                            <td style="width:12%;" class="text-center p-2">{{$detail_order_clients->created_at}}</td>
                            <td style="width:10%;">{{$detail_order_clients->note}}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="  mt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Trạng thái đơn hàng:
                                <span style="font-size: 14px" class="px-1 p-2 bg-info text-light rounded">{{$detail_order_clients->status}}</span>
                            </h5>
                            <div class="form-action form-inline py-2">
                                <form action="{{url('admin/order/order_detail', $detail_order_clients->id)}}" method="GET">
                                    @csrf
                                    <select class="form-control mr-2" name="act">
                                        <option>Chọn</option>
                                        @foreach($list_act as $k => $act)
                                        <option value="{{$k}}">{{$act}}</option>
                                        @endforeach
                                    </select>
                                    <input type="submit" name="btn-update" value="Cập nhật" style="padding: 5px 8px;border:1px solid rgb(163, 241, 241);color:aliceblue" class="rounded bg-primary">
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <table style="table-layout: fixed;width:100%;font-size:14px" border="1">
                                <thead>
                                    <tr style=" background-color:  rgb(236 236 236);">
                                        <th class="text-center p-2">Tổng số lượng</th>
                                        <th class="text-center p-2">Tổng tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center p-2">{{$qty}}</td>
                                        <td class="text-center p-2">{{$detail_order_clients->sub_total}}đ</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 "><a href="">CHI TIẾT ĐƠN HÀNG ĐÃ ĐẶT</a></h5>
            </div>
            <div class="card-body">
                <table style="table-layout: auto;width:100%;font-size:16px;">
                    <thead>
                        <tr style="border-bottom: 1px solid gray; background-color: rgb(236 236 236);">
                            <th class="text-center py-2">Ảnh Sản Phẩm</th>
                            <th class="text-center">Tên Sản Phẩm</th>
                            <th class="text-center">Mã Sản Phẩm</th>
                            <th class="text-center">Số Lượng Sản Phẩm</th>
                            <th class="text-center">Giá Sản Phẩm</th>
                            <th class="text-center">Phương Thức Thanh Toán</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr style="border-bottom: 1px solid rgb(241, 229, 229);">
                            <td style="width:15%;" class="text-center p-2"><img src="{{url($order->thumbnail)}}" alt="" class="img-fluid" style="max-width:110px;"></td>
                            <td style="width:30%;" class="text-center">{{$order->name}}</td>
                            <td style="width:15%;" class="text-center"><a href="" style="text-transform:uppercase;">{{$order->masp}}</a></td>
                            <td style="width:15%;" class="text-center">{{$order->qty}}</td>
                            <td style="width:15%;" class="text-center text-bold" style="color:red;">{{number_format($order->price, 0, ',', '.')}}đ</td>
                            <td style="width:30%;" class="text-center">{{$order->payment}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // $(document).ready(function() {
    //     $(".num_order").change(function() {
    //         let id = $(this).attr("id");
    //         let val = $(this).val();
    //         let token = $("#token").val();
    //         let data = {
    //             id: id,
    //             token: token,
    //             val: val
    //         };
    //         $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             }
    //         });
    //         $.ajax({
    //             url: $(this).attr('data-url'), // trang sử lý mặc định trang hiện tại
    //             method: 'POST', // Post goặc Get, mặc ddingj Get
    //             data: data, // Dữ liệu truyền lên Sever
    //             dataType: 'json', // Html, text, script hoặc json
    //             success: function(data) {

    //             },
    //             // kiểm tra nếu có lỗi nó xuất lên
    //             error: function(xhr, ajaxOptions, thrownError) {
    //                 console.log(xhr.status);
    //                 console.log(thrownError);
    //             },
    //         });
    //     });
    // });
</script>
@endsection