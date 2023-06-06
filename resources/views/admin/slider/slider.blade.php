@extends('layouts.admin')
@section('content')
<div id="wp-content" style="padding:0rem !important;">
    <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if(session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                    @endif
                    <div class="card-header font-weight-bold">
                        Thêm ảnh slider
                    </div>
                    <div class="card-body">
                        <h4 class="text-info"></h4>
                        <form action="{{url('admin/slider/add')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="name_slider">Tên slider</label>
                                    <input type="name" placeholder="Tên slider" name="name_slider" class="form-control" id="name_slider">
                                    @error('name_slider')
                                    <small style="color:red; font-size: 15px;">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-6">
                                    <label for="name_slug">Đường dẫn slider</label>
                                    <input type="name_slug" placeholder="Đường dẫn slider" name="name_slug" class="form-control" id="name_slug">
                                    @error('name_slug')
                                    <small style="color:red; font-size: 15px;">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group col-6" style="overflow:hidden;">
                                    <label for="file-product">Ảnh slider</label>
                                    <input type="file" name="file" id="file-uploader" class="form-control-file  mb-3" accept=".jpg, .jpeg, .png">

                                    <div id="image-grid" style="width:300px; border:2px solid grey; height:135px;" title="Hiển Thị Ảnh !">

                                    </div>

                                    @error('file')
                                    <small style="color:red; font-size: 15px;">{{$message}}</small>
                                    @enderror

                                </div>
                                <div class="form-group col-6">
                                    <label for="">Trạng thái</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="Công khai" checked>
                                        <label class="form-check-label" for="exampleRadios1">
                                            Công khai
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="Chờ duyệt">
                                        <label class="form-check-label" for="exampleRadios2">
                                            Chờ duyệt
                                        </label>
                                    </div>
                                    @error('status')
                                    <small style="color:red; font-size: 15px;">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-danger p-2">Thêm Slider</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Danh sách slider
                    </div>
                    @if($list_sliders->total()>0)
                    <div class="card-body" style="min-height: 500px">
                        <div class="analytic mb-2">
                            <a href="" class="text-primary">Công khai({{$count}})<span class="text-muted"></span></a>
                            <a href="" class="text-primary">Chờ duyệt({{$counts}})<span class="text-muted"></span></a>
                        </div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">Thứ tự</th>
                                    <th scope="col">Hình ảnh slider</th>
                                    <th scope="col">Tên slider</th>
                                    <th scope="col">Đường dẫn slider</th>
                                    <th scope="col" class="text-center">Trạng thái</th>
                                    <th scope="col" class="text-center">Người tạo</th>
                                    <th scope="col" class="text-center">Ngày tạo</th>
                                    <th scope="col" class="text-center">Tác vụ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $stt=0;
                                @endphp
                                @foreach($list_sliders as $list_slider)
                                @php
                                $stt++;
                                @endphp
                                <tr>
                                    <th scope="row" class="text-center">{{$stt}}</th>
                                    <td><img style="max-width: 150px;" src="{{url($list_slider->images_slider)}}" alt="" class="img-fluid"></td>
                                    <td scope="" class="text-center"><span>{{$list_slider->name_slider}}</span></td>
                                    <td scope="" class="text-center"><span>{{$list_slider->name_slug}}</span></td>
                                    <td class="text-center"><span>{{$list_slider->status}}</span></td>
                                    <td class="text-center"><span>{{$list_slider->user_create}}</span></td>
                                    <td class="text-center"><span>{{$list_slider->created_at}}</span></td>
                                    <td class="text-center">
                                        <a href="{{url('delete', $list_slider->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash" onclick="return confirm('Bạn có chắc chắn xóa bản ghi này vĩnh viễn ?')"></i></a>
                                        <!-- <a style="width:30px;" href="{{url('edit/slider', $list_slider->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a> -->

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$list_sliders->links()}}
                    @else
                    <b>Hiện Tại Không Có Slider Trên Trang Này !</b>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    const fileUploader = document.getElementById('file-uploader');
    const reader = new FileReader();
    const imageGrid = document.getElementById('image-grid');

    fileUploader.addEventListener('change', (event) => {
        const files = event.target.files;
        const file = files[0];
        reader.readAsDataURL(file);

        reader.addEventListener('load', (event) => {
            const img = document.createElement('img');
            imageGrid.appendChild(img);
            img.src = event.target.result;
            img.alt = file.name;
        });
    });
</script>
@endsection