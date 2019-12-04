<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TestModel extends Model
{
    //指定表名  因laravel框架默认表名比模型名多一 个s
    protected $table="test";
    //指定主键id
    protected $primaryKey="id";
    public $timestamps=false;
    protected $quarded=[];
}
