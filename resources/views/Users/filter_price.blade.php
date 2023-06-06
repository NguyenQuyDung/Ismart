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
                        <a href="" title="">Sản Phẩm</a>
                    </li>

                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <!-- <div class="filter-wp fl-right" style="position: absolute;right: 170px;top: 165px;">
                <p class="desc">Hiển thị <b style="color:black; font-weight:bold;">{{($count_product)}}</b> trên <b style="color:black; font-weight:bold;">{{($count_product)}}</b> sản phẩm</p>
                <div class="form-filter">
                    <form method="GET" action="{{url('sap-xep-san-pham')}}">
                        @csrf
                        <select name="select" style="padding:5px 0px;">
                            <option value="0" {{ request()->input('select') == 0 ? 'selected=selected' : '' }}>Sắp xếp</option>
                            <option value="1" {{ request()->input('select') == 1 ? 'selected=selected' : '' }}>Từ A-Z</option>
                            <option value="2" {{ request()->input('select') == 2 ? 'selected=selected' : '' }}>Từ Z-A</option>
                            <option value="3" {{ request()->input('select') == 3 ? 'selected=selected' : '' }}>Giá cao xuống thấp</option>
                            <option value="4" {{ request()->input('select') == 4 ? 'selected=selected' : '' }}>Giá thấp lên cao</option>
                        </select>
                        <button type="submit" name="btn-sort" style="background-color:black; color:goldenrod;">Lọc</button>
                    </form>
                </div>
            </div> -->
            <div class="section" id="list-product-wp">
                @if($products)
                <div class="section-head clearfix" style="border-bottom: 2px solid black;">
                    <h3 class="section-title fl-left" style="font-size: 18px;
    display: inline-block;
    padding: 5px 15px;
    text-transform: uppercase;
    line-height:normal;">Kết Quả Lọc Giá Sản Phẩm</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach($products as $product)
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
                @else
                <div style="align-items: center;text-align: -webkit-center; padding-top: 80px">
                    <img style="height: 19.5rem;width: auto;" src="{{url('public/images_comment_product/erro.png')}}" alt="" style="margin:auto;">
                    <span style="font-size:20px; padding-top:10px; display:block;"> Không Thấy Sản Phẩm Tìm Kiếm !</span>
                    <span style="font-size:18px; padding-top:8px; display:block;" class="typcn typcn-spanner">Nhấn <a href="{{url('trang-chu')}}">Vào Đây</a> Để Quay Lại Trang Chủ Hoặc <a href="{{url('san-pham')}}">Tiếp Tục</a> Mua Hàng !</span>
                </div>
                @endif
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    <ul class="list-item">
                        @php
                        function showCats($category, $parent_id = 0, $class = 'list-item ', $class_sub_menu = 'sub-menu')
                        {
                        // LẤY DANH SÁCH CATE CON
                        $cate_child = [];
                        foreach ($category as $key => $item) {
                        // Nếu là chuyên mục con thì hiển thị
                        if ($item['parent_id'] == $parent_id) {
                        $cate_child[] = $item;
                        unset($category[$key]);
                        }
                        }

                        // HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
                        if ($cate_child) {
                        echo "<ul class={$class}>";
                            foreach ($cate_child as $key => $value) {
                            $link = route('product_list', [$value->slug]);
                            echo "<li><a href='{$link}'>{$value['name']}</a>";
                                showCats($category, $value['id'], $class = 'sub-menu');
                                echo '</li>';
                            }
                            echo '</ul>';
                        }
                        }
                        showCats($category);
                        @endphp
                    </ul>
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

            <!-- <div class="section" id="filter-product-wp">
                <div class="section-head">
                    <h3 class="section-title" style="background-color:#f12a43;">Bộ lọc</h3>
                </div>
                <!-- <div class="section-detail">
                    <form method="POST" action="">
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Giá</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>Dưới 500.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>500.000đ - 1.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>1.000.000đ - 5.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>5.000.000đ - 10.000.000đ</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>Trên 10.000.000đ</td>
                                </tr>
                            </tbody>
                        </table>
                        <button style="background-color:red; color: white; border-radius: 0px; border: 1px solid white;">Áp Dụng</button>
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Hãng</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Acer</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Apple</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Hp</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Lenovo</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Samsung</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-brand"></td>
                                    <td>Toshiba</td>
                                </tr>
                            </tbody>
                        </table>
                        <button style="background-color:red; color: white; border-radius: 0px; border: 1px solid white;">Áp Dụng</button>
                        <table>
                            <thead>
                                <tr>
                                    <td colspan="2">Loại</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>Điện thoại</td>
                                </tr>
                                <tr>
                                    <td><input type="radio" name="r-price"></td>
                                    <td>Laptop</td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div> 
            </div> -->
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
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
            max: 900000000,
            values: [75, 300],
            step: 100,
            slide: function(event, ui) {
                $("#amount").val(ui.values[0] + "vnđ" + '---' + ui.values[1] + "vnđ");
                $("#start_price").val(ui.values[0]);
                $("#end_price").val(ui.values[1]);
            }
        });
        $("#amount").val($("#slider-range").slider("values", 0) + "vnđ" + '---' +
            +$("#slider-range").slider("values", 1) + "vnđ");
        $('.orderby').change(function() {
            $("#form_order").submit();
        });
        $(document).ready(function() {
            $("#main-content-wp .section .secion-detail .list-item > li")
                .find("ul.sub-menu")
                .after('<i class="fa fa-angle-right arrow" aria-hidden="true"></i>');
        });
    });
</script>
@endsection