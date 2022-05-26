<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_Distribusi extends CI_Model
{

    public $table = 'distribusi';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    function admin_distribusi()
    {
        $this->db->join('produk', 'distribusi.id_produk = produk.id_produk', 'left');
        $this->db->order_by('tanggal_distribusi', $this->order);
        $this->db->limit(5);
        return $this->db->get($this->table)->result();
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

    function get_distribusi_penulis($id_penulis)
    {
        $this->db->select('distribusi.*, produk.judul, produk.no_isbn,riwayat.id_user');
        $this->db->join('produk', 'distribusi.id_produk = produk.id_produk');
        $this->db->join('riwayat', 'distribusi.id_produk = riwayat.id_produk');
        $this->db->where('riwayat.status_kerjaan', 11);
        $this->db->where('riwayat.id_user', $id_penulis);

        $this->db->order_by('distribusi.tanggal_distribusi', $this->order);
        return $this->db->get($this->table)->result();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('id', $q);
        $this->db->or_like('id_produk', $q);
        $this->db->or_like('tujuan_distribusi', $q);
        $this->db->or_like('tanggal_distribusi', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->join('produk', 'distribusi.id_produk = produk.id_produk');

        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        // $this->db->or_like('id_produk', $q);
        $this->db->or_like('tujuan_distribusi', $q);
        $this->db->or_like('tanggal_distribusi', $q);
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

    // delete bulkdata
    function deletebulk()
    {
        $data = $this->input->post('msg_', TRUE);
        $arr_id = explode(",", $data);
        $this->db->where_in($this->id, $arr_id);
        return $this->db->delete($this->table);
    }
}

/* End of file M_Distribusi.php */
/* Location: ./application/models/M_Distribusi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-05-17 13:40:46 */
/* http://harviacode.com */