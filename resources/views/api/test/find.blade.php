@extends('layouts.layouts')

@section('title', 'Api测试')

@section('content')
        <h3><b>Api测试--修改</b></h3>
        <form method="post" action="javascript:;">
            <div class="form-group">
                <label for="exampleInputEmail1">姓名</label>
                <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="请填写姓名">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">年龄</label>
                <input type="text" class="form-control" name="age" id="exampleInputPassword1" placeholder="请填写年龄">
            </div>
            <button type="submit" class="btn btn-primary" id="upd">修改</button>
        </form>
        <script>
            var url="http://www.api.com/api/test";
            function getUrlParam(name)
            {
                var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
                var r = window.location.search.substr(1).match(reg);  //匹配目标参数
                if (r!=null) return unescape(r[2]); return null; //返回参数值
            }
            var id=getUrlParam('id');
            $.ajax({
                url: url+"/"+id,
                dataType: "json",
                success: function (res) {
                    var name=$("[name='name']").val(res.data.name);
                    var age=$("[name='age']").val(res.data.age);
                }
             })
            //修改
        $(function(){
            $("#upd").on('click',function(){
                var name=$("[name='name']").val();
                var age=$("[name='age']").val();
                var id=getUrlParam('id');
                $.ajax({
                    url: url+"/"+id,
                    type:"PUT",
                    dataType: "json",
                    data: {name:name,age:age,id:id},
                    success: function (res) {
                        alert(res.msg);
                        if(res.ret){
                            location.href="http://www.api.com/test/show";
                        }
                    }
                })
            })
        })
        </script>
@endsection

