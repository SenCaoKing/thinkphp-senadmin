<?php
namespace Common\Controller;
use Common\Controller\BaseController;
/**
 * admin 基类控制器
 */
class AdminBaseController extends BaseController {
    /**
     * 初始化方法
     */
    public function _initialize(){
        parent::_initialize();

        // 分配菜单数据
        $nav_data=D('AdminNav')->getTreeData('level', 'order_number, id');
        $assign=array(
            'nav_data'=>$nav_data
        );
        // dump($nav_data);
        $this->assign($assign);
    }
}