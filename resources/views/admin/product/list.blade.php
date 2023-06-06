@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
        @endif
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách sản phẩm</h5>
            <div class="form-search form-inline">
                <form action="#" class="d-flex">
                    <input type="text" class="form-control form-search" placeholder="Tìm kiếm" name="keyword">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['status'=>'Pending'])}}" class="text-primary">Còn Hàng<span class="text-muted">({{$count_Pending}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'public'])}}" class="text-primary">Hết Hàng<span class="text-muted">({{$count_public}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'featured_products'])}}" class="text-primary">Những Sản Phẩm Nổi Bật<span class="text-muted">({{$featured_products}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status'=>'delete'])}}" class="text-primary">Thùng Rác<span class="text-muted">({{$count_trash}})</span></a>
            </div>
            <form action="{{url('admin/product/action')}}">
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" id="" name="act">
                        <option>Chọn</option>
                        @foreach($list_act as $k => $act)
                        <option value="{{$k}}">{{$act}}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                </div>
                @if($products->total()>0)
                <table class="table table-striped table-checkall table-hover">
                    <thead>
                        <tr>
                            <th scope="col">
                                <input name="checkall" type="checkbox">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col" style="font-size:14px;">Thư Viện Ảnh Gallery</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Người tạo</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $stt=0;
                        @endphp
                        @foreach ($products as $product)
                        @php
                        $stt++;
                        @endphp
                        <tr class="">
                            <td>
                                <input type="checkbox" name="list_check[]" value="{{$product->id}}">
                            </td>
                            <td>{{$stt}}</td>
                            <td><img style="width:60px; height:60px;" src="{{url($product->images_product)}}" alt=""></td>
                            <td><a href="{{url('admin/view/gallery', $product->id)}}"><img title="Thêm Ảnh Gallery !" src="https://img.icons8.com/color/48/000000/add-image.png"/></a></td>
                            <td><a href="#">{{$product->name}}</a></td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->product_cat->name}}</td>
                            <td>{{$product->created_at}}</td>
                            <td>{{$product->user_create}}</td>
                            <td><span class="badge badge-success">{{$product->status}}</span></td>
                            <td>
                                <a style="width:30px;" href="{{url('admin/product/edit', $product->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                                <a style="width:30px;" href="{{url('admin/product/delete', $product->id)}}" onclick="return confirm('Bạn Có Chắc Muốn Xóa Bản Ghi Này !')" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <p class="alert alert-danger">Không Tìm Thấy Bản Ghi Nào Trên Hệ Thống !</p>
                @endif
                {{$products->links()}}
            </form>
        </div>
    </div>
</div>
@endsection