<?php
/**
 * Created by PhpStorm.
 * User: 爱车小屋
 * Date: 2017/6/19
 * Time: 15:58
 */
namespace Home\Model;
use Think\Model;
class ArticleModel extends Model{
    //获取当前时间
    protected function getCurrentTime(){
        return date('Y-m-d H:i:s',time());
    }

    //首页Index输出数据4张轮播图片 按点击数排序
    public function getArticle(){
        $result = M('article')->order('click_number desc')->where(array('article_type'=>3,'is_delete'=>0))->limit(4)->select();
        return $result;
    }
    //首页Index输出8张图片按上传时间排序
    public function getArticle1_4(){
        $result = M('article')->order('create_time asc')->where(array('article_type'=>3,'is_delete'=>0))->limit(4)->select();
        return $result;
    }
    public function getArticle5_8(){
        $result = M('article')->order('create_time asc')->where(array('article_type'=>3,'is_delete'=>0))->limit(4,4)->select();
        return $result;
    }
    //首页Index输出9-16图片按上传时间排序
    public function getArticle9_16(){
        $result = M('article')->order('create_time asc')->where(array('article_type'=>3,'is_delete'=>0))->limit(8,8)->select();
        return $result;
    }
    //输出文章详细页
    public function detailedNew($id){
        $this->clickNum($id);
        $result = M('article')->where(array('id'=>$id,'article_type'=>3,'is_delete'=>0))->find();
        return $result;
    }
    //个人文章列表 文章简略遍历
    public function allArticle($id){
        $result = M('article')->where(array('writer'=>$id,'article_type'=>3,'is_delete'=>0))->select();
        return $result;
    }
    //进入文章详细页时 文章点击数+1的逻辑
    protected function clickNum($id){
        $clickNum = $this->getClickNum($id);
        $newClickNum = $clickNum+1;
        $this->updateClickNum($id,$newClickNum);
    }
    //获取文章的点击数
    public function getClickNum($id){
        $result = M('article')->where(array('id'=>$id))->field('click_number')->find();
        return $result['click_number'];
    }
    //更新文章点击数
    public function updateClickNum($id,$newClickNum){
        M('article')->where(array('id'=>$id))->save(array('click_number'=>$newClickNum));
    }
    //根据用户id查找用户本人的文章
    public function selectMyarticle($userId){
        $result = M('article')->where(array('writer'=>$userId))->select();
        return $result;
    }

    //查找文章（查询起始位置，查询条数）
    public function selectArticle($start,$num){
        $result = M('article')->where(array('article_type'=>3,'is_delete'=>0))->order('click_number desc')->limit($start,$num)->select();
        return $result;
    }



}