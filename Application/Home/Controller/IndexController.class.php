<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $count = M('Articles')->count();
        $page = new \Org\Sen\Page($count, 1);
        $list = M('Articles')->order('id desc')->limit($page->firstRow.','.$page->listRows)->select();
        $show=$page->show();

        $this->assign('list', $list);
        $this->assign('page', $show);
        $this->display();
    }
}