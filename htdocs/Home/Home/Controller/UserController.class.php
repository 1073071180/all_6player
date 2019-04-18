<?php
/**
 * Created by PhpStorm.
 * User: 爱车小屋
 * Date: 2017/6/13
 * Time: 10:15
 */
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
class UserController extends Controller{

    //在数据库中查找用户是否存在
    protected function findUser($username,$password){
        $result = D('user')->selectuser($username,$password);
        if (!$result){
            return false;
            exit();
        }
        session('username',$username);
        session('id',$result['id']);
        session('picture',$result['picture_url']);
        /*$_SESSION['username']=$username;
        $_SESSION['id']=$result['id'];*/
        return true;
    }

    //用户登录  同步登录
    public function login(){
        if ($_POST){
            $username = I('POST.username');
            $password = I('POST.password');

            $this->assign('message',$username);

            if(false === $this->findUser($username, $password)){
                redirect('/home.php/home/user/login', 1, '登录失败');
            }
           redirect('/home.php/home/index/index', 1, '登录成功');
        }else{
            $this->display();
        }
    }

    //Index页面用户异步登录
    public function ajaxLogin()
    {
        if ($_POST) {
            $username = I('POST.username');
            $password = I('POST.password');
            if ( ! $this->findUser($username, $password)) {
                $this->ajaxreturn(array('status' => 'error', 'message' => '登录失败，用户名或密码错误'));
            }
            $this->ajaxreturn(array('status' => 'success', 'message' => '登录成功'));
        }else{
            $this->display();
        }
    }

    //Header点击发布文章 时检查是否登录
    public function ajaxCheck(){
        if (!session('username')){
            $this->ajaxreturn(array('status'=>2,'message'=>'该功能需要登陆'));
        }
        $this->ajaxreturn(array('status'=>1,'message'=>'已经登录'));
    }

    //用户登出
    public function logout(){
            //session_start();
            unset($_SESSION['id']);
            unset($_SESSION['username']);
            //将整个session文件清空
            $_SESSION = array();
            //删除session文件
            session_destroy();

        redirect('/home.php/home/index/index', 1, '退出成功，即将返回首页');
    }


    //检验验证码
    //检测输入的验证码是否正确， $code为用户输入的验证码字符串
    public function check_verify($code, $id = ''){
            $verify = new \Think\Verify();
            return $verify->check($code, $id);}


    //用户注册
    public function add(){
        if ($_POST){
            //查询要注册的用户名是否存在
            $username = I('POST.username');
            $findUser = D('user')->findUser($username);
            if ($findUser){
                redirect('/home.php/home/user/add', 1, '用户名已存在');
                exit();
            }




            $userModel = D('user');
            //修改上传时图片文件的名字，将图片储存的路径拼接在前面
            $data = I('POST.');
            if( ! empty($data['picture_url'])){
                $fileDir = C('DIR_AVATAR_IMG');
                $data['picture_url'] = $fileDir.$data['picture_url'];
            }
            $userModel->create($data);
            $result = $userModel->add();
            if (!$result){
                echo '注册失败';
                exit();
            }

            //注册成功，直接登录
            if(true === $this->findUser($_POST['username'],$_POST['password'])){
                redirect('/home.php/home/index/index', 1, '登录成功');
            }
        }else{
            $this->display();
        }
    }

    //用户更改个人信息模板
    public function uploadMsg(){
        if ($_POST){
            //要更改的用户id
            $id = session('id');
            //查询要注册的用户名是否存在
            $username = I('POST.username');
            $findUser = D('user')->findUser($username,$id);
            if ($findUser){
                $this->ajaxreturn(array('status'=>'repeat','msg'=>'用户名已存在'));
            }
            //验证手机号码是否合法

            //修改上传时图片文件的名字，将图片储存的路径拼接在前面
            $data = I('POST.');
            if( ! empty($data['picture_url'])){
                $fileDir = C('DIR_AVATAR_IMG');
                $data['picture_url'] = $fileDir.$data['picture_url'];
            }
            $result = D('user')->updateUserMsg($id,$data);
            if ( !$result ){
                $this->ajaxreturn(array('status'=>'error','msg'=>'没有数据被更改'));
            }
            session('username',$data['username']);
            session('picture',$data['picture_url']);
            $this->ajaxreturn(array('status'=>'success','msg'=>'更新成功'));


        }else{
            $id = session('id');
            //查询用户的信息在更改时填入信息栏中
            $userMsg = D('user')->userMessage($id);
            $this->assign('Msg',$userMsg);
            $this->display();
        }
    }

    //根据id查询用户的密码是否正确
    public function selectPassword(){
        $id = session(id);
        if ($_POST){
            $password = I('post.password');
            $result = D('user')->selectUserById($id,$password);
            if (!$result){
                $this->ajaxreturn(array('status'=>1,'msg'=>'密码错误，请重新输入'));
                return false;
            }
            $this->ajaxreturn(array('status'=>2,'msg'=>'密码正确!'));
        }else{
            $this->display();
        }
    }

    //更新用户的密码
    public function uploadPassword(){
        $id = session(id);
        if ($_POST){
            $password = I('post.password');
            if (strlen($password)<6 or strlen($password)>16){
                $this->ajaxreturn(array('status'=>2,'msg'=>'修改失败,密码长度不合法'));
            }
            $result = D('user')->uploadPassword($id,$password);
            if (!$result){
                $this->ajaxreturn(array('status'=>1,'msg'=>'修改失败'));
            }
            $this->ajaxreturn(array('status'=>10,'msg'=>'修改成功'));
        }else{
            $this->display();
        }
    }



}