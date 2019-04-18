<?php
/**
 * Thinkphp控制器扩展，自动验证登录状态及错误处理跳转
 * @Author: Dave Jiang
 * @Date:   2015-10-07 16:23:21
 * @Last Modified by:   anchen
 * @Last Modified time: 2015-11-21 17:54:11
 */
namespace Extend\Controller;
use Think\Controller;
class LoginAuthController extends Controller {

    //页面权限判断
    protected function _initialize() {
        if(session('?isLogin')){                            //判断是否已经登录
            if(session('loginRole') != C('LOGIN_ROLE_CARRIER') && MODULE_NAME == 'Logistics'){     // 进入物流商后台,应该登录为物流商
                if (IS_AJAX) {
                    $this->ajaxReturn(array("result"=>false,"errorCode"=>"ERROR_CODE_NO_LOGIN",'failureDetail'=>"login is required."));
                } else {
                    $redirect_url = urlencode(__SELF__);
                    $this->redirect('/Member/Login/carrier_login/',array('redirect_url'=>$redirect_url),0);
                }
            } else if(session('loginRole') != C('LOGIN_ROLE_SHIPPER') && (MODULE_NAME == 'Member' || MODULE_NAME == 'Shipping')) { // 进入发货方后台,应该登录为发货方
                if (IS_AJAX) {
                    $this->ajaxReturn(array("result"=>false,"errorCode"=>"ERROR_CODE_NO_LOGIN",'failureDetail'=>"login is required."));
                } else {
                    $redirect_url = urlencode(__SELF__);
                    $this->redirect('/Member/Login/shipper_login/',array('redirect_url'=>$redirect_url),0);
                }
            } else {
                $userID = session('userID');
                $handler = D('Member/error');
                $errorList = $handler->getErrorList($userID,'',0,1);          //获取用户所有错误信息
                $errorList &&  $this->redirect($errorList[0]['error_field']); //如果有严重的错误信息，跳转到错误信息处理页
            }
        } else { 
            if (IS_AJAX) {
                $this->ajaxReturn(array("result"=>false,"errorCode"=>"ERROR_CODE_NO_LOGIN",'failureDetail'=>"login is required."));
            } else {
                $redirect_url = urlencode(__SELF__);

                //$url 需要跳转的登录页面
                if(MODULE_NAME === 'Member'){
                    $url = '/Member/Login/shipper_login/';
                }elseif(MODULE_NAME === 'Logistics'){
                    $url = '/Member/Login/carrier_login/';
                }

                header('content-type:text/html;charset=utf8');
                $this->redirect($url,array('redirect_url'=>$redirect_url),0,'登录超时，请重新登录!');
            }
        }
    }
}