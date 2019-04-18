<?php
/**
 * Created by PhpStorm.
 * User: 爱车小屋
 * Date: 2017/6/26
 * Time: 14:00
 */
namespace Home\Model;
use Think\Model;
class categoryModel extends Model{
    //获取当前时间
    protected function getCurrentTime(){
        return date('Y-m-d H:i:s',time());
    }
}