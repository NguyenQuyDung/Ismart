@extends('layouts.user')
@section('content')
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    @foreach($sliders as $slider)
                    <div class="item">
                        <img style="height:380px;" src="{{url($slider->images_slider)}}" alt="">
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" style="margin-bottom:30px; margin-top:30px;" id="feature-product-wp">
                <div class="section-head clearfix" style="border-bottom: 3px solid black;">
                    <h3 class="section-title fl-left" style="margin:0px;font-size: 18px;
    display: inline-block;
    padding: 5px 15px;
    text-transform: uppercase;
    line-height:normal;">Sản Phẩm Nổi Bật</h3>
                </div>
                <div class="section-detail" style="margin-top:10px;">
                    <ul class="list-item">
                        @foreach($featured_products as $product)
                        <li>
                            <form>
                                @csrf
                                <input type="hidden" name="" value="{{$product['id']}}" class="cart_product_id_{{$product['id']}}">
                                <input type="hidden" name="" value="{{$product['name']}}" class="cart_product_name_{{$product['id']}}">
                                <input type="hidden" name="" value="{{url($product['images_product'])}}" class="cart_product_image_{{$product['id']}}">
                                <input type="hidden" name="" value="{{$product['price']}}" class="cart_product_price_{{$product['id']}}">
                                <input type="hidden" name="" value="1" class="cart_product_qty_{{$product['id']}}">
                                <a href="{{url('san-pham/'.$product['slug'].'/'.$product['name'])}}" title="" class="thumb">
                                    <img src="{{url($product['images_product'])}}">
                                </a>
                                <a href="{{url('san-pham/'.$product['slug'].'/'.$product['name'])}}" title="" class="product-name">{{$product['name']}}</a>
                                <div class="price">
                                    <span class="price-old" style="color: red;">{{number_format($product['price'],0,",",".")}}đ</span>
                                    <del class="price-new">{{number_format($product['price_old'],0,",",".")}}đ</del>
                                </div>
                                <div class="action clearfix">
                                    <button type="button" title="Thêm giỏ hàng" data-id="{{$product['id']}}" class="add-cart fl-left add-to-cart" style="font-size:13px;padding-top: 2px;background: #fff;border-radius: 8px;padding-bottom: 2px;" name="add-to-cart">Thêm giỏ hàng</button>
                                    <a href="{{url('mua-ngay/'.$product['slug'].'/'.$product['name'])}}" title="Mua ngay" class="buy-now fl-right" style="border-radius:8px;">Mua ngay</a>
                                </div>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @foreach($parent_product_cats as $cat_id)
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix" style="border-bottom: 2px solid black;">
                    <h3 class="section-title fl-left" style="margin:0px;font-size: 18px;
    display: inline-block;
    padding: 5px 15px;
    text-transform: uppercase;
    line-height:normal;">{{$cat_id->name}}</h3>
                </div>
                <div class="section-detail" style="margin-top:20px;">
                    <ul class="list-item clearfix">
                        @foreach($list_products_by[$cat_id->id] as $product)
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
                                    <button type="button" title="Thêm giỏ hàng" data-id="{{$product['id']}}"  class="add-cart-outside add-cart fl-left add-to-cart" data-toggle="modal" data-target="#demo-modal" style="font-size:13px;padding-top: 2px;background: #fff;border-radius: 8px;padding-bottom: 2px;" name="add-to-cart">Thêm giỏ hàng</button>
                                    <a href="{{url('mua-ngay/'.$product['slug'].'/'.$product['name'])}}" title="Mua ngay" class="buy-now fl-right" style="border-radius:8px;">Mua ngay</a>
                                </div>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    @include('Users.menu-category.menu-category')
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
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/th.jpg" alt="">
                    </a>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/1.png" alt="">
                    </a>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/gg.jpg" alt="">
                    </a>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/gh.jpg" alt="">
                    </a>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/hk.jpg" alt="">
                    </a>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/th (2).jpg" alt="">
                    </a>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/gg.jpg" alt="">
                    </a>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/gh.jpg" alt="">
                    </a>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/th (2).jpg" alt="">
                    </a>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="?page=detail_product" title="" class="thumb">
                        <img src="public/images/gg.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection