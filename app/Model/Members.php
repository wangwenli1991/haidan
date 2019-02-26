<?php

namespace App\Model;

use Illuminate\Foundation\Auth\User as Authtable;

class Members extends Authtable
{
    //指定关联数据表，默认是 该模型类名的复数
    protected  $table='members'; //我们一般都要这两个，指定的表名
    //指定可填充数据
    //protected  $fillable=['account','password'];  //数组里面是字段名，一般我们只要$table、$guarded这两个
    //指定当前这个表的所有字段都是可填充的
    protected  $guarded =[];      //我们一般都要这两个，指定的不可填充数据，设置为空，就代表都可以填充
    //重置验证账号字段
    public function username(){
        return 'account';
    }
    //关联图片表的图像
    public function avators(){
        return $this->hasOne('App\Model\Images','id','avator')
        ->where('status','=',1)->select('path');
    }
    //关联会员表的图像
    public function images(){
        return $this->hasMany('App\Model\Images','tableid','id')
        ->where([
            ['status','=',1],
            ['type','=',0]
        ])->select('id','path','title');
    }
    //关联择偶表
    public function spouse(){
        return $this->hasOne('App\Model\Spouse','mid','id');
    }
}
