@extends('layouts.user')
@section('content')
<main class="py-4" style="background-color:#f7f7f7;">
    <div class="section" id="breadcrumb-wp" style="background-color:#f7f7f7;">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix" style="padding-top:30px;">
                    <li>
                        <a href="{{route('home_index')}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Đặt hàng thành công</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="content-complete">
        <p style="color:green; font-size:30px; text-align:center; padding-top:50px; padding-bottom:20px;"> Đặt hàng thành công!
        </p>
        <p style="text-align:center; font-size:18px;"> Cảm ơn quý khách đã đặt hàng tại hệ thống Ismart!</p>
        <p style="text-align:center; font-size:18px;"> Nhân viên chăm sóc sẽ liên hệ tới bạn sớm nhất.</p>

    </div>
    <div id="main-content-wp" class="checkout-page">
        <div id="wrapper" class="wp-inner clearfix">
            <div id="content">
                <div class="section" id="thank-wp">
                    <div class="section-detail">
                        <div class="section">
                            <div class="section-head mt-3">
                                <div class="card" style="background-color:#fff;">
                                    <div class="card-body">
                                        <h2 class="" style="font-size:25px; font-weight:200; padding-bottom:10px;">Thông Tin Khách Hàng</h2>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Tên Khách Hàng</th>
                                                    <th scope="col">Số điện thoại</th>
                                                    <th scope="col">Địa chỉ</th>
                                                    <th scope="col">Email</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{$data['fullname']}}</td>
                                                    <td>{{$data['phone']}}</td>
                                                    <td>Thành Phố {{$data['province']}} - {{$data['district']}} - {{$data['ward']}}
                                                    </td>
                                                    <td>{{$data['email']}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card" style="background-color:#fff;">
                                    <div class="card-body">
                                        <h5 class="d-block ml-2" style="font-size:25px; font-weight:200; padding:20px 0px;">Thông Tin Đơn Hàng</h5>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">STT</th>
                                                    <th scope="col">Ảnh</th>
                                                    <th scope="col">Tên sản phẩm</th>
                                                    <th scope="col">Giá</th>
                                                    <th scope="col">Số lượng</th>
                                                    <th scope="col">Trạng thái đơn hàng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $stt = 0;
                                                @endphp
                                                @foreach($data['order'] as $item)
                                                @php
                                                $stt++;
                                                @endphp
                                                <tr>
                                                    <td>{{$stt}}</td>
                                                    <td style="max-width:80px;"><img src="{{url($item->options->images_product)}}" alt="" class="img-fluid" style="width: 100%"></td>
                                                    <td>{{$item->name}}</td>
                                                    <td> {{number_format($item->price,0,' ','.')}}đ</td>
                                                    <td>{{$item->qty}}</td>
                                                    <td>Đang Vận Chuyển</td>
                                                </tr>
                                                @endforeach
                                                <tr>
                                                    <th colspan="5">Giá trị đơn hàng</th>
                                                    <td>{{$data['total']}}đ</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="back-home" style="background-color:black; width:180px; margin:0px auto; border-radius:20px; margin-top:20px;">
                                    <a href="{{route('home_index')}}" title="" style="color:goldenrod; font-size:18px; padding:10px 10px 10px 15px; display:block; ">Quay lại trang chủ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection