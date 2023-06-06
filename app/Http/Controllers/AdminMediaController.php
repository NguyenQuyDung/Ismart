<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMediaController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'media']);
            return $next($request);
        });
    }
    public function media(Request $request){
        $list_sliders = Media::paginate(4);
        $count = Media::where(['status' => 'Công khai'])->count();
        $counts = Media::where(['status' => 'Chờ duyệt'])->count();
        return view('admin.media.list_media', compact('list_sliders', 'count', 'counts'));
    }
    function add_media(Request $request)
    {
        $request->validate(
            [
                'name_slider' => 'required',
                'name_slug' => 'required',
                'file' => 'required',
                'status' => 'required',
            ],
            [
                'required' => ' :attribute Không Được Để Trống !',
                'min' => ' :attribute Có Độ Dài ít Nhẩt :min Ký Tự !',
                'max' => ' :attribute Có Độ Dài Tối Đa :min Ký Tự !',
            ],
            [

                'file' => 'Hình Ảnh Media',
                'status' => 'Trạng Thái',
                'name_slider' => 'Tên Media',
                'name_slug' => 'Đường dẫn Media'
            ]
        );
        $user_create = Auth::user()->name;
        if ($request->hasFile('file')) {
            $file = $request->file;
            $name = $file->getClientOriginalName();
            $images_slider = $file->move('public/uploads', $name);
        }
        Media::create(
            [
                'status' => $request->input('status'),
                'images_media' => $images_slider,
                'name_media' => $request->input('name_slider'),
                'name_slug' => $request->input('name_slug'),
                'user_id' => Auth::id(),
                'user_create' => $user_create
            ]
        );
        return redirect('media')->with('status', 'Bạn Đã Thêm Media Thành Công !');
    }
    function delete($id)
    {
        $delete = Media::find($id);
        $delete->delete();
        return redirect('media')->with('status', 'Bạn Đã Xóa Slider Thành Công !');
    }
    public function list_media(Request $request){
        $list_sliders = Media::paginate(4);
        $count = Media::where(['status' => 'Công khai'])->count();
        $counts = Media::where(['status' => 'Chờ duyệt'])->count();
        return view('admin.media.list_media', compact('list_sliders', 'count', 'counts'));
    }
}
