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
    // thinkphp快捷查询用法 - getBy、getField、getFieldBy
    public function quickSelect(){
        /**
         * ① 查询用户名为 sen01 的这条数据
         * getBy 后边要跟一个字段，获取整条数据
         */
        // 常规情况
        $data = M('tp_getfield_user')->where(array('name' => 'sen01'))->find();

        // 使用 getby 简化为
        $data = M('tp_getfield_user')->getByName('sen01'); // 通过 name 字段获取整条数据
        $data = M('tp_getfield_user')->getByAvatar('sen01.jpg'); // 同理可得通过 avatar 字段获取整条数据
        $data = M('tp_getfield_user')->getById(1); // 同理可得通过 id 字段获取整条数据；但是如果 id 是主键的话，可以使用 find(id) 如下:
        $data = M('tp_getfield_user')->find(1); // 得到的结果和 M('tp_getfield_user')->getById(1); 是一样的
        // ①中几条语句打印结果均为：
        /*
        array(3) {
            ["id"] => string(1) "1"
            ["name"] => string(5) "sen01"
            ["avatar"] => string(9) "sen01.jpg"
        }
        */

        /**
         * ② 通过用户名，得到用户的图像
         * getFieldBy 后面要跟一个字段，括号内有两个参数:第一个跟 Field 对应的条件，第二个是要取得字段
         */
        // 常规情况
        $data = M('tp_getfield_user')->field('avatar')->where(array('name' => 'sen01'))->find();
        $avatar = $data['avatar'];

        // 使用 getField 简化为:
        $avatar = M('tp_getfield_user')->where(array('name' => 'sen01'))->getField('avatar');

        // 使用 getFieldBy 简化:
        $avatar = M('tp_getfield_user')->getFieldByName('sen01', 'avatar');
        // ②中几条语句打印结果均为:
        /**
         * string(9) "sen01.jpg"
         */

        /**
         * ③ 通过图像 获取使用这个图像的用户名
         * getField 的使用方法：
         * getField 是需要自己写where的；传的第一个参数就是需要获取的字段，如果只获取一条值的时候不需要传第二个参数；如果获取多个值得话，则第二个参数传true
         * 读取字段值其实就是获取数据表中的某个列的多个或者单个数据，最常用的方法时 getField 方法
         */
        // 常规情况
        $data = M('tp_getfield_user')->field('name')->where(array('avatar' => 'sen02.jpg'))->select();
        $name_array = array_column($data, 'name');

        // 使用 getField 简化:
        $avatar_array = M('tp_getfield_user')->where(array('avatar' => 'sen02.jpg'))->getField('name', true);
        // 打印结果
        /*
        array(2) {
            [0] => string(5) "sen02"
            [1] => string(5) "sen03"
        }
        */

        // 如果我们传入一个字符串分隔符 : ;那么返回的结果就是一个数组，键名是用户id，键值是 name:avatar 的输出字符串
        $data = M('tp_getfield_user')->getField('id, name, avatar', ':');
        // 打印结果
        /*
        array(3) {
            [1] => string(15) "sen01:sen01.jpg"
            [2] => string(15) "sen02:sen02.jpg"
            [3] => string(15) "sen03:sen02.jpg"
        }
        */

        // getField 方法还可以支持限制数量
        $data = M('tp_getfield_user')->getField('id, name', 2); // 限制返回2条记录
        // 打印结果
        /*
        array(2) {
            [1] => string(5) "sen01"
            [2] => string(5) "sen02"
        }
        */

        $data = M('tp_getfield_user')->getField('id', 2); // 获取id数组 限制2条记录
        // 打印结果
        /*
        array(2) {
            [0] => string(1) "1"
            [1] => string(1) "2"
        }
        */

        $this->display();
    }
}