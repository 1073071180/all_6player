<?php
/**
 * Created by PhpStorm.
 * User: 爱车小屋
 * Date: 2017/7/8
 * Time: 14:06
 */
namespace Home\Model;
use Think\Model\ViewModel;
class ArticleViewModel extends viewModel{
    public $viewFields = array(
        //用户表
        'user' => array(
            'id',
            'username',
            'picture_url',
            'signature', //用户签名
        ),
        //文章表
        'article' => array(
            'count(*)',
            'writer',
            '_on'=>'user.id = article.writer',
            '_type'=>'LEFT',
        ),
    );
}