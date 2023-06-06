<?php

namespace App\Http\Controllers;

use App\Product;
use App\Product_cat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProductController extends Controller
{

    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'product']);
            return $next($request);
        });
    }   //
    function list(Request $request)
    {
        $status = $request->input('status');
        $list_act = [
            'Pending' => 'Còn Hàng',
            'public' => 'Hết Hàng',
            'forceDelete' => 'Xóa Vĩnh Viễn',
            'delete' => 'Xóa Tạm Thời'

        ];
        if ($status == 'active') {
            $list_act = [
                'Pending' => 'Còn Hàng',
                'public' => 'Hết Hàng',
                'delete' => 'Xóa Tạm Thời'
            ];
            $products = Product::where(['status' => 'Công Khai'])->paginate(5);
        } else if ($status == 'trash') {
            $list_act = [
                'restore' => 'Khôi Phục',
                'forceDelete' => 'Xóa Vĩnh Viễn',
                'delete' => 'Xóa Tạm Thời'
            ];
            $products = Product::onlyTrashed()->paginate(5);
        } else if ($status == 'featured_products') {
            $list_act = [
                'forceDelete' => 'Xóa Vĩnh Viễn',
                'delete' => 'Xóa Tạm Thời'
            ];
            $products = Product::where(['status' => 'Sản Phẩm Nổi Bật'])->paginate(5);
        } else if ($status == 'Pending') {
            $list_act = [
                'public' => 'Hết Hàng',
                'forceDelete' => 'Xóa Vĩnh Viễn',
                'delete' => 'Xóa Tạm Thời'
            ];
            $products = Product::where(['status' => 'Còn Hàng'])->paginate(5);
        } else if ($status == 'public') {
            $list_act = [
                'Pending' => 'Còn Hàng',
                'forceDelete' => 'Xóa Vĩnh Viễn',
                'delete' => 'Xóa Tạm Thời'
            ];
            $products = Product::where(['status' => 'Hết Hàng'])->paginate(5);
        } else if ($status == 'delete') {
            $list_act = [
                'restore' => 'Khôi Phục',
                'forceDelete' => 'Xóa Vĩnh Viễn',
            ];
            $products = Product::onlyTrashed()->paginate(5);
        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $products = Product::where('name', 'LIKE', "%{$keyword}%")->paginate(8);
        }
        $count_active = Product::count();
        $count_public = Product::where(['status' => 'Hết Hàng'])->count();
        $count_Pending = Product::where(['status' => 'Còn Hàng'])->count();
        $featured_products = Product::where(['status' => 'Sản Phẩm Nổi Bật'])->count();
        $count_trash = Product::onlyTrashed()->count();
        $count = [$count_active, $count_trash];
        return view('admin.product.list', compact('products', 'list_act', 'count_trash','count', 'count_public', 'count_Pending', 'featured_products'));
    }
    function add()
    {
        $category = Product_cat::all();
        return view('admin.product.add', compact('category'));
    }
    public function edit_product($id)
    {
        $category = Product_Cat::all();
        $product = Product::find($id);
        return view('admin.product.edit', compact('product', 'category'));
    }
    function delete_product($id)
    {
        $user = Product::find($id);
        $user->delete();
        return redirect('admin/product/list')->with('status', 'Xóa Bản Ghi Thành Công !');
    }
    public function update_product($id, Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'price' => 'required',
                'price_old' => 'required',
                'intro' => 'required',
                'detail' => 'required',
                'images_product' => 'required',
            ],
            [
                'required' => ' :attribute Sản Phẩm Không Được Để Trống !',
            ],
            [
                'name' => 'Tên',
                'price' => 'Giá',
                'price_old' => 'Giá Cũ',
                'intro' => 'Mô Tả',
                'detail' => 'Chi Tiết',
                'images_product' => 'Hình Ảnh',
            ]
        );
        if ($request->hasFile('images_product')) {
            $images_product = $request->images_product;
            $name = $images_product->getClientOriginalName();
            $images_product = $images_product->move('public/uploads', $name);
        }
        $user_create = Auth::user()->name;
        Product::where('id', $id)->update(
            [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'price_old' => $request->input('price_old'),
                'intro' => $request->input('intro'),
                'detail' => $request->input('detail'),
                'images_product' => $images_product,
                'user_create' => $user_create,
                'user_id' => Auth::id(),
                'cat_id' => $request->input('cat_id'),
                'status' => $request->input('status')
            ]
        );
        return redirect('admin/product/list')->with('status', ' Cập Nhật Dữ Liệu Thành Công !');
    }
    function add_product(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'price' => 'required',
                'price_old' => 'required',
                'intro' => 'required',
                'detail' => 'required',
                'images_product' => 'required',
                'gallery' => 'required'
            ],
            [
                'required' => ' :attribute Sản Phẩm Không Được Để Trống !',
            ],
            [
                'name' => 'Tên',
                'price' => 'Giá',
                'price_old' => 'Giá Cũ',
                'intro' => 'Mô Tả',
                'detail' => 'Chi Tiết',
                'images_product' => 'Hình Ảnh',
                'gallery' => 'Thư Viện Ảnh gallery'
            ]
        );
        if ($request->hasFile('images_product')) {
            $images_product = $request->images_product;
            $name = $images_product->getClientOriginalName();
            $images_product = $images_product->move('public/uploads', $name);
        }
        if ($request->hasFile('gallery')) {
            $gallery = $request->gallery;
            $name = $gallery->getClientOriginalName();
            $gallery = $gallery->move('public/uploads', $name);
        }
        // for($gallery = 1; $gallery <=1; $gallery++){
        //     dd($gallery);
        // }
        $user_create = Auth::user()->name;
        //dd($request->all());
        Product::create(
            [
                'name' => $request->input('name'),
                'price' => $request->input('price'),
                'price_old' => $request->input('price_old'),
                'intro' => $request->input('intro'),
                'detail' => $request->input('detail'),
                'images_product' => $images_product,
                'user_create' => $user_create,
                'user_id' => Auth::id(),
                'cat_id' => $request->input('cat_id'),
                'status' => $request->input('status'),
            ]
        );
        return redirect('admin/product/list')->with('status', 'Bạn Đã thêm Dữ Liệu Thành Công !');
    }
    function add_cat(Request $request)
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
                'slug' => 'Đường Dẫn Danh Mục',
            ]
        );
        $user_create = Auth::user()->name;
        Product_cat::create(
            [
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'user_create' => $user_create,
                'parent_id' => $request->input('parent_id'),
                'user_id' => Auth::id(),
            ]
        );
        return redirect('admin/product/category')->with('status', 'Bạn Đã Thêm Danh Mục Thành Công !');
    }
    function category()
    {
        $category = Product_cat::paginate(10);
        $categorys = Product_Cat::count();
        return view('admin.product.category', compact('category', 'categorys'));
    }
    function delete_cat($id)
    {
        $user = Product_cat::find($id);
        $user->delete();
        return redirect('admin/product/category')->with('status', 'Bạn Đã Xóa Bản Ghi Thành Công !');
    }
    public function edit_cat($id)
    {
        $product_cats = Product_cat::find($id);
        return view('admin.product.edit_cat', compact('product_cats'));
    }
    public function update_cat($id, Request $request)
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
                'slug' => 'Đường Dẫn Danh Mục',
            ]
        );
        $user_create = Auth::user()->name;
        Product_cat::where('id', $id)->update(
            [
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
                'user_create' => $user_create,
                'user_id' => Auth::id(),
            ]
        );
        return redirect('admin/product/category')->with('status', 'Bạn Đã Cập Nhật Danh Mục Thành Công !');
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
                    Product::destroy($list_check);
                    return redirect('admin/product/list')->with('status', 'Bạn Đã Xóa Bản Ghi Thành Công !');
                }

                if ($act == 'restore') {
                    Product::withTrashed()->whereIn('id', $list_check)->restore();
                    return redirect('admin/product/list')->with('status', 'Bạn Đã Khôi Phục Bản Ghi Thành Công !');
                }

                if ($act == 'forceDelete') {
                    Product::withTrashed()
                        ->whereIn('id', $list_check)
                        ->forceDelete();
                    return redirect('admin/product/list')->with('status', 'Bạn Đã Xóa Vĩnh Viễn Bản Ghi Thành Công !');
                }
                if ($act == 'Pending') {
                    Product::whereIn('id', $list_check)->update(['status' => 'Còn Hàng']);
                    return redirect('admin/product/list')->with('status', 'Bạn Đã Chuyển Trạng Thái Thành Công !');
                }
                if ($act == 'public') {
                    Product::whereIn('id', $list_check)->update(['status' => 'Hết Hàng']);
                    return redirect('admin/product/list')->with('status', 'Bạn Đã Chuyển Trạng Thái Thành Công !');
                }
                if ($act == 'delete') {
                    Product::destroy($list_check);
                    return redirect('admin/product/list')->with('status', 'Bạn Đã Xóa Bản Ghi Thành Công !');
                }
                if ($act == 'featured_products') {
                    Product::whereIn('id', $list_check)->update(['status' => 'Sản Phẩm Nổi Bật']);
                    return redirect('admin/product/list')->with('status', 'Bạn Đã Chuyển Trạng Thái Thành Công !');
                }
            }
            return redirect('admin/product/list')->with('status', 'Bạn Cần Chọn Phần Tử Cần Thực Thi !');
        }
    }
    function ckfinder()
    {
        return view('admin/ckfinder');
    }
}
