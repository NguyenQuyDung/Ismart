<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPageController extends Controller
{
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'page']);
            return $next($request);
        });
    }
    //
    function list(Request $request)
    {
        $status = $request->input('status');
        $list_act = [
            'delete' => 'Xóa Tạm Thời',
            'Pending' => 'Công Khai',
            'public' => 'Chờ Duyệt'
        ];
        if ($status == 'active') {
            $list_act = [
                'delete' => 'Xóa Tạm Thời',
                'Pending' => 'Công Khai',
                'public' => 'Chờ Duyệt'
            ];
            $pages = Page::where(['status' => 'Công Khai'])->paginate(5);
        } else if ($status == 'trash') {
            $list_act = [
                'restore' => 'Khôi Phục',
                'forceDelete' => 'Xóa Vĩnh Viễn',
            ];
            $pages = Page::onlyTrashed()->paginate(5);
        } else if ($status == 'Pending') {
            $list_act = [
                'public' => 'Chờ Xét Duyệt',
            ];
            $pages = Page::where(['status' => 'Công Khai'])->paginate(5);
        } else if ($status == 'public') {
            $list_act = [
                'Pending' => 'Công Khai',
            ];
            $pages = Page::where(['status' => 'Chờ Duyệt'])->paginate(5);
        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $pages = Page::where('name', 'LIKE', "%{$keyword}%")->paginate(5);
        }
        $count_active = Page::count();
        $count_public = Page::where(['status' => 'Chờ Duyệt'])->count();
        $count_Pending = Page::where(['status' => 'Công Khai'])->count();
        $count_trash = Page::onlyTrashed()->count();
        $count = [$count_active, $count_trash];
        return view('admin.page.list', compact('pages', 'list_act', 'count', 'count_public', 'count_Pending'));
    }
    function add()
    {
        return view('admin/page/add');
    }
    public function edit($id)
    {
        $page = Page::find($id);
        return view('admin.page.edit', compact('page'));
    }
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'content' => 'required',
                'status' => 'required',
            ],
            [
                'required' => ' :attribute Không Được Để Trống !',
                'min' => ' :attribute Có Độ Dài ít Nhẩt :min Ký Tự !',
                'max' => ' :attribute Có Độ Dài Tối Đa :min Ký Tự !',
            ],
            [
                'name' => 'Tên Trang',
                'content' => 'Nội Dung Trang',
                'status' => 'Trạng Thái',
            ]
        );
        $user_create = Auth::user()->name;
        Page::where('id', $id)->update(
            [
                'name' => $request->input('name'),
                'content' => $request->input('content'),
                'status' => $request->input('status'),
                'user_id' => Auth::id(),
                'user_create' => $user_create,

            ]
        );
        return redirect('admin/page/list')->with('status', 'Cập Nhật Dữ Liệu Thành Công !');
    }
    function delete($id)
    {
        if (Auth::id() != $id) {
            $user = Page::find($id);
            $user->delete();
            return redirect('admin/page/list')->with('status', 'Bạn Đã Xóa Bản Ghi Thành Công !');
        } else {
            return redirect('admin/page/list')->with('status', 'Bạn Không Thể Tự Xóa Mình Ra Khỏi Hệ Thống !');
        }
    }
    function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'content' => 'required',
                'status' => 'required',
            ],
            [
                'required' => ' :attribute Không Được Để Trống !',
                'min' => ' :attribute Có Độ Dài ít Nhẩt :min Ký Tự !',
                'max' => ' :attribute Có Độ Dài Tối Đa :min Ký Tự !',
            ],
            [
                'name' => 'Tên Trang',
                'content' => 'Nội Dung Trang',
                'status' => 'Trạng Thái',
            ]
        );
        $user_create = Auth::user()->name;
        Page::create(
            [
                'name' => $request->input('name'),
                'content' => $request->input('content'),
                'status' => $request->input('status'),
                'user_id' => Auth::id(),
                'user_create' => $user_create,

            ]
        );
        return redirect('admin/page/list')->with('status', 'Thêm Dữ Liệu Thành Công !');
    }
    function action(Request $request)
    {
        $list_check = $request->input('list_check');
        if ($list_check) {
            foreach ($list_check as $k => $id) {
                if (Auth::id() == $id) {
                    unset($list_check[$k]);
                }
            }
            if (!empty($list_check)) {
                $act = $request->input('act');
                if ($act == 'delete') {
                    Page::destroy($list_check);
                    return redirect('admin/page/list')->with('status', 'Bạn Đã Xóa Bản Ghi Thành Công !');
                }

                if ($act == 'restore') {
                    Page::withTrashed()->whereIn('id', $list_check)->restore();
                    return redirect('admin/page/list')->with('status', 'Bạn Đã Khôi Phục Bản Ghi Thành Công !');
                }

                if ($act == 'forceDelete') {
                    Page::withTrashed()
                        ->whereIn('id', $list_check)
                        ->forceDelete();
                    return redirect('admin/page/list')->with('status', 'Bạn Đã Xóa Vĩnh Viễn Bản Ghi Thành Công !');
                }
                if ($act == 'Pending') {
                    Page::whereIn('id', $list_check)->update(['status' => 'Công Khai']);
                    return redirect('admin/page/list')->with('status', 'Bạn Đã Chuyển Trạng Thái Thành Công !');
                }
                if ($act == 'public') {
                    Page::whereIn('id', $list_check)->update(['status' => 'Chờ Duyệt']);
                    return redirect('admin/page/list')->with('status', 'Bạn Đã Chuyển Trạng Thái Thành Công !');
                }
            }
            return redirect('admin/page/list')->with('status', 'Bạn Cần Chọn Phần Tử Cần Thực Thi !');
        }
    }
}
