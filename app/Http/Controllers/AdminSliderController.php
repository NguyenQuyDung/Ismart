<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminSliderController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'slider']);
            return $next($request);
        });
    }
    function slider(Request $request)
    {
        $list_sliders = Slider::paginate(4);
        $count = Slider::where(['status' => 'Công khai'])->count();
        $counts = Slider::where(['status' => 'Chờ duyệt'])->count();
        return view('admin.slider.slider', compact('list_sliders', 'count', 'counts'));
    }
    function add(Request $request)
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

                'file' => 'Hình Ảnh Slider',
                'status' => 'Trạng Thái',
                'name_slider' => 'Tên slider',
                'name_slug' => 'Đường dẫn slider'
            ]
        );
        $user_create = Auth::user()->name;
        if ($request->hasFile('file')) {
            $file = $request->file;
            $name = $file->getClientOriginalName();
            $images_slider = $file->move('public/uploads', $name);
        }
        Slider::create(
            [
                'status' => $request->input('status'),
                'images_slider' => $images_slider,
                'name_slider' => $request->input('name_slider'),
                'name_slug' => $request->input('name_slug'),
                'user_id' => Auth::id(),
                'user_create' => $user_create
            ]
        );
        return redirect('slider')->with('status', 'Bạn Đã Thêm Slider Thành Công !');
    }
    function delete($id)
    {
        $delete = Slider::find($id);
        $delete->delete();
        return redirect('slider')->with('status', 'Bạn Đã Xóa Slider Thành Công !');
    }
    function slider_edit($id)
    {
        $edit = Slider::find($id);
        return view('admin.slider.edit', compact('edit'));
    }
}
