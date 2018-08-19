<?php
namespace Common\Model;
use Common\Model\BaseModel;
/**
 * 菜单操作model
 */
class AdminNavModel extends BaseModel{

    /**
     * 数据排序
     * @param $data         数据源
     * @param string $id    主键
     * @param string $order 排序字段
     * @return boolean      操作是否成功
     */
    public function orderData($data, $id='id', $order='order_number'){
        foreach($data as $k => $v){
            $v=empty($v) ? null : $v;
            $this->where(array($id=>$k))->save(array($order=>$v));
        }
        return true;
    }

    /**
     * 删除数据
     * @param array $map where语句形式数组
     * @return boolean   操作是否成功
     */
    public function deleteData($map){
        $count=$this
            ->where(array('pid'=>$map['id']))
            ->count();
        if($count!=0){
            return false;
        }
        $this->where(array($map))->delete();
        return true;
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
        // dump($data);
        return $data;
    }
}