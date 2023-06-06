<?php

namespace App\Http\Controllers;

use App\Page;
use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function introduce()
    {
        $featured_products = Product::where(['status' => 'Sản Phẩm Nổi Bật'])->get();
        $introduces = Page::all();
        return view('Users.introduce', compact('introduces', 'featured_products'));
    }
    public function contact()
    {
        $featured_products = Product::where(['status' => 'Sản Phẩm Nổi Bật'])->get();
        return view('Users.contact', compact('featured_products'));
    }
}
