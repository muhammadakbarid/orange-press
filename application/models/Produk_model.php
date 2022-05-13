<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produk_model extends CI_Model
{

    public $table = 'produk';
    public $id = 'id_produk';
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

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('id_produk', $q);
        $this->db->or_like('id_kti', $q);
        $this->db->or_like('judul', $q);
        $this->db->or_like('edisi', $q);
        $this->db->or_like('tgl_submit', $q);
        $this->db->or_like('no_isbn', $q);
        $this->db->or_like('file_hakcipta', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_produk', $q);
        $this->db->or_like('id_kti', $q);
        $this->db->or_like('judul', $q);
        $this->db->or_like('edisi', $q);
        $this->db->or_like('tgl_submit', $q);
        $this->db->or_like('no_isbn', $q);
        $this->db->or_like('file_hakcipta', $q);
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
        // return true if success
        return $this->db->affected_rows();
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

    function get_list_submission()
    {
        return $this->db->query("SELECT * FROM produk JOIN jenis_kti ON produk.id_kti = jenis_kti.id_kti ORDER BY id_produk DESC")->result();
    }
}
