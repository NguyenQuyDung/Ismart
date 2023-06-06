@extends('layouts.user')
@section('content')
<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Blog</a>
                    </li>
                    <li>
                        <a href="" title="">{{$this_cat_name}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div style="border-bottom:3px solid black; width: 600px">
                    <div class="section-head clearfix" style="background-color:black;width:210px;">
                        <h3 class="section-title" style="padding: 8px 10px; color:goldenrod; margin-bottom: 0px; ">{{$this_cat_name}}</h3>
                    </div>
                </div>
                <div class="section-detail">
                    <ul class="list-item" style="margin-top: 20px; margin-bottom: 30px;">
                        @foreach($list_posts as $post)
                        <li class="clearfix">
                            <a href="{{url('bai--viet/'.$post->name)}}" title="" class="thumb fl-left">
                                <img src="{{url($post->images)}}" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="{{url('bai--viet/'.$post->name)}}" title="" class="title">{{$post->name}}</a>
                                <span class="create-date">{{$post->created_at}}</span>
                                <p class="desc">{{$post->content}}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- <div class="section" id="paging-wp">
                    <div class="section-detail">
                        <ul class="list-item clearfix">
                            <li>
                            </li>
                        </ul>
                    </div>
                </div> -->
            </div>
            <div class="section" id="social-wp">
                <div class="section-detail">
                    <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    <div class="g-plusone-wp">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
                    <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp" style="margin-bottom: 30px;">
                <div class="section-head">
                    <h3 class="section-title">Danh mục bài viết</h3>
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
                            $link = route('post.list', [$value->slug]);
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
                                <a href="{{url('mua-ngay/'.$product['slug'].'/'.$product['name'])}}" title="Mua ngay" class="buy-now fl-right" style="border-radius:8px;">Mua ngay</a>                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
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

@endsection