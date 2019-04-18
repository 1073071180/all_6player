<?php
return array(
	//'配置项'=>'配置值'
    'LOAD_EXT_CONFIG' => 'db,const,user',	//加载其他3个配置文件
    'SHOW_PAGE_TRACE' =>  true,
    'URL_PARAMS_BIND' =>  true, //设置参数绑定
    'SESSION_AUTO_START'    =>  true,    // 是否自动开启Session
    'SESSION_PREFIX'        =>  'user', // session 前缀

    //'DEFAULT_MODULE'       =>    'Home',  // 默认模块
    //'DEFAULT_CONTROLLER'    =>  'Index', // 默认控制器名称
    //'DEFAULT_ACTION'        =>  'index', // 默认操作名称
    //上传图片的各种参数
    'URL_CASE_INSENSITIVE'=>false,
    'SHOW_PAGE_TRACE'=>false,  // 显示页面Trace信息
    'DB_FIELDTYPE_CHECK'=>true,  // 开启字段类型验证
    'UPLOAD_IMAGE_MAX_SIZE'=>5242880,//2Mb,允许上传图片的最大尺寸(单位byte)
    'LOG_RECORD' => false,//开启日志记录
    'SESSION_OPTIONS'=>array('expire'=>3600*24),
    'COOKIE_EXPIRE'=> 3600*24,
    'VAR_PAGE'=>'p', //分页变量
    'SESSION_AUTO_START' =>true,
    'CACHE_DEFAULT_TIME'=> 12*3600, //默认缓存时间
    'URL_CASE_INSENSITIVE'=>FALSE, //url不区分大小写
    'ROOT'=>'/',//定义商家后台的目录
    'IMG_ALLOW'=>array('.jpg','.gif','.png'),//定义允许上传的图片类型
    'DIR_THUMB_IMG'=>'Upload/goods/'.date('Ymd').'/thumb/',//定义产品图片压缩图的存放目录
    'DIR_GOODS_IMG'=>'Upload/goods/'.date('Ymd').'/middle/',//定义产品图片压缩图的存放目录
    'DIR_SOURCE_IMG'=>'Upload/goods/'.date('Ymd').'/source/',//定义产品图片原图的存放目录
    'SIZE_THUMB_IMG'=>'200,200',//定义产品图片缩略图压缩宽度,高度
    'SIZE_GOODS_IMG'=>'420,420',//定义产品图片列表图压缩宽度,高度
    'DIR_AVATAR_IMG' => 'Upload/HeadPortrait/'.date('Ymd').'/'
);
