<?php if (!defined('THINK_PATH')) exit();?><!--_meta 作为公共模版分离出去-->
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


<!--header 作为公共模版分离出去-->
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


<div id="category_top" style="background: url(/Public/MyImage/article.png)">
    <div class="am-hide-lg-only kz" id="leftbtn">
        <i class="am-icon-angle-left" ></i>
    </div>
    <div class="am-hide-lg-only kz" style="right:0px;" id="rightbtn">
        <i class="am-icon-angle-right"></i>
    </div>
    <div class="am-container" >
        <ul class="am-avg-sm-2 am-avg-md-3 am-avg-lg-6 am-thumbnails" id="topface">
            <?php if(is_array($users)): $i = 0; $__LIST__ = $users;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><li>
                    <a href="/home.php/home/category/publicCategory/id/<?php echo ($user["id"]); ?>">
                    <div class="ctl active" style="width: 162px;height: 213px;">
                        <img style="width: 69px;height: 69px" src=/<?php echo ($user["picture_url"]); ?>>
                        <h3><?php echo ($user["username"]); ?></h3>
                        <p><?php echo ($user["signature"]); ?></p>
                    </div>
                    <button type="button" class="am-btn am-btn-primary">进入专栏</button>
                    </a>
                </li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>

<script>
    var countnum=5 //一共多少个图 例如6个请输入5
    $("#leftbtn").click(function(){
        var temp_href=$("#topface li:eq(0) a").attr("href");
        var temp_img=$("#topface li:eq(0) img").attr("src");
        var temp_h3=$("#topface li:eq(0) h3").html();
        var temp_p=$("#topface li:eq(0) p").html();

        for (i=0; i<countnum; i++){
            var n=i+1;
            $("#topface li:eq("+i+") a").attr('href',$("#topface li:eq("+n+") a").attr("href"));
            $("#topface li:eq("+i+") img").attr('src',$("#topface li:eq("+n+") img").attr("src"));
            $("#topface li:eq("+i+") h3").html($("#topface li:eq("+n+") h3").html());
            $("#topface li:eq("+i+") p").html($("#topface li:eq("+n+") p").html());
        };
        $("#topface li:eq("+countnum+") a").attr('href',temp_href);
        $("#topface li:eq("+countnum+") img").attr('src',temp_img);
        $("#topface li:eq("+countnum+") h3").html(temp_h3);
        $("#topface li:eq("+countnum+") p").html(temp_p);
    });
    $("#rightbtn").click(function(){
        var temp_href=$("#topface li:eq("+countnum+") a").attr("href");
        var temp_img=$("#topface li:eq("+countnum+") img").attr("src");
        var temp_h3=$("#topface li:eq("+countnum+") h3").html();
        var temp_p=$("#topface li:eq("+countnum+") p").html();

        for (i=countnum; i>0; i--){
            var n=i-1;
            $("#topface li:eq("+i+") a").attr('href',$("#topface li:eq("+n+") a").attr("href"));
            $("#topface li:eq("+i+") img").attr('src',$("#topface li:eq("+n+") img").attr("src"));
            $("#topface li:eq("+i+") h3").html($("#topface li:eq("+n+") h3").html());
            $("#topface li:eq("+i+") p").html($("#topface li:eq("+n+") p").html());
        };
        $("#topface li:eq(0) a").attr('href',temp_href);
        $("#topface li:eq(0) img").attr('src',temp_img);
        $("#topface li:eq(0) h3").html(temp_h3);
        $("#topface li:eq(0) p").html(temp_p);
    });
</script>
<div id="cattit">
    <ul class="am-avg-sm-2 am-avg-md-2 am-avg-lg-2">
        <li><h3><a href="#">合作专栏</a></h3></li>
        <li  class="active-none"><h3><a href="#">个人专栏</a></h3></li>
    </ul>
</div>
<hr data-am-widget="divider" style="" class="am-divider am-divider-default" />
<div id="cattlist" class="am-container">
    <ul class="am-avg-sm-1 am-avg-md-3 am-avg-lg-4">
        <li>
            <div class="cattlist_0">
                <div class="cattlist_1">
                    <div class="am-g">

                        <div class="am-u-sm-4 am-u-md-5 am-u-lg-5 am-vertical-align">
                            <div class="am-vertical-align-middle">
                                <img src="/Public/HomeStyle/Temp-images/face1.jpg">
                            </div>
                        </div>
                        <div class="am-u-sm-8 am-u-md-7 am-u-lg-7">

                            <h3>山边小溪</h3>
                            <h4>AmazeUI</h4>
                            <p>文章<span>9</span></p>
                        </div>
                    </div>
                </div>
                <div class="cattlist_2">
                    <p>
                        设计的空间发生快，乐十分的骄傲了开发奥斯卡的房间辣椒反馈。发奥斯卡的房间辣椒反馈。设计的空间发生快，
                    </p>
                </div>
                <div class="cattlist_3">
                    <button type="button" class="am-btn am-btn-warning">
                        <i class="am-icon-plus"></i>
                        关注
                    </button>
                </div>
            </div>
        </li>

    </ul>
</div>

<div class="am-container" style="margin: 100px auto">
    <ul data-am-widget="pagination" class="am-pagination am-pagination-default am-text-center">

        <li class="am-pagination-first ">
            <a href="#" class="">第一页</a>
        </li>

        <li class="am-pagination-prev ">
            <a href="#" class="">上一页</a>
        </li>


        <li class="">
            <a href="#" class="">1</a>
        </li>
        <li >
            <a href="#">2</a>
        </li>
        <li class="">
            <a href="#" class="">3</a>
        </li>
        <li class="">
            <a href="#" class="">4</a>
        </li>
        <li class="">
            <a href="#" class="">5</a>
        </li>
        <li class="">
            <a href="#" class="">6</a>
        </li>
        <li class="">
            <a href="#" class="">7</a>
        </li>
        <li class="">
            <a href="#" class="">8</a>
        </li>
        <li class="am-active">
            <a href="#">9</a>
        </li>
        <li class="">
            <a href="#" class="">10</a>
        </li>
        <li class="">
            <a href="#" class="">11</a>
        </li>
        <li class="">
            <a href="#" class="">12</a>
        </li>
        <li class="">
            <a href="#" class="">13</a>
        </li>
        <li class="">
            <a href="#" class="">14</a>
        </li>
        <li class="">
            <a href="#" class="">15</a>
        </li>
        <li class="">
            <a href="#" class="">16</a>
        </li>


        <li class="am-pagination-next ">
            <a href="#" class="">下一页</a>
        </li>

        <li class="am-pagination-last ">
            <a href="#" class="">最末页</a>
        </li>
    </ul>
</div>




<div data-am-widget="gotop" class="am-gotop am-gotop-fixed" >
    <a href="#top" title="回到顶部">
        <span class="am-gotop-title">回到顶部</span>
        <i class="am-gotop-icon am-icon-chevron-up"></i>
    </a>
</div>

<!--Footer 作为公共模版分离出去-->
<div data-am-widget="gotop" class="am-gotop am-gotop-fixed" >
    <a href="#top" title="回到顶部">
        <span class="am-gotop-title">回到顶部</span>
        <i class="am-gotop-icon am-icon-chevron-up"></i>
    </a>
</div>

<footer>
    <div class="content">
        <ul class="am-avg-sm-5 am-avg-md-5 am-avg-lg-5 am-thumbnails">
            <li><a href="#">联系我们</a></li>
            <li><a href="#">加入我们</a></li>
            <li><a href="#">合作伙伴</a></li>
            <li><a href="#">广告及服务</a></li>
            <li><a href="#">友情链接</a></li>
        </ul>
        <div class="btnlogo"><img src="/Public/HomeStyle/images/logo.png"/></div>
        <p>张 大师 出品    By 2017.6 </p>
        <div class="w2div">
            <!--<ul data-am-widget="gallery" class="am-gallery am-avg-sm-2
  am-avg-md-2 am-avg-lg-2 am-gallery-overlay" data-am-gallery="{ pureview: true }" >
                <li   class="w2">
                    <div class="am-gallery-item">
                        <a href="/Public/HomeStyle/Temp-images/dd.jpg">
                            <img src="/Public/HomeStyle/Temp-images/dd.jpg"/>
                            <h3 class="am-gallery-title">服务号：Amaze UI</h3>
                        </a>
                    </div>
                </li>
            </ul>-->
        </div>
    </div>
</footer>
<!--/Footer 作为公共模版分离出去-->
</body>
</html>