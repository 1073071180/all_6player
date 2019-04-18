<?php
namespace Home\Controller;
use Think\Controller;
class OssController extends Controller {
    public function index(){
        echo 111;
    }

    public function ajaxUpload(){
        $this->display();
    }
}