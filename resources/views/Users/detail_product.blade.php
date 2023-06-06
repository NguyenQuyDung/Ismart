@extends('layouts.user')
@section('content')
<style>
    .view-mode {
        padding: 5px 89px;
        display: inline-block;
        position: absolute;
        top: 92%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 15px;
        border: 1px solid #2f80ed;
        color: #2f80ed;
        border-radius: 4px;
        background: none;
        text-transform: uppercase;
        outline: none;
    }

    .view-mode:hover {
        border: 2px solid #2f80ed;
    }

    .view-mode::before {
        border-bottom: 5px solid transparent;
        border-top: 5px solid transparent;
        border-left: 5px solid #2f80ed;
        content: '';
        position: absolute;
        top: 11px;
        right: 70px;
    }
</style>
<div id="main-content-wp" class="clearfix detail-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{route('home_index')}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Điện thoại</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right" id="detail">
            <div class="section" id="detail-product-wp">
                <div class="section-detail clearfix" id="1">
                    <div class="thumb-wp fl-left">
                        <a href="" title="" id="main-thumb" class="m">
                            <img id="zoom" src="{{url($detail_product['images_product'])}}" data-zoom-image="{{url($detail_product['images_product'])}}" />
                        </a>
                        <div id="list-thumb">
                            @foreach($list_product_detail_images as $gallery)
                            <a href="" data-image="{{url($gallery->images)}}" data-zoom-image="{{url($gallery->images)}}">
                                <img id="zoom" src="{{url($gallery->images)}}" style="height:60px;" />
                            </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="info fl-right" style=" clear: both;width: 50%;padding-top: px;margin-right: 30px;margin-top: -450px !important;">
                        <h3 class="product-name">{{$detail_product->name}}</h3>
                        <div class="desc">
                            <p>{!!$detail_product->intro!!}</p>
                        </div>
                        <div class="num-product">
                            <span class="title">Sản phẩm: </span>
                            <span class="status" style="background-color: red; padding:5px 8px; color:#fff;">Còn Hàng</span>
                        </div>
                        <p class="price">{{number_format($detail_product['price'],0,",",".")}}đ</p>
                        <form action="{{url('them-san-pham/'.$detail_product['slug'].'/'.$detail_product['name'])}}">
                            <div id="num-order-wp">
                                <a title="" id="minus"><i class="fa fa-minus"></i></a>
                                <input type="text" name="num_order" value="1" id="num-order">
                                <a title="" id="plus"><i class="fa fa-plus"></i></a>
                            </div>
                            <button type="submit" class="add-cart" style="background-color:black !important ; border:none; color:gold;" data-id="{{ $detail_product->id }}"><i class="fa-solid fa-cart-plus"></i>Thêm giỏ hàng</button>
                        </form>

                    </div>
                </div>
            </div>
            <div class="section" id="post-product-wp">
                <div class="section-head clearfix" style="margin-top:30px;">

                </div>
                <div class="section-detail detail-hide" style="height:600px; overflow:hidden; position:relative;">
                    <div id="bg-article" style="display: block;  background: linear-gradient(to bottom, rgba(255 255 255/0), rgba(255 255 255/62.5), rgba(255 255 255/1));bottom: 0px;height: 105px; left: 0;position: absolute;width: 100%;"></div>
                    <button class="view-mode">Xem thêm</button>
                    <div class="" style="width:200px; border:1px solid #f9ede5;color: rgba(0,0,0,.87);font-size: 20px;padding: 0.875rem;text-transform: capitalize;">MÔ TẢ SẢN PHẨM</div>
                    <p>{!!$detail_product->detail!!}</p>
                </div>
                <div style="margin-top:30px;">
                    <div class="product-ratings__header product-rating-overview" style="margin:0px;">NHẬN XÉT VÀ ĐÁNH GIÁ SẢN PHẨM<b style="padding:0px 5px;">ISMART</b> TẠI DƯỚI ĐÂY !</div>
                    <form action="#" class="" style="margin:0px; background: #fffbf8;padding:30px;">
                        <span style="display:block;">Nhập thông tin của bạn tại bên dưới.</span> <br>
                        <div class="information_comments">
                            <input type="text" class="information comment_name" name="comment_name" placeholder="Nhập tên của bạn">
                        </div>
                        <div>
                            <textarea name="comment" class="comment_content" placeholder="Nhận xét sản phẩm" cols="30" rows="10"></textarea>
                        </div>
                        <div class="dflex">
                            <div>
                                <p>Đánh Giá Số Sao Sản Phẩm Bên Dưới :</p>
                                <ul class="list-inline" title="đánh giá số sao sản phẩm" style="display:flex;">
                                    @for($count=1;$count<=5;$count++) @php if($count<=$rating) { $color='color:red;' ; } else { $color='color:#ccc;' ; } @endphp 
                                    <li title="đánh giá sao" id="{{$detail_product->id}}-{{$count}}" 
                                    data-index="{{$count}}" data-product_id="{{$detail_product->id}}" 
                                    data-rating="{{$rating}}" class="rating" style="cursor:pointer; font-size:30px; {{$color}}">
                                        &#9733;
                                        </li>
                                        @endfor
                                </ul>
                            </div>
                            <div>
                                <button type="button" class="evaluate send-comment">Đánh Giá</button>
                            </div>
                        </div>
                        <div class="success-comment-product">

                        </div>
                    </form>
                    <div class="clear-both"></div>
                    <div class="product-rating-overview" style="margin:0px;">
                        <div class="product-rating-overview__briefing">
                            <div class="product-rating-overview__score-wrapper"><span class="product-rating-overview__rating-score">4.9</span><span class="product-rating-overview__rating-score-out-of"> trên 5 </span></div>
                            <div class="shopee-rating-stars product-rating-overview__stars">
                                <span style="color:red; font-size:28px;"> &#9733;</span>
                                <span style="color:red; font-size:28px;"> &#9733;</span>
                                <span style="color:red; font-size:28px;"> &#9733;</span>
                                <span style="color:red; font-size:28px;"> &#9733;</span>
                                <span style="color:#ccc; font-size:28px;"> &#9733;</span>
                            </div>
                        </div>
                        <div class="product-rating-overview__filters">
                            <div class="product-rating-overview__filter product-rating-overview__filter--active product-rating-overview__filter--all">tất cả</div>
                            <div class="product-rating-overview__filter">5 Sao ({{$count_5}})</div>
                            <div class="product-rating-overview__filter">4 Sao ({{$count_4}})</div>
                            <div class="product-rating-overview__filter">3 Sao ({{$count_3}})</div>
                            <div class="product-rating-overview__filter">2 Sao ({{$count_2}})</div>
                            <div class="product-rating-overview__filter">1 Sao ({{$count_1}})</div>
                            <div class="product-rating-overview__filter product-rating-overview__filter--with-comment">Có Bình luận ({{$count_comment}})</div>
                        </div>
                    </div>
                    <form>
                        @csrf
                        <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$detail_product->id}}">
                        <div id="comment_show" class="">

                        </div>
                    </form>
                </div>
            </div>
            <div class="section" id="same-category-wp">
                <div class="section-head" style="margin-bottom:10px; margin-top:30px;">
                    <div style="border-bottom:3px solid black; width:600px;">
                        <div class="section-head clearfix" style="background-color:black; border-bottom:50px; width:210px;">
                            <h3 class="section-title" style="padding: 5px 5px 5px 15px; color:goldenrod; margin-bottom: 0px; margin-top:0px;">Sản Phẩm Khác</h3>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach($list_product as $product)
                        <li>
                            <a href="{{url('san-pham/'.$product['slug'].'/'.$product['name'])}}" title="" class="thumb">
                                <img src="{{url($product['images_product'])}}">
                            </a>
                            <a href="{{url('san-pham/'.$product['slug'].'/'.$product['name'])}}" title="" class="product-name">{{$product['name']}}</a>
                            <div class="price">
                                <span class="price" style="color:red;">{{number_format($product['price'],0,",",".")}}đ</span>
                                <del class="old">{{number_format($product['price_old'],0,",",".")}}đ</del>
                            </div>
                            <div class="action clearfix">
                                <a href="{{url('them-san-pham/'.$product['slug'].'/'.$product['name'])}}" title="Thêm giỏ hàng" class="add-cart fl-left" style="border-radius:8px;">Thêm giỏ hàng</a>
                                <a href="{{url('mua-ngay/'.$product['slug'].'/'.$product['name'])}}" title="Mua ngay" class="buy-now fl-right" style="border-radius:8px;">Mua ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
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
                        @foreach($medias as $key => $media)
                        <img src="{{url($media->images_media)}}" alt="">
                        @endforeach
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.view-mode').click(function() {
            $('.section-detail').addClass('active');
            $('.view-mode').css('display', 'none');
        });
        $('.fa-star').click(function() {
            $(this).toggleClass('start');
        });
    })
</script>
@endsection