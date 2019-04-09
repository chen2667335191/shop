<?php

namespace App\Http\Controllers\Admin;

use App\Rbac\brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    //商品品牌列表页面
    public function list(){
        return view('admin.brand.list');
    }
    //获取列表的数据
    public function getListData(){
        $list = brand::getList();
        $return = [
            'code' =>2000,
            'msg' =>'获取数据成功',
            'data' => $list,
        ];

        return json_encode($return);
    }
    //商品品牌添加页面
    public function add(){
        return view('admin.brand.add');
    }
    //执行商品品牌添加
    public function doadd(Request $request){
        $params = $request->all();

        if (empty($params['brand_name'])||!isset($params['brand_name'])){
            return redirect()->back()->with('msg','商品品牌不能为空');
        }
        unset($params['_token']);

        $res = brand::create($params);
        if (!$res){
            return redirect()->back()->with('msg','商品品牌添加失败');
        }
        return redirect('/admin/brand/list');

    }
    //修改商品品牌
    public function edit($id){
        $assign['info'] = brand::getInfo($id);
        return view('admin.brand.edit',$assign);
    }
    //执行品牌修改
    public function doedit(Request $request){
        $param = $request->all();
        if (empty($param)||!isset($param)){
            return redirect()->back()->with('msg','商品品牌不能为空');
        }
        unset($param['_token']);
        $id = $param['id'];
        $res = brand::doEdit($param,$id);
        if (!$res){
            return redirect()->back()->with('msg','商品品牌修改失败');
        }
        return redirect('/admin/brand/list');

    }
    //删除商品品牌
    public function del($id){
        $res = brand::del($id);
        $return = [
          'code' => 2000,
            'msg' =>'成功'
        ];
        if(!$res){
            $return = [
              'code' => 4000,
                'msg' => '删除失败'
            ];
        }
        return json_encode($return);
    }
    //品牌属性修改
    public function changeAttr(Request $request){
        $params = $request->all();
        $return = [
            'code' => 200,
            'msg' => '属性修改成功'
        ];
        $data = [
          $params['key'] => $params['value']
        ];
        $res = brand::doEdit($data,$params['id']);
        if(!$res){
            $return = [
               'code' =>4002,
                'msg' => '属性修改失败'
            ] ;
        }
        return json_encode($return);



    }
}
