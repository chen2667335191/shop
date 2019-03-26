<?php

use Illuminate\Database\Seeder;

class InitPermission extends Seeder
{
    /**
     * Run the database seeds.
     *初始化权限表
     * @return void
     */
    public function run()
    {
        DB::table('permission')->insert([
            'Fid' =>0,
            'name' =>'首页',
            'url' => 'admin.home',
            'is_menu' =>'1'
        ]);
        //插入系统设置
        DB::table('permission')->insert([
            'Fid' =>0,
            'name' =>'系统设置',
            'url' => '#',
            'is_menu' =>'1',
        ]);

        DB::table('permission')->insert([
            'Fid' =>2,
            'name' =>'权限列表',
            'url' => 'admin.permission.list',
            'is_menu' =>'1',
        ]);

        DB::table('permission')->insert([
            'Fid' =>2,
            'name' =>'权限添加',
            'url' => 'admin.permission.create',
            'is_menu' =>'1',
        ]);

        DB::table('permission')->insert([
            'Fid' =>2,
            'name' =>'执行权限添加',
            'url' => 'admin.permission.doCreate',
            'is_menu' =>'1'
        ]);
    }
}
