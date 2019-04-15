<?php

namespace App\Rbac;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $table = 'jy_ad';
    public $timestamps = false;

    public static function getInfo(){
        return self::select('jy_ad.*','jy_ad_position.position_name')->leftJoin('jy_ad_position','jy_ad.position_id','=','jy_ad_position.id')->paginate(1);
    }

    public static function doadd($data){
        return self::insert($data);
    }

    public static function edit($data,$id){
        return self::where('id',$id)->update($data);
    }

    public static function del($id){
        return self::where('id',$id)->delete();
    }

}
