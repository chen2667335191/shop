<?php

namespace App\Rbac;

use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    //
    protected $table='jy_brand';

    public $timestamps = false;

    public static function getList(){
        return self::get()->toArray();
    }

    public static function create($data){
        return self::insert($data);
    }

    public static function getInfo($id){
        return self::where('id',$id)->first();
    }

    public static function doEdit($data,$id){
        return self::where('id',$id)->update($data);
    }

    public static function del($id){
        return self::where('id',$id)->delete();
    }

}
