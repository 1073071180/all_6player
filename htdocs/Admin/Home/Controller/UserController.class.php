<?php
/**
 * Created by PhpStorm.
 * User: 爱车小屋
 * Date: 2017/6/8
 * Time: 16:56
 */
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller{
    //属性$a判断是切换账户还是用户登出
    public $a=0;



    //admin登陆
    public function index(){

    }

    public function login(){
        if(session('?username')){
            redirect('/admin.php/home/Index/index');
        }
        //登陆，跳转
        $this->display();
    }

    //用户登录
    public function doLogin(){
        $username = I('POST.username');
        $password = I('POST.password');
        $result = D('admin_user')->selectuser($username,$password);
        if(!$result){
            redirect('/admin.php/home/user/login', 2, '用户名或密码有误，请重新登录');
        }

        $create_time = $result[create_time];
        //$_SESSION['username']=$username;
        session('username',$username);
        session('create_time',$create_time);
        redirect('/admin.php/home/Index/index', 2, '登录成功，2秒后跳转');
    }

    //用户登出
    public function quit(){
        unset($_SESSION['username']);
        //将整个session文件清空
        $_SESSION = array();
        //删除session文件
        session_destroy();

        if($this->a==0){
            redirect('/admin.php/home/user/login', 2, '退出成功，2秒后跳转');
        }
    }

    //切换账户
    public function SwitchAccount(){
        //用成员属性 $a 判断是切换账户还是退出
        $this->a=1;
        $this->quit();
        redirect('/admin.php/home/user/login', 2, '请登录新账户，2秒后跳转');
    }

    //添加用户/管理员
    public function add(){
        if ($_POST){
            $UserModel = D('admin_user');
            $UserModel->create($_POST);
            $result = $UserModel->add();
            if (!$result){
                echo '注册失败';
            }
            redirect('/admin.php/home/user/login', 2, '注册成功，2秒后跳转到登录页面');
        }else{
            $this->display();
        }

    }

    //ajax 提交查询用户信息 显示表单
    public function userList(){

        //$username = $_SESSION['username'];
        $username = session('username');

        $result = D('admin_user')->selectlist($username);
        if ($result){
            $this->ajaxreturn(array('status'=>'success','message'=>array($result=>username,$result=>create_time)));

        }else{
            $this->ajaxreturn(array('status'=>'error','message'=>$result->getError()));
        }

    }



}