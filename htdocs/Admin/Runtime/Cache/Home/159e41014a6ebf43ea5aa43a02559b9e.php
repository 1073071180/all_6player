<?php if (!defined('THINK_PATH')) exit();?><!--_meta 作为公共模版分离出去-->
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
        urls="/admin.php?c=Article&a=articleAdd";
        $.ajax({
            type: "POST",
            url:urls,
            data: data,
            success: function(result){
              //  console.log(result);
                if(result.status == 'success'){
                    alert('添加成功');
                    window.location.href="/admin.php/Home/Article/articleList";
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
            $.get("/admin.php?c=Upload&a=delImg&channel=normal&file="+img, function(result){
            });
        }

        $.ajaxFileUpload ({
            url :"/admin.php?c=Upload&a=uploadImg&channel=normal&inputName="+inputName+"&types="+types,
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
                        //$.get('/admin.php?c=Upload&a=uploadToCDN&channel=brand&fileName='+dataArr[1]);		//将图片提交到COS
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

</head>
<body>
<article class="page-container">
	<form action="" class="form form-horizontal" id="form-article-add">

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>文章标题：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="article_title" name="article_title">
			</div>
		</div>

		<!--<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类栏目：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select name="" class="select">
					<option value="0">全部栏目</option>
					<option value="1">新闻资讯</option>
					<option value="11">├行业动态</option>
					<option value="12">├行业资讯</option>
					<option value="13">├行业新闻</option>
				</select>
				</span> </div>
		</div>-->

		<!--<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>文章类型：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select name="" class="select">
					<option value="0">全部类型</option>
					<option value="1">帮助说明</option>
					<option value="2">新闻资讯</option>
				</select>
				</span> </div>
		</div>-->

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

		<!--<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">文章摘要：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,200)"></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
		</div>-->

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">文章作者：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="0" placeholder="" id="writer" name="writer">
			</div>
		</div>
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
				<a onclick="saveArticle();" class="btn btn-primary radius"><i class="Hui-iconfont">&#xe632;</i> 保存并上线</a>
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