<?php
/**
 * Created by PhpStorm.
 * User: 爱车小屋
 * Date: 2017/6/20
 * Time: 11:02
 */
namespace Home\Controller;
use Think\Controller;
//对文章详细页的处理 类
class NewsController extends Controller{
    public $id;
    //构造方法获取调用文章详细页时 传来的id
    public function _initialize(){
        $this->id = I('GET.id');
    }

    public function news(){
        //拿文章的详细信息
        $result = D('article')->detailedNew($this->id);
        $this->assign('news',$result);
        $this->display();
    }
}