<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsTypeController extends Controller
{
    //品牌列表
    public function list(){
        return view('admin.brand.list');
    }


    public function add(){

    }
}
