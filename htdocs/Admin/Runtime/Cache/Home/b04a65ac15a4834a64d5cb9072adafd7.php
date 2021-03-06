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

<title>产品分类</title>
<link rel="stylesheet" href="/Public/Style/lib/zTree/v3/css/zTreeStyle/zTreeStyle.css" type="text/css">
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
                            <li><a href="javascript:;" onClick="myselfinfo('<?php echo (session('username')); ?>','<?php echo (session('create_time')); ?>')">个人信息</a></li>
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
        <dt><i class="Hui-iconfont">&#xe613;</i> 图片管理<?php echo (CONTROLLER_NAME); ?><i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
        <dd <?php if((CONTROLLER_NAME) == "Picture"): ?>style="display:block"<?php endif; ?>>
            <ul>
                <li>
                    <a href="/admin.php/home/Picture/pictureList" title="图片管理">图片管理</a>
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
                    <a href="http://h-ui.duoshuo.com/admin/" title="评论列表">评论列表</a>
                </li>
                <li>
                    <a href="/admin.php/home/feedback/feedbackList" title="意见反馈">意见反馈</a>
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


<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<!--/_menu 作为公共模版分离出去-->

<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 产品分类 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
	<div class="Hui-article">
		<article class="cl pd-20">
			<table class="table">
				<tr>
					<td width="200" class="va-t"><ul id="treeDemo" class="ztree"></ul></td>
					<td class="va-t"><iframe ID="testIframe" Name="testIframe" FRAMEBORDER=0 SCROLLING=AUTO width=100%  height=390px SRC="/admin.php/home/product/productCategoryAdd"></iframe></td>
				</tr>
			</table>
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
<script type="text/javascript" src="/Public/Style/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript" src="/Public/Style/lib/zTree/v3/js/jquery.ztree.all-3.5.min.js"></script>
<script type="text/javascript">
var setting = {
	view: {
		dblClickExpand: false,
		showLine: false,
		selectedMulti: false
	},
	data: {
		simpleData: {
			enable:true,
			idKey: "id",
			pIdKey: "pId",
			rootPId: ""
		}
	},
	callback: {
		beforeClick: function(treeId, treeNode) {
			var zTree = $.fn.zTree.getZTreeObj("tree");
			if (treeNode.isParent) {
				zTree.expandNode(treeNode);
				return false;
			} else {
				demoIframe.attr("src",treeNode.file + ".html");
				return true;
			}
		}
	}
};

var zNodes =[
	{ id:1, pId:0, name:"一级分类", open:true},
	{ id:11, pId:1, name:"二级分类"},
	{ id:111, pId:11, name:"三级分类"},
	{ id:112, pId:11, name:"三级分类"},
	{ id:113, pId:11, name:"三级分类"},
	{ id:114, pId:11, name:"三级分类"},
	{ id:115, pId:11, name:"三级分类"},
	{ id:12, pId:1, name:"二级分类 1-2"},
	{ id:121, pId:12, name:"三级分类 1-2-1"},
	{ id:122, pId:12, name:"三级分类 1-2-2"},
];

var code;

function showCode(str) {
	if (!code) code = $("#code");
	code.empty();
	code.append("<li>"+str+"</li>");
}

$(document).ready(function(){
	var t = $("#treeDemo");
	t = $.fn.zTree.init(t, setting, zNodes);
	demoIframe = $("#testIframe");
	demoIframe.bind("load", loadReady);
	var zTree = $.fn.zTree.getZTreeObj("tree");
	zTree.selectNode(zTree.getNodeByParam("id",'11'));
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>