<?php
namespace Common\Model;
use Common\Model\BaseModel;
/**
 * 菜单操作model
 */
class AdminNavModel extends BaseModel{

    /**
     * 添加数据
     * @param  array $data 添加的数据
     * @return int         新增的数据id
     */
    public function addData($data){
        // 去除键值首尾的空格
        foreach ($data as $k => $v) {
            $data[$k]=trim($v);
        }
        $id=$this->add($data);
        return $id;
    }

    /**
     * 获取全部菜单
     * @param  string $type  tree获取树形结构 level获取层级结构
     * @return array         结构数据
     */
    public function getTreeData($type='tree',$order=''){
        // 判断是否需要排序
        if(empty($order)){
            $data=$this->select();
        }else{
            $data=$this->order('order_number is null,'.$order)->select();
        }
        // 获取树形或者结构数据
        if($type='tree'){
            $data=\Org\Sen\Data::tree($data, 'name', 'id', 'pid');
        }elseif($type="level"){
            $data=\Org\Sen\Data::channelLevel($data, 0, '&nbsp;', 'id');
            // 显示有权限的菜单
            $auth=new \Think\Auth();
            foreach($data as $k => $v){
                if($auth->check($v['mca'], $_SESSION['user']['id'])){
                    foreach($v['_data'] as $m => $n){
                        if(!$auth->check($n['mca'], $_SESSION['user']['id'])){
                            unset($data[$k]['_data'][$m]);
                        }
                    }
                }else{
                    // 删除无权限的菜单
                    unset($data[$k]);
                }
            }
        }
        dump($data);
        return $data;
    }
}