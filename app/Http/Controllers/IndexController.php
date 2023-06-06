<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product_cat;
use Illuminate\Support\Facades\DB;

use App\Product;
use App\Slider;

class IndexController extends Controller
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
    public function index(Request $request)
    {
        $sliders = Slider::all();
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
        return view('Users.index', compact('sliders', 'category', 'list_products_by', 'parent_product_cats', 'featured_products'));
    }
    public function search_product(Request $request)
    {
        $featured_products = Product::where(['status' => 'Sản Phẩm Nổi Bật'])->get();

        $category = Product_cat::all();
        $title_product = Product_cat::where(['parent_id' => 0])->get();
        //    $product_id = Product_cat::where(['parent_id',"=",$category->id ]);
        // dd($title_product);
        // $product_id = Product::whereIn();
        $list_product = Product::all();
        $list_product = json_decode(json_encode($list_product), True);

        foreach ($list_product as &$product) {
            $parent_id = DB::table('product_cats')->select('parent_id')->where('id', $product['cat_id'])->get();
            $parent_id = json_decode(json_encode($parent_id), True);
            foreach ($parent_id as $v) {
                $temp = $v['parent_id'];
            }
            $product['cat_id_product'] = $temp;
        }
        $keyword = "";
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }elseif($request->input('keyword') == ""){
                return redirect('loc-san-pham');
        }
        $search_products = $request->input('keyword');
        $search_title = Product_cat::where('name', 'LIKE', "%{$keyword}%")->get();
        $search_product = Product::where('name', 'LIKE', "%{$keyword}%")->paginate(5);
       
        // return $search_product;
        return view('Users.search', compact('search_products', 'category', 'featured_products', 'title_product', 'list_product', 'search_product'))->with('search_product', $search_product)
            ->with('search_title', $search_title);
    }
}
