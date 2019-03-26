<?php

use Illuminate\Database\Seeder;

class InitAdminUser extends Seeder
{
    /**
     * Run the database seeds.
     *初始化后台管理员用户表
     * @return void
     */
    public function run()
    {
        //
        $data = [
            'user_name' =>'admin',
            'password' =>'admin',
            'image_url' =>'',
            'is_super' =>'1',
            'status' =>'1'
        ];
        DB::table('admin_user')->insert($data);
    }
}
