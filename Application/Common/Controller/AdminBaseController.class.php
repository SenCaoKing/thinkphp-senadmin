<?php
namespace Common\Controller;
use Common\Controller\BaseController;
/**
 * admin 基类控制器
 * @package Common\Controller
 */
class AdminBaseController extends BaseController {
    /**
     * 初始化方法
     */
    public function _initialize()
    {
        parent::_initialize();
        /**
         * 后台访问权限、菜单分配等
         */
    }
}