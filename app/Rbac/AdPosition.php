<?php

namespace App\Rbac;

use Illuminate\Database\Eloquent\Model;

class AdPosition extends Model
{
    //
    protected $table='jy_ad_position';
    public $timestamps = false;

    public static function getInfo(){
        return self::get()->toArray();
    }
    public static function doadd($data){
        return self::insert($data);
    }

    public static function getInfoById($id){
        return self::where('id',$id)->first();
    }

    public static function doedit($data,$id){
        return self::where('id',$id)->update($data);
    }

    public static function del($id){
        return self::where('id',$id)->delete();
    }


}
