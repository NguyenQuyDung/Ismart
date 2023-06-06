@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-8">
            <div class="card">
                @if(session('status'))
                <div class="alert alert-success">
                    {{session('status')}}
                </div>
                @endif
                <div class="card-header font-weight-bold">
                    Thêm danh mục
                </div>
                <div class="card-body">
                    <form action="{{url('admin/post/update_cat', $post_cats->id)}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input value="{{$post_cats->name}}" class="form-control" type="text" name="name" id="name">
                            @error('name')
                            <small style="color:red; font-size: 15px;">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Đường dẫn slug</label>
                            <input value="{{$post_cats->slug}}" class="form-control" type="text" name="slug" id="slug">
                            @error('slug')
                            <small style="color:red; font-size: 15px;">{{$message}}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">CẬP NHẬT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection