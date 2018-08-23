<?php
namespace Admin\Controller;
use Common\Controller\AdminBaseController;
/**
 * 用户
 */
class UsersController extends AdminBaseController{

    /**
     * 用户列表
     */
    public function index(){
        $word=I('get.word', '');
        if(empty($word)){
            $map=array();
        }else{
            $map=array(
                'username'=>$word
            );
        }
        $assign=D('Users')->getAdminPage($map, 'register_time desc');
        $this->assign($assign);
        $this->display();
    }




}
