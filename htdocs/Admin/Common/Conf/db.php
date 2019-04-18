<?php
/**
 * Created by PhpStorm.
 * User: 爱车小屋
 * Date: 2017/4/25
 * Time: 14:25
 */
//连接正式服务器
return array(
    //'配置项'=>'配置值'
    'DB_TYPE' => 'mysql',
    'DB_HOST' => '193.112.181.35',
    'DB_NAME' => '6player',
    'DB_USER' => 'root',
    'DB_PWD' => '123456',
    'DB_PORT' => '3306',
    'DB_CHARSET' => 'utf8',
    'DB_PARAMS' => array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL),
);

/*    原aliyun 共享服务器数据库配置
 * return array(
    //'配置项'=>'配置值'
    'DB_TYPE' => 'mysql',
    'DB_HOST' => 'bdm263446320.my3w.com',
    'DB_NAME' => 'bdm263446320_db',
    'DB_USER' => 'bdm263446320',
    'DB_PWD' => '571902834',
    'DB_PORT' => '3306',
    'DB_CHARSET' => 'utf8',
    'DB_PARAMS' => array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL),
);*/

//连接本地 uiadmin.com
/*return array(
    //'配置项'=>'配置值'
    'DB_TYPE' => 'mysql',
    'DB_HOST' => '127.0.0.1',
    'DB_NAME' => 'uiadmin',
    'DB_USER' => 'root',
    'DB_PWD' => 'root',
    'DB_PORT' => '3307',
    'DB_CHARSET' => 'utf8',
    'DB_PARAMS' => array(\PDO::ATTR_CASE => \PDO::CASE_NATURAL),
);*/