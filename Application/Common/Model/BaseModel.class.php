<?php
namespace Common\Model;
use Think\Model;
/**
 * 基础Model
 */
class BaseModel extends Model{
    /**
     * 添加数据
     * @param  array $data 数据
     * @return integer     新增数据的id
     */
    public function addData($data){
        $id = $this->add($data);
        return $id;
    }

    /**
     * 修改数据
     * @param  array $map  where语句数组形式
     * @param  array $data 修改的数据
     * @return boolean     操作是否成功
     */
    public function editData($map, $data){
        $result = $this->where($map)->save($data);
        return $result;
    }

    /**
     * 删除数据
     * @param  array   $map where语句数组形式
     * @return boolean      操作是否成功
     */
    public function deleteData($map){
        $result = $this->where($map)->delete();
        return $result;
    }

    /**
     * 根据主键id查找数据
     * @param  integer $id 主键id
     * @return array       获取到的数据
     */
    public function getDataById($id){
        /**
         * 示例查询代码
         * 建议:
         * ① 所有的where条件统一使用数组格式的，避免使用字符串格式的where
         * ② 竖着排版，易于阅读
         * ③ 固定按照 field、alias、join、where、order、limit、select 的顺序查询(与正常sql顺序一直)
         */
        $data = $this
            ->field('u.id, s.*')
            ->alias('s')
            ->join('__USERS__ u ON u.id=s.uid')
            ->where(array('id'=>$id))
            ->order('date')
            ->limit(10)
            ->select();
        // sql顺序
        /*
        SELECT
            u.id,
            s.*
        FROM
            student AS s
        JOIN users AS u ON s.uid=u.id
        WHERE
            s.STATUS=1
        ORDER BY
            date
        LIMIT 10;
        */
        return $data;
    }

}