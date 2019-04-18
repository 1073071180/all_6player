<?php
/**
 * Created by PhpStorm.
 * User: 爱车小屋
 * Date: 2017/6/12
 * Time: 15:57
 */
// 主页入口文件

// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
//中文编码
header('Content-Type: text/html; charset=utf8');
// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);

// 定义应用目录
define('APP_PATH','./Home/');
//定义项目入口控制器
//define('BIND_CONTROLLER','User');


// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单

echo '添加测试代码 _home';
echo '添加测试代码 _home master ';
echo '添加测试代码 _home test2_branch ';
echo '添加测试代码 commit and push  ';