<?php
/**
 * Created by PhpStorm.
 * User: 爱车小屋
 * Date: 2017/6/9
 * Time: 10:22
 */
namespace Home\Model;
use Think\Model;
class UserModel extends Model{
    //创建数据对象user时自动完成创建时间 和 password的加密
    protected $_auto = array(
        array('create_time','getCurrentTime',1,'callback'),//注册时写入注册时间
        array('update_time','getCurrentTime',3,'callback'),//更新时修改update时间

        //     array('article_type','1'),  // 新增的时候把status字段设置为1
        //   array('password','md5',3,'function') , // 对password字段在新增和编辑的时候使md5函数处理
        //array('name','getName',3,'callback'), // 对name字段在新增和编辑的时候回调getName方法
        //  array('update_time','time',2,'function'), // 对update_time字段在更新的时候写入当前时间戳
    );

    //获取当前时间
    protected function getCurrentTime(){
        return date('Y-m-d H:i:s',time());
    }

    //登陆时查找用户名密码
    public function selectUser($username,$password){
        $result = M('user')->where(array('username'=>$username,'password'=>$password))->find();
        return $result;
    }

    //注册时查询用户名是否存在
   /* public function findUser($username, $selfId){
        $result = M('user')->where(array('username'=>$username,'id'=>array('neq',$selfId)))->find();
        return $result;
    }*/
    public function findUser($username){
        $result = M('user')->where(array('username'=>$username,))->find();
        return $result;
    }

    //根据username查询管理员详细信息
    public function selectList($username){
        $result = M('admin_user')->where(array('username'=>$username))->select();
        return $result;
    }

    //根据id查找用户的详细信息
    public function userMessage($id){
        $result = M('user')->where(array('id'=>$id))->find();
        return $result;
    }

    //遍历用户详细信息
    /*public function userMessage(){
        $result = M('user')->select();
        return $result;
    }*/


    //根据id查找用户密码是否正确
    public function selectUserById($id,$password){
        $result = M('user')->where(array('id'=>$id,'password'=>$password))->find();
        return $result;
    }

    //用户更改密码
    public function uploadPassword ($id,$password){
        $result = M('user')->where(array('id'=>$id))->save(array('password'=>$password));
        return $result;
    }

    //对指定用户的信息进行更改
    public function updateUserMsg($id,$data){
        $result = M('user')->where(array('id'=>$id))->save($data);
        return $result;
    }

    //找到人气最高的6个作者  根据文章数排行
    public function top6(){
        $result = M('user')->limit(6)->select();
        return $result;
    }

    //article_num文章数
    //根据参数找相应数量用户 按文章数排行
    public function topUser($start,$num){
        $result = M('user')->limit($start,$num)->select();
        return $result;
    }


}