<?php
/**
 * Created by PhpStorm.
 * User: 爱车小屋
 * Date: 2017/6/13
 * Time: 16:07
 */
namespace Home\Controller;
use Think\Controller;
class ArticleController extends Controller{
    //文章首页模板
    public function article(){
        //selectArticle(起始查询点，查询条数)
        $result0_4 = D('article')->selectArticle(0,4);
        $this->assign('article0_4',$result0_4);

        $result4_2 = D('article')->selectArticle(4,2);
        $this->assign('article4_2',$result4_2);

        $result6_10 = D('article')->selectArticle(6,10);
        $this->assign('article6_10',$result6_10);

        $this->display();
    }

    //添加文章
    public function articleAdd(){
        if ($_POST) {
            $data = I('POST.');
            $staffInfo = D('article');
            if( ! empty($data['picture_url'])){
                //l4p()->debug($data);
                $fileDir = C('DIR_AVATAR_IMG');
                $data['picture_url'] = $fileDir.$data['picture_url'];
            }
            //网页端用户上传文章  须审核 'article_type'=>1     3为审核通过
            $data['article_type']=1;
            //上传文章时，将存在session中的用户id取出作为文章的归属作者标记
            $userId = session('id');
            $data['writer'] = $userId;
            //创建对象，上传数据
            if ($staffInfo->create($data)) {
                $result = $staffInfo->add();
                if( ! $result){
                    $this->ajaxReturn(array('status' => 'error', 'message' => '添加失败，请稍后再试'));
                }
                $this->ajaxReturn(array('status' => 'success', 'message' => '提交成功，审核后显示'));
            } else {
                $this->ajaxReturn(array('status' => 'error', 'message' => $staffInfo->getError()));
            }
        } else {
            $this->display();
        }
    }
}