<?php
/**
 * Created by PhpStorm.
 * User: 爱车小屋
 * Date: 2017/6/14
 * Time: 15:39
 */
namespace Home\Controller;
use Think\Controller;
class CategoryController extends Controller{
    public $id;
    //构造方法获取调用文章详细页时 传来的id
    public function _initialize(){
        $this->id = I('GET.id');
    }

    public function category(){
        $result = D('user')->top6();
        $this->assign('users',$result);
        $this->display();
    }


    public function publicCategory(){
        $article = D('article')->allArticle($this->id);
        $this->assign('articles',$article);
        $users = D('user')->userMessage($this->id);
        $this->assign('users',$users);

        //联查出作者的文章数
        $articleNum = D('ArticleView')->where(array('id'=>$this->id))->count(1);
        $this->assign('number',$articleNum);
        $this->display();
    }

    //category页面联查出作者的信息，根据作者发布的文章数量排序
    public function orderByArticleNum(){
        $result = D('ArticleViem')->order()->limit()->select();
        
    }

}