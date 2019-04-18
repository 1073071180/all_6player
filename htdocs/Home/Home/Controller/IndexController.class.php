<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        //点击数排行的首页4张轮播图片
        $result = D('article')->getArticle();
        $this->assign('articles',$result);
        //按最新上传时间排序的8张图 1-4
        $result1_4 = D('article')->getArticle1_4();
        $this->assign('article1_4',$result1_4);
        //按最新上传时间排序的8张图 5-8
        $result5_8 = D('article')->getArticle5_8();
        $this->assign('article5_8',$result5_8);
        //按最新上传时间排序的8张图 9-16
        $result9_16 = D('article')->getArticle9_16();
        $this->assign('article9_16',$result9_16);

        //从零开始 找6个
        $user = D('user')->topUser(0,6);
        $this->assign('userMsg',$user);
        $this->display();
    }

}