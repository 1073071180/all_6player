<?php
/**
 * Created by PhpStorm.
 * User: 爱车小屋
 * Date: 2017/6/14
 * Time: 16:22
 */
namespace Home\Controller;
use Think\Controller;
class MyArticleController extends Controller
{
    //我的文章访问控制
    protected function _initialize()
    {
        if (!session('?username')) {
            redirect('/home.php/home/User/login', 2, '请登陆...');
        }

    }

    public function MyArticle()
    {
        $userId = session('id');
        $username = session('username');
        //根据用户id查询用户详细信息
        $userMessage = D('user')->userMessage($userId);
        $this->assign('user', $userMessage);
        //根据用户id查找用户文章
        $result = D('article')->selectMyarticle($userId);
        $this->assign('myArticle', $result);

        //联查出作者的文章数
        $articleNum = D('ArticleView')->where(array('username'=>$username))->count(1);
        $this->assign('number',$articleNum);
        $this->display();
    }


}