@extends('layouts.admin')
@section('content')
<div id="conten" class="container-fluid">
    <h1 class="text-center p-2 alert alert-success" style="font-size:30px;">THƯ VIỆN ẢNH GALLERY</h1>
    @if(session('status'))
    <div class="alert alert-success">
        {{session('status')}}
    </div>
    @endif
    <div class="form-group" style="margin: 0px auto;margin-bottom: 1rem;margin-top:20px;">
        <form action="{{url('/insert-gallery/'.$pro_id)}}" method="POST" enctype="multipart/form-data" style="max-width:900px; margin:0px auto; margin-bottom:10px;">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <input type="file" title="Thêm Ảnh Gallery !" class="form-control mb-4" id="file" name="file[]" accept="images/*" multiple>
                    <span id="error_gallery" class="text-danger mb-4 d-block"></span>
                </div>
                <div class="" align="right">
                    <input style="padding: 8px 15px;" type="submit" name="upload" name="upload_images" value="Tải Ảnh" class="btn btn-success">
                    @error('upload')
                    <small style="color:red; font-size: 15px;">{{$message}}</small>
                    @enderror
                </div>
            </div>
        </form>
        <div id="panel-body">
            <input type="hidden" value="{{$pro_id}}" name="pro_id" class="pro_id">
            <form>
                @csrf
                <div id="gallery_load">

                </div>
            </form>
        </div>

    </div>

</div>
@endsection