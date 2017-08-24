<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class auth extends Model
{
    //
    protected $table='auth';//指定表名

    protected $primaryKey="auth_id";//主键

    protected $guarded=[];//黑名单
}
