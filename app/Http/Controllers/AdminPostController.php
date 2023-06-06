<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostCat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPostController extends Controller
{
    //

    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'post']);
            return $next($request);
        });
    }
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
            $posts = Post::where(['status' => 'Công Khai'])->paginate(5);
        } else if ($status == 'trash') {
            $list_act = [
                'restore' => 'Khôi Phục',
                'forceDelete' => 'Xóa Vĩnh Viễn',
            ];
            $posts = Post::onlyTrashed()->paginate(5);
        } else if ($status == 'Pending') {
            $list_act = [
                'public' => 'Chờ Xét Duyệt',
            ];
            $posts = Post::where(['status' => 'Công Khai'])->paginate(5);
        } else if ($status == 'public') {
            $list_act = [
                'Pending' => 'Công Khai',
            ];
            $posts = Post::where(['status' => 'Chờ Duyệt'])->paginate(5);
        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $posts = Post::where('name', 'LIKE', "%{$keyword}%")->paginate(4);
        }
        $count_active = Post::count();
        $count_public = Post::where(['status' => 'Chờ Duyệt'])->count();
        $count_Pending = Post::where(['status' => 'Công Khai'])->count();
        $count_trash = Post::onlyTrashed()->count();
        $count = [$count_active, $count_trash];
        return view('admin.post.list', compact('posts', 'list_act', 'count', 'count_public', 'count_Pending'));
    }
    function add()
    {
        $category = PostCat::all();
        return view('admin.post.add', compact('category'));
    }
    function category()
    {
        $category = PostCat::paginate(10);
        $categorys = PostCat::count();
        return view('admin.post.category', compact('category', 'categorys'));
    }
    function delete($id)
    {
        if (Auth::id() != $id) {
            $user = Post::find($id);
            $user->delete();
            return redirect('admin/post/list')->with('status', 'Bạn Đã Xóa Bản Ghi Thành Công !');
        } else {
            return redirect('admin/post/list')->with('status', 'Bạn Không Thể Tự Xóa Mình Ra Khỏi Hệ Thống !');
        }
    }
    public function edit(Request $request, $id)
    {
        $category = PostCat::all();
        $post = Post::find($id);
        return view('admin.post.edit', compact('post', 'category'));
    }
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required',
                'content' => 'required',
                'detail' => 'required',
                'images' => 'required',
            ],
            [
                'required' => ' :attribute Không Được Để Trống !',
            ],
            [
                'name' => 'Tên Bài Viết',
                'content' => 'Nội Dung Bài Viết',
                'detail' => 'Chi Tiết Bài Viết',
                'images' => 'Hình Ảnh Bài Viết',
            ]
        );
        if ($request->hasFile('images')) {
            $images = $request->images;
            $name = $images->getClientOriginalName();
            $images_post = $images->move('public/uploads' , $name);
        }
        $user_create = Auth::user()->name;
        Post::where('id', $id)->update(
            [
                'name' => $request->input('name'),
                'content' => $request->input('content'),
                'detail' => $request->input('detail'),
                'images' => $images_post,
                'status' => $request->input('status'),
                'user_create' => $user_create,
                'user_id' => Auth::id(),
                'cat_id' => $request->input('cat_id'),
                'slug' => $request->input('slug'),
            ]
        );
        return redirect('admin/post/list')->with('status', 'Cập Nhật Dữ Liệu Thành Công !');
    }
    public function edit_cat($id)
    {
        $category = PostCat::all();
        $post_cats = PostCat::find($id);
        return view('admin.post.edit_cat', compact('post_cats', 'category'));
    }
    public function update_cat(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required',
                'slug' => 'required',
            ],
            [
                'required' => ' :attribute Không Được Để Trống !',
            ],
            [
                'name' => 'Tên Danh Mục',
                'slug' => 'Đường Dẫn Danh Mục'
            ],
        );
        $user_create = Auth::user()->name;
        PostCat::where('id', $id)->update(
            [
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'user_create' => $user_create,
                'user_id' => Auth::id(),
            ]
        );
        return redirect('admin/post/category')->with('status', 'Bạn Cập Nhật Danh Mục Thành Công !');
    }
    function delete_cat($id)
    {
        if (Auth::id() != $id) {
            $user = PostCat::find($id);
            $user->delete();
            return redirect('admin/post/category')->with('status', 'Bạn Đã Xóa Bản Ghi Thành Công !');
        } else {
            return redirect('admin/post/category')->with('status', 'Bạn Không Thể Tự Xóa Mình Ra Khỏi Hệ Thống !');
        }
    }
    function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'slug' => 'required',
            ],
            [
                'required' => ' :attribute Không Được Để Trống !',
            ],
            [
                'name' => 'Tên Danh Mục',
                'slug' => 'Đường Dẫn Danh Mục'
            ],
        );
        $user_create = Auth::user()->name;
        PostCat::create(
            [
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'user_create' => $user_create,
                'parent_id' => $request->input('parent_id'),
                'user_id' => Auth::id(),
            ]
        );
        return redirect('admin/post/category')->with('status', 'Bạn Đã Thêm Danh Mục Thành Công !');
    }
    function add_post(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'content' => 'required',
                'detail' => 'required',
                'images' => 'required',
            ],
            [
                'required' => ' :attribute Không Được Để Trống !',
            ],
            [
                'name' => 'Tên Bài Viết',
                'content' => 'Nội Dung Bài Viết',
                'detail' => 'Chi Tiết Bài Viết',
                'images' => 'Hình Ảnh Bài Viết',
            ]
        );
        if ($request->hasFile('images')) {
            $images = $request->images;
            $name = $images->getClientOriginalName();
            $images_post = $images->move('public/uploads' , $name);
        }
        $user_create = Auth::user()->name;
        Post::create(
            [
                'name' => $request->input('name'),
                'content' => $request->input('content'),
                'detail' => $request->input('detail'),
                'images' => $images_post,
                'status' => $request->input('status'),
                'user_create' => $user_create,
                'user_id' => Auth::id(),
                'cat_id' => $request->input('cat_id'),
            ]
        );
        return redirect('admin/post/list')->with('status', 'Đã Thêm Dữ Liệu Thành Công !');
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
                    Post::destroy($list_check);
                    return redirect('admin/post/list')->with('status', 'Bạn Đã Xóa Bản Ghi Thành Công !');
                }

                if ($act == 'restore') {
                    Post::withTrashed()->whereIn('id', $list_check)->restore();
                    return redirect('admin/post/list')->with('status', 'Bạn Đã Khôi Phục Bản Ghi Thành Công !');
                }

                if ($act == 'forceDelete') {
                    Post::withTrashed()
                        ->whereIn('id', $list_check)
                        ->forceDelete();
                    return redirect('admin/post/list')->with('status', 'Bạn Đã Xóa Vĩnh Viễn Bản Ghi Thành Công !');
                }
                if ($act == 'Pending') {
                    Post::whereIn('id', $list_check)->update(['status' => 'Công Khai']);
                    return redirect('admin/post/list')->with('status', 'Bạn Đã Chuyển Trạng Thái Thành Công !');
                }
                if ($act == 'public') {
                    Post::whereIn('id', $list_check)->update(['status' => 'Chờ Duyệt']);
                    return redirect('admin/post/list')->with('status', 'Bạn Đã Chuyển Trạng Thái Thành Công !');
                }
            }
            return redirect('admin/post/list')->with('status', 'Bạn Cần Chọn Phần Tử Cần Thực Thi !');
        }
    }
}
