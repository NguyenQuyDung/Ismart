<!DOCTYPE html>
<html>

<head>
    <title>ISMART STORE</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="icon" href="{{asset('images/klipartz.com.png')}}">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link href="{{asset('css/bootstrap/bootstrap-theme.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/bootstrap/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/reset.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/carousel/owl.carousel.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/carousel/owl.theme.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/import/home.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/import/header.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/import/global.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/import/footer.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/import/fonts.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/import/detail_product.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/import/detail_blog.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/import/checkout.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/import/category_product.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/import/cart.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/alert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('js/alert.js')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('css/import/blog.css')}}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery-3.6.0.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/elevatezoom-master/jquery.elevatezoom.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/carousel/owl.carousel.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/main.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.spritezoom.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/simple.money.format.js')}}" type="text/javascript"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".add-cart").click(function() {
                var id = $(this).data('id');
                var cart_product_id = $('.cart_product_id_' + id).val();
                var name = $('.cart_product_name_' + id).val();
                var img = $('.cart_product_image_' + id).val();
                var price = $('.cart_product_price_' + id).val();
                var qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{url('/add-to-cart-ajax')}}",
                    method: "POST",
                    data: {
                        cart_product_id: cart_product_id,
                        name: name,
                        img: img,
                        price: price,
                        qty: qty,
                        _token: _token
                    },
                    success: function(data) {
                        swal("Thêm Sản Phẩm Vào Giỏ Hàng Thành Công", " ", "success");
                        location.reload(0);
                        // alertify.success('Thêm Sản Phẩm Vào Giỏ Hàng Thành Công !');
                    },
                });
            });
            $(".del-product").click(function() {
                swal("Bạn Đã Xóa Sản Phẩm Thành Công", " ", "success");
                // return false
            });
            $("#delete-cart").click(function() {
                swal("Bạn Đã Xóa Giỏ Hàng Thành Công", " ", "success");
            });
            $(".update").click(function() {
                swal("Bạn Đã Cập Nhật Giỏ Hàng Thành Công", " ", "success");
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            load_comment();

            function load_comment() {
                var product_id = $('.comment_product_id').val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{url('/load-comment-product')}}",
                    method: "POST",
                    data: {
                        product_id: product_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#comment_show').html(data);
                    },
                });
            }
            $('.send-comment').click(function() {
                var product_id = $('.comment_product_id').val();
                var comment_name = $('.comment_name').val();
                var comment_content = $('.comment_content').val();
                var _token = $('input[name="_token"]').val();
                console.log(product_id);
                console.log(comment_name);
                console.log(comment_content);
                $.ajax({
                    url: "{{url('sent-comment')}}",
                    method: "POST",
                    data: {
                        product_id: product_id,
                        comment_name: comment_name,
                        comment_content: comment_content,
                        _token: _token
                    },
                    success: function(data) {
                        swal("Đánh Giá Sản Phẩm Thành Công , Bài viết đánh giá Của bạn đang được tiến hành phê duyệt !", " ", "success");
                        load_comment();
                        $('.comment_name').val('');
                        $('.comment_content').val('');
                    },
                });
            });
        });
    </script>
    <script type="text/javascript">
        function remove_background(product_id) {
            for (var count = 1; count <= 5; count++) {
                $('#' + product_id + '-' + count).css('color', '#ccc');
            }
        }
        // hover chuột khi đánh giá
        $(document).on('mouseenter', '.rating', function() {
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');

            remove_background(product_id);
            for (var count = 1; count <= index; count++) {
                $('#' + product_id + '-' + count).css('color', 'red');
            }
        });
        //nhả chuột không đánh giá
        $(document).on('mouseleave', '.rating', function() {
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
            var rating = $(this).data("rating");
            remove_background(product_id);
            for (var count = 1; count <= rating; count++) {
                $('#' + product_id + '-' + count).css('color', 'red');
            }
        });
        // click đánh giá sao
        $(document).on('click', '.rating', function() {
            var index = $(this).data("index");
            var product_id = $(this).data('product_id');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/rating-insert')}}",
                method: "POST",
                data: {
                    index: index,
                    product_id: product_id,
                    _token: _token
                },
                success: function(data) {
                    if (data == 'done') {
                        // swal({
                        //     title: "ISMART!",
                        //     text: "Bạn đã đánh giá " + index +"Sao"+"trên 5 Sao",
                        //     imageUrl: "https://common.olemiss.edu/examples/sweet-alert/images/thumbs-up.jpg"
                        // });
                        swal(
                            'ISMART!',
                            "Bạn đã đánh giá " + index + " Sao " + "trên 5 Sao",
                            'success'
                        )

                    } else {
                        return " ";
                    }
                },
            });
        });
    </script>
</head>

<body>
    <style>
        .swal-button {
            display: none;
        }

        .ajax_jquery {
            position: absolute;
            top: 100px;
            background-color: #fff;
            border-radius: 20px;
            width: 494px;
            max-height: 300px;
            z-index: 1;
            overflow: hidden;
        }

        .ajax_jquery ul li.search-ajax {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            padding: 10px 20px 0;
        }
    </style>
    <div id="site">
        <div id="container">
            <div id="header-wp">
                <div id="head-top" class="clearfix">
                    <div class="wp-inner">
                        <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                        <div id="main-menu-wp" class="fl-right">
                            <ul id="main-menu" class="clearfix">
                                <li>
                                    <a href="{{route('home_index')}}" title="">Trang chủ</a>
                                </li>
                                <li>
                                    <a href="{{route('category_product')}}" title="">Sản phẩm</a>
                                </li>
                                <li>
                                    <a href="{{route('blog')}}" title="">Blog công nghệ</a>
                                </li>
                                <li>
                                    <a href="{{route('introduce')}}" title="">Giới thiệu</a>
                                </li>
                                <li>
                                    <a href="{{route('contact')}}" title="">Liên hệ</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="head-body" class="clearfix">
                    <div class="wp-inner">
                        <a href="{{route('home_index')}}" title="" id="logo" class="fl-left">
                            <img src="{{asset('images/logo.png')}}" />
                        </a>
                        <div id="search-wp" class="fl-left">
                            <form action="{{url('tim-kiem-san-pham.html')}}" method="POST">
                                @csrf
                                <div>
                                    <input style=" margin-left: 8px;
    display: inline-block;
    width: 400px;
    border-radius: 20px;
    border: none;
    outline: none;
    padding: 10px 20px !important;
    line-height: normal;" type="text" name="keyword" id="s" placeholder="Bạn muốn tìm kiếm sản phẩm gì ?" class="input_search_ajax" autocomplete="off">
                                    <input type="submit" name="search_item" id="sm-s" value="Tìm Kiếm" style=" border-radius: 50px;
    position: relative;
    left: 0px;
    display: inline-block;
    border: none;
    outline: none;
    background: #111111;
    color: goldenrod;
    padding: 13px 25px !important;
    line-height: 13px;
    font-size: 13px;font-weight:bold;">
                                </div>
                                <div class="ajax_jquery">

                                </div>
                            </form>
                        </div>
                        <div id="action-wp" class="fl-right">
                            <div id="advisory-wp" class="fl-left">
                                <span class="title">Tư vấn</span>
                                <span class="phone">0987.654.321</span>
                            </div>
                            <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                            <a href="{{url('gio-hang.html')}}" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                <span id="num">2</span>
                            </a>
                            <div id="cart-wp" class="fl-right">
                                <div id="btn-cart">
                                    <a href="{{url('gio-hang.html')}}"> <i style="color:maroon;" class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                                    <span id="num">{{Cart::count()}}</span>
                                </div>
                                <div id="dropdown">
                                    <p class="desc">Có <a href="" class="font-weight-bold">({{Cart::count()}})</a> Sản Phẩm Trong Giỏ Hàng</p>
                                    <ul class="list-cart">
                                        @foreach(Cart::content() as $cart)
                                        <li class="clearfix">
                                            <a href="" title="" class="thumb fl-left">
                                                <img src="{{url($cart->options->images_product)}}" alt="">
                                            </a>
                                            <div class="info fl-right">
                                                <a href="" title="" class="product-name">{{$cart->name}}</a>
                                                <p class="price">{{number_format($cart->price,0,' ','.')}}đ</p>
                                                <p class="qty">Số lượng: <span class="qty-{{$cart->rowId}}">{{$cart->qty}}</span></p>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @if(Cart::count() > 0)
                                    <div class="total-price clearfix" style="display:flex; justify-content: space-between;">
                                        <p class="title">Tổng:</p>
                                        <p class="price" id="total-price" style="margin:0px;">{{Cart::total()}}đ</p>
                                    </div>
                                    <dic class="action-cart clearfix">
                                        <a href="{{url('gio-hang.html')}}" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                        <a href="{{route('payment')}}" title="Thanh toán" class="checkout fl-right">Thanh
                                            toán</a>
                                    </dic>
                                    @else
                                    <img src="public/images/11.png" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="wp-content">
        @yield('content');
    </div>
    <div id="footer-wp">
        <div id="foot-body">
            <div class="wp-inner clearfix">
                <div class="block" id="info-company">
                    <h3 class="title">ISMART</h3>
                    <p class="desc">ISMART luôn cung cấp luôn là sản phẩm chính hãng có thông tin rõ ràng, chính sách ưu
                        đãi cực lớn cho khách hàng có thẻ thành viên.</p>
                    <div id="payment">
                        <div class="thumb">
                            <img src="public/images/img-foot.png" alt="">
                        </div>
                    </div>
                </div>
                <div class="block menu-ft" id="info-shop">
                    <h3 class="title">Thông tin cửa hàng</h3>
                    <ul class="list-item">
                        <li>
                            <p>106 - Trần Bình - Cầu Giấy - Hà Nội</p>
                        </li>
                        <li>
                            <p>0987.654.321 - 0989.989.989</p>
                        </li>
                        <li>
                            <p>vshop@gmail.com</p>
                        </li>
                    </ul>
                </div>
                <div class="block menu-ft policy" id="info-shop">
                    <h3 class="title">Chính sách mua hàng</h3>
                    <ul class="list-item">
                        <li>
                            <a href="" title="">Quy định - chính sách</a>
                        </li>
                        <li>
                            <a href="" title="">Chính sách bảo hành - đổi trả</a>
                        </li>
                        <li>
                            <a href="" title="">Chính sách hội viện</a>
                        </li>
                        <li>
                            <a href="" title="">Giao hàng - lắp đặt</a>
                        </li>
                    </ul>
                </div>
                <div class="block" id="newfeed">
                    <h3 class="title">Bảng tin</h3>
                    <p class="desc">Đăng ký với chung tôi để nhận được thông tin ưu đãi sớm nhất</p>
                    <div id="form-reg">
                        <form method="POST" action="">
                            <input type="email" name="email" id="email" placeholder="Nhập email tại đây">
                            <button type="submit" id="sm-reg">Đăng ký</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="foot-bot">
            <div class="wp-inner">
                <p id="copyright">© Bản quyền thuộc về unitop.vn | Php Master</p>
            </div>
        </div>
    </div>
    </div>
    <div id="menu-respon">
        <a href="{{route('home_index')}}" title="" class="logo">VSHOP</a>
        <div id="menu-respon-wp">
            <ul class="" id="main-menu-respon">
                <li>
                    <a href="{{route('home_index')}}" title>Trang chủ</a>
                </li>
                <li>
                    <a href="{{route('category_product')}}" title>Điện thoại</a>
                    <ul class="sub-menu">
                        <li>
                            <a href="" title="">Iphone</a>
                        </li>
                        <li>
                            <a href="?page=category_product" title="">Samsung</a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="?page=category_product" title="">Iphone X</a>
                                </li>
                                <li>
                                    <a href="?page=category_product" title="">Iphone 8</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?page=category_product" title="">Nokia</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="?page=category_product" title>Máy tính bảng</a>
                </li>
                <li>
                    <a href="?page=category_product" title>Laptop</a>
                </li>
                <li>
                    <a href="?page=category_product" title>Đồ dùng sinh hoạt</a>
                </li>
                <li>
                    <a href="?page=blog" title>Blog</a>
                </li>
                <li>
                    <a href="#" title>Liên hệ</a>
                </li>
            </ul>
        </div>
    </div>
    <div id="btn-top"><img src="public/images/icon-to-top.png" alt="" /></div>
    <div id="fb-root"></div>
    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <!-- Modal -->
    <!-- CSS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css" />
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />

    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=849340975164592";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <script type="text/javascript">
        $('.input_search_ajax').keyup(function() {
            var _text = $(this).val();
            var _url = "{{url('')}}";
            if (_text != '') {
                $.ajax({
                    url: "{{route('search-product')}}?keyword=" + _text,
                    type: 'GET',
                    success: function(res) {
                        var _html = '';
                        for (var pro of res) {
                            _html += '<ul>';
                            _html += '<li class="search-ajax">';
                            _html += '<a href="http://localhost/unitop.vn/Ismart.vn/san-pham/' + pro.slug + '/' + pro.name + '" style="flex-basis:10%;">';
                            _html += '<img src="' + _url + '/' + pro.images_product + ' ">';
                            _html += '</a>';
                            _html += '<a href="http://localhost/unitop.vn/Ismart.vn/san-pham/' + pro.slug + '/' + pro.name + '" style="flex-basis: 82%; padding-left:50px; color:cadetblue; font-size:14px;">' + pro.name + '</a > ';
                            _html += '</li>';
                            _html += '</ul>';
                        }
                        $('.ajax_jquery').show();
                        $('.ajax_jquery').html(_html);
                    }
                });
            } else {
                $('.ajax_jquery').html('');
                $('.ajax_jquery').hide();
            }
        });
    </script>
</body>

</html>