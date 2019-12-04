@extends('layouts.layouts')

@section('title', 'Api测试')

@section('content')
        <h3><b>Api测试</b></h3>
        <form action="javascript:;">
            <div class="form-group">
                <label for="exampleInputEmail1">姓名</label>
                <input type="text" class="form-control" name="name" id="exampleInputEmail1" placeholder="请填写姓名">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">年龄</label>
                <input type="text" class="form-control" name="age" id="exampleInputPassword1" placeholder="请填写年龄">
            </div>
            <button type="submit" class="btn btn-primary sub">提交</button>
        </form>
        <script>
            $(function(){
                var url="http://www.api.com/api/test";
                $(".sub").on("click",function(){
                    var name=$("input[name='name']").val();
                    var age=$("input[name='age']").val();
                    $.ajax({
                        url: url,
                        type:"post",
                        dataType: "json",
                        data: {name:name,age:age},
                        success: function (res) {
                            alert(res.msg);
                            if(res.ret == 200){
                                location.href="http://www.api.com/test/show";
                            }
                        }
                     })
                })
            })
        </script>
@endsection

