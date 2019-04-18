<?php
/**
 * Created by PhpStorm.
 * User: 爱车小屋
 * Date: 2017/6/19
 * Time: 10:37
 */
namespace Home\Model;
use Think\Model;
class ArticleModel extends Model{

    protected $_auto = array(
        array('create_time','getCurrentTime',1,'callback'), // 对create_time字段在新增的时候写入当前时间戳
    );

    //获取文章列表
    public function articleList(){
        /*$number = M('staff');
        $result = $number->query("select count(b.belongStaffId) as count,s.* from wst_staff s LEFT JOIN wst_business b on s.id = b.belongStaffId where s.belong_user_id = {$userId} and s.belong_user_type = {$userType} and s.is_delete = 0 GROUP BY s.id;");
        return $result;*/
       $result = M('article')->where(array('is_delete'=>0))->order('id desc')->select();
        return $result;
    }

    //获取文章图片列表
    public function selectPicture(){
        $result = M('article')->select();
        return $result;
    }

    //获取当前时间
    protected function getCurrentTime(){
        return date('Y-m-d H:i:s',time());
    }

    //对文章做逻辑删除  is_delete =>1
    public function delArticle($id){
        $result = M('article')->where(array('id'=>$id))->save(array('is_delete'=>1));
        return $result;
    }

    //修改文章状态
    public function article_type($id,$article_type){
        $result = M('article')->where(array('id'=>$id))->save(array('article_type'=>$article_type));
        return $result;
    }

}