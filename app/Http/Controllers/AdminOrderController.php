<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Order;
use App\Order_detail;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    //

    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'order']);
            return $next($request);
        });
    }
    function list_order(Request $request)
    {
        $status = $request->input('status');
        $list_act = [
            'Processing' => 'Đang Xử Lý',
            'Complete' => 'Hoàn Tất',
            'forceDelete' => 'Xóa Vĩnh Viễn',
            'Garbage_can' => 'Hủy Đơn Hàng',
            'being_transported' => 'Đang Vận Chuyển',
        ];
        $clients = Customer::where(['status' => 'Đang Xử Lý'])->orderBy('id', 'DESC')->paginate(10);
        if ($status == 'Processing') {
            $list_act = [
                'Complete' => 'Hoàn Tất',
                'being_transported' => 'Đang Vận Chuyển',
                'forceDelete' => 'Xóa Vĩnh Viễn',
            ];
            $clients = Customer::where('id','>',0)->orderBy('id', 'DESC')->paginate(10);
        } elseif ($status == 'being_transported') {
            $list_act = [
                'Complete' => 'Hoàn Tất',
                'Processing' => 'Đang Xử Lý',
            ];
            $clients = Customer::where(['status' => 'Đang Vận Chuyển'])->orderBy('id', 'DESC')->paginate(10);
        } elseif ($status == 'Complete') {
            $list_act = [
                'forceDelete' => 'Xóa Vĩnh Viễn',
            ];
            $clients = Customer::where(['status' => 'Hoàn Tất'])->orderBy('id', 'DESC')->paginate(10);
        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $clients = Customer::where('fullname', 'LIKE', "%{$keyword}%")->orderBy('id', 'DESC')->paginate(10);
        }
        $order_product = Order::where('id', '!=', 0)->orderBy('name', 'DESC')->get();
        $count_completee = Customer::where(['status' => 'Đang Vận Chuyển'])->count();
        $count_complete = Customer::where(['status' => 'Hoàn Tất'])->count();
        $count_completes = Customer::where(['status' => 'Đang Vận Chuyển'])->count();
        $count_completess = Customer::where(['status' => 'Đang Xử Lý'])->count();

        return view('admin.order.list_order', compact('count_complete', 'count_completee', 'count_completes', 'count_completess', 'list_act', 'order_product', 'clients'));
    }
    # Tác vụ hiển thị thông tin khách hàng
    function action(Request $request)
    {
        $list_check = $request->input('list_check');
        if ($list_check) {
            if (!empty($list_check)) {
                $act = $request->input('act');
                if ($act == 'restore') {
                    Customer::withTrashed()->whereIn('id', $list_check)->restore();
                    return redirect('admin/order/list_order')->with('status', 'Bạn Đã Khôi Phục Bản Ghi Thành Công !');
                }

                if ($act == 'forceDelete') {
                    Customer::destroy($list_check);
                    return redirect('admin/order/list_order')->with('status', 'Bạn Đã Xóa Vĩnh Viễn Bản Ghi Thành Công !');
                }

                if ($act == 'Complete') {
                    Customer::whereIn('id', $list_check)->update(['status' => 'Hoàn Tất']);
                    return redirect('admin/order/list_order')->with('status', 'Bạn Đã Chuyển Trạng Thái Thành Công !');
                }
                if ($act == 'Garbage_can') {
                    Customer::whereIn('id', $list_check)->update(['status' => 'Hủy Đơn Hàng']);
                    return redirect('admin/order/list_order')->with('status', 'Bạn Đã Chuyển Trạng Thái Thành Công !');
                }
                if ($act == 'Processing') {
                    Customer::whereIn('id', $list_check)->update(['status' => 'Đang Xử Lý']);
                    return redirect('admin/order/list_order')->with('status', 'Bạn Đã Chuyển Trạng Thái Thành Công !');
                }
                if ($act == 'being_transported') {
                    Customer::whereIn('id', $list_check)->update(['status' => 'Đang Vận Chuyển']);
                    return redirect('admin/order/list_order')->with('status', 'Bạn Đã Chuyển Trạng Thái Thành Công !');
                }
            }
        }
    }
    # xóa thông tin khách hàng đã mua sản phẩm
    function delete($id)
    {
        $order = Customer::find($id);
        $order->delete();
        return redirect('admin/order/list_order')->with('status', 'Xóa Thông Tin Khách Hàng Thành Công !');
    }
    # Chi tiết đơn hàng
    function detail_order(Request $request, $id)
    {
        $act = $request->input('act');
        $list_act = [
            'Complete' => 'Hoàn Tất',
            'being_transported' => 'Đang Vận Chuyển',
            'Processing' => 'Đang Xử Lý',

            'Garbage_can' => 'Hủy Đơn Hàng',
        ];
        if ($act == 'Complete') {
            Customer::where('id', $id)->update(['status' => 'Hoàn Tất']);

            // return view('admin.order.detail_order')->with('status', 'Thay Đổi Trạng Thái Thành Công !');
        }
        if ($act == 'being_transported') {
            Customer::where('id', $id)->update(['status' => 'Đang Vận Chuyển']);
            //return redirect('dashboard')->with('status', 'Thay Đổi Trạng Thái Thành Công !');
        }
        if ($act == 'Processing') {
            Customer::where('id', $id)->update(['status' => 'Đang Xử Lý']);
            //return redirect('dashboard')->with('status', 'Thay Đổi Trạng Thái Thành Công !');
        }
        if ($act == 'Garbage_can') {
            Customer::where('id', $id)->update(['status' => 'Hủy Đơn Hàng']);
            //return redirect('dashboard')->with('status', 'Thay Đổi Trạng Thái Thành Công !');
        }
        $detail_order_clients = Customer::find($id);
        $orders = order::where('customer_id', '=', $detail_order_clients->id)->orderBy('id', 'DESC')->get();
        $qty = order::where('customer_id', '=', $detail_order_clients->id)->sum('qty');
        // return $sumorder;
        return view('admin.order.detail_order', compact('list_act', 'detail_order_clients', 'orders', 'qty'));
    }

    // cập nhật trạng thái đơn hàng trong chi tiết của đơn hàng
}
