<?php

namespace App\Rbac;

use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    //
    protected $table='jy_article_category';
    public $timestamps = false;

    public static function getArticleCategoryList(){
        return self::get()->toArray();
    }
}
