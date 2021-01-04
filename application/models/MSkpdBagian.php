<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MSkpdBagian extends CI_Model
{

    public $table = 'skpd_bagian';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }
    function get_all_by_skpd_id($skpd_id)
    {
        $this->db->where('skpd_id', $skpd_id);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
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
        $this->db->select('sb.*, sk.nama as skpd');
        $this->db->from('skpd_bagian sb');
        $this->db->join('skpd sk', 'sk.id = sb.skpd_id', 'left');
        $this->db->like('sk.nama', $q);
        $this->db->or_like('sb.nama', $q);
        $this->db->or_like('sb.deskripsi', $q);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->select('sb.*, sk.nama as skpd');
        $this->db->from('skpd_bagian sb');
        $this->db->join('skpd sk', 'sk.id = sb.skpd_id', 'left');
        $this->db->order_by($this->id, $this->order);
        $this->db->like('sk.nama', $q);
        $this->db->or_like('sb.nama', $q);
        $this->db->or_like('sb.deskripsi', $q);
        $this->db->limit($limit, $start);
        return $this->db->get()->result();
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

    // delete bulkdata
    function deletebulk()
    {
        $data = $this->input->post('msg_', TRUE);
        $arr_id = explode(",", $data);
        $this->db->where_in($this->id, $arr_id);
        return $this->db->delete($this->table);
    }
}

/* End of file MSkpdBagian.php */
/* Location: ./application/models/MSkpdBagian.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-04 06:22:02 */
/* http://harviacode.com */