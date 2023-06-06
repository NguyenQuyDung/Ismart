<! DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{csrf_token()}}">
        <meta name="viewport" content="width = device-width, initial-scale = 1.0">
        <link rel="icon" href="{{asset('images/2003.png')}}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" Integrity="sha384-ggOyR0iXCbMQv3Xipma34MD + dH / 1fQ784 / j6cY / iJTQUOhcW1 = " ẩn danh">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/solid.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="{{asset('css/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/detail_order.css')}}">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <link rel="stylesheet" href="http://localhost/unitop.vn/Ismart.vn/public/vendor/laravel-filemanager/js/dropzone.min.js">
        <title> Quản trị viên </title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/brands.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.6.0/css/brands.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
        <link rel="stylesheet" href="/resources/demos/style.css">
        <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
        <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
        <script src="https://cdn.tiny.cloud/1/560vdjcu2ip1ij9n9shlzndj67qdsznb1lwe1i4k974r6kjc/tinymce/4/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            var editor_config = {
                path_absolute: "http://localhost/unitop.vn/Ismart.vn/",
                selector: "textarea",
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                relative_urls: false,
                file_browser_callback: function(field_name, url, type, win) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                    if (type == 'image') {
                        cmsURL = cmsURL + "&type=Images";
                    } else {
                        cmsURL = cmsURL + "&type=Files";
                    }

                    tinyMCE.activeEditor.windowManager.open({
                        file: cmsURL,
                        title: 'Filemanager',
                        width: x * 0.8,
                        height: y * 0.8,
                        resizable: "yes",
                        close_previous: "no"
                    });
                }
            };

            tinymce.init(editor_config);
        </script>
        // xu ly ajax
        <script type="text/javascript">
            $(document).ready(function() {
                load_gallery();

                function load_gallery() {
                    var pro_id = $('.pro_id').val();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{url('/select-gallery')}}",
                        method: "POST",
                        data: {
                            pro_id: pro_id,
                            _token: _token
                        },
                        success: function(data) {
                            $('#gallery_load').html(data);
                        }
                    });
                }

                $('#file').change(function() {
                    var error = '';
                    var files = $('#file')[0].files;

                    if (files.length > 5) {
                        error += '<p>Bạn chỉ phép chọn tối đa 5 ảnh !</p>';
                    } else if (files.length == "") {
                        error += '<p>Bạn không được bỏ trống file ảnh !</p>';
                    } else if (files.size > 2000000) {
                        error += '<p>File ảnh không được lớn hơn 2MB !</p>';
                    }
                    if (error == '') {

                    } else {
                        $('#file').val('');
                        $('#error_gallery').html('<span class="text-danger">' + error + '</span>');
                        return false;
                    }

                });
                /**chỉnh sửa tên gallery theo ajax */
                $(document).on('blur', '.edit_gal_name', function() {
                    var gal_id = $(this).data('gal_id');
                    var gal_text = $(this).text();
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{url('/update-gallery-name')}}",
                        method: "POST",
                        data: {
                            gal_id: gal_id,
                            gal_text: gal_text,
                            _token: _token
                        },
                        success: function(data) {
                            load_gallery();
                            $('#error_gallery').html('<span class="text-success alert alert-success">Bạn Đã Chỉnh Sửa Tên ảnh thư viện thành công !</span>');
                        }
                    });
                });
                /**Xóa ảnh gallery theo ajax */
                $(document).on('click', '.delete-gallery', function() {
                    var gal_id = $(this).data('gal_id');
                    var _token = $('input[name="_token"]').val();
                    if (confirm('Bạn Có Chắc Muốn Xóa Hình Ảnh Này không ?')) {
                        $.ajax({
                            url: "{{url('/delete-gallery')}}",
                            method: "POST",
                            data: {
                                gal_id: gal_id,
                                _token: _token
                            },
                            success: function(data) {
                                load_gallery();
                                $('#error_gallery').html('<span class="text-success alert alert-success w-100 ">Bạn Đã Xóa ảnh thư viện thành công !</span>');
                            }
                        });
                    }
                });
                /**Cập nhật ảnh mới bằng ajax */
                $(document).on('change', '.file_image', function() {
                    var gal_id = $(this).data('gal_id');
                    var image = document.getElementById('file-' + gal_id).files[0];
                    var form_data = new FormData();
                    form_data.append("file", document.getElementById('file-' + gal_id).files[0]);
                    form_data.append("gal_id", gal_id);
                    $.ajax({
                        url: "{{url('/update-gallery')}}",
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: form_data,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            load_gallery();
                            $('#error_gallery').html('<span class="text-success alert alert-success w-100 ">Bạn Đã Cập Nhật Hình ảnh thư viện thành công !</span>');
                        }
                    });
                });
            });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $('.comment_duyet_btn').click(function() {
                    var commnent_status = $(this).data('comment_status');
                    var comment_id = $(this).data('comment_id');
                    var comment_product_id = $(this).attr('id');
                    if (commnent_status == 0) {
                        var alert = 'Thay Đổi Trạng Thái Phê Duyệt Thành Công !';
                    } else {
                        var alert = 'Đã Thay Đổi Trạng Thái Chờ Duyệt Thành Công !';
                    }
                    $.ajax({
                        url: "{{url('/update-comment')}}",
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            commnent_status: commnent_status,
                            comment_id: comment_id,
                            comment_product_id: comment_product_id
                        },
                        success: function(data) {
                            location.reload();
                            $('#notifly_comment_success').html('<span class="d-block alert alert-success">' + alert + '</span>');
                        }
                    });
                });
                $('.btn-reply-comment').click(function() {
                    var comment_id = $(this).data('comment_id');
                    var commnent = $('.reply_comment_' + comment_id).val();
                    var comment_product_id = $(this).data('product_id');
                    $.ajax({
                        url: "{{url('/reply-comment')}}",
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            commnent: commnent,
                            comment_id: comment_id,
                            comment_product_id: comment_product_id
                        },
                        success: function(data) {
                            location.reload();
                            $('.reply_comment_' + comment_id).val('');
                            $('#notifly_comment_success').html('<span class="d-block alert alert-success">Phản Hồi Comment Đánh Giá Sản Phẩm Của Khách Hàng Về Sản Phẩm Ismart Thành Công !</span>');
                        }
                    });
                });
                // $('.delete').click(function() {
                //     var comment_id = $(this).attr('id');
                //     $.ajax({
                //         url: "{{url('/delete-comment')}}",
                //         method: "POST",
                //         headers: {
                //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //         },
                //         data: {
                //             comment_id: comment_id,
                //         },
                //         success: function(data) {
                //             location.reload();
                //             $('#delete_comment_success').html('<span class="d-block alert alert-success">Đã Xóa Comment Đánh Giá Sản Phẩm Thành Công !</span>');
                //         }
                //     });
                // });
            });
        </script>
    </head>

    <body>
        <style>
            #image-grid img {
                width: 300px;
            }
        </style>
        <div id="warpper" class="nav-fixed">
            <nav class="topnav shadow navbar-light bg-white d-flex">
                <div class="navbar-brand"> <a href="?"> QUẢN TRỊ UNITOP </a> </div>
                <div class="nav-right">
                    <div class="btn-group mr-auto">
                        <button type="button" class="btn dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expand="false">
                            <i class="plus-icon fas fa-plus-circle"> </i>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{url('admin/post/add')}}"> Thêm bài viết </a>
                            <a class="dropdown-item" href="{{url('admin/product/add')}}"> Thêm sản phẩm </a>
                            <a class="dropdown-item" href="{{url('admin/order/list')}}"> Thêm đơn hàng </a>
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expand="false">
                            {{Auth::user()->name}}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#"> Tài khoản </a>
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
            @php
            $module_active = session('module_active');
            @endphp
            <div id="page-body" class="d-flex">
                <div id="sidebar" class="bg-white">
                    <ul id="sidebar-menu">
                        <li class="nav-link {{$module_active=='dashboard'?'active':''}}">
                            <a href="{{url('dashboard')}}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"> </i>
                                </div>
                                Dashboard
                            </a>
                            <i class="arrow fas fa-angle-right"> </i>
                        </li>
                        <li class="nav-link {{$module_active=='page'?'active':''}}">
                            <a href="{{url('admin/page/list')}}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"> </i>
                                </div>
                                Trang
                            </a>
                            <i class="arrow fas fa-angle-right"> </i>

                            <ul class="sub-menu">
                                <li> <a href="{{url('admin/page/add')}}"> Thêm mới </a> </li>
                                <li> <a href="{{url('admin/page/list')}}"> Danh sách </a> </li>
                            </ul>
                        </li>
                        <li class="nav-link {{$module_active=='post'?'active':''}}">
                            <a href="{{url('admin/post/list')}}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"> </i>
                                </div>
                                Bài viết
                            </a>
                            <i class="arrow fas fa-angle-right"> </i>
                            <ul class="sub-menu">
                                <li> <a href="{{url('admin/post/add')}}"> Thêm mới </a> </li>
                                <li> <a href="{{url('admin/post/list')}}"> Danh sách </a> </li>
                                <li> <a href="{{url('admin/post/category')}}"> Danh mục </a> </li>
                            </ul>
                        </li>
                        <li class="nav-link {{$module_active=='product'?'active':''}}">
                            <a href="{{url('admin/product/list')}}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"> </i>
                                </div>
                                Sản phẩm
                            </a>
                            <i class="arrow fas fa-angle-right"> </i>
                            <ul class="sub-menu">
                                <li> <a href="{{url('admin/product/add')}}"> Thêm mới </a> </li>
                                <li> <a href="{{url('admin/product/list')}}"> Danh sách </a> </li>
                                <li> <a href="{{url('admin/product/category')}}"> Danh mục </a> </li>
                            </ul>
                        </li>
                        <li class="nav-link {{$module_active=='comment'?'active':''}}">
                            <a href="{{url('admin/comment/list')}}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"> </i>
                                </div>
                                Bình luận sản phẩm
                            </a>
                            <i class="arrow fas fa-angle-right"> </i>
                            <ul class="sub-menu">
                                <li> <a href="{{url('admin/comment/list')}}"> Liệt kê bình luận</a> </li>
                            </ul>
                        </li>
                        <li class="nav-link {{$module_active=='order'?'active':''}}">
                            <a href="{{url('admin/order/list_order')}}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"> </i>
                                </div>
                                Bán hàng
                            </a>
                            <i class="arrow fas fa-angle-right"> </i>
                            <ul class="sub-menu">
                                <li> <a href="{{url('admin/order/list_order')}}"> Đơn hàng </a> </li>
                            </ul>
                        </li>
                        <li class="nav-link {{$module_active=='slider'?'active':''}}">
                            <a href="{{url('slider')}}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"> </i>
                                </div>
                                Slider
                                <i class="arrow fas fa-angle-right"> </i>
                            </a>
                        </li>
                        <li class="nav-link {{$module_active=='media'?'active':''}}">
                            <a href="{{url('media')}}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"> </i>
                                </div>
                                Media
                                <i class="arrow fas fa-angle-right"> </i>
                                <ul class="sub-menu">
                                    <li> <a href="{{url('admin/media/list')}}"> Danh sách </a> </li>
                                </ul>
                            </a>
                        </li>
                        <li class="nav-link  {{$module_active=='menu'?'active':''}}" id="alert">
                            <a href="{{url('menu/admin')}}" id="alert">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"> </i>
                                </div>
                                Menu
                                <i class="arrow fas fa-angle-right"> </i>
                            </a>
                        </li>
                        <li class="nav-link {{$module_active=='user'?'active':''}}">
                            <a href="{{url('admin/user/list')}}">
                                <div class="nav-link-icon d-inline-flex">
                                    <i class="far fa-folder"> </i>
                                </div>
                                Người dùng
                            </a>
                            <i class="arrow fas fa-angle-right"> </i>

                            <ul class="sub-menu">
                                <li> <a href="{{url('admin/user/add')}}"> Thêm mới </a> </li>
                                <li> <a href="{{url('admin/user/list')}}"> Danh sách </a> </li>
                            </ul>
                        </li>

                        <!-- <li class="nav-link"> <a> Bài viết </a>
                                <ul class="sub-menu">
                                    <li> <a> Thêm mới </a> </li>
                                    <li> <a> List </a> </li>
                                    <li> <a> Thêm danh mục </a> </li>
                                    <li> <a> Danh mục list </a> </li>
                                </ul>
                                </li>
                                <li class="nav-link"> <a> Sản phẩm </a> </li>
                                <li class="nav-link"> <a> Đơn hàng </a> </li>
                                <li class="nav-link"> <a> Hệ thống </a> </li>  -->

                    </ul>
                </div>
                <div id="wp-content">
                    @yield('content')
                </div>
            </div>


        </div>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#alert").click(function() {
                    swal("Đang Bổ Sung !", " ", "success");
                    return false;
                });
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"> </script>
        <script src="{{asset('js/app.js')}}"> </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>

    </html>