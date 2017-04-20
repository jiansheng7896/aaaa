<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
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
            $table->string('name')->comment('name');
            $table->string('email')->unique()->comment('email');
            $table->string('password')->comment('password');
            $table->rememberToken()->comment('toke');
            $table->dateTime('created_at')->comment('created_at');
            $table->dateTime('updated_at')->comment('updated_at');
            $table->dateTime('deleted_at')->nullable()->comment('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
