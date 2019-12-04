@extends('layouts.layouts')

@section('title', 'Api展示')

@section('content')
    <h3><b>Api测试---展示</b></h3>
    <form method="get" >
        <input type="text" name="search" placeholder="用户名">
        <button type="button" class="btn btn-primary search">搜索</button>
    </form>
    <table class="table table-hover">
       <tr>
           <td>id</td>
           <td>用户名</td>
           <td>年龄</td>
           <td>操作</td>
       </tr>
        <tbody id="list">

        </tbody>
    </table>
    <nav aria-label="Page navigation">
        <ul class="pagination">

        </ul>
    </nav>
    <script>
        var url="http://www.api.com/api/test";
        $.ajax({
            url: url,
            dataType: "json",
            success: function (res) {
//                $.each(res.data.data,function(i,v){
//                    var tr=$("<tr></tr>");
//                    tr.append("<td>"+v.id+"</td>");
//                    tr.append("<td>"+v.name+"</td>");
//                    tr.append("<td>"+v.age+"</td>");
//                    tr.append("<td><button type='button' class='btn btn-success'><a href='javascript:;' style='color:#ffffff' test_id='"+v.id+"' class='update'>编辑</a>" +
//                           "</button><button type='button' class='btn btn-danger'><a href='javascript:;' style='color:#ffffff' test_id='"+v.id+"' class='del'>删除</a></button>" +
//                              "</td>");
//                    $("#list").append(tr);
//                })
//                //构建一个页码
//                for (var i=1; i<=res.data.last_page;i++){
//                    if(res.data.current_page==i){
//                        var li=$("<li class='active'><a href='javascript:;'>"+i+"</a></li>");
//                    }else{
//                        var li=$("<li><a href='javascript:;'>"+i+"</a></li>");
//                    }
//                    $('.pagination').append(li);
//                }
                list(res);
            }
        })
        //分页 点击页码 获取数据
        $(document).on('click','.pagination a',function(){
            //获取第几页的数据
            var page=$(this).html();
           //调用接口获取数据
           $.ajax({
               url: 'http://www.api.com/api/test_show',
               dataType: "json",
               data: {page:page},
               success: function (res) {
                  list(res);
               }
           })
        });
        //修改
        $(document).on('click','.update',function(){
            var id=$(this).attr('test_id');
            location.href="http://www.api.com/test/find?id="+id;
        });
        //删除
        $(document).on('click','.del',function(){
            var id=$(this).attr('test_id');
            var _this=$(this);
            $.ajax({
                url: url+"/"+id,
                type:"DELETE",
                dataType: "json",
                success: function (res) {
                    alert(res.msg);
                    if(res.ret == 200){
//                        location.href="http://.api.c om/test/show";
                        _this.parents("tr").remove();
                        //重新请求接口
                        $.ajax({
                            url: 'http://www.api.com/api/test_show',
                            dataType: "json",
                            success: function (res) {
                                list(res);
                            }
                        })
                    }

                }
            })

        })
        //搜索
        $(document).on('click','.search',function(){
            var search=$("[name='search']").val();
            $.ajax({
                url: 'http://www.api.com/api/test_show',
                dataType: "json",
                data: {search:search},
                success: function (res) {
                  list(res);
                }
            })
        })
       function list(res){
            $("#list").empty();
            $.each(res.data.data,function(i,v){
                var tr=$("<tr></tr>");
                tr.append("<td>"+v.id+"</td>");
                tr.append("<td>"+v.name+"</td>");
                tr.append("<td>"+v.age+"</td>");
                tr.append("<td><button type='button' class='btn btn-success'><a href='javascript:;' style='color:#ffffff' test_id='"+v.id+"' class='update'>编辑</a></button>" +
                    "<button type='button' class='btn btn-danger'><a href='javascript:;' style='color:#ffffff' test_id='"+v.id+"' class='del'>删除</a></button>" +
                    "</td>");
                $("#list").append(tr);
            });

            $(".pagination").empty();
            //构建一个页码
            for (var i=1; i<=res.data.last_page;i++){
                if(res.data.current_page==i){
                    var li=$("<li class='active'><a href='javascript:;'>"+i+"</a></li>");
                }else{
                    var li=$("<li><a href='javascript:;'>"+i+"</a></li>");
                }
                $('.pagination').append(li);
            }
        }
    </script>
@endsection

