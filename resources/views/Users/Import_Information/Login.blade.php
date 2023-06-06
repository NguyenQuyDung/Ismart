<!-- <html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta http-Equiv="X-UA-Tương thích" content="IE = edge">
    <meta name="viewport" content="width = device-width, ban đầu-scale = 1.0 ">
    <title> Đăng Ký Tài Khoản</title>
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min. css " rel="bảng định kiểu" liêm chính="sha384-EVSTQN3 / azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="nặc danh">

    <head link rel="stylesheet" href="https ://cdonsn.jsdelivr.bost1.5strap/icfont/boons .css ">
    </head>

<body>
    <div class="container-liquid vh-100" style="margin-top: 300px">
        <div class="" style="margin-top: 200px">
            <div class="round d-flex justify-content-center ">
                <div class=" col-md-4 col-sm-12 shadow-lg p-5 bg-light ">
                    <div class=" text-center ">
                        <h3 class="text-primary"> Đăng Nhập Tài Khoản Của Bạn
                        </h3>
                    </div>
                    <div class="p-4">
                        <form action="">
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-primary ">
                                    <i class=" bi bi-person-plus-fill text-white "> </i>
                                </span>

                                <input type="text" class="form-control" placeholder="Username">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-primary">
                                    <i class="bi bi-key-fill text-white"></i>
                                </span>

                                <div input type="password" class="form-control" placeholder="password">
                                </div>
                                <div class="d-grid col-12 mx-auto">
                                    <lớp nút="btn btn-primary" type="button">
                                        <span></span> Đăng Nhập
                                        </button>
                                </div>
                        </form>
                    </div>
                    <div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html> -->

<body style="background: #E0F7FA; background-image: url('https://cdn.pixabay.com/photo/2018/05/07/19/07/cubes-3381438_960_720.jpg');background-repeat:repeat-y; background-size: 100%;">
    <div id="app">
        <div id="">
            <div class="container text-center">
                <div class="" style="padding-top:100px;"><a href="https://vanmanh.unitopcv.com/project/ismart/public"><img src="public/images/logo.png" /></a></div>
            </div>
        </div>
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="card form-lgrg" style="box-shadow: #8c8cbd 0px 0px 50px 0px; background: #a6a6b7;">
                            <div class="card-header text-center" style="font-size: 35px">Đăng nhập</div>
                            <div class="card-body">
                                <form method="POST" action="https://vanmanh.unitopcv.com/project/ismart/public/login">
                                    <input type="hidden" name="_token" value="o2dGLFAqdnAkB925iEBuG9KGZXFz3xWfIqU59eKD">
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input id="email" type="email" class="form-control " name="email" value="" required autocomplete="email" autofocus placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control " name="password" required autocomplete="current-password" placeholder="Mật khẩu">

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <div class="form-check" style="font-size: 13px">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                                <label class="form-check-label" for="remember">
                                                    Ghi nhớ đăng nhập
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-12">
                                            <div><button style="width: 100%; margin-bottom: 5px;" type="submit" class="btn btn-primary">Đăng nhập</button></div>

                                            <a class="btn btn-link" href="https://vanmanh.unitopcv.com/project/ismart/public/password/reset" style="font-size: 14px; padding:0px;">
                                                Quên Mật Khẩu?
                                            </a>

                                            <div class="float-right"><a style="font-size: 14px;" class="" href="https://vanmanh.unitopcv.com/project/ismart/public/register">Đăng ký</a></div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>