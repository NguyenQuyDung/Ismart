@extends('layouts.user')
@section('content')
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @if(Cart::count()>0)
    <div id="wrapper" class="wp-inner clearfix">
        <form method="POST" action="{{route('insert_info_client')}}" name="form-checkout">
            @csrf
            <div class="section" id="customer-info-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin khách hàng</h1>
                </div>
                <div class="section-detail">

                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="fullname">Họ tên <span style="color:red;">(*)</span></label>
                            <input type="text" name="fullname" id="fullname" placeholder="Họ và tên">
                            @error('fullname')
                            <small style="color:#dc3545; font-size: 14px;">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-col fl-right">
                            <label for="email">Email <span style="color:red;">(*)</span></label>
                            <input type="email" name="email" id="email" placeholder="Email">
                            @error('email')
                            <small style="color:#dc3545; font-size: 14px;">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="address">Địa chỉ nhận </label>
                            <input type="text" name="address" id="address" placeholder="Số đường-tên nhà">
                        </div>
                        <div class="form-col fl-right">
                            <label for="phone">Số điện thoại <span style="color:red;">(*)</span></label>
                            <input type="tel" name="phone" id="phone" placeholder="Số điện thoại">
                            @error('phone')
                            <small style="color:#dc3545; font-size: 14px;">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <style>
                            select {
                                display: block;
                                width: 100%;
                                height: 40px;
                                border: 1px solid #cccccc;
                                margin-bottom: 10px;
                            }
                        </style>
                        <div style="display:flex;">
                            <!-- <Tỉnh thành phố là Province>-->
                            <div>
                                <label for="province">Tỉnh / Thành phố <span style="color:red;">(*)</span></label>
                                <select name="province" class="form-control" id="province" style="width:252px;">
                                    <option value="">Chọn tỉnh / Thành phố</option>
                                    @foreach($provinces as $key => $value)
                                    <option data-id="{{$value->province_id}}" value="{{$value->name}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                                @error('province')
                                <small style="color:#dc3545; font-size: 14px;">{{$message}}</small>
                                @enderror
                            </div>
                            <!-- <Quận là district>-->
                            <div>
                                <label style="margin-left: 33px;">Chọn Quận <span style="color:red;">(*)</span></label>
                                <select name="district" id="district" class="form-control" style="margin-left: 33px; width: 280px;">
                                    <option value="">Chọn quận / Huyện</option>
                                    @foreach($district as $key => $dis)
                                    <option data-id="{{$dis->district_id}}" value="{{$dis->name}}">{{$dis->name}}</option>
                                    @endforeach
                                </select>
                                @error('district')
                                <small style="color:#dc3545; font-size: 14px;margin-left: 33px; padding-bottom:8px;">{{$message}}</small>
                                @enderror <br>
                            </div>
                        </div>
                        <label>Chọn Xã Phường <span style="color:red;">(*)</span></label>
                        <select name="ward" id="ward" class="form-control">
                            <option value="">Chọn phường / Xã</option>
                            @foreach($wards as $key => $ward)
                            <option data-id="{{$ward->wards_id}}" value="{{$ward->name}}">{{$ward->name}}</option>
                            @endforeach
                        </select>
                        @error('ward')
                        <small style="color:#dc3545; font-size: 14px;">{{$message}}</small>
                        @enderror <br>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="notes">Ghi chú</label>
                            <textarea name="note" style="height: 148px; width: 565px;border: 1px solid #ccc;" placeholder="Ghi chú đơn hàng"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" id="order-review-wp">
                <div class="section-head">
                    <h1 class="section-title">Thông tin đơn hàng sản phẩm</h1>
                </div>
                <div class="section-detail">
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <td>Tên Sản phẩm</td>
                                <td style="padding-right:20px;">Ảnh Sản Phẩm</td>
                                <td style="padding-right:20px;">Số Lượng</td>
                                <td>Tổng Tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Cart::content() as $row)
                            <tr class="cart-item">
                                <td class="product-name" style="width:40%;">{{$row->name}}</td>

                                <td style="width:20%; padding-left:20px;">
                                    <img src="{{url($row->options->images_product)}}" width="100px" alt="">
                                </td>
                                <td style="width:20%; "><strong class="product-quantity" style="color:red; font-size:14px; padding-left:30px;">{{$row->qty}}</strong></td>
                                <td class="product-total" style="color:red; font-weight:bold; width: 40%;">{{number_format($row->total,0,',','.')}}đ</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="order-total">
                                <td>Tổng chi phí đơn hàng:</td>
                                <td><strong class="total-price" style="color:red; font-weight:bold;">{{Cart::total()}}đ</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div id="payment-checkout-wp">
                        <ul id="payment_methods">
                            <p style="color:red; font-weight:bold; padding-bottom:10px;">CÁC PHƯƠNG THỨC THANH TOÁN:</p>
                            <li>
                                <input type="radio" id="payment-home" name="payment-method" value="Thanh toán khi nhận hàng">
                                <label for="payment-home">Thanh toán khi nhận hàng</label>
                            </li>
                            @error('payment-method')
                            <small style="color:#dc3545; font-size: 14px;">{{$message}}</small>
                            @enderror
                        </ul>
                    </div>
                    <div class="place-order-wp clearfix">
                        <input type="submit" id="order-now" style="background-color:black !important; color:goldenrod;" value="Đặt hàng">
                    </div>
                </div>
            </div>
        </form>
    </div>
    @else
    <div id="content-complete">
        <p style="color:green; font-size:30px; text-align:center; padding-top:50px; padding-bottom:20px;"> Không Có Sản Phẩm Cần Mua Trong Trang Này!
        </p>
        <p style="text-align:center; font-size:18px;"> Vui Lòng Click Bên Dưới để Mua Hàng Tại hệ thống Ismart Xin Cảm ơn !</p>
    </div>
    <div class="back-home" style="background-color:black; width:180px; margin:0px auto; border-radius:20px; margin-top:20px;">
        <a href="{{route('home_index')}}" title="" style="color:goldenrod; font-size:18px; padding:10px 10px 10px 15px; display:block; ">Quay lại trang chủ</a>
    </div>
    @endif
</div>
<script>
    // $(document).ready(function() {
    //     $("select#province").change(function() {
    //         var province = $(this).children("option:selected").val();
    //         var id = $(this).children("option:selected").attr("data-id");
    //         var _token = $('input[name="_token"]').val();
    //         let data = {
    //             province: province,
    //             id: id,
    //             _token: _token
    //         };
    //         $.ajaxSetup({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             }
    //         });
    //         $.ajax({
    //             url: "{{url('get-province')}}",
    //             method: "POST",
    //             data: data,
    //             dataType: "text",
    //             success: function(data) {
    //                 console.log(data);
    //             },
    //             error: function(xhr, ajaxOptions, throwError) {
    //                 alert(xhr.status);
    //                 alert(throwError);
    //             },
    //         });
    //     });
    // });
</script>
@endsection