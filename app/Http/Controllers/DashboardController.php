<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\Order;
use App\Product;

class DashboardController extends Controller
{
    //
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'dashboard']);
            return $next($request);
        });
        $this->middleware('auth');

    }
    function show(Request $request)
    {  
        $count_complete = Customer::where(['status' => 'Hoàn Tất'])->count();
        $count_completes = Customer::where(['status' => 'Đang Vận Chuyển'])->count();
        $count_completess = Customer::where(['status' => 'Hủy Đơn Hàng'])->count();
        $count_completesss = Customer::where(['status' => 'Đang Xử Lý'])->count();
        $shows = Customer::where('id','>',0)->orderBy('id','DESC')->paginate(10);
        $revenue = Order::select('sub_total')->sum('sub_total');
        $client = Customer::all();
        // $total = 0;
        // foreach ($revenue as $value) {
        //     $total += (int)$value->total;
        // }
        // $data['revenue'] = $total;
        return view('admin.dashboard',compact('shows','client','count_complete','count_completes','count_completess','count_completesss','revenue'));
    }
    // đơn hàng thành công
     public function list_success_order(Request $request){
        $list_success_orders = Customer::where('status', 'Hoàn Tất')->orderBy('id','DESC')->paginate(10);
        return view('admin.list_order.success', compact('list_success_orders'));
     }
     public function list_processing_order(Request $request){
        $list_success_orders = Customer::where('status', 'Đang Xử Lý')->orderBy('id','DESC')->paginate(10);
        return view('admin.list_order.processing', compact('list_success_orders'));
     }
     public function list_being_transported_order(Request $request){
        $list_success_orders = Customer::where('status', 'Đang Vận Chuyển')->orderBy('id','DESC')->paginate(10);
        return view('admin.list_order.being_transported', compact('list_success_orders'));
     }
     public function list_cancel_order(Request $request){
        $list_success_orders = Customer::where('status', 'Hủy Đơn Hàng')->orderBy('id','DESC')->paginate(10);
        return view('admin.list_order.cancel', compact('list_success_orders'));
     }
}
