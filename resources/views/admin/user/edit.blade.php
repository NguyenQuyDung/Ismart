@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Cập Nhật người dùng
        </div>
        <div class="card-body">
            <form action="{{url('admin/user/update', $user->id)}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{$user->name}}">
                    @error('name')
                    <small style="color:red; font-size: 15px;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" disabled type="text" name="email" id="email" value="{{$user->email}}">
                  
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu Mới</label>
                    <input class="form-control" type="password" name="password" id="email">
                    @error('password')
                    <small style="color:red; font-size: 15px;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirm">Xác Nhận Mật khẩu</label>
                    <input class="form-control" type="password" name="password_confirm" id="email">
                    @error('password_confirm')
                    <small style="color:red; font-size: 15px;">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Nhóm quyền</label>
                    <select class="form-control" id="">
                        <option>Chọn quyền</option>
                        <option>Danh mục 1</option>
                        <option>Danh mục 2</option>
                        <option>Danh mục 3</option>
                        <option>Danh mục 4</option>
                    </select>
                </div>

                <button type="submit" value="Cập Nhật" class="btn btn-primary" name="btn_add">Cập Nhật</button>
            </form>
        </div>
    </div>
</div>
@endsection