<?php
/**
 * Created by PhpStorm.
 * User: 爱车小屋
 * Date: 2017/8/1
 * Time: 16:23
 */

namespace Home\Controller;


class CommonController
{
    //验证码
    public function verify(){
        $Verify = new \Think\Verify();
        $Verify->entry();
    }

}