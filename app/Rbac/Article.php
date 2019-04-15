<?php

namespace App\Rbac;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //

    protected $table='jy_article';

    protected function getInfo(){
        return self::select('jy_article.id','jy_article_category.cate_name','title','publish_at','clicks','status')
            ->leftJoin('jy_article_category','jy_article.cate_id','=','jy_article_category.id')
            ->paginate(2);
    }

    public static function getInfoId($id){
        return self::where('id',$id)->first();
    }

    public static function doadd($data){
        return self::insert($data);
    }

    public static function doedit($data,$id){
        return self::where('id',$id)->update($data);
    }

    public static function del($id){
        return self::where('id',$id)->delete();
    }
}
