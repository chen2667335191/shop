<?php

namespace App\Http\Controllers\Admin;

use App\Rbac\Category;
use app\Tools\ToolsAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    //商品分类列表
    public function list(){
        return view('admin.category.list');
    }
    public function getlistData($fid=0)
    {
        $return = [
            'code' => 2000,
            'msg' => '成功'
        ];
        $list = Category::getCategoryByFid($fid);

        $return['data'] = $list;

        return json_encode($return);
    }

    public function add(){
        $list = Category::getCategoryList();
        $assign['list'] = ToolsAdmin::buildTreeString($list,0,0,'f_id');
        return view('admin.category.add',$assign);
    }
    public function doadd(Request $request){
        $params = $request->all();
        if (!isset($params['cate_name'])||empty($params['cate_name'])){
            return redirect()->back()->with('msg','分类名称不能为空');
        }
        unset($params['_token']);
        $res = Category::doadd($params);
        if(!$res){
            return redirect()->back()->with('msg','分类添加失败');
        }
        return redirect('/admin/category/list');
    }

    public function edit($id)
    {
        $assign['info'] = Category::getCateInfo($id);
        //获取分类的树形结构
        $list = Category::getCategoryList();
        $assign['list'] = ToolsAdmin::buildTreeString($list,0,0,'f_id');
        return view('admin.category.edit',$assign);
    }

    public function doedit(Request $request){
        $params = $request->all();
        if(!isset($params['cate_name'])||empty($params['cate_name'])){
            return redirect()->back()->with('msg','分类名字不能为空');
        }
        unset($params['_token']);
        $res = Category::doedit($params,$params['id']);
        if(!$res){
            return redirect()->back()->with('msg','分类修改失败');
        }
        return redirect('/admin/category/list');
    }

    public function del($id){

         $return = [
             'code' => 2000,
             'msg' =>'删除成功'
         ];
         $res = Category::del($id);
         if(!$res){
             $return = [
               'code' => 4001,
                 'msg' => '删除失败'
             ];
         }
         return json_encode($return);

    }


}
