<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 后台权限管理
 */
class RuleController extends AdminBaseController{

    //************ 权限 ***********
    /**
     * 权限列表
     */
    public function index(){
        $data=D('AuthRule')->getTreeData('tree', 'id', 'title');
        $assign=array(
            'data'=>$data
        );
        $this->assign($assign);
        $this->display();
    }

    /**
     * 添加权限
     */
    public function add(){
        $data=I('post.');
        unset($data['id']);
        $result=D('AuthRule')->addData($data);
        if($result){
            $this->success('添加成功', U('Admin/Rule/index'));
        }else{
            $this->error('添加失败');
        }
    }

    /**
     * 修改权限
     */
    public function edit(){
        $data=I('post.');
        $map=array(
            'id'=>$data['id']
        );
        $result=D('AuthRule')->editData($map, $data);
        if($result){
            $this->success('修改成功', U('Admin/Rule/index'));
        }else{
            $this->error('修改失败');
        }
    }

    /**
     * 删除权限
     */
    public function delete(){
        $id=I('get.id');
        $map=array(
            'id'=>$id
        );
        $result=D('AuthRule')->deleteData($map);
        if($result){
            $this->success('删除成功', U('Admin/Rule/index'));
        }else{
            $this->error('请先删除子权限');
        }
    }

}