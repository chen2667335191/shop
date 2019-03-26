<?php
namespace App\Http\Controllers\classs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Study\bonus;
use App\Study\Record;
use App\Study\User;

class ClassController extends Controller{
    public function index(){

    }
    /**
     * @抢红包的业务逻辑
     * 1.判断红包ID和userId是否传递
     * 2.判断红包是否存在
     * 3.判断红包是否被抢光
     * 4.判断是否是最后一个人抢红包
     */
    public function getBonus(Request $request){
        //获取所有的参数
        $params = $request->all();
        $return = [
          'code' => 2000,
            'msg' => '成功'
        ];


        //用户ID
        if(!isset($params['user_id'])||empty($params['user_id'])){
            $return = [
               'code' => 4001,
                'msg' => '用户未登录'
            ];
            return json_encode($return);
        }

        //红包ID
        if(!isset($params['bonus_id'])||empty($params['bonus_id'])){
            $return = [
                'code' => 4002,
                'msg' => '请选择指定的红包'
            ];
            return json_encode($return);
        }

        //检测红包是否存在
        $bonus = Bonus::getBonusInfo($params['bonus_id']);
        if(empty($bonus)){
            $return = [
              'code' => 4003,
                'msg' => '红包不存在'
            ];
            return json_encode($return);
        }

        //
        $record = Record::getRecordInfo($params['user_id'],$params['bonus_id']);
        if($record){
            $return = [
                'code' =>4005,
                'msg' =>'已经抢过该红包'
            ];
            return json_encode($return);
        }
        //检测红包是否被抢完
        if($bonus['num_left']==0 ||$bonus['bonus_left']==0){
            $return = [
                'code' =>4004,
                'msg' =>'红包被抢完'
            ];
            return json_encode($return);
        }

        //判断是否是最后一个红包
        if($bonus['num_left']==1){
            //用户抢到的金额
            $getMoney = $bonus['bonus_left'];
            //插入一条红包记录
            $data = [
                'user_id' =>$params['user_id'],
                'bonus_id' =>$params['bonus_id'],
                'money' =>$getMoney,
                'flag' =>1
            ];
            Record::createRecord($data);

            //更新红包数据
            $data1 = [
                'bonus_left' =>0,
                'num_left' =>0
            ];
            bonus::updataBonusInfo($data1,$params['bonus_id']);

            //评选运气王
            //将抢到红包的数据降序排列
            $getMaxBonus = Record::getMaxBonus($bonus['bonus_id']);
            //更新红包记录
            $updateRecordInfo = Record::updateReportInfo(['flag' =>2],$getMaxBonus['bonus_id']);

        }else{
            $min = 0.01;
            $max = $bonus['bonus_left']-($bonus['num_left']-1)*0.01;
            $getMoney = rand($min*100,$max*100)/100;
            //插入用户抢到的红包数据
            $data = [
                'user_id' =>$params['user_id'],
                'bonus_id' =>$params['bonus_id'],
                'money' => $getMoney,
                'flag' =>1
            ];
            Record::createRecord($data);

            //更新红包金额
            $data1 = [
                'bonus_left'=> $bonus['bonus_left']-$getMoney,
                'num_left' => $bonus['num_left']-1
            ];
            bonus::updataBonusInfo($data1,$params['bonus_id']);
        }


    }
    public function yf(){
        echo 111;
    }
}