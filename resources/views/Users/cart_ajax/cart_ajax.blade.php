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
                    <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="font-size: 18px; text-transform: uppercase;">#</th>
                                <th scope="col" style="font-size: 18px; text-transform: uppercase;  font-weight:200;">Ảnh</th>
                                <th scope="col" style="padding-left:200px; font-size: 18px; text-transform: uppercase; font-weight:200;">Tên sản phẩm</th>
                                <th scope="col" style="font-size: 18px; text-transform: uppercase; padding-left:20px; font-weight:200;">Giá</th>
                                <th scope="col" style="font-size: 18px; text-transform: uppercase; padding-left:20px; font-weight:200;">Số lượng</th>
                                <th scope="col" style="font-size: 18px; text-transform: uppercase; padding-left:20px; font-weight:200;">Thành tiền</th>
                                <th scope="col" style="font-size: 18px; text-transform: uppercase; padding-left:20px; font-weight:200;">Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            print_r(Cart::content());
                            @endphp
                            <tr class="cartpage">
                                <td scope="row"></td>
                                <td>
                                    <img src="" width="100px" alt="">
                                </td>
                                <td scope="col"><a href="{{url('san-pham')}}"></a></td>
                                <td scope="col" style="color:red;"></td>
                                <td scope="col">
                                    <input class="num_order" data-id="" name="num-order-cart" type="number" style="width:50px; text-align: center" max="10" min="1">
                                </td>
                                <td scope="col" class="cart-grand-total-price" id="" style="color:red;"></td>
                                <td><a href="" class="text-danger">Xóa</a></td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <p id="total-price" class="fl-right">Tổng giá: <span></span>đ</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <div class="fl-right">
                                            <input class="update" type="submit" value="Cập Nhật Giỏ Hàng" name="btn_update" class="" style="padding: 8px 10px;">
                                            <a href="{{route('payment')}}" title="Thanh Toán " id="checkout-cart" style="background-color: red !important;">Thanh toán</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="section" id="action-cart-wp">
                        <div class="section-detail">
                            <p class="title" style="font-size:18px;">Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                            <p> <a href="{{route('category_product')}}" title="" id="buy-more">Mua tiếp</a></p>
                            <p> <a href="{{route('detroy.cart')}}" title="Xóa giỏ hàng" id="delete-cart">Xóa giỏ hàng</a></p>
                        </div>
                    </div>

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