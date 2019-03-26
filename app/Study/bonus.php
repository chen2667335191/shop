<?php

namespace App\Study;

use Illuminate\Database\Eloquent\Model;

class bonus extends Model
{
    //红包表
    protected $table = "bonus";

    //获取红包信息
    //@params $id
    public static function getBonusInfo($id){
        $bonus = self::where('bonus_id',$id)->first();
        return $bonus;
    }
    //修改抢过后的红包记录
    public static function updataBonusInfo($data,$id){
        return self::where('bonus_id',$id)->update($data);
    }
}
