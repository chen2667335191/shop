<?php

namespace App\Http\Controllers\Admin;

use App\Rbac\AdPosition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdPositionController extends Controller
{
    //
    public function list(){
        $assign['list'] = AdPosition::getInfo();
        return view('admin.position.list',$assign);
    }

    public function add(){
        return view('admin.position.add');
    }

    public function doadd(Request $request){
        $params = $request->all();
        unset($params['_token']);
        if(!isset($params['position_name'])|| empty($params['position_name'])){
            return redirect()->back()->with('msg','广告位名称不能为空');
        }
        $res = AdPosition::doadd($params);
        if(!$res){
            return redirect()->back()->with('msg','广告位添加失败');
        }
        return redirect('admin/Ad/Position/list');
    }

    public function edit($id){
        $assign['info'] = AdPosition::getInfoById($id);
        return view('admin/position/edit',$assign);
    }

    public function doedit(Request $request){
        $params = $request->all();
        if(!isset($params['position_name'])||empty($params['position_name'])){
            return redirect()->back()->with('msg','广告名称不能为空');
        }
        unset($params["_token"]);
        $res = AdPosition::doedit($params,$params['id']);
        if(!$res){
            return redirect()->back()->with('msg','广告修改失败');
        }
        return redirect('admin/Ad/Position/list');
    }

    public function del($id){
        AdPosition::del($id);
        return redirect('admin/Ad/Position/list');
    }

}
