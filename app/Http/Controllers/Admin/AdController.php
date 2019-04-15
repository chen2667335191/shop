<?php

namespace App\Http\Controllers\Admin;

use App\Rbac\Ad;
use App\Rbac\AdPosition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdController extends Controller
{
    //
    public function list(){
        $assign['ad'] = Ad::getInfo();
        return view('admin.ad.list',$assign);
    }

    public function add(){
        $assign['position'] = AdPosition::getInfo();
        return view('admin.ad.add');
    }

    public function doadd(Request $request){
        $params = $request->all();
        unset($params['_token']);
        if(!isset($params['ad_name'])||empty($params['ad_name'])){
            return redirect()->back()->with('msg','广告名字不能为空');
        }
        $files = $params['image_url'];

        Excel::load($files->path(),function ($reader){
            $data = $reader->all()->toArray();
            dd($data);
        });

        $params['image_url'] =

        $res = Ad::doadd($params);
        if(!$res){
            return redirect()->back()->with('msg','广告位添加失败');
        }
        return redirect('admin/ad/list');
    }

    public function del($id){
        Ad::del($id);
        return redirect('admin/ad/list');
    }


}
