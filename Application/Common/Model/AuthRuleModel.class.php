<?php
namespace Common\Model;
use Common\Model\BaseModel;
/**
 * 权限规则model
 */
class AuthRuleModel extends BaseModel{

    /**
     * 删除数据
     * @param  array $map where语句数组形式
     * @return boolean    操作是否成功
     */
    public function deleteData($map){
        $count=$this
            ->where(array('pid'=>$map['id']))
            ->count();
        if($count!=0){
            return false;
        }
        $result=$this->where($map)->delete();
        return $result;
    }

    /**
     * 获取全部数据
     * @param  string $type  tree获取树形结构 level获取层级结构
     * @param  string $order 排序方式
     * @return array         结构数据
     */
    public function getTreeData($type='tree', $order='', $name='name', $child='id', $parent='pid'){
        // 判断是否需要排序
        if(empty($order)){
            $data=$this->select();
        }else{
            $data=$this->order($order.' is null,'.$order)->select();
        }
        // 获取树形或者结构数据
        if($type='tree'){
            $data=\Org\Sen\Data::tree($data, $name, $child, $parent);
        }elseif($type="level"){
            $data=\Org\Sen\Data::channelLevel($data, 0, '&nbsp;', $child);
        }
        return $data;
    }
}