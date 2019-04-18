<?php
/**
 * @Author: Dave jiang
 * @Date:   2015-11-25 10:58:18
 * @Last Modified by:   anchen
 * @Last Modified time: 2015-11-25 11:05:11
 */
namespace Extend\Controller;
use Think\Controller;
class AdminAuthController extends Controller {
    public function _initialize() {
        !session('?isAdmin') && $this->redirect('/Admin/Login/index/');
    }
}