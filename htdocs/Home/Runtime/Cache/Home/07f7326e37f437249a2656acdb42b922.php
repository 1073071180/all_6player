<?php if (!defined('THINK_PATH')) exit();?><!--header 作为公共模版分离出去-->
<script>
    //点击时弹出登录框
    var login = function () {
        layer.open({
            type: 2,
            skin: 'layui-layer-demo', //加上边框
            area: ['550px','500px'], //宽高
            shadeClose: true,
            content:'/home.php/home/User/ajaxLogin'
        });
    }

    //ajax异步登录请求
    var ajaxLogin = function () {
        var username = $("#username").val();
        var password = $("#password").val();
            $.ajax({
                url:"/home.php?c=User&a=ajaxLogin",
                type:"POST",
                data:{
                    username:username,
                    password:password,
                },
                success:function (result) {
                    if (result.status == 'success'){
                       //登录成功，跳转 alert(result.message)
                        window.location.href="/home.php/home/index/index";
                    } else {
                        alert(result.message)
                    }
                },
                error:function (result) {
                    alert(result.message)
                }
            })
    }

    //点击发布文章时触发请求，检查是否有session 若没有，则 弹出登录框
    function jump(url){
      $.ajax({
          url:"/home.php?c=User&a=ajaxCheck",
          type:'POST',
          success:function (result) {
              if(result.status == '1') {
                  window.location.href = "/home.php/home/"+url;
              }else if(result.status == '2'){
                      //特殊弹窗效果
                  layer.msg('该功能需要登录，请先登录', function(){
                      //弹出登录框
                      login();
                  });
              }
          },
          error:function () {
             alert("请求失败");
          },
      })
    }

    //用户修改密码
    //用户修改资料
    //根据用户的id异步查询用户的详细信息
    function updateUser(){
        layer.confirm('要修个人信息吗？', {
            btn: ['改密码','改资料','先不了~'] //按钮
        }, function(index){
               layer.close(index);
               layer.prompt({title: '输入原密码，并确认', formType: 1}, function(pass, index){
                   var password = pass;
                   $.ajax({
                       url:"/home.php?c=user&a=selectPassword",
                       type:"POST",
                       data:{
                           password:password,
                       },
                       success:function (result) {
                           if (result.status == 1 ){
                               alert(result.msg);
                           }else if(result.status == 2){
                               layer.close(index);
                               layer.prompt({title: '输入新密码，并确认', formType: 2}, function(text, index){
                                   layer.close(index);
                                   var newPassword = text;
                                   $.ajax({
                                       url:"/home.php?c=user&a=uploadPassword",
                                       type:"POST",
                                       data:{
                                           password:newPassword,
                                       },
                                       success:function (result) {
                                           if (result.status == 1){   //修改失败
                                               layer.msg(result.msg+'，新密码不能与原密码相同');
                                           }else if (result.status == 2){
                                               layer.msg(result.msg);
                                           }else if(result.status == 10){  //修改成功
                                               layer.msg('您的密码已改为：'+text+'，请牢记！');
                                           }
                                       },
                                       error:function () {
                                           alert('请求失败');
                                       },
                                   });
                               });
                           };
                       },
                       error:function () {
                           alert('请求失败');
                       },
                   });

               });
           },
            function(index){
                layer.open({
                    type: 2,
                    skin: 'layui-layer-demo', //加上边框
                    area: ['450px','500px'], //宽高
                    shadeClose: true,
                    content:'/home.php/home/User/uploadMsg'
                });
            },

            function() {
            layer.msg('也可以这样', {
                time: 20000, //20s后自动关闭
                btn: ['明白了', '知道了']
            });
        })




    }
</script>
<body style="background:url(/Public/MyImage/background2.jpg);background-attachment:fixed">
<header style="background:url(/Public/MyImage/header.png)" class="am-topbar am-topbar-fixed-top wos-header">
    <div class="am-container">
        <h1 class="am-topbar-brand">
            <a href="#"><img src="/Public/HomeStyle/images/logo.png" alt=""></a>
        </h1>

        <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-warning am-show-sm-only"
                data-am-collapse="{target: '#collapse-head'}">
            <span class="am-sr-only">导航切换</span>
            <span class="am-icon-bars"></span>
        </button>

        <div class="am-collapse am-topbar-collapse" id="collapse-head">
            <ul class="am-nav am-nav-pills am-topbar-nav">
                <li  <?php if((CONTROLLER_NAME) == "Index"): ?>class="am-active"<?php endif; ?>><a href="/home.php/home/index/index">首页</a></li>
                <li <?php if((CONTROLLER_NAME) == "Article"): ?>class="am-active"<?php endif; ?>><a href="/home.php/home/article/article">资讯</a></li><!--显示文章列表-->
                <li <?php if((CONTROLLER_NAME) == "Category"): ?>class="am-active"<?php endif; ?>><a href="/home.php/home/category/category">专栏</a></li>
                <li <?php if((CONTROLLER_NAME) == "Events"): ?>class="am-active"<?php endif; ?>><a href="/home.php/home/events/events">活动</a></li>
                <!--发布文章和我的专栏 需要访问控制 调用jump-->
                <li <?php if((CONTROLLER_NAME) == "Release"): ?>class="am-active"<?php endif; ?>><a href="#" onclick="jump('release/release')">发布文章</a></li>
                <li <?php if((CONTROLLER_NAME) == "MyArticle"): ?>class="am-active"<?php endif; ?>><a href="#" onclick="jump('MyArticle/MyArticle')">我的专栏</a></li>

            </ul>

            <div class="am-topbar-right">
                <?php if(empty($_SESSION['user']['id'])): ?><a href="/home.php/home/user/add"><button class="am-btn am-btn-default am-topbar-btn am-btn-sm"><span class="am-icon-pencil"></span> 注册</button></a>
                        <?php else: ?>
                    <a style="color: #fbffff" href="/home.php/home/user/logout">退出</a><?php endif; ?>
            </div>

            <div class="am-topbar-right">
                <?php if(empty($_SESSION['user']['id'])): ?><button class="am-btn am-btn-danger am-topbar-btn am-btn-sm" onclick="login()"><span class="am-icon-user"></span> 登录</button>
                    <?php else: ?>
                    <div ><a style="color: #3f6dff" href="javascript:;" onclick="updateUser()">欢迎您：<?php echo ($_SESSION['user']['username']); ?></a></div><?php endif; ?>
            </div>

            <div class="am-topbar-right">
                <?php if(empty($_SESSION['user']['id'])): else: ?>
                    <a href="javascript:;" onclick="updateUser()"><img src="/<?php echo ($_SESSION['user']['picture']); ?>" style="width:40px;height:40px;border-radius:50%; overflow:hidden;" alt="头像为空"></a><?php endif; ?>
            </div>
        </div>
    </div>
</header>
<!--/header 作为公共模版分离出去-->

<!--_meta 作为公共模版分离出去-->
<!doctype html>
<html class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <!--360 browser -->
    <meta name="renderer" content="webkit">
    <meta name="author" content="wos">
    <!-- Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="/Public/HomeStyle/images/i/app.png">
    <!--Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
    <link rel="apple-touch-icon-precomposed" href="/Public/HomeStyle/images/i/app.png">
    <!--Win8 or 10 -->
    <meta name="msapplication-TileImage" content="images/i/app.png">
    <meta name="msapplication-TileColor" content="#e1652f">

    <link rel="icon" type="image/png" href="/Public/HomeStyle/images/i/favicon.png">
    <link rel="stylesheet" href="/Public/HomeStyle/assets/css/amazeui.css">
    <link rel="stylesheet" href="/Public/HomeStyle/css/public.css">


    <!--[if (gte IE 9)|!(IE)]><!-->
    <script src="/Public/HomeStyle/assets/js/jquery.min.js"></script>
    <!--<![endif]-->

    <script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
    <script src="/Public/HomeStyle/assets/js/amazeui.ie8polyfill.min.js"></script>
    <![endif]-->
    <script src="/Public/HomeStyle/assets/js/amazeui.min.js"></script>
    <script src="/Public/HomeStyle/js/public.js"></script>

    <!--引入layui-->
    <script src="/Public/layer/layer.js"></script>

<!--/meta 作为公共模版分离出去-->

<!--_meta 作为公共模版分离出去-->

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



    <!--引入图片上传文件-->
    <script type="text/javascript" src="/Public/js/ajaxfileupload.js"></script>


<!--/meta 作为公共模版分离出去-->

<title>新增文章 - 资讯管理 - H-ui.admin v3.0</title>
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
</style>
<script>
    //提交基本资料
    var saveArticle = function(){

        var formData = $('#form-article-add').serializeArray();
        //   console.log(formData);
        var data = {};
        $.each(formData,function(index,elem){
            data[elem.name] = elem.value;
        });
        console.log(data);
        urls="/home.php?c=Article&a=articleAdd";
        $.ajax({
            type: "POST",
            url:urls,
            data: data,
            success: function(result){
                //  console.log(result);
                if(result.status == 'success'){
                    alert(result.message);
                    window.location.href="/home.php/Home/MyArticle/MyArticle";
                }else{
                    alert(result.message);
                }
            },
            error: function () {
                alert('请求失败！');
            }
        });
        return false;
    }

    //上传图片
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

</script>



<article class="page-container">
	<form action="" class="form form-horizontal" id="form-article-add">

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>文章标题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="article_title" name="article_title">
			</div>
		</div>


		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">排序值(越大越靠前)：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="0" placeholder="" id="article_number" name="article_number">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">关键词：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" name="key_word" id="key_word" >
			</div>
		</div>

				<input type="hidden" class="input-text" value="0" placeholder="" id="writer" name="writer">

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">文章来源：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="0" placeholder="" id="come_from" name="come_from">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">允许评论：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="check-box" >
					<input type="checkbox"  name="is_comment" id="is_comment">
					<label for="is_comment">&nbsp;</label>
				</div>
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">评论开始日期：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" onfocus="WdatePicker()" name="comment_start" id="comment_start" class="input-text Wdate">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">评论结束日期：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" onfocus="WdatePicker()" name="comment_end" id="comment_end" class="input-text Wdate">
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">缩略图：</label>
			<div class="item formControls col-xs-8 col-sm-9">
				<!-- loding... -->
				<span id="normalBox" style="margin-right:10px;display:none;float:left;padding: 3px; border: #c6c4c4 1px solid"></span>

				<span id="normalBtn">
								<a href="javascript:;" style="background: dodgerblue" class="tools-button style" onclick="normalFile.click()">上传图片</a>
								&nbsp;&nbsp;&nbsp;(图片规格：50*50以上规格图片)
								</span>
				<!--隐藏原来的上传按钮 hidden-->
				<p id="load_upPic" hidden>
					<input type="file" id="normalFile" name="normalFile" onchange="uploadPic('normal');"/>
					<input type="hidden" id="normal" name="picture_url" >
				</p>
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">文章内容：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<script id="editor" type="text/plain" name="content"></script>
			</div>
		</div>

		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
				<a onclick="saveArticle();" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe632;</i> 保存并提交审核</a>
				<!--<button onClick="article_save();" class="btn btn-secondary radius" type="button"><i class="Hui-iconfont">&#xe632;</i> 保存草稿</button>-->
				<button onClick="removeIframe();" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</button>
			</div>
		</div>
	</form>
</article>

<!--_footer 作为公共模版分离出去-->

<!--<script type="text/javascript" src="/Public/Style/lib/jquery/1.9.1/jquery.min.js"></script> -->
<script type="text/javascript" src="/Public/Style/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/Style/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/Style/static/h-ui.admin/js/H-ui.admin.page.js"></script>
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Public/Style/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Style/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="/Public/Style/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="/Public/Style/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript" src="/Public/Style/lib/webuploader/0.1.5/webuploader.min.js"></script>
<script type="text/javascript" src="/Public/Style/lib/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/Public/Style/lib/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/Public/Style/lib/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
    $(function(){
        //选中是否允许评论,js修改前端样式
        $('.skin-minimal input').iCheck({
            checkboxClass: 'icheckbox-blue',
            radioClass: 'iradio-blue',
            increaseArea: '20%'
        });

        //设置文章填写栏高度
        var ue = UE.getEditor('editor',{
            initialFrameHeight:'400',
        });
    });
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>