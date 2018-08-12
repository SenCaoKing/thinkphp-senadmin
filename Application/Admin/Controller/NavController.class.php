<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 后台菜单管理
 */
class NavController extends AdminBaseController{
    /**
     * 菜单列表
     */
    public function index(){
        $data = D('AdminNav')->getTreeData('tree', 'order_number, id');
        $assign=array(
            'data'=>$data
        );
        $this->assign($assign);
        $this->display();
    }

    /**
     * 添加菜单
     */
    public function add(){
        $data = I('post.');
        unset($data['id']);
        $result = D('AdminNav')->addData($data);
        if ($result) {
            $this->success('添加成功', U('Admin/Nav/index'));
        }else{
            $this->error('添加失败');
        }

    }
}