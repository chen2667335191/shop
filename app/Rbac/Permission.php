<?php

namespace App\Rbac;


use Illuminate\Database\Eloquent\Model;
use App\Tools\ToolsAdmin;
class Permission extends Model
{
    //权限表名
    protected $table = 'permission';

    const
        IS_MENU = 1,
        IS_NO_MENU =2,

        END = true;

    public static function getMenus($user = []){
        $permission = self::select('id','fid','name','url')
                    ->where('is_menu',self::IS_MENU)
                    ->orderBy('sort')
                    ->get()
                    ->toArray();


        //如果不是超管
        if($user['is_super'] !=2){
            $pids = ToolsAdmin::getUserPermissionIds($user['user_id']);//当前登录用户权限节点

            $permission = self::select('id','fid','name','url')
                ->whereIn('id',$pids)
                ->where('is_menu',self::IS_MENU)
                ->orderBy('sort')
                ->get()
                ->toArray();
        }
        $leftmenus = ToolsAdmin::buildTree($permission);
        return $leftmenus;
    }

    /**
     * 获取所有的权限节点
     */
    public static function getAllPermissions()
    {
        $permissions = self::select('id','fid','name','url')
            ->orderBy('sort')
            ->get()
            ->toArray();

        $permissions = ToolsAdmin::buildTree($permissions);

        return $permissions;
    }

    /**
     * 获取权限列表
     * @return array
     */
    public static function getListByFid($fid=0)
    {
        $list = self::select('id', 'fid','name','url','is_menu','sort')
            ->where('fid',$fid)
            ->orderBy('sort')
            ->get()
            ->toArray();

        return $list;
    }

    /**
     * 添加权限
     * @return bool
     */
    public static function addRecord($data)
    {

        return self::insert($data);
    }

    /**
     * 删除权限的函数
     */
    public static function delRecord($id)
    {
        return self::where('id',$id)->delete();
    }

    /**
     * 通过权限的主键id获取权限的url地址集合
     */
    public static function getUrlsByIds($pids)
    {

        $permissions = self::select('url')
            ->whereIn('id', $pids)
            ->get()
            ->toArray();


        $urls = [];

        foreach ($permissions as $key => $value) {
            $urls[] = $value['url'];
        }

        return $urls;
    }


}
