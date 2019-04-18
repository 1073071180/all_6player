<?php
/**
 * Created by PhpStorm.
 * User: 爱车小屋
 * Date: 2017/6/14
 * Time: 16:08
 */
namespace Home\controller;
use think\Controller;
class ReleaseController extends Controller{
    protected function _initialize(){
        if( ! session('?username')){
            redirect('/home.php/home/User/login', 2, '请登陆...');
        }

    }

    public function release(){

            $this->display();

    }
}