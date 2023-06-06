<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Product;
use Illuminate\Contracts\Session\Session;
use League\CommonMark\Block\Element\Document;
use Psy\Readline\Hoa\Console;
use Whoops\Run;

class CartController extends Controller
{
    //
    public function add_cart(Request $request, $nameCat, $nameProduct)
    {
        $products = Product::where('name', $nameProduct)->first();
        //dd($products);
        if ($request->num_order) {
            $qty = $request->input('num_order');
        } else {
            $qty = 1;
        }
        Cart::add(
            [
                'id' => $products->id,
                'name' => $products->name,
                'price' => $products->price,
                'qty' => $qty,
                'options' => [
                    'images_product' => $products->images_product
                ],
            ]
        );
        return redirect('gio-hang.html');
    }
    public function buy_now(Request $request, $nameCat, $nameProduct)
    {
        $products = Product::where('name', $nameProduct)->first();
        $p = Cart::add(
            [
                'id' => $products->id,
                'name' => $products->name,
                'price' => $products->price,
                'qty' => 1,
                'options' => [
                    'images_product' => $products->images_product
                ],
            ]
        );
        //dd($products);
        //return Cart::content();
        return redirect('thanh-toan.html');
    }
    # them sp ajax
    public function add_cart_ajax(Request $request)
    {
        $data = $request->all();
        Cart::add(
            [
                'id' => $data['cart_product_id'],
                'name' => $data['name'],
                'price' => $data['price'],
                'qty' => $data['qty'],
                'options' => [
                    'images_product' => $data['img']
                ],
            ]
        );
    }
    public function gio_hang(Request $request)
    {
        $meta_desc = "Giỏ Hàng Của Bạn";
        $meta_keywords = "Giỏ Hàng Ajax";
        $meta_title = "Giỏ Hàng Ajax";
        $url_cannoical = $request->url();
        return view('Users.cart_ajax.cart_ajax');
    }
    public  function show_cart()
    {
        return view('Users.cart');
    }

    public function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect('gio-hang.html');
    }

    public function detroy()
    {
        Cart::destroy();
        return  redirect('gio-hang.html');
    }
    #cập nhật toàn bộ giỏ hàng
    //do là form submit lên vì vậy ta dùng Requesst
    public function update(Request $request)
    {
        $data = $request->get('qty');
        // dd($data);
        // foreach ($data as $k => $v) {
        //     Cart::update($k, $v);
        // }
        return redirect('gio-hang.html');
    }

    # Cập nhật giá tiền trong giỏ hàng bằng ajax
    public function ajax_shopping_cart(Request $request)
    {
        $qty = $request->qty;
        $id = $request->id;
        //return $qty;
        Cart::update($id, $qty);
        // return response()->json(
        //     [
        //         'total_price' => number_format(Cart::total(), 0, '', '.') . "đ",
        //         'sub_total' => number_format(Cart::get($id)->total(), 0, '', '.') . "đ",
        //         'num' => Cart::count(),
        //         'qty' => Cart::get($id)->qty,
        //         'message' => 'success'
        //     ]
        // );
        foreach (Cart::content() as $row) {
            if ($row->rowId == $id) {
                $sub_total = $row->total;
            }
        }
        $sub_total = number_format($sub_total, 0, '', '.') . "đ";
        // $total_price = number_format(Cart::total(), 0, '', '.') . "đ";
        $result = array(
            'sub_total' => $sub_total,
            'total_price' => Cart::total(),
            'num' => Cart::count()
        );
        return json_encode($result);
    }
}
