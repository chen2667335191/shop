<?php

namespace App\Study;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    //记录表
    protected $table = "record";

    //红包记录
    public static function createRecord($data){
        $res = self::insert($data);
        return $res;
    }
    //获取最大红包的记录
    public static function getMaxBonus($BonusId){
        $getMaxBonus = self::where('Bonus_id',$BonusId)->orderBy('money','desc')->first();
        return $getMaxBonus;
    }
    //更新红包记录
    public static function updateReportInfo($data,$RecordId){
        $updateRecordInfo = self::where('record_id',$RecordId)->update($data);
        return $updateRecordInfo;
    }
    //根据红包ID和用户ID查询红包记录
    public static function getRecordInfo($userId,$bonusId){
        $getRecordInfo = self::where('user_id',$userId)->where('bonus_id',$bonusId)->first();
        return $getRecordInfo;
    }
}
