<?php
namespace app\Tools;
class ToolsAdmin{

    //无限极分类的数组表
    public static function buildTree($data,$fid=0){
        if (empty($data)){
            return [];
        }

        static $menus = [];//定义一个静态变量，用来储存无限极分类的数据
        foreach ($data as $key => $value){

            if($value['fid']==$fid){//当前循环内容中的fid是否等于函数fid的参数
                if(!isset($menus[$value['fid']])){
                    $menus[$value['id']]=$value;
                }else{
                    $menus[$value['fid']]['son'][$value['id']] = $value;
                }
                //删除已经添加过的数据
                unset($data[$key]);
                self::buildTree($data,$value['id']);//执行递归调用
            }
        }
        return $menus;
    }

    /**
     * 文件上传函数
     * @param $files $object
     * @return string url
     */
    public static function uploadFile($files)
    {
        //参数为空
        if(empty($files)){
            return "";
        }

        //文件上传的目录
        $basePath = 'uploads/'.date("Y-m-d",time());

        //目录不存在
        if(!file_exists($basePath)){
            @mkdir($basePath, 755, true);
        }

        //文件名字
        $filename = "/".date("YmdHis",time()).rand(0,10000).".".$files->extension();

        @move_uploaded_file($files->path(), $basePath.$filename);//执行文件的上传

        return '/'.$basePath.$filename;
    }

    /**
     * 获取用户所有权限的主键id
     * 1、根据用户userId 查询角色id
     * 2、根据角色id查询权限id
     */

    public static function getUserPermissionIds($userId)
    {

        if(!isset($userId) || empty($userId)){
            return [];
        }

        $userRole =  new \App\Rbac\UserRole();

        $roles = $userRole->getByUserId($userId);//根据用户id去查询角色id

        //角色id没有不存在
        if( empty($roles) ){
            return [];
        }


        $roleP = new \App\Rbac\RolePermission();

        $pids = $roleP->getPermissionByRoleId($roles->role_id);//根据用户的角色id去调用权限id集合

        return $pids;
    }

    /**
     * 获取当前登录用户的所有的权限url地址
     */
    public static function getUrlsByUserId($userId)
    {
        $pids = self::getUserPermissionIds($userId); //获取所有权限节点id


        $urls = \App\Rbac\Permission::getUrlsByIds($pids);//根据权限节点id获取所有的权限的url地址


        return $urls;
    }



}