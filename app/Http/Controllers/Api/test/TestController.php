<?php

namespace App\Http\Controllers\Api\test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\TestModel;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search=$request->input('search');
        $where=[];
        if(isset($search)){
            $where[]=["name","like","%$search%"];
        }
        $data=TestModel::where($where)->paginate(2)->toArray();
        return json_encode(['ret'=>200,'msg'=>'查询成功','data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name=$request->input('name');
        $age=$request->input("age");
        if(empty($name) || empty($age)){
            return json_encode(['ret'=>201,'msg'=>'用户名或年龄不能为空']);
        }
        $res=TestModel::insert(
            ['name'=>$name,'age'=>$age]
        );
        return json_encode(['ret'=>200,'msg'=>'添加成功']);    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=TestModel::where(['id'=>$id])->first();
        return json_encode(['ret'=>200,'msg'=>'查询成功','data'=>$data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data=TestModel::where(['id'=>$id])->first();
        return json_encode(['ret'=>200,'msg'=>'查询成功','data'=>$data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $name=$request->input('name');
        $age=$request->input('age');
        $res=TestModel::where(['id'=>$id])->update([
            'name'=>$name,
            'age'=>$age
        ]);
        return json_encode(['ret'=>200,'msg'=>'修改成功']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $res=TestModel::where(['id'=>$id])->delete();
        return json_encode(['ret'=>200,'msg'=>'删除成功']);
    }
}
