<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;

class AdminUserController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'user']);
            return $next($request);
        });
    }
    function list(Request $request)
    {
        $status = $request->input('status');
        $list_act = [
            'delete' => 'Xóa Tạm Thời',
        ];
        if ($status == 'trash') {
            $list_act = [
                'restore' => 'Khôi Phục',
                'forceDelete' => 'Xóa Vĩnh Viễn',
            ];
            $list_user = User::onlyTrashed()->paginate(5);
        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $list_user = User::where('name', 'LIKE', "%{$keyword}%")->paginate(5);
        }
        $count_active = User::count();
        $count_trash = User::onlyTrashed()->count();
        $count = [$count_active, $count_trash];
        return view('admin.user.list', compact('count', 'list_user', 'list_act'));
    }
    function add(Request $request)
    {
        return view('admin.user.add');
    }
    function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|',
                'password' => 'required|string|min:8|',
                'password_confirm' => 'required'
            ],
            [
                'required' => ' :attribute Không Được Để Trống !',
                'min' => ' :attribute Có Độ Dài ít Nhẩt :min Ký Tự !',
                'max' => ' :attribute Có Độ Dài Tối Đa :min Ký Tự !',
            ],
            [
                'name' => 'Tên Người Dùng',
                'email' => 'Email',
                'password' => 'Mật Khẩu',
                'password_confirm' => 'Xác Nhận Mật Khẩu '
            ]
        );
        User::create(
            [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]
        );
        return redirect('admin/user/list')->with('status', 'Thêm Dữ Liệu Thành Công !');
    }
    function delete($id)
    {
        if (Auth::id() != $id) {
            $user = User::find($id);
            $user->delete();
            return redirect('admin/user/list')->with('status', 'Bạn Đã Xóa Bản Ghi Thành Công !');
        } else {
            return redirect('admin/user/list')->with('status', 'Bạn Không Thể Tự Xóa Mình Ra Khỏi Hệ Thống !');
        }
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
                    User::destroy($list_check);
                    return redirect('admin/user/list')->with('status', 'Bạn Đã Xóa Bản Ghi Thành Công !');
                }

                if ($act == 'restore') {
                    User::withTrashed()->whereIn('id', $list_check)->restore();
                    return redirect('admin/user/list')->with('status', 'Bạn Đã Khôi Phục Bản Ghi Thành Công !');
                }

                if ($act == 'forceDelete') {
                    User::withTrashed()
                        ->whereIn('id', $list_check)
                        ->forceDelete();
                    return redirect('admin/user/list')->with('status', 'Bạn Đã Xóa Vĩnh Viễn Bản Ghi Thành Công !');
                }
            }
            return redirect('admin/user/list')->with('status', 'Bạn Cần Chọn Phần Tử Cần Thực Thi !');
        }
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', compact('user'));
    }
    public  function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255',
                'password' => 'required|string|min:8|',
                'password_confirm' => 'required'
            ],
            [
                'required' => ' :attribute Không Được Để Trống !',
                'min' => ' :attribute Có Độ Dài ít Nhẩt :min Ký Tự !',
                'max' => ' :attribute Có Độ Dài Tối Đa :min Ký Tự !',
            ],
            [
                'name' => 'Tên Người Dùng',
                'password' => 'Mật Khẩu',
                'password_confirm' => 'Xác Nhận Mật Khẩu '
            ]
        );
        User::where('id', $id)->update(
            [
                'name' => $request->input('name'),
                'password' => Hash::make($request->input('password')),
            ]
        );
        return redirect('admin/user/list')->with('status', 'Cập Nhật Dữ Liệu Thành Công !');
    }
}
