<?php

namespace App\Rbac;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $table='jy_category';
    public $timestamps = false;
     public static function getCategoryList(){
         return self::get()->toArray();
     }

     public static function getCategoryByFid($fid){
         return self::where('f_id',$fid)->get()->toArray();
     }

    //获取分类的信息
    public static function getCateInfo($id)
    {
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
