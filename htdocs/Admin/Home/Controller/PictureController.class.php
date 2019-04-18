<?php
/**
 * Created by PhpStorm.
 * User: 爱车小屋
 * Date: 2017/6/9
 * Time: 19:51
 */
namespace Home\Controller;
use Extend\Controller\BaseController;
class PictureController extends BaseController{
    //图片管理回传数据
    public function pictureList(){
        $result = D('article')->selectPicture();
        $this->assign("pictures",$result);
        $this->display();

    }

    public function pictureAdd(){
        if ($_POST){

        }else{
            $this->display();
        }
    }
}