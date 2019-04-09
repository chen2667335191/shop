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
}
