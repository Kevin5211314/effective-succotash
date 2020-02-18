<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Auth_rule 权限规则
 */
class Auth_rule extends CI_Model
{

    //获取权限规则列表主页
    public function get_auth_rule_list()
    {
         return $this->db->select("*")->from("auth_rule")->get()->result_array();
    }

    //获取权限规则列表
    public function get_auth_rule_info($where=array(), $field='*')
    {
        $query = $this->db->select($field)->from("auth_rule")->where($where)->get();
        return $query->row_array();
    }

    //获取父级权限规则列表
    public function get_parent_rule_list()
    {
        $query = $this->db->select("*")->from("auth_rule")->where('isMenu', 0)->get();
        return $query->result_array();
    }

    /**
     * [insert_entry 增加数据入口]
     */
    public function insert_entry($data)
    {
        $data['createTime'] = date('Y-m-d H:i:s', time());
        $data['updateTime'] = date('Y-m-d H:i:s', time());
        $this->db->insert('auth_rule', $data);
        return $this->db->insert_id('auth_rule', $data);
    }

    /**
     * [update_entry 修改数据入口]
     */
    public function update_entry($id, $data)
    {
        return $this->db->update('auth_rule', $data, array('authorityId' => $id));
    }

    /**
     * delete_entry 删除数据入口
     */
    public function delete_entry($id)
    {
        return $this->db->delete('auth_rule', array('authorityId' => $id));
    }
}
