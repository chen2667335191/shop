<?php

namespace App\Http\Controllers\Admin;

use App\Rbac\Article;
use App\Rbac\ArticleCategory;
use App\Rbac\ArticleContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class ArticleController extends Controller
{
    protected $category = null;
    protected $article = null;
    protected $content = null;

    //文章页面
    public function list(){
        $assign['list'] = Article::getInfo();
        return view('admin.article.article.list',$assign);
    }

    //文章添加页面
    public function add(){
        $assign['category'] = ArticleCategory::getArticleCategoryList();
        return view('admin.article.article.add',$assign);
    }

    public function doadd(Request $request){
        $params = $request->all();
        unset($params['_token']);

        $content = $params['content'];
        unset($params['content']);

        try{
            DB::beginTransaction();//开始事物
            $id = Article::doadd($params);
            $data = [
              'a_id' =>$id,
                'content' => $content
            ];
            ArticleContent::doadd($data);
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            \log::info('文章添加失败'.$e->getMessage());
            return redirect()->back()->with('msg',$e->getMessage());
        }
        return redirect('/admin/Article/list');
    }

    public function edit($id){
        $assion['info'] = Article::getInfoId($id);
        $assion['category'] = ArticleCategory::getArticleCategoryList();
        $assion['content'] = ArticleContent::getInfoId($id);
        return view('admin.article.article.edit',$assion);
    }

    public function doedit(Request $request){
        $params = $request->all();
        unset($params['_token']);

        $content = $params['content'];
        unset($params['content']);

        try{
            DB::beginTransaction();//开始事物
            $id = Article::doedit($params,$params['id']);
            $data = [
                'content' => $content
            ];
            ArticleContent::doedit($data,$params['id']);
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            \log::info('文章修改失败'.$e->getMessage());
            return redirect()->back()->with('msg',$e->getMessage());
        }
        return redirect('/admin/Article/list');
    }

    public function del($id){
        try{
            DB::beginTransaction();
            Article::del($id);
            ArticleContent::del($id);
            DB::commit();

        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect('/admin/Article/list');

    }

}
