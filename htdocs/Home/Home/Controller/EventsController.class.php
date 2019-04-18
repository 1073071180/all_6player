<?php
/**
 * Created by PhpStorm.
 * User: 爱车小屋
 * Date: 2017/6/14
 * Time: 15:50
 */
namespace Home\Controller;
use Think\Controller;
class EventsController extends Controller{
    public function events(){
        if ($_POST){

        }else{
            $this->display();
        }
    }
}