<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminQx extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('qxb',function(Blueprint $table){
            $table->increments("id")->unsigned();
            $table->integer('pid')->default(0)->comment("父级ID");
            $table->string("qx_name",50)->nullable()->comment('权限名称');
            $table->string("qx_ff",50)->nullable()->comment('权限方法');
            $table->string("qx_wifi",50)->nullable()->comment('权限路由');
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
        Schema::dropIfExists('qxb');
    }
}
