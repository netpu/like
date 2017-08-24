<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminJuese extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //管理员角色表
        Schema::create('juese',function(Blueprint $table){
            $table->increments("id")->unsigned();
            $table->integer('pid')->default(0)->comment("父级ID")；
            $table->string("name",100)->nullable()->comment("权限称呼");
            $table->string("qx",255)->nullable()->comment("权限");
            $table->string("conter",100)->comment("描述");
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
        Schema::dropIfExists('juese');
    }
}
