<?php

namespace App\Http\Controllers\Api\test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\TestModel;

class TestController1 extends Controller
{
    public function add_do(Request $request){
        $name=$request->input('name');
        $age=$request->input("age");
        if(empty($name) || empty($age)){
            return json_encode(['ret'=>201,'msg'=>'用户名或年龄不能为空']);
        }
        $res=TestModel::insert(
            ['name'=>$name,'age'=>$age]
        );
        return json_encode(['ret'=>200,'msg'=>'添加成功']);
    }
    public function test_show(Request $request){
        $search=$request->input('search');
        $where=[];
        if(isset($search)){
            $where[]=["name","like","%$search%"];
        }
        $data=TestModel::where($where)->paginate(2)->toArray();
        return json_encode(['ret'=>200,'msg'=>'查询成功','data'=>$data]);
    }
    public function find(Request $request){
        $id=$request->input('id');
        $data=TestModel::where(['id'=>$id])->first();
        return json_encode(['ret'=>200,'msg'=>'查询成功','data'=>$data]);
    }
    public function update(Request $request){
        $name=$request->input('name');
        $age=$request->input('age');
        $id=$request->input('id');
        $res=TestModel::where(['id'=>$id])->update([
          'name'=>$name,
          'age'=>$age
        ]);
      return json_encode(['ret'=>200,'msg'=>'修改成功']);
    }
    public function del(Request $request){
        $id=$request->input('id');
        $res=TestModel::where(['id'=>$id])->delete();
        return json_encode(['ret'=>200,'msg'=>'删除成功']);
    }
    public function user(){
        $url="http://wym.yingge.fun/api/exam/mytest";
        $name="刘金月";
        $age=18;
        $sign=md5("1904".$name.$age);
        $url .="?name=$name&age=$age&sign=$sign";
        $data=file_get_contents($url);
        dd($data);
    }
}
