<?php
namespace Common\Controller;
use Common\Controller\BaseController;

/**
 * 用户基类控制器
 * @package Common\Controller
 */
class UserBaseController extends BaseController {
    /**
     * 初始化方法
     */
    public  function _initialize()
    {
        parent::_initialize();
        /**
         * 验证是否登录
         */
    }

}