@extends('layouts.user')
@section('content')
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{route('home_index')}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="{{url('san-pham')}}" title="">Sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            @if($search_product->total() > 0)
            <div style="border-bottom:3px solid black;">
                <h3 style=" width:400px; padding:5px 10px; background:black;color:goldenrod; font-size:18px;">KẾT QUẢ TÌM KIẾM CHO : <span style="text-transform: uppercase;font-size:20px; color:goldenrod;">“{{$search_products}}”</span></h3>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix" style="margin-bottom:20px;">
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        @foreach($search_product as $key => $product)
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
                            @endforeach
                        </li>
                    </ul>
                </div>
            </div>
            @else
            <div style="align-items: center;text-align: -webkit-center; padding-top: 80px">
                <img style="height: 19.5rem;width: auto;" src="{{url('public/images_comment_product/box.png')}}" alt="">
                <span style="font-size:20px; padding-top:10px; display:block;"> Không Thấy Sản Phầm Tìm Kiếm !</span>
                <span style="font-size:18px; padding-top:8px; display:block;" class="typcn typcn-spanner">Vui Lòng Thử Lại ! </span>
            </div>
            @endif
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
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
                        $link = route('product_list',$value['slug']);
                        echo "<li><a href='{$link}'>{$value['name']}</a>";
                            showCats($category,$value['id'], $class = 'sub-menu');
                            echo '</li>';
                        }
                        echo '</ul>';
                    }
                    }
                    showCats($category);
                    @endphp
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
                    <a href="" title="" class="thumb">
                        <img src="public/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection