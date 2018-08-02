<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    // 首页分页测试
    public function index(){
        $count = M('Articles')->count();
        $page = new \Org\Sen\Page($count, 1);
        $list = M('Articles')->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
        $show=$page->show();

        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->display();
    }

    // 自定义标签 ueditor
    public function ueditor(){
        $this->display();
    }
}