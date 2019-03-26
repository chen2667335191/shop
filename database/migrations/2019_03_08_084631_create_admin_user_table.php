<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUserTable extends Migration
{
    /**
     * Run the migrations.
     *后台用户管理表
     * @return void
     */
    public function up()
    {
        Schema::create('admin_user', function (Blueprint $table) {
            $table->increments('id')->comment('主键id');
            $table->string('user_name',50)->comment('用户名');
            $table->string('password',32)->comment('用户密码');
            $table->string('image_url',100)->comment('用户头像');
            $table->enum('is_super',['1','2'])->default('1')->comment('是否是超管 1非超管 2超管 ');
            $table->enum('username',['1','2'])->default('1')->comment('用户状态1正常 2停用');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_user');
    }
}
