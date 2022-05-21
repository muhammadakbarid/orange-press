<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users_model extends CI_Model
{

    public $table = 'users';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('id,ip_address,password,salt,email,activation_code,forgotten_password_code,forgotten_password_time,remember_code,created_on,last_login,active,first_name,last_name,company,phone');
        $this->datatables->from('users');
        //add this line for join
        //$this->datatables->join('table2', 'users.field = table2.field');
        $this->datatables->add_column('action', anchor(site_url('users/read/$1'), '<i class="fa fa-search"></i>', 'class="btn btn-xs btn-primary"  data-toggle="tooltip" title="Detail"') . "  " . anchor(site_url('users/update/$1'), '<i class="fa fa-edit"></i>', 'class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit"') . "  " . anchor(site_url('users/delete/$1'), '<i class="fa fa-trash"></i>', 'class="btn btn-xs btn-danger" onclick="return confirmdelete(\'users/delete/$1\')" data-toggle="tooltip" title="Delete"'), 'id');
        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function check_is_empty($user_id)
    {
        $fields = $this->db->list_fields($this->table);

        // jika kososng
        foreach ($fields as $field) {
            $this->db->where($field, '');
            $this->db->where('id', $user_id);
            $query = $this->db->get($this->table);
            if ($query->num_rows() > 0) {
                return true;
            }
        }
        // jika lengkap
        return false;
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }


    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('id', $q);
        $this->db->or_like('ip_address', $q);
        // $this->db->or_like('username', $q);
        $this->db->or_like('password', $q);
        $this->db->or_like('salt', $q);
        $this->db->or_like('email', $q);
        $this->db->or_like('activation_code', $q);
        $this->db->or_like('forgotten_password_code', $q);
        $this->db->or_like('forgotten_password_time', $q);
        $this->db->or_like('remember_code', $q);
        $this->db->or_like('created_on', $q);
        $this->db->or_like('last_login', $q);
        $this->db->or_like('active', $q);
        $this->db->or_like('first_name', $q);
        $this->db->or_like('last_name', $q);
        $this->db->or_like('company', $q);
        $this->db->or_like('phone', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('ip_address', $q);
        // $this->db->or_like('username', $q);
        $this->db->or_like('password', $q);
        $this->db->or_like('salt', $q);
        $this->db->or_like('email', $q);
        $this->db->or_like('activation_code', $q);
        $this->db->or_like('forgotten_password_code', $q);
        $this->db->or_like('forgotten_password_time', $q);
        $this->db->or_like('remember_code', $q);
        $this->db->or_like('created_on', $q);
        $this->db->or_like('last_login', $q);
        $this->db->or_like('active', $q);
        $this->db->or_like('first_name', $q);
        $this->db->or_like('last_name', $q);
        $this->db->or_like('company', $q);
        $this->db->or_like('phone', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function getUserGroups($user_id)
    {
        $query = "SELECT `users_groups`.*,`groups`.`name`
    FROM `users_groups` JOIN `groups`
    ON `users_groups`.`group_id` = `groups`.`id`
    WHERE user_id=$user_id
    ";

        return $this->db->query($query)->row_array();
    }

    function get_all_by_id_groups($id_group)
    {
        return $this->db->query("SELECT users.id, users.email, users.first_name,users.last_name,users.profesi,users.bidang_kompetensi FROM users JOIN users_groups  ON (users.id = users_groups.user_id)  JOIN groups  ON (users_groups.group_id = groups.id) WHERE groups.id = $id_group")->result();
    }
}

/* End of file Users_model.php */
/* Location: ./application/models/Users_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-08 19:47:42 */
/* http://harviacode.com */