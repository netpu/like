<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class QxAuth extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('auth',function(Blueprint $table){
            $table->increments("auth_id")->unsigned();
            $table->integer("qx_id")->default(0)->comment("父级ID");
            $table->string("auth_name",50)->comment("权限名称");
            $table->string("auth_action",50)->comment("权限方法");
            $table->string("auth_controller",100)->comment("权限控制器");
            $table->string("auth_route",50)->comment("权限路由");
            $table->unsignedTinyInteger("is_menu")->comment("是否为菜单");
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
        //
        Schema::dropIfExists('auth');
    }
}
