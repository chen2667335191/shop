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

    public static function doadd($data){
        return self::insertGetId($data);
    }

    public static function edit($id){
        return self::where('id',$id)->first();
    }

    public static function doedit($data,$id){
        return self::where('id',$id)->update($data);
    }

    public static function del($id){
        return self::where('id',$id)->delete();
    }

}