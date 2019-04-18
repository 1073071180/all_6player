<?php if (!defined('THINK_PATH')) exit();?>﻿<!--_meta 作为公共模版分离出去-->
<!--Meta作为公共部分分离出来-->
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


    <!--引入插件-->
    <script type="text/javascript" src="/Public/js/jquery.min.js"></script>
    <!--引入图片上传文件-->
    <script type="text/javascript" src="/Public/js/ajaxfileupload.js"></script>
<!--/meta 作为公共模版分离出去-->

<title>资讯列表 - 资讯管理 - H-ui.admin v3.0</title>
<meta name="keywords" content="H-ui.admin v3.0,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.0，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<!--_header 作为公共模版分离出去-->

<!--_header 作为公共模版分离出去-->
<header class="navbar-wrapper">
    <div class="navbar navbar-fixed-top">
        <div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="/aboutHui.shtml">H-ui.admin</a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="/aboutHui.shtml">H-ui</a>
            <span class="logo navbar-slogan f-l mr-10 hidden-xs">v3.0</span>
            <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
            <nav class="nav navbar-nav">
                <ul class="cl">
                    <li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:;" onclick="article_add('添加资讯','article-add.html')"><i class="Hui-iconfont">&#xe616;</i> 资讯</a></li>
                            <li><a href="javascript:;" onclick="picture_add('添加资讯','picture-add.html')"><i class="Hui-iconfont">&#xe613;</i> 图片</a></li>
                            <li><a href="javascript:;" onclick="product_add('添加资讯','product-add.html')"><i class="Hui-iconfont">&#xe620;</i> 产品</a></li>
                            <li><a href="javascript:;" onclick="member_add('添加用户','member-add.html','','510')"><i class="Hui-iconfont">&#xe60d;</i> 用户</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
                <ul class="cl">
                    <li>欢迎管理员</li>
                    <li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A"><?php echo ($_SESSION['admin']['username']); ?><i class="Hui-iconfont">&#xe6d5;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:;" onclick="myselfInfo('<?php echo (session('username')); ?>','<?php echo (session('create_time')); ?>')">个人信息</a></li>
                            <li><a href="/admin.php/home/user/SwitchAccount">切换账户</a></li>
                            <li><a href="/admin.php/home/user/quit">退出</a></li>
                        </ul>
                    </li>
                    <li id="Hui-msg"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li>
                    <li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
                        <ul class="dropDown-menu menu radius box-shadow">
                            <li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
                            <li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
                            <li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
                            <li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
                            <li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
                            <li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
<!--/_header 作为公共模版分离出去-->
<!--/_header 作为公共模版分离出去-->

<!--_menu 作为公共模版分离出去-->


	<!--引入公共的左侧导航栏-->
	<aside class="Hui-aside">
<div class="menu_dropdown bk_2">
    <dl id="menu-article">
        <dt class="selected"><i class="Hui-iconfont">&#xe616;</i> 文章管理(占位，兼容手机)<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
        <dd <?php if((CONTROLLER_NAME) == "Article"): ?>style="display:block"<?php endif; ?>>
        <ul>
            <li class="current">
                <a href="/admin.php/home/Article/articleList" title="文章管理">文章管理</a>
            </li>
        </ul>
        </dd>
    </dl>

    <dl id="menu-article">
        <dt class="selected"><i class="Hui-iconfont">&#xe616;</i> 文章管理<?php echo (CONTROLLER_NAME); ?><i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
        <dd <?php if((CONTROLLER_NAME) == "Article"): ?>style="display:block"<?php endif; ?>>
            <ul>
                <li class="current">
                    <a href="/admin.php/home/Article/articleList" title="文章管理">文章管理</a>
                </li>
            </ul>
        </dd>
    </dl>

    <dl id="menu-picture">
        <dt><i class="Hui-iconfont">&#xe613;</i> 图片管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
        <dd <?php if((CONTROLLER_NAME) == "Picture"): ?>style="display:block"<?php endif; ?>>
            <ul>
                <li>
                    <a href="/admin.php/home/Picture/pictureList" title="图片管理">图片管理</a>
                </li>
            </ul>
        </dd>
    </dl>

    <dl id="menu-picture">
        <dt><i class="Hui-iconfont">&#xe613;</i>合作商管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
        <dd <?php if((CONTROLLER_NAME) == "Picture"): ?>style="display:block"<?php endif; ?>>
        <ul>
            <li>
                <a href="/admin.php/home/Picture/pictureList" title="图片管理">合作商管理</a>
            </li>
        </ul>
        </dd>
    </dl>

    <dl id="menu-product">
        <dt><i class="Hui-iconfont">&#xe620;</i> 产品管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
        <dd <?php if((CONTROLLER_NAME) == "Product"): ?>style="display:block"<?php endif; ?>>
            <ul>
                <li>
                    <a href="/admin.php/home/product/productBrand" title="品牌管理">品牌管理</a>
                </li>
                <li>
                    <a href="/admin.php/home/product/productCategory" title="分类管理">分类管理</a>
                </li>
                <li>
                    <a href="/admin.php/home/product/productList" title="产品管理">产品管理</a>
                </li>
            </ul>
        </dd>
    </dl>

    <dl id="menu-comments">
        <dt><i class="Hui-iconfont">&#xe622;</i> 评论管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
        <dd>
            <ul>
                <li>
                    <a href="/admin.php/home/feedback/feedback" title="评论列表">评论列表</a>
                </li>
                <li>
                    <a href="/admin.php/home/feedback/feedback" title="意见反馈">意见反馈</a>
                </li>
            </ul>
        </dd>
    </dl>

    <dl id="menu-member">
        <dt><i class="Hui-iconfont">&#xe60d;</i> 会员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
        <dd>
            <ul>
                <li>
                    <a href="/admin.php/home/member/memberList" title="会员列表">会员列表</a>
                </li>
                <li>
                    <a href="/admin.php/home/member/memberDel" title="删除的会员">删除的会员</a>
                </li>
                <li>
                    <a href="/admin.php/home/member/memberLevel" title="等级管理">等级管理</a>
                </li>
                <li>
                    <a href="/admin.php/home/member/memberScoreoperation" title="积分管理">积分管理</a>
                </li>
                <li>
                    <a href="/admin.php/home/member/memberRecordBrowse" title="浏览记录">浏览记录</a>
                </li>
                <li>
                    <a href="/admin.php/home/member/memberRecordDownload" title="下载记录">下载记录</a>
                </li>
                <li>
                    <a href="/admin.php/home/member/memberRecordShare" title="分享记录">分享记录</a>
                </li>
            </ul>
        </dd>
    </dl>

    <dl id="menu-admin">
        <dt><i class="Hui-iconfont">&#xe62d;</i> 管理员管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
        <dd>
            <ul>
                <li>
                    <a href="/admin.php/home/admin/adminRole.html" title="角色管理">角色管理</a>
                </li>
                <li>
                    <a href="/admin.php/home/admin/adminPermission.html" title="权限管理">权限管理</a>
                </li>
                <li>
                    <a href="/admin.php/home/admin/adminList.html" title="管理员列表">管理员列表</a>
                </li>
            </ul>
        </dd>
    </dl>

    <dl id="menu-tongji">
        <dt><i class="Hui-iconfont">&#xe61a;</i> 系统统计<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
        <dd>
            <ul>
                <li>
                    <a href="/admin.php/home/charts/charts_1.html" title="折线图">折线图</a>
                </li>
                <li>
                    <a href="/admin.php/home/charts/charts_2.html" title="时间轴折线图">时间轴折线图</a>
                </li>
                <li>
                    <a href="/admin.php/home/charts/charts_3.html" title="区域图">区域图</a>
                </li>
                <li>
                    <a href="/admin.php/home/charts/charts_4.html" title="柱状图">柱状图</a>
                </li>
                <li>
                    <a href="/admin.php/home/charts/charts_5.html" title="饼状图">饼状图</a>
                </li>
                <li>
                    <a href="/admin.php/home/charts/charts_6.html" title="3D柱状图">3D柱状图</a>
                </li>
                <li>
                    <a href="/admin.php/home/charts/charts_7.html" title="3D饼状图">3D饼状图</a>
                </li>
            </ul>
        </dd>
    </dl>

    <dl id="menu-system">
        <dt><i class="Hui-iconfont">&#xe62e;</i> 系统管理<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
        <dd>
            <ul>
                <li>
                    <a href="/admin.php/home/system/systemBase.html" title="系统设置">系统设置</a>
                </li>
                <li>
                    <a href="/admin.php/home/system/systemCategory.html" title="栏目管理">栏目管理</a>
                </li>
                <li>
                    <a href="/admin.php/home/system/systemData.html" title="数据字典">数据字典</a>
                </li>
                <li>
                    <a href="/admin.php/home/system/systemShielding.html" title="屏蔽词">屏蔽词</a>
                </li>
                <li>
                    <a href="/admin.php/home/system/systemLog.html" title="系统日志">系统日志</a>
                </li>
            </ul>
        </dd>
    </dl>
</div>
</aside>


<div class="dislpayArrow hidden-xs">
	<a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a>
</div>
<!--/_menu 作为公共模版分离出去-->

<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
		<span class="c-gray en">&gt;</span>
		资讯管理
		<span class="c-gray en">&gt;</span>
		资讯列表
		<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
	</nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<div class="text-c">
				<span class="select-box inline">
				<select name="" class="select">
					<option value="0">全部分类</option>
					<option value="1">分类一</option>
					<option value="2">分类二</option>
				</select>
				</span>
				日期范围：

				<!--TP框架与{}括号冲突  所以不用-->
				<input type="text" onfocus="WdatePicker()" id="logmin" class="input-text Wdate" style="width:120px;">
				-
				<input type="text" onfocus="WdatePicker()" id="logmax" class="input-text Wdate" style="width:120px;">
				<input type="text" name="" id="" placeholder=" 资讯名称" style="width:250px" class="input-text">
				<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜资讯</button>
			</div>
			<div class="cl pd-5 bg-1 bk-gray mt-20">
				<span class="l">
				<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
				<a class="btn btn-primary radius" data-title="添加资讯" href="/admin.php/home/Article/articleAdd" onclick="articleAdd('添加资讯','article-add.html')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加资讯</a>
				</span>
				<span class="r">共有数据：<strong>54</strong> 条</span>
			</div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-bg table-hover table-sort">
					<thead>
						<tr class="text-c">
							<th width="25"><input type="checkbox" name="" value=""></th>
							<th width="80">ID</th>
							<th>标题</th>
							<th width="200">缩略图</th>
							<th width="80">来源</th>
							<th width="120">创建时间</th>
							<th width="75">浏览次数</th>
							<th width="60">发布状态</th>
							<th width="120">操作</th>
						</tr>
					</thead>
					<tbody>
					     <?php if(is_array($articleLists)): $key = 0; $__LIST__ = $articleLists;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$article): $mod = ($key % 2 );++$key;?><tr class="text-c">
							<td><input type="checkbox" value="" name=""></td>
							<td><?php echo ($article["id"]); ?></td>
							<td  class="text-l"><u align="center"  style="cursor:pointer" class="text-primary" onClick="article_edit('查看','article-zhang.html','10002')" title="查看"><?php echo ($article["article_title"]); ?></u></td>
								<td><img style="width:100px;height:60px;" src="/<?php echo ($article["picture_url"]); ?>"  alt="预览图为空"></td>
							<td><?php echo ($article["come_from"]); ?></td>
							<td><?php echo ($article["create_time"]); ?></td>
							<td><?php echo ($article["click_number"]); ?></td>
								<td class="td-status">
									    <?php if($article["article_type"] == 0): ?><span class="label label-success radius">草稿</span>
									<?php elseif($article["article_type"] == 1): ?><span class="label label-success radius" style="background: rgba(94,119,255,0.87)">审核中..</span>
									<?php elseif($article["article_type"] == 2): ?><span class="label label-danger radius">未通过</span>
									<?php elseif($article["article_type"] == 3): ?><span class="label label-success radius">已发布</span>
									<?php elseif($article["article_type"] == 4): ?><span class="label label-defaunt radius">已下架</span><?php endif; ?></td>
							<td class="f-14 td-manage"><a style="text-decoration:none" onClick="article_shenhe(this,'<?php echo ($article["id"]); ?>')" href="javascript:;" title="审核">审核</a>
								<a style="text-decoration:none" class="ml-5" onClick="article_edit('资讯编辑','article-add.html','10001')" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a>
								<a style="text-decoration:none" class="ml-5" onClick="article_del(this,'<?php echo ($article["id"]); ?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
						    </tr><?php endforeach; endif; else: echo "" ;endif; ?>
					</tbody>
				</table>
			</div>
		</article>
	</div>
</section>

<!--_footer 作为公共模版分离出去-->
<!--Footer作为公共部分分离出来-->
<script type="text/javascript" src="/Public/Style/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Public/Style/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Public/Style/static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="/Public/Style/static/h-ui.admin/js/H-ui.admin.page.js"></script>
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="/Public/Style/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="/Public/Style/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src=/Public/Style/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
		//{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
		{"orderable":false,"aTargets":[0,8]}// 不参与排序的列
	]
});

/*资讯-添加*/
function articleAdd(title,url,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*资讯-编辑*/
function article_edit(title,url,id,w,h){
	var index = layer.open({
		type: 2,
		title: title,
		content: url
	});
	layer.full(index);
}
/*资讯-删除*/
function article_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.ajax({
			type: 'get',
			url: '/admin.php/home/Article/delArticle/id/'+id,
			dataType: 'json',
			success: function(data){
				$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
			},
			error:function(data) {
				console.log(data.msg);
				alert('删除失败');
			},
		});		
	});
}

/*资讯-审核*/
/*function article_shenhe(obj,id){
    layer.confirm('审核文章？', {
            btn: ['通过','不通过','取消'],
            shade: false,
            closeBtn: 0
        },
        function(){
            $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_start(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
            $(obj).remove();
            layer.msg('已发布', {icon:6,time:1000});
        },
        function(){
            $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_shenqing(this,id)" href="javascript:;" title="申请上线">申请上线</a>');
            $(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
            $(obj).remove();
            layer.msg('未通过', {icon:5,time:1000});
        });
}*/

/*资讯-发布*/
function article_shenhe(obj,id){
    layer.confirm('审核通过并发布？',{
        btn: ['发布','不通过','取消'],
            shade: false,
            closeBtn: 0
    },function(){
        $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_stop(this,'+id+')" href="javascript:;" title="下架"><i class="Hui-iconfont">&#xe6de;</i></a>');
        $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已发布</span>');
        $(obj).remove();
//console.log(id);
        article_type(id,3);
        layer.msg('已发布!',{icon: 6,time:1000});
    },function(){
        $(obj).parents("tr").find(".td-manage").prepend('<a class="c-primary" onClick="article_shenhe(this,'+id+')" href="javascript:;" title="重新审核">重新审核</a>');
        $(obj).parents("tr").find(".td-status").html('<span class="label label-danger radius">未通过</span>');
        $(obj).remove();

        article_type(id,2)
        layer.msg('未通过', {icon:5,time:1000});
    });
}

/*资讯-下架*/
function article_stop(obj,id){
    layer.confirm('确认要下架吗？',function(index){
        $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" onClick="article_shenhe(this,'+id+')" href="javascript:;" title="发布"><i class="Hui-iconfont">&#xe603;</i></a>');
        $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已下架</span>');
        $(obj).remove();

        article_type(id,4)
        layer.msg('已下架!',{icon: 5,time:1000});
    });
}

//异步更改文章状态 0草稿 1未审核 2审核未通过 3审核通过并发布 4已下架
function article_type(id,type) {
    console.log(id);
	$.ajax({
		type:'get',
		url:'/admin.php/home/Article/article_type/id/'+id+'/article_type/'+type,
		success:function (data) {
			//alert(data.msg)
        },
        error:function (data) {
			alert(data.msg)
			alert('请求失败');
        },
	})
}

/*资讯-申请上线*/
/*function article_shenqing(obj,id){
    $(obj).parents("tr").find(".td-status").html('<span class="label label-default radius">待审核</span>');
    $(obj).parents("tr").find(".td-manage").html("");
    layer.msg('已提交申请，耐心等待审核!', {icon: 1,time:2000});
}*/
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>