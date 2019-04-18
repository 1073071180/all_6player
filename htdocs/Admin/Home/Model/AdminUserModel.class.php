<?php
/**
 * Created by PhpStorm.
 * User: 爱车小屋
 * Date: 2017/6/9
 * Time: 10:22
 */
namespace Home\Model;
use Think\Model;
class AdminUserModel extends Model{

    //获取当前时间
    protected function getCurrentTime(){
        return date('Y-m-d H:i:s',time());
    }

    //登陆时查找用户名密码
    public function selectUser($username,$password){
        $result = M('admin_user')->where(array('username'=>$username,'password'=>$password))->find();
        return $result;
    }

    //根据username查询管理员详细信息
    public function selectList($username){
        $result = M('admin_user')->where(array('username'=>$username))->select();
        return $result;
    }

}