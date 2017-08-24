<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Admin extends Model
{
    //管理员模型
    protected $table='admin';//指定表名

    protected $primaryKey="id";//主键

    protected $guarded=['pwd2'];//黑名单

    public function role(){
    	return $this->belongsTo(App\Models\Role::class,'qx','id');
    }
}
