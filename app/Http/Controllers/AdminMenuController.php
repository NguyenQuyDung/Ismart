<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    //]
    function __construct()
    {
        $this->middleware(function ($request, $next) {
            session(['module_active' => 'menu']);
            return $next($request);
        });
    }
    public function menu(){
        return view('admin.menu.menu_admin');
    }
}
