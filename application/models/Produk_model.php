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

    function get_produk_by_id($id_produk)
    {
        $this->db->join('jenis_kti', 'jenis_kti.id_kti = produk.id_kti');
        // $this->db->where('jenis_kti.nama_paket', 'Penerbitan');
        $this->db->where('produk.id_produk', $id_produk);
        return $this->db->get($this->table)->row();
    }

    function get_produk_by_id_cetak($id_produk)
    {
        $this->db->join('jenis_kti', 'jenis_kti.id_kti = produk.id_kti');
        // $this->db->where('jenis_kti.nama_paket', 'Percetakan');
        $this->db->where('produk.id_produk', $id_produk);
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
        return $this->db->query("SELECT * FROM produk ORDER BY id_produk DESC")->result();
    }

    function get_list_penulis_submission($id_penulis)
    {
        return $this->db->query("SELECT * FROM produk join riwayat on produk.id_produk=riwayat.id_produk where riwayat.id_user=$id_penulis and riwayat.status_kerjaan = 11 ORDER BY produk.id_produk DESC")->result();
    }

    function get_list_editor_submission($id_lead_editor)
    {
        return $this->db->query("SELECT * FROM produk JOIN riwayat ON produk.id_produk=riwayat.id_produk WHERE riwayat.id_user=$id_lead_editor AND riwayat.status_kerjaan=10 ORDER BY riwayat.id_produk DESC")->result();
    }

    function get_list_editors_submission($id_editor_sunting)
    {
        return $this->db->query("SELECT * FROM produk JOIN riwayat ON produk.id_produk=riwayat.id_produk WHERE riwayat.id_user=$id_editor_sunting AND riwayat.status_kerjaan=12 ORDER BY riwayat.id_produk DESC")->result();
    }

    function get_list_editor_proofreader_submission($id_editor_proofreader)
    {
        return $this->db->query("SELECT * FROM produk JOIN riwayat ON produk.id_produk=riwayat.id_produk WHERE riwayat.id_user=$id_editor_proofreader AND riwayat.status_kerjaan=19 ORDER BY riwayat.id_produk DESC")->result();
    }

    function get_list_desainer_submission($id_desainer)
    {
        return $this->db->query("SELECT * FROM produk JOIN riwayat ON produk.id_produk=riwayat.id_produk WHERE riwayat.id_user=$id_desainer AND riwayat.status_kerjaan=21 ORDER BY riwayat.id_produk DESC")->result();
    }

    function insert_file_attach($data_file_attach)
    {
        $this->db->insert('file_attach', $data_file_attach);
        return $this->db->affected_rows();
    }

    function get_produk_distribusi()
    {
        $where = "no_isbn is  NOT NULL"; // Ambil jika no ISBN ada
        $this->db->where($where);
        return $this->db->get($this->table)->result();
    }

    function admin_jumlah_produk_terbit()
    {
        $this->db->where("no_isbn IS NOT NULL");
        return $this->db->get($this->table)->num_rows();
    }
}
