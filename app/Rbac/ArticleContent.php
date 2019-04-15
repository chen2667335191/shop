<?php

namespace App\Rbac;

use Illuminate\Database\Eloquent\Model;

class ArticleContent extends Model
{
    //
    protected $table = "jy_article_content";

    public $timestamps = false;

    public static function doadd($data){
        return self::insert($data);
    }

    public static function getInfoId($id){
        return self::where('id',$id)->first();
    }

    public static function doedit($data,$id){
        return self::where('id',$id)->update($data);
    }
    public static function del($id){
        return self::where('id',$id)->delete();
    }
}
