<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    public function ajaxSearch(Request $request){
        $keyword = "";
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $data = Product::where('name', 'LIKE', "%{$keyword}%")->get(); 
        return $data;
    }
}
