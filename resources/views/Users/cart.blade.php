@extends('layouts.user')
@section('content')
<div id="main-content-wp" class="cart-page" style="min-height:300px;">
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{route('home_index')}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{url('gio-hang.html')}}" title="">Giỏ Hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                <!-- <p class="text-danger container">Hiện Tại Có <a href="{{url('/cart/show')}}" class="font-weight-bold">({{Cart::count()}})</a> Sản Phẩm Trong Giỏ Hàng</p> -->
                <form action="{{route('cart.update')}}" method="POST">
                    @csrf
                    <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                    @if(Cart::count()>0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Mã sản phẩm</th>
                                <th scope="col">Ảnh sản phẩm</th>
                                <th scope="col" style="text-align:center;">Tên sản phẩm</th>
                                <th scope="col">Giá sản phẩm</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Thành tiền</th>
                                <th scope="col">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $stt = 0;
                            @endphp
                            @foreach(Cart::content() as $cart)
                            @php
                            $stt++;
                            @endphp
                            <tr class="cartpage">
                                <td scope="row">{{$stt}}</td>
                                <td>
                                    <img src="{{url($cart->options->images_product)}}" width="100px" alt="">
                                </td>
                                <td scope="col"><a href="{{url('san-pham')}}" class="name">{{$cart->name}}</a></td>
                                <td scope="col" style="color:red;font-size: 18px;">{{number_format($cart->price,0,' ','.')}}đ</td>
                                <td scope="col">
                                    <input class="num_order" data-id="{{$cart->rowId}}" data-rowid="[{{$cart->rowId}}]" value="{{$cart->qty}}" name="num-order-cart" data-url="{{route('ajax_shopping_cart')}}" type="number" style="border: 1px solid #ccc;border-radius: 3px;text-align: center;height: 34px;width: 35px;" max="10" min="1">
                                </td>
                                <td scope="col" class="cart-grand-total-price" id="sub_total-{{$cart->rowId}}" style="color:red;font-size: 18px;">{{number_format($cart->price* $cart->qty,0,' ','.')}}đ</td>
                                <td>
                                    <a href="{{route('remove.cart', $cart->rowId)}}" title="" class="del-product">
                                        <i class="fa fa-trash"></i>
                                        Xoá
                                    </a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <p id="total-price" style="color:red;font-size: 20px;" class="fl-right">Tổng giá: <span>{{Cart::total()}}</span>
                                            <spans tyle="color:red;font-size: 20px;">Đ</spans>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <div class="fl-right">
                                            <input class="update" type="submit" value="Cập Nhật Giỏ Hàng" name="btn_update" class="" style="padding: 8px 10px; line-height:1.6; background:black; color:#fff;">
                                            <a href="{{route('payment')}}" title="Thanh Toán " id="checkout-cart" style="background-color: red !important;">Thanh toán</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="section" id="action-cart-wp">
                        <p class="title" style="font-size:18px;">Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                        <div class="section-detail" style="display:flex;">
                            <p> <a href="{{route('category_product')}}" title="" id="buy-more" style="text-decoration: none !important;background: black;padding: 8px 20px;color: #fff;">Mua tiếp</a></p>
                            <p style="margin-left:6px;"> <a href="{{route('detroy.cart')}}" title="Xóa giỏ hàng" id="delete-cart" style="text-decoration: none !important;background: black;padding: 8px 20px;color: #fff;">Xóa giỏ hàng</a></p>
                        </div>
                    </div>
                    @else
                    <p style="color:black; font-size: 24px; text-align:center; padding-bottom:30px;">Hiện Tại Không Có Sản Phẩm Nào Trong Giỏ Hàng </p>
                    <p style="text-align:center;background:black; width:220px; margin:0px auto; border-radius:10px;"><a style="padding:10px 15px; font-size:18px; color:goldenrod;display:block;" href="{{url('san-pham')}}">Quay Lại Cửa Hàng</a></p>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".num_order").change(function() {
            let id = $(this).attr("data-id");
            let qty = $(this).val();
            let token = $("#token").val();
            let data = {
                id: id,
                qty: qty,
                token: token
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: $(this).attr('data-url'), // trang sử lý mặc định trang hiện tại
                method: 'POST', // Post goặc Get, mặc ddingj Get
                data: data, // Dữ liệu truyền lên Sever
                dataType: 'json', // Html, text, script hoặc json
                success: function(data) {
                    $("#sub_total-" + id).text(data.sub_total);
                    $("#total-price span").text(data.total_price);
                    $("#btn-cart span").text(data.num);
                    $(".desc .font-weight-bold").text(data.num);
                    $(".qty-" + id).text(qty);
                    $("#total-price").text(data.total_price);
                },
                // kiểm tra nếu có lỗi nó xuất lên
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(xhr.status);
                    console.log(thrownError);
                },
            });
        });
    });
</script>
@endsection