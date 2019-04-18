<?php
/**
 * Created by PhpStorm.
 * User: 爱车小屋
 * Date: 2017/6/14
 * Time: 14:34
 */
namespace Extend\Controller;
use Think\Controller;
class BaseController extends Controller{
    protected function _initialize(){
        if( ! session('?username')){
            redirect('/admin.php/home/User/login', 2, '请登陆...');

            /*$this->display();
            exit();*/
        }
    }
}