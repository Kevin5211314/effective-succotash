<?php /* HULK template engine v0.3
a:2:{s:9:"/auth/add";i:1581135570;s:9:"auth/from";i:1581133848;}
*/ ?>
<!DOCTYPE html>
<html>
<head>
    <title>LuiciCms - 基于LUI和CI框架的后台管理系统</title>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/resource/lib/layui-v2.5.4/css/layui.css" media="all">
    <link rel="stylesheet" href="/resource/css/public.css" media="all">
</head>
<body>

            <div class="layuimini-container">
            <div class="layuimini-main">
                 
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 25px;">
            <legend>添加规则</legend>
        </fieldset>
                    <form class="layui-form">

                    <div class="layui-form-item">
                        <label class="layui-form-label">父级名称</label>
                        <div class="layui-input-block">
                            <select id="sePar" name="parentId" lay-verify="required" lay-search="">
                            </select>
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">权限名称</label>
                        <div class="layui-input-block">
                            <input type="text" name="authorityName" lay-verify="authorityName" autocomplete="off" placeholder="请输入权限名称" class="layui-input" value="<?php if(isset($authorityName)){ echo $authorityName; } ?>">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">菜单URL</label>
                        <div class="layui-input-block">
                            <input type="text" name="menuUrl" lay-verify="menuUrl" autocomplete="off" placeholder="请输入菜单URL" class="layui-input" value="<?php if(isset($menuUrl)){ echo $menuUrl; }?>">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">菜单图标</label>
                        <div class="layui-input-block">
                            <input type="text" name="menuIcon" lay-verify="menuIcon" autocomplete="off" placeholder="请输入菜单图标" class="layui-input" value="<?php if(isset($menuIcon)){ echo $menuIcon; }?>">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">排序</label>
                        <div class="layui-input-block">
                            <input type="text" name="orderNumber" lay-verify="orderNumber" autocomplete="off" placeholder="请输入排序" class="layui-input">
                        </div>
                    </div>

                     <div class="layui-form-item">
                        <label class="layui-form-label">是否为菜单</label>
                        <div class="layui-input-block">
                            <input type="radio" name="isMenu" value="1" title="是" checked="">
                            <input type="radio" name="isMenu" value="0" title="否">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">checked</label>
                        <div class="layui-input-block">
                            <input type="text" name="checked" lay-verify="checked" autocomplete="off" placeholder="请输入checked" class="layui-input">
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label class="layui-form-label">authority</label>
                        <div class="layui-input-block">
                            <input type="text" name="authority" lay-verify="authority" autocomplete="off" placeholder="请输入authority" class="layui-input">
                        </div>
                    </div>

                    <input class="layui-input" type="text" name="authorityId" style="display: none;" value="">

                    <div class="layui-form-item">
                        <div class="layui-input-block">
                            <button class="layui-btn" lay-submit="" lay-filter="demo1">立即提交</button>
                            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                            <button id="return1" class="layui-btn layui-btn-primary" >返回</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    
        <script type="text/javascript" src="/resource/lib/jquery-3.4.1/jquery-3.4.1.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="/resource/lib/layui-v2.5.4/layui.js" charset="utf-8" ></script>
    <script type="text/javascript">
        $(function(){
            $.ajax({
                 type: "POST",
                 url: "/authsrule/getparentrule",
                 data: {},
                 dataType: "json",
                 success: function(data){
                    var result = data.data; var str = '';
                    for (var i=0; i < result.length; i++)
                    {   
                        if(result[i].parentId == '-1')
                        {
                            result[i].authorityName = '|-'+result[i].authorityName;
                        }
                        str += '<option value="'+result[i].authorityId+'">'+result[i].authorityName+'</option>'; 
                    }
                    console.log(str)
                    $('#sePar').append(str);  
                    layui.form.render("select");   
                 }
            });
        });

        layui.use(['form', 'layer'], function () {
            var form = layui.form
                , layer = layui.layer;

            //自定义验证规则
            form.verify({
                authorityName: function (value) {
                    if (value.length < 2) {
                        return '标题至少得2个字符啊';
                    }
                }
            });
            
            // 进行提交操作
            form.on('submit(demo1)', function (data) {
                console.log(data)
                $.ajax({
                    type: "POST",
                    url: "/authsrule/addruledata",
                    data: {data:data.field},
                    dataType: "json",
                    beforeSend: function (request) {
                        index = layer.load();
                    },
                    success: function (data) {
                        layer.close(index);
                        layer.msg(data.message, { icon: 1, time: 2000}, function(){
                            window.location.href = '/authsrule/index.html';
                        });  
                    },
                    error: function (data) {
                        layer.alert(JSON.stringify(data));
                        console.log(data)
                    }
                });
                return false;
            });

        });
    </script>
    
    <script type="text/javascript">
        $('#return1').on('click', function(){
             parent.location.reload()//刷新父亲对象（用于框架）
        });
    </script>
</body>
</html>