<?php
/**
 * Created by PhpStorm.
 * User: 爱车小屋
 * Date: 2017/6/9
 * Time: 17:48
 */
namespace Home\Controller;
use Extend\Controller\BaseController;
class ArticleController extends BaseController{
    //显示文章管理列表
    public function articleList(){
        $result = D('article')->articleList();
        $this->assign('articleLists',$result);
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

            //admin上传文章  直接审合通过  article_type = 3
            $data['article_type']=3;

            if ($staffInfo->create($data)) {
                $result = $staffInfo->add();
                if( ! $result){
                    $this->ajaxReturn(array('status' => 'error', 'message' => '添加失败，请稍后再试'));
                }
                $this->ajaxReturn(array('status' => 'success', 'message' => '添加成功'));
            } else {
                $this->ajaxReturn(array('status' => 'error', 'message' => $staffInfo->getError()));
            }
        } else {
            $this->display();
        }
    }

    //删除文章 逻辑删除
    public function delArticle(){
        $id = I('get.id');
        $result = D('article')->delArticle($id);
        if (!$result){
            $this->ajaxReturn(array('status'=>'error','msg'=>'删除失败'));
        }
        $this->ajaxReturn(array('status'=>'success','msg'=>'删除成功'));
    }

    //审核 修改文章状态
    public function article_type(){
        $id = I('get.id');
        $article_type = I('article_type');
        $result = D('article')->article_type($id,$article_type);
        if (false === $result){
            $this->ajaxReturn(array('status'=>'error','msg'=>'修改失败'));
        }
        $this->ajaxReturn(array('status'=>'success','msg'=>'修改成功'));
    }


}