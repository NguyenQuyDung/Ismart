@extends('layouts.user')
@section('content')
<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{route('home_index')}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{url('san-pham')}}" title="">Sản Phẩm</a>
                    </li>
                    <li>
                        <a href="" title="">{{$this_cat_name}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix" style="border-bottom: 2px solid black; width:500px;  justify-content:space-between;">
                    <h3 class="section-title fl-left" style="font-size: 18px;
    display: inline-block;
    padding: 5px 15px;
    text-transform: uppercase;
    line-height:normal;">{{$this_cat_name}}</h3>
                    <div class="filter-wp fl-right" style="position: absolute;right: 170px;top: 190px;">
                        <div class="form-filter">
                            <form method="GET" action="{{url('sap-xep-san-pham')}}">
                                @csrf
                                <select name="select">
                                    <option value="0" {{ request()->input('select') == 0 ? 'selected=selected' : '' }}>Sắp xếp</option>
                                    <option value="1" {{ request()->input('select') == 1 ? 'selected=selected' : '' }}>Từ A-Z</option>
                                    <option value="2" {{ request()->input('select') == 2 ? 'selected=selected' : '' }}>Từ Z-A</option>
                                    <option value="3" {{ request()->input('select') == 3 ? 'selected=selected' : '' }}>Giá cao xuống thấp</option>
                                    <option value="4" {{ request()->input('select') == 4 ? 'selected=selected' : '' }}>Giá thấp lên cao</option>
                                </select>
                                <button type="submit" name="btn-sort">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach($list_product as $product)
                        <li>
                            <form>
                                @csrf
                                <input type="hidden" value="{{$product['id']}}" class="cart_product_id_{{$product['id']}}">
                                <input type="hidden" value="{{$product['name']}}" class="cart_product_name_{{$product['id']}}">
                                <input type="hidden" value="{{url($product['images_product'])}}" class="cart_product_image_{{$product['id']}}">
                                <input type="hidden" value="{{$product['price']}}" class="cart_product_price_{{$product['id']}}">
                                <input type="hidden" value="1" class="cart_product_qty_{{$product['id']}}">
                                <a href="{{url('san-pham/'.$product['slug'].'/'.$product['name'])}}" title="" class="thumb">
                                    <img src="{{url($product['images_product'])}}">
                                </a>
                                <a href="{{url('san-pham/'.$product['slug'].'/'.$product['name'])}}" title="" class="product-name">{{$product['name']}}</a>
                                <div class="price">
                                    <span class="price-old" style="color: red;">{{number_format($product['price'],0,",",".")}}đ</span>
                                    <del class="price-new">{{number_format($product['price_old'],0,",",".")}}đ</del>
                                </div>
                                <div class="action clearfix">
                                    <button type="button" title="Thêm giỏ hàng" data-id="{{$product['id']}}" class="add-cart-outside add-cart fl-left add-to-cart" data-toggle="modal" data-target="#demo-modal" style="font-size:13px;padding-top: 2px;background: #fff;border-radius: 8px;padding-bottom: 2px;" name="add-to-cart">Thêm giỏ hàng</button>
                                    <a href="{{url('mua-ngay/'.$product['slug'].'/'.$product['name'])}}" title="Mua ngay" class="buy-now fl-right" style="border-radius:8px;">Mua ngay</a>
                                </div>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left" id="icon">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    @include('Users.menu-category.menu-category')
                </div>
            </div>
            <div class="section" id="filter-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Bộ lọc</h3>
                </div>
                <div class="section-detail">
                    <form action="{{url('loc-san-pham')}}" method="GET">
                        <table style="margin-bottom:10px;">
                            <thead>
                                <tr>
                                    <td colspan="2">Giá</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" id="price-1" name="b-price"></td>
                                    <td><label for="price-1">5.000.000đ - 11.000.000đ</label></td>
                                </tr>
                                <tr>
                                    <td><input type="radio" id="price-2" name="c-price"></td>
                                    <td><label for="price-2">11.000.000đ - 12.000.000đ</label></td>
                                <tr>
                                    <td><input type="radio" id="price-3" name="d-price"></td>
                                    <td><label for="price-3">10.000.000đ - 60.000.000đ</label></td>
                                </tr>
                                <tr>
                                    <td><input type="radio" id="price-5" name="a-price"></td>
                                    <td><label for="price-5">19.000.000đ - 20.000.000đ</label></td>
                                </tr>
                                <tr>
                                    <td><input type="radio" id="price-4" name="e-price"></td>
                                    <td><label for="price-4">Trên 60.000.000đ</label></td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Hãng</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width:20px;"><input type="radio" class="the_firm" name="acer" id="Acer"></td>
                                    <td><label for="Acer">Acer</label></td>
                                </tr>
                                <tr>
                                    <td style="width:20px;"><input type="radio" class="the_firm" name="apple" id="Apple"></td>
                                    <td><label for="Apple">Apple</label></td>
                                </tr>
                                <tr>
                                    <td style="width:20px;"><input type="radio" class="the_firm" name="hp" id="Hp"></td>
                                    <td><label for="Hp">Hp</label></td>
                                </tr>
                                <tr>
                                    <td style="width:20px;"><input type="radio" class="the_firm" name="lenovo" id="Lenovo"></td>
                                    <td><label for="Lenovo">Lenovo</label></td>
                                </tr>
                                <tr>
                                    <td style="width:20px;"><input type="radio" class="the_firm" name="samsung" id="Samsung"></td>
                                    <td><label for="Samsung">Samsung</label></td>
                                </tr>
                                <tr>
                                    <td style="width:20px;"><input type="radio" class="the_firm" name="toshiba" id="Toshiba"></td>
                                    <td><label for="Toshiba">Toshiba</label></td>
                                </tr>
                            </tbody>
                        </table>
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Loại</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width:20px;"><input type="radio" name="dien-thoai" class="type" id="dienthoai"></td>
                                    <td><label for="dienthoai">Điện Thoại</label></td>
                                </tr>
                                <tr>
                                    <td style="width:20px;"><input type="radio" name="lap-top" class="type" id="laptop"></td>
                                    <td><label for="laptop">LapTop</label></td>
                                </tr>
                            </tbody>
                        </table> -->
                        <div style="margin-top:5px;">
                            <button style="background-color:black; color:goldenrod; font-size:15px;">Lọc Ngay</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach($featured_products as $product)
                        <li class="clearfix">
                            <a href="{{url('san-pham/'.$product['slug'].'/'.$product['name'])}}" title="" class="thumb fl-left">
                                <img src="{{url($product['images_product'])}}" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="{{url('san-pham/'.$product['slug'].'/'.$product['name'])}}" title="" class="product-name">{{$product['name']}}</a>
                                <div class="price">
                                    <span class="price-old" style="color: red;">{{number_format($product['price'],0,",",".")}}đ</span>
                                    <del class="price-new">{{number_format($product['price_old'],0,",",".")}}đ</del>
                                </div>
                                <div>
                                    <a href="{{url('mua-ngay/'.$product['slug'].'/'.$product['name'])}}" title="Mua ngay" class="buy-now fl-right" style="border-radius:8px;">Mua ngay</a>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    @foreach($medias as $key => $value)
                    <a href="" title="" class="thumb">
                        <img src="{{url($value->images_media)}}" alt="">
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#slider-range").slider({
            range: true,
            min: 11000000,
            max: 100000000,
            values: [75, 300],
            step: 100,
            slide: function(event, ui) {
                $("#amount").val("vnđ" + ui.values[0] + " - vnđ" + ui.values[1]);
                $("#start_price").val(ui.values[0]);
                $("#end_price").val(ui.values[1]);
            }
        });
        $("#amount").val("vnđ" + $("#slider-range").slider("values", 0) +
            " - vnđ" + $("#slider-range").slider("values", 1));
        $('.orderby').change(function() {
            $("#form_order").submit();
        });
        $(document).ready(function() {
            $("#icon .section .secion-detail .list-item > li")
                .find("ul.sub-menu")
                .after('<i class="fa fa-angle-right arrow" aria-hidden="true"></i>');
        });
    });
</script>
@endsection