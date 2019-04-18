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

<!--banner-->
<div class="banner">
    <div class="am-g am-container">
        <!--轮播模块-->
        <div class="am-u-sm-12 am-u-md-12 am-u-lg-8">
            <div data-am-widget="slider" class="am-slider am-slider-c1" data-am-slider='{"directionNav":false}' >
                <ul class="am-slides">
                    <?php if(is_array($articles)): $key = 0; $__LIST__ = $articles;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($key % 2 );++$key;?><li>
                                <a href="/home.php/Home/news/news/id/<?php echo ($article["id"]); ?>"><img style="width: 820px;height: 400px" src="/<?php echo ($article["picture_url"]); ?>" alt="图片"></a>
                                <div class="am-slider-desc"><?php echo ($article["article_title"]); ?></div>

                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
        </div>

        <!--每日推荐-->
        <div class="am-u-sm-0 am-u-md-0 am-u-lg-4 padding-none" style="background: rgba(251,255,255,0.87);width: 420px;height: 400px;">
            <div class="star am-container"><span><img src="/Public/HomeStyle/images/star.png">每日推荐</span></div>
            <ul class="padding-none am-gallery am-avg-sm-2 am-avg-md-4 am-avg-lg-2 am-gallery-overlay" data-am-gallery="{ pureview: true }" >
                <?php if(is_array($article1_4)): $key = 0; $__LIST__ = $article1_4;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($key % 2 );++$key;?><li>
                        <div class="am-gallery-item">
                            <a href="/home.php/Home/news/news/id/<?php echo ($article["id"]); ?>">
                                <img style="width:203px;height: 150px" src="/<?php echo ($article["picture_url"]); ?>"  />
                                <h3 class="am-gallery-title"><?php echo ($article["article_title"]); ?></h3>
                                <div class="am-gallery-desc">2375-09-26</div>
                            </a>
                        </div>
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
</div>

<!--banner2-->
<!--周推荐，文章-->
<div class="am-container">
    <ul class="padding-none banner2 am-gallery am-avg-sm-2 am-avg-md-4 am-avg-lg-4 am-gallery-overlay" data-am-gallery="{ pureview: true }" >
        <?php if(is_array($article5_8)): $key = 0; $__LIST__ = $article5_8;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($key % 2 );++$key;?><li>
                <div class="am-gallery-item">
                    <a href="/home.php/Home/news/news/id/<?php echo ($article["id"]); ?>">
                        <img style="width: 305px;height: 140px;" src="/<?php echo ($article["picture_url"]); ?>"  alt="远方 有一个地方 那里种有我们的梦想"/>
                        <h3 class="am-gallery-title"><?php echo ($article["article_title"]); ?></h3>
                        <div class="am-gallery-desc">2375-09-26</div>
                    </a>
                </div>
            </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>

<!--news-->
<div class="am-g am-container newatype">
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-8 oh">
        <div data-am-widget="titlebar" class="am-titlebar am-titlebar-default" style="border-bottom: 0px; margin-bottom: -10px">
            <h2 class="am-titlebar-title ">
                热门资讯
            </h2>
            <nav class="am-titlebar-nav">
                <a href="#more">more &raquo;</a>
            </nav>
        </div>

        <div data-am-widget="list_news" style="background: rgba(251,255,255,0.5)" class="am-list-news am-list-news-default news">
            <div style="background: rgba(251,255,255,0.5)" class="am-list-news-bd">
                <ul class="am-list">
                    <?php if(is_array($article9_16)): $key = 0; $__LIST__ = $article9_16;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($key % 2 );++$key;?><li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left" data-am-scrollspy="{animation:'fade'}">
                                <div class="am-u-sm-5 am-list-thumb">
                                    <a href="/home.php/Home/news/news/id/<?php echo ($article["id"]); ?>">
                                        <img style="width: 315px;height: 158px; " src="/<?php echo ($article["picture_url"]); ?>" alt=<?php echo ($article["article_title"]); ?>/>
                                    </a>
                                </div>
                                <div class=" am-u-sm-7 am-list-main">
                                    <h3 class="am-list-item-hd"><a href="/home.php/home/category/publicCategory/id/<?php echo ($user["id"]); ?>"><?php echo ($article["article_title"]); ?></a></h3>
                                    <div class="am-list-item-text"><?php echo ($article["content"]); ?></div>
                                </div>

                                </li>
                                <div class="newsico am-fr">
                                    <i class="am-icon-clock-o"><?php echo ($article["create_time"]); ?></i>
                            <i class="am-icon-hand-pointer-o"><?php echo ($article["Fabulous"]); ?></i>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>


            </div>



            <a href="#"><img src="/Public/HomeStyle/Temp-images/ad2.png" class="am-img-responsive" width="100%"/></a>

            <div class="am-hide-sm">
                <div data-am-widget="titlebar" class="am-titlebar am-titlebar-default">
                    <h2 class="am-titlebar-title ">
                        热门资讯
                    </h2>
                    <!--<nav class="am-titlebar-nav">
                        <a href="#more" onClick="$('.case').hide();$('#youxi').show();">游戏案例</a>
                        <a href="#more" onClick="$('.case').hide();$('#yingxiao').show();">营销案例</a>
                        <a href="#more" onClick="$('.case').hide();$('#gongju').show();">工具案例</a>
                    </nav>-->
                </div>


                <div id="youxi" class="case am-animation-slide-left">
                    <ul class="am-gallery am-avg-sm-2 am-avg-md-4 am-avg-lg-4 am-gallery-overlay" data-am-gallery="{ pureview: true }" >
                        <li>
                            <div class="am-gallery-item">
                                <a href="/Public/HomeStyle/Temp-images/dd.jpg">
                                    <img src="/Public/HomeStyle/Temp-images/cc.jpg" data-replace-img="/Public/HomeStyle/Temp-images/dd.jpg" alt="远方 有一个地方 那里种有我们的梦想"/>
                                    <h3 class="am-gallery-title">远方 有一个地方 那里种有我们的梦想</h3>
                                    <div class="am-gallery-desc">2375-09-26</div>
                                </a>
                            </div>
                        </li>

                    </ul>
                </div>

                <div id="yingxiao" class="case am-animation-slide-right dn">
                    <ul class="am-gallery am-avg-sm-2 am-avg-md-4 am-avg-lg-4 am-gallery-overlay" data-am-gallery="{ pureview: true }" >
                        <li>
                            <div class="am-gallery-item">
                                <a href="/Public/HomeStyle/Temp-images/dd.jpg">
                                    <img src="/Public/HomeStyle/Temp-images/cc.jpg" data-replace-img="/Public/HomeStyle/Temp-images/dd.jpg" alt="远方 有一个地方 那里种有我们的梦想"/>
                                    <h3 class="am-gallery-title">远方 有一个地方 那里种有我们的梦想</h3>
                                    <div class="am-gallery-desc">2375-09-26</div>
                                </a>
                            </div>
                        </li>

                    </ul>
                </div>


                <div id="gongju" class="dn case am-animation-slide-right">
                    <ul class="am-gallery am-avg-sm-2 am-avg-md-4 am-avg-lg-4 am-gallery-overlay" data-am-gallery="{ pureview: true }" >
                        <li>
                            <div class="am-gallery-item">
                                <a href="/Public/HomeStyle/Temp-images/dd.jpg">
                                    <img src="/Public/HomeStyle/Temp-images/cc.jpg" data-replace-img="/Public/HomeStyle/Temp-images/dd.jpg" alt="远方 有一个地方 那里种有我们的梦想"/>
                                    <h3 class="am-gallery-title">远方 有一个地方 那里种有我们的梦想</h3>
                                    <div class="am-gallery-desc">2375-09-26</div>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="am-u-sm-12 am-u-md-12 am-u-lg-4" >
        <div data-am-widget="titlebar" class="am-titlebar am-titlebar-default">
            <h2 class="am-titlebar-title ">
                个人专栏
            </h2>
            <nav class="am-titlebar-nav">
                <a href="#more">more &raquo;</a>
            </nav>
        </div>
        <div data-am-widget="list_news" style="background: rgba(251,255,255,0.5)" class="am-list-news am-list-news-default right-bg" data-am-scrollspy="{animation:'fade'}">
                <ul class="am-list"  >
                    <?php if(is_array($userMsg)): $i = 0; $__LIST__ = $userMsg;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?><li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">
                            <div class="am-u-sm-4 am-list-thumb">
                                <a href="/home.php/home/category/publicCategory/id/<?php echo ($user["id"]); ?>">
                                    <img style="width: 96px;height: 96px;" src="/<?php echo ($user["picture_url"]); ?>" class="face"/>
                                </a>
                            </div>

                            <div class=" am-u-sm-8 am-list-main">
                                <h3 class="am-list-item-hd"><a href="/home.php/home/category/publicCategory/id/<?php echo ($user["id"]); ?>"><?php echo ($user["username"]); ?></a></h3>

                                <div class="am-list-item-text"><?php echo ($user["signature"]); ?></div>
                            </div>
                        </li>
                        <hr data-am-widget="divider" style="" class="am-divider am-divider-default" /><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
        </div>

        <div data-am-widget="titlebar" class="am-titlebar am-titlebar-default">
            <h2 class="am-titlebar-title ">
                合作专栏
            </h2>
            <nav class="am-titlebar-nav">
                <a href="#more">more &raquo;</a>
            </nav>
        </div>

        <div data-am-widget="list_news" class="am-list-news am-list-news-default right-bg" data-am-scrollspy="{animation:'fade'}">
            <ul class="am-list">
                <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">
                    <div class="am-u-sm-4 am-list-thumb">
                        <a href="/home.php/home/category/publicCategory/id/<?php echo ($user["id"]); ?>">
                            <img src="/Public/HomeStyle/Temp-images/face.jpg" class="face"/>
                        </a>
                    </div>

                    <div class=" am-u-sm-8 am-list-main">
                        <h3 class="am-list-item-hd"><a href="/home.php/home/category/publicCategory/id/<?php echo ($user["id"]); ?>">勾三古寺</a></h3>

                        <div class="am-list-item-text">代码压缩和最小化。在这里，我们为你收集了9个最好的JavaScript压缩工具将帮</div>
                    </div>
                </li>
                <hr data-am-widget="divider" style="" class="am-divider am-divider-default" />
            </ul>
        </div>


       <!-- <div data-am-widget="titlebar" class="am-titlebar am-titlebar-default">
            <h2 class="am-titlebar-title ">
                评测
            </h2>
            <nav class="am-titlebar-nav">
                <a href="#more">more &raquo;</a>
            </nav>
        </div>


        <div data-am-widget="list_news" class="am-list-news am-list-news-default right-bg" data-am-scrollspy="{animation:'fade'}">
            <ul class="am-list"  >
                <li class="am-g am-list-item-desced am-list-item-thumbed am-list-item-thumb-left">
                    <div class="am-u-sm-4 am-list-thumb">
                        <a href="/home.php/home/category/publicCategory/id/<?php echo ($user["id"]); ?>">
                            <img src="/Public/HomeStyle/Temp-images/face.jpg"/>
                        </a>
                    </div>

                    <div class=" am-u-sm-8 am-list-main">
                        <h3 class="am-list-item-hd"><a href="/home.php/home/category/publicCategory/id/<?php echo ($user["id"]); ?>">勾三古寺</a></h3>

                        <div class="am-list-item-text">代码压缩和最小化。在这里，我们为你收集了9个最好的JavaScript压缩工具将帮</div>
                    </div>
                </li>
                <hr data-am-widget="divider" style="" class="am-divider am-divider-default" />

            </ul>
        </div>
-->

        <ul class="am-gallery am-avg-sm-1
  am-avg-md-1 am-avg-lg-1 am-gallery-default" data-am-gallery="{ pureview: true }" >
            <li>
                <div class="am-gallery-item">
                    <a href="http://s.amazeui.org/media/i/demos/bing-1.jpg" class="">
                        <img src="http://s.amazeui.org/media/i/demos/bing-1.jpg"  alt="远方 有一个地方 那里种有我们的梦想"/>
                        <h3 class="am-gallery-title">远方 有一个地方 那里种有我们的梦想</h3>
                        <div class="am-gallery-desc">
                            <div class="am-fr">北京</div>
                            <div class="am-fl">2016/11/11</div>
                        </div>
                    </a>
                </div>
            </li>
            <li>
                <div class="am-gallery-item">
                    <a href="http://s.amazeui.org/media/i/demos/bing-2.jpg" class="">
                        <img src="http://s.amazeui.org/media/i/demos/bing-2.jpg"  alt="某天 也许会相遇 相遇在这个好地方"/>
                        <h3 class="am-gallery-title">某天 也许会相遇 相遇在这个好地方</h3>
                        <div class="am-gallery-desc">
                            <div class="am-fr">北京</div>
                            <div class="am-fl">2016/11/11</div>
                        </div>
                    </a>
                </div>
            </li>
            <li>
                <div class="am-gallery-item">
                    <a href="http://s.amazeui.org/media/i/demos/bing-2.jpg" class="">
                        <img src="http://s.amazeui.org/media/i/demos/bing-2.jpg"  alt="某天 也许会相遇 相遇在这个好地方"/>
                        <h3 class="am-gallery-title">某天 也许会相遇 相遇在这个好地方</h3>
                        <div class="am-gallery-desc">
                            <div class="am-fr">北京</div>
                            <div class="am-fl">2016/11/11</div>
                        </div>
                    </a>
                </div>
            </li>
        </ul>
    </div>
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