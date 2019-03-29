<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::any('/', function () {
    return view('welcome');
});

Route::prefix('classs')->group(function (){
    Route::any('get/bonus','classs\ClassController@getBonus');
//    Route::any('yf','classs\ClassController@yf');
});

//登陆页面
Route::get('admin/login','Admin\LoginController@index');
//执行登陆
Route::post('admin/doLogin','Admin\LoginController@doLogin');
//用户退出登陆
Route::get('admin/loginout','Admin\LoginController@loginout');

//管理后台RBAC功能类的路由组
Route::middleware('admin_auth')->prefix('admin')->group(function (){
    //登陆成功后的首页
    Route::get('home','Admin\HomeController@home')->name('admin.home');
    //权限列表
    Route::get('/permission/list','Admin\PermissionController@List')->name('admin.permission.list');
    //获取权限的数据
    Route::any('/get/permission/list/{fid?}','Admin\PermissionController@getPermissionList')->name('admin.get.permission.list');
    //权限添加
    Route::get('/permission/create','Admin\PermissionController@create')->name('admin.permission.create');
    //执行权限添加
    Route::post('/permission/doCreate','Admin\PermissionController@doCreate')->name('admin.permission.doCreate');
    //删除权限的操作
    Route::get('/permission/del/{id}','Admin\PermissionController@del')->name('admin.permission.del');

    /*#############################[权限相关]#############################*/



    /*#############################[用户相关]#############################*/
    //用户添加页面
    Route::get('/user/add','Admin\AdminUsersController@create')->name('admin.user.add');
    //执行用户添加
    Route::post('/user/store','Admin\AdminUsersController@store')->name('admin.user.store');

    //用户列表页面
    Route::get('/user/list','Admin\AdminUsersController@list')->name('admin.user.list');

    //用户删除操作
    Route::get('/user/del/{id}','Admin\AdminUsersController@delUser')->name('admin.user.del');

    //用户编辑页面
    Route::get('/user/edit/{id}','Admin\AdminUsersController@edit')->name('admin.user.edit');
    //用户执行编辑页面
    Route::post('/user/doEdit','Admin\AdminUsersController@doEdit')->name('admin.user.doEdit');

    /*#############################[用户相关]#############################*/


    /*#############################[角色相关]#############################*/

    //角色列表
    Route::get('/role/list','Admin\RoleController@list')->name('admin.role.list');
    //角色删除
    Route::get('/role/del/{id}','Admin\RoleController@delRole')->name('admin.role.del');

    //角色添加
    Route::get('/role/create','Admin\RoleController@create')->name('admin.role.create');
    //角色执行添加
    Route::post('/role/store','Admin\RoleController@store')->name('admin.role.store');

    //角色编辑
    Route::get('/role/edit/{id}','Admin\RoleController@edit')->name('admin.role.edit');
    //角色执行编辑
    Route::post('/role/doEdit','Admin\RoleController@doEdit')->name('admin.role.doEdit');

    //角色权限编辑
    Route::get('/role/permission/{id}','Admin\RoleController@rolePermission')->name('admin.role.permission');
    //角色权限执行编辑
    Route::post('/role/permission/save','Admin\RoleController@saveRolePermission')->name('admin.role.permission.save');

    /*#############################[角色相关]#############################*/


});



