<?php if (!defined('THINK_PATH')) exit();?><!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="Bookmark" href="favicon.ico" >
    <link rel="Shortcut Icon" href="favicon.ico" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="/Public/Style/lib/html5.js"></script>
    <script type="text/javascript" src="/Public/Style/lib/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/Public/Style/static/h-ui/css/H-ui.min.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Style/static/h-ui.admin/css/H-ui.admin.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Style/lib/Hui-iconfont/1.0.8/iconfont.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Style/static/h-ui.admin/skin/default/skin.css" id="skin" />
    <link rel="stylesheet" type="text/css" href="/Public/Style/static/h-ui.admin/css/style.css" />
    <!--[if IE 6]>
    <script type="text/javascript" src="/Public/Style/http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
    <script>DD_belatedPNG.fix('*');</script><![endif]-->
    <!--/meta 作为公共模版分离出去-->


    <script type="text/javascript" src="/Public/Style/lib/jquery/1.9.1/jquery.min.js"></script>
    <!--引入图片上传文件-->
    <script type="text/javascript" src="/Public/js/ajaxfileupload.js"></script>

    <title>用户注册</title>
    <meta name="keywords" content="H-ui.admin v3.0,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
    <meta name="description" content="H-ui.admin v3.0，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">

    <style>
        .style{
            background: #2c2cff url(overlay.png) repeat-x;
            display: inline-block;
            padding: 5px 10px 6px;
            color: #fff;
            text-decoration: none;
            -moz-border-radius: 6px;
            -webkit-border-radius: 6px;
            -moz-box-shadow: 0 1px 3px rgba(64, 63, 255, 0.6);
            -webkit-box-shadow: 0 1px 3px rgba(108, 101, 255, 0.6);
            text-shadow: 0 -1px 1px rgba(104, 106, 160, 0.25);
            border-bottom: 1px solid rgba(159, 167, 255, 0.55);
            position: relative;
            cursor: pointer
        }

        .style:hover{
            background: #0b0b6a url(overlay.png) repeat-x;
            display: inline-block;
            padding: 5px 10px 6px;
            color: #76ff3d;
            text-decoration: none;
            -moz-border-radius: 6px;
            -webkit-border-radius: 6px;
            -moz-box-shadow: 0 1px 3px rgba(64, 63, 255, 0.6);
            -webkit-box-shadow: 0 1px 3px rgba(108, 101, 255, 0.6);
            text-shadow: 0 -1px 1px rgba(104, 106, 160, 0.25);
            border-bottom: 1px solid rgba(159, 167, 255, 0.55);
            position: relative;
            cursor: pointer
        }
    </style>
    <script>
        var uploadPic = function(types){
            var inputName = types+'File';
            console.log(inputName);
            var loading='<img border=0 src="/Public/Style/images/loading_line.gif" style="width:80px;">';
            $('#'+types+'Box').html(loading);
            $('#'+types+'Btn').hide();
            $('#'+types+'Box').show();
            /*获取原来Box中是否有资源*/
            var img=$('#'+types).val();
            /*如果原来已经传了一张图,则进入方法,删除原图*/
            if(img!=''){
                $.get("/home.php?c=Upload&a=delImg&channel=normal&file="+img, function(result){
                });
            }

            $.ajaxFileUpload ({
                url :"/home.php?c=Upload&a=uploadImg&channel=normal&inputName="+inputName+"&types="+types,
                secureuri :false,
                fileElementId :inputName,
                dataType : 'text',
                success : function (data,status){
                    if(data!='undefined'){
                        //eval计算表达式的值
                        var dataArr=eval("("+data+")");
                        if(dataArr[0]<=0){
                            if(dataArr[0]==-4){
                                alert(dataArr[1]);
                            }else{
                                alert('Error：'+dataArr[1]);
                            }
                            $('#'+types+'Box').html('');
                            $('#'+types+'Box').hide();
                            $('#'+types+'Btn').show();
                        }else{
                            //$.get('/home.php?c=Upload&a=uploadToCDN&channel=brand&fileName='+dataArr[1]);		//将图片提交到COS
                            $('#'+types+'Box').html('<img border=0 src="" width="100">');
                            $('#'+types+'Box').find('img').attr('src','/<?php echo C("DIR_AVATAR_IMG");?>'+dataArr[1])
                            $('#'+types).val(dataArr[1]);
                            $('#'+types+'Btn').show();
                        }
                    }
                },
                error: function (data, status, e){
                    alert('Faild！');
                    $('#'+types+'Box').html('');
                    $('#'+types+'Box').hide();
                    $('#'+types+'Btn').show();
                }
            });
        }

        $(document).ready(function(){
            var index = '';
            $(document).ajaxStart(function(){
                index = layer.load(1, {
                    shade: [0.2,'#000'] //0.1透明度的白色背景
                });
            });

            $(document).ajaxStop(function(){
                layer.close(index);
            });
        });
        
        
        var uploadMsg = function () {
            //将form提交的数据转换为 json 格式
            var formData = $('#form-updateMsg').serializeArray();
            var data = {};
            $.each(formData,function(index,elem){
                data[elem.name] = elem.value;
            });
            $.ajax({
                urls:"/home.php?c=User&a=uploadMsg",
                type:"POST",
                data:data,
                success:function (result) {
                    alert(result.msg);
                    //window.location.href = "/home.php/home/index/index/";
                    window.parent.location.reload();
                },
                error:function () {
                    alert('请求失败');
                },
            });
        }
    </script>
</head>
<body>
<article class="cl pd-20">
    <form action="#" method="post" class="form form-horizontal" id="form-updateMsg">
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">用户名：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="<?php echo ($Msg["username"]); ?>" placeholder="" id="username" name="username">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">缩略图：</label>
            <div class="item formControls col-xs-8 col-sm-9">
                <!-- loding... -->
                <span id="normalBox" style="margin-right:10px;float:left;padding: 3px; border: #c6c4c4 1px solid">
                    <img src="/<?php echo ($Msg["picture_url"]); ?>" width="100px" border="0" alt="头像为空">
                </span>

                <span id="normalBtn">
								<a href="javascript:;" style="background: dodgerblue" class="tools-button style" onclick="normalFile.click()">上传头像</a>
								&nbsp;&nbsp;&nbsp;(图片规格：50*50以上规格图片)
								</span>
                <!--隐藏原来的上传按钮 hidden-->
                <p id="load_upPic" hidden>
                    <input type="file" id="normalFile" name="normalFile" onchange="uploadPic('normal');"/>
                    <input type="hidden" id="normal" name="picture_url" value="<?php echo basename($Msg['picture_url']);?>" >
                </p>
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">性别：</label>
            <div class="formControls col-xs-8 col-sm-9 skin-minimal">
                <div class="radio-box">
                    <input name="sex" type="radio" id="sex-1" checked>
                    <label for="sex-1">男</label>
                </div>
                <div class="radio-box">
                    <input type="radio" id="sex-2" name="sex">
                    <label for="sex-2">女</label>
                </div>
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>手机：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" value="<?php echo ($Msg["phone"]); ?>" placeholder="" id="phone" name="phone">
            </div>
        </div>
        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3"><span class="c-red"></span>邮箱：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input type="text" class="input-text" placeholder="@" name="email" id="email" value="<?php echo ($Msg["email"]); ?>">
            </div>
        </div>

        <div class="row cl">
            <label class="form-label col-xs-4 col-sm-3">签名：</label>
            <div class="formControls col-xs-8 col-sm-9">
                <input name="signature" value="<?php echo ($Msg["signature"]); ?>"  class="input-text"  placeholder="这家伙很懒..什么也没留下..." dragonfly="true" onKeyUp="textarealength(this,100)">
                <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
            </div>
        </div>
        <div class="row cl">
            <div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
                <span onclick="uploadMsg()" class="btn btn-primary radius" type="submit">修改</span>
            </div>
        </div>
    </form>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Public/Style/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/Style/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/Style/static/h-ui.admin/js/H-ui.admin.page.js"></script>

<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Public/Style/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/Public/Style/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/Public/Style/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
    $(function(){
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        $("#form-admin-add").validate({
            rules:{
                username:{
                    required:true,
                    minlength:4,
                    maxlength:16
                },
                password:{
                    required:true,
                },
                password2:{
                    required:true,
                    equalTo: "#password"
                },

            },
            onkeyup:false,
            focusCleanup:true,
            success:"valid",

        });
    });
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>