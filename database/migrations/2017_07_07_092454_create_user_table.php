<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->comment('用户名');
            $table->string('password')->comment('密码');
            $table->string('nickname')->comment('昵称');
            $table->string('avatar')->comment('头像');
            $table->tinyInteger('sex')->default(1)->comment('性别');
            $table->string('mobile')->comment('手机号');
            $table->string('email', 100)->comment('邮箱');
            $table->timestamp('register_time')->comment('注册时间');
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
        //
    }
}
