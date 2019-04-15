<?php

namespace App\Http\Controllers\Admin;

use App\Rbac\ArticleCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleCategoryController extends Controller
{
    //
    public function list(){
        $assign['list'] = ArticleCategory::getArticleCategoryList();
        return view("admin.article.category.list",$assign);
    }
    public function add(){
        return view("admin.article.category.add");
    }

    public function doadd(Request $request){
        $params = $request->all();
        if(!isset($params['cate_name'])||empty($params['cate_name'])){
            return redirect()->back()->with('msg','分类名称不能为空');
        }
        unset($params['_token']);
        $res = ArticleCategory::doadd($params);

        if(!$res){
            return redirect()->back()->with('msg','文章分类添加失败');
        }

        return redirect('admin/ArticleCategory/list');
    }

    public function edit($id){
        $assign['info'] = ArticleCategory::edit($id);
        return view('admin.article.category.edit',$assign);
    }

    public function doedit(Request $request){
        $params = $request->all();
        if(!isset($params['cate_name'])||empty($params['cate_name'])){
            return redirect()->back()->with('msg','文章分类不能为空');
        }
        unset($params['_token']);
        $res = ArticleCategory::doedit($params,$params['id']);
        if(!$res){
            return redirect()->back()->with('msg','文章分类修改失败');
        }
        return redirect('admin/ArticleCategory/list');
    }

    public function del($id){
        $res = ArticleCategory::del($id);

        if(!$res){
            return redirect()->back()->with('msg','文章分类删除失败');
        }
        return redirect('admin/ArticleCategory/list');
    }
}
