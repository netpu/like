<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LaraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //创建数据表
        Schema::create('admin',function(Blueprint $table){
            $table->increments("id")->unsigned();
            $table->string("name",200)->comment("姓名");
            $table->string("pwd",32)->comment("密码");
            $table->enum("sex",['0','1'])->comment("性别");
            $table->string("shouji",20)->comment("手机");
            $table->string("email",32)->comment("邮箱");
            $table->string("qx",10)->comment("权限");
            $table->string("conter",100)->comment("描述");
            $table->enum("qiy",['0','1'])->comment("是否启用");
            $table->timestamps();//记录时间
            $table->softDeletes();//伪删除
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //删除数据表
        Schema::dropIfExists('jkb');
    }
}
