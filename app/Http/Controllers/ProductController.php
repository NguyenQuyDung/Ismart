<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Customer;
use App\District;
use App\Gallery;
use App\Media;
use Illuminate\Support\Facades\DB;
use App\Product;
use App\Order;
use App\Product_cat;
use App\Province;
use App\Rating;
use App\Ward;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Mail;
use phpDocumentor\Reflection\PseudoTypes\True_;

use function GuzzleHttp\json_encode;

class ProductController extends Controller
{
    //
    public function show_data($data)
    {
        echo "<prev>";
        print_r($data);
        echo "</prev>";
    }
    public function searchChildren($data, $id, &$child)
    {
        foreach ($data as $item) {
            if ($item['parent_id'] == $id) {
                $child[] = $item['id'];
                $this->searchChildren($data, $item['id'], $child);
            }
        }
    }
    public function category_product(Request $request)
    {
        $title_product = Product_cat::where(['parent_id' => 0])->get();
        //---
        $parent_product_cats = Product_cat::where('parent_id', 0)->get();
        foreach ($parent_product_cats  as $product_cat) {
            $child[] = $product_cat->id;
            $all_product_cats = Product_cat::all();
            $this->searchChildren($all_product_cats, $product_cat->id, $child);
            $list_products_by[$product_cat->id] = Product::whereIn('cat_id', $child)->limit(8)->get();
            unset($child);
        }
        //---
        $featured_products = Product::where(['status' => 'Sản Phẩm Nổi Bật'])->get();
        $category = Product_Cat::all();
        return view('Users.category_product', compact('parent_product_cats', 'featured_products', 'category', 'list_products_by', 'title_product'));
    }
    // lấy sản phẩm theo danh mục cha và danh mục con
    public function product_list(Request $request, $slug)
    {
        $featured_products = Product::where(['status' => 'Sản Phẩm Nổi Bật'])->get();
        $products = Product::all();
        $count_total_list_product = Product::count();
        $medias = Media::all();
        // láy sản phẩm thuộc danh mục con
        $product_cat = Product_cat::where('slug', $slug)->first();
        $this_cat_id = $product_cat->id;
        $data = Product_cat::all();
        $child[] = $this_cat_id;
        $this_cat_name = $product_cat->name;
        $this->searchChildren($data, $this_cat_id, $child);
        $list_product = Product::whereIn('cat_id', $child)->get();
        $category = Product_Cat::all();
        $featured_products = Product::where(['status' => 'Sản Phẩm Nổi Bật'])->get();
        $medias = Media::where('status', 'Công khai')->limit(5)->get();
        return view('Users.product_list', compact('count_total_list_product', 'list_product', 'featured_products', 'this_cat_name', 'products', 'category', 'medias'));
    }
    public function cart()
    {
        return view('Users.cart');
    }
    public function buy_now($id)
    {
        return view('Users.checkout');
    }
    // Thanh Toán GIỎ HÀNG
    public  function payment(Request $request)
    {
        //  $products = Product::find($id);
        // Lấy Thông tin tỉnh thành Phố
        $wards = Ward::all();
        $district = District::all();
        $provinces = Province::all();
        return view('Users.checkout', compact('provinces', 'district', 'wards'));
    }
    public function get_province(Request $request)
    {
        $id = $request->id;
        $province = $request->province;
        $get_province = Province::where('province_id', $id)->get();
        echo $get_province;
        // if($get_province->isEmpty()){
        //     echo "<option value='' >Chọn quận / Huyện</option>";
        //     // return;
        // }
        // $optionHtml =  "<option value='' >Chọn quận / Huyện</option>";
        // if(!empty($get_province)){
        //     foreach($get_province as $item){
        //         $optionHtml .= "<option data-id='{$item->id}' value='{$item->_name}'>{$item->_name}</option>";
        //     }
        // }
        // echo $optionHtml;
    }
    public function filter_price(Request $request)
    {
        // $categorys = Post::where('cat_id', $id)->get();
        $category = Product_Cat::all();
        if (isset($_GET['a-price'])) {
            $products = Product::where('price', '<=', 19000000)->get();
        } elseif (isset($_GET['b-price'])) {
            $products = Product::where('price', '>=', 5000000)->where('price', '<=', 11000000)->get();
            //  dd($products);
        } elseif (isset($_GET['c-price'])) {
            $products = Product::where('price', '>=', 11000000)
                ->where('price', '<=', 12000000)->get();
        } elseif (isset($_GET['d-price'])) {
            $products = Product::where('price', '>=', 10000000)
                ->where('price', '<=', 60000000)->get();
        } elseif (isset($_GET['e-price'])) {
            $products = Product::where('price', '>', 60000000)->get();
        } else {
            $products = "";
        }
        $count_product = Product::count();
        $featured_products = Product::where(['status' => 'Sản Phẩm Nổi Bật'])->get();
        return view('Users.filter_price', compact('products', 'featured_products', 'category', 'count_product'));
    }
    public function insert_info_client(Request $request)
    {
        $all = $request->all();
        //  dd($all);
        $request->validate(
            [
                'fullname' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'payment-method' => 'required',
                'province' => 'required',
                'district' => 'required',
                'ward' => 'required',
            ],
            [
                'required' => ' :attribute  Không Được Để Trống !',
            ],
            [
                'fullname' => 'Họ và Tên',
                'email' => 'Email',
                'phone' => 'Số Điện Thoại',
                'payment-method' => 'Phương Thức Thanh Toán',
                'province' => 'Tỉnh Thành Phố',
                'district' => 'Quận',
                'ward' => 'Phường',
            ]
        );
        $cart = Cart::content();
        // $qty = $cart::qty();
        // dd($qty);
        // $name = Cart::name();
        $subtotal = 0;
        foreach (Cart::content() as $item) {
            $subtotal += $item->subtotal;
        }
        $time = time();
        $subtotal = Cart::total();
        // dd($subtotal);
        $code_order = "ISM-" . Str::random(8);
        $id_customerinsert = Customer::create(
            [
                'fullname' => $request->input('fullname'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'province' => $all['province'],
                'district' => $all['district'],
                'ward' => $all['ward'],
                'phone' => $request->input('phone'),
                'note' => $request->input('note'),
                'sub_total' => $subtotal,
                'status' => 'Đang Xử Lý',
                'payment_method' => $request->input('payment-method'),
                'MaKH' => $code_order,
            ]
        )->id;
        $code_order = "ISM-" . Str::random(8);
        $Order_product = Cart::content();
        $total = Cart::total();
        $dataOrderDetail = array();
        foreach ($Order_product as $key => $value) {
            $dataOrderDetail['masp'] = $code_order;
            $dataOrderDetail['thumbnail'] = $value->options->images_product;
            $dataOrderDetail['name'] = $value->name;
            $dataOrderDetail['price'] = $value->price;
            $dataOrderDetail['qty'] = $value->qty;
            $dataOrderDetail['sub_total'] = $subtotal;
            $dataOrderDetail['payment'] = $request->input('payment-method');
            $dataOrderDetail['status'] = "Đang Xử Lý";
            $dataOrderDetail['customer_id'] = $id_customerinsert;
            $dataOrderDetail['MaKH'] = $code_order;
            Order::create($dataOrderDetail);
        }
        // Thông tin gửi Mail
        $cart = Cart::content();
        $data = [
            'fullname' => $request->input('fullname'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'province' => $all['province'],
            'district' => $all['district'],
            'ward' => $all['ward'],
            'email' => $request->input('email'),
            'order' => $cart,
        ];
        $data['order'] = $cart;
        $data['total'] = Cart::total();
        $data['fullname'] = $request->input('fullname');
        $data['address'] = $request->input('address');
        $data['province'] = $all['province'];
        $data['district'] = $all['district'];
        $data['ward'] = $all['ward'];
        $data['email'] = $request->input('email');
        $emailCustomer = $request->input('email');
        $nameCustomer = $request->input('fullname');
        //Send Mail
        Mail::send('Users.mails.orderConfirmation', $data, function ($message) use ($emailCustomer, $nameCustomer) {
            $message->from('dn5678853@gmail.com', 'ISMART STORE');
            $message->to($emailCustomer, $nameCustomer);
            $message->subject('[ISMART STORE] Xác Nhận Đơn Hàng Ở Cửa Hàng ISMART');
        });

        Cart::destroy();
       // $info = $request->session()->put('data', $data);
        return view('Users.thank_your', compact('data'));
    }
    public function detail_product($nameCat, $nameProduct)
    {
        $products = Product::all();
        $featured_products = Product::where(['status' => 'Sản Phẩm Nổi Bật'])->get();
        $category = Product_cat::all();
        $product_cat = Product_cat::where('slug', $nameCat)->first();
        $nameCat = $product_cat->slug;
        $list_product = Product::all();
        $list_product = json_decode(json_encode($list_product), True);
        $detail_product = Product::where('name', $nameProduct)->first();
        $id_productsss = $detail_product->id;
        $medias = Media::all();
        // dd($id_productsss);
        // foreach ($detail_product as $key => $value) {
        //     $id_product = $value->id;
        // }
        // lấy hình ảnh gallery dựa trên product_id với id bên product
        $list_product_detail_images = Gallery::where('product_id', $id_productsss)->get();

        $rating = Rating::where('product_id', $id_productsss)->avg('rating');
        // làm tròn số sao trung bình
        $rating = round($rating);
        $count_1 = Rating::where('rating', 1)->where('product_id', $id_productsss)->count();
        $count_2 = Rating::where('rating', 2)->where('product_id', $id_productsss)->count();
        $count_3 = Rating::where('rating', 3)->where('product_id', $id_productsss)->count();
        $count_4 = Rating::where('rating', 4)->where('product_id', $id_productsss)->count();
        $count_5 = Rating::where('rating', 5)->where('product_id', $id_productsss)->count();
        $count_comment = Comment::where('comment_product_id', $id_productsss)->where('comment_status', 0)->where('comment_parent_comment', 0)->count();
        // dd($list_product_detail_images);
        //-----------//
        //dd($detail_product);
        return view('Users.detail_product', compact('count_comment', 'count_1', 'count_2', 'count_3', 'count_4', 'count_5', 'rating', 'medias', 'featured_products', 'category', 'list_product', 'detail_product', 'nameCat', 'list_product_detail_images'));
    }


    public function add_cart(Request $request, $id)
    {
        $products = Product::find($id);
        return redirect('cart-show');
    }
    public function show_cart(Request $request, $id)
    {
        $product = Product::find($id);
        if (empty($product)) {
            return view('errors.404');
        }
        return view('Users.cart', compact('product'));
    }
    // lọc giá sản phẩm
    public function update_price(Request $request)
    {
        $products = Product::all();
        return view('Users.product_list', compact('products'));
    }
    public function login()
    {
        return view('Users.Import_Information.Login');
    }

    public function filter_product(Request $request)
    {
        $featured_products = Product::where(['status' => 'Sản Phẩm Nổi Bật'])->get();
        $products = Product::all();
        // đếm số sản phẩm có trong website
        $count_total_list_product = Product::count();
        // láy sản phẩm thuộc danh mục con
        $data = Product_cat::all();
        $category = Product_Cat::all();
        $featured_products = Product::where(['status' => 'Sản Phẩm Nổi Bật'])->get();
        $fillter = request()->select;
        if ($fillter == 1) {
            $list_products = Product::where('status', 'Còn Hàng')
                ->orderBy('name', 'desc')->get();
            $count_product = count($list_products);
        } elseif ($fillter == 2) {
            $list_products = Product::where('status', 'Còn Hàng')->orderBy('name', 'asc')->get();
            $count_product = count($list_products);
        } elseif ($fillter == 3) {
            $list_products = Product::where('status', 'Còn Hàng')->orderBy('price', 'desc')->get();
            $count_product = count($list_products);
        } elseif ($fillter == 4) {
            $list_products = Product::where('status', 'Còn Hàng')->orderBy('price', 'asc')->get();
            $count_product = count($list_products);
        } else {
           return redirect('loc-san-pham');
        }
        return view('Users.filter_product', compact(
            'featured_products',
            'products',
            'category',
            'list_products',
            'count_product',
            'count_total_list_product'
        ));
    }
    // thêm đánh giá sản phẩm
    public function sent_comment(Request $request)
    {
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment->comment = $comment_content;
        $comment->comment_name = $comment_name;
        $comment->comment_product_id = $product_id;
        $comment->comment_parent_comment = 0;
        $comment->comment_status = 1;
     
    }
    // hiên thị coment sản phẩm
    public function comment(Request $request)
    {
        $product_id = $request->product_id;
        $rating = Rating::where('product_id', $product_id)->get();
        $comments = Comment::where('comment_product_id', $product_id)->where('comment_parent_comment', '=', 0)->where('comment_status', 0)->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment', '>', 0)->get();
        $output = '';
        foreach ($comments as $key => $comment) {
            $output .= '<div style="display:flex; margin:0px;" class="product-rating-overview">
                    <a href="">
                        <img style="width:50px;" src="' . url('public/images_comment_product/no_user.png') . '" alt="">
                    </a>
                    <div style="padding-left:15px;">
                        <p><b>' . $comment->comment_name . '</b> <span style="font-size:12px;">' . $comment->created_at . '</span>
                         </p>
                        <p style="font-size: 14px;
                        color: green;
                        font-family: serif;
                        font-weight: bold;"><i class="fa-solid fa-check-double" style="color: lawngreen;
                        font-weight: bold;"></i> Đã mua sản phẩm tại Ismart</p>
                        <p style="font-family: inherit;"><i class="fa-solid fa-comment-dots" style="padding-right:5px;"></i>' . $comment->comment . '</p>
                    </div>
                  </div>';
            foreach ($comment_rep as $key => $rep_comment) {
                if ($rep_comment->comment_parent_comment == $comment->id) {
                    $output .= '<div class="product-rating-overview" style="margin:0px;  padding:0px !important;">
                   <div style="margin-left:100px; display:flex; padding:0px !important;">
                   <a href="">
                   <img src="' . url('public/images_comment_product/0.png') . '" alt="">
                   </a>
                   <p style="font-size: 14px; color: green;font-family: serif;font-weight: bold;"><i class="fa-solid fa-check-double" style="color: lawngreen;font-weight: bold;"></i>Admin ISMART : </p>
                   <span style="disply:block;padding-left:3px;"></span><p style="margin-bottom:0px;"> ' . $rep_comment->comment . '</p>
            </div>
            </div>';
                }
            }
        }
        echo $output;
    }
    // đánh giá số sao sản phẩm
    public function rating_insert(Request $request)
    {
        $data = $request->all();
        $rating = new Rating();
        $rating->product_id = $data['product_id'];
        $rating->rating = $data['index'];
        $rating->save();
        echo "done";
    }
}
