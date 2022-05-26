<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
  public $table = 'v_last_riwayat';
  public $order = 'DESC';

  function __construct()
  {
    parent::__construct();
    //Do your magic here
  }

  function admin_jumlah_produk()
  {
    return $this->db->get($this->table)->num_rows();
  }

  function admin_jumlah_produk_proses_terbit()
  {
    $ignore = array(2, 9, 14, 15, 16, 23);
    $this->db->where_not_in('status_kerjaan', $ignore);
    return $this->db->get($this->table)->num_rows();
  }



  function penulis_jumlah_produk($id_user)
  {
    $this->db->join('riwayat', 'produk.id_produk = riwayat.id_produk');
    $this->db->where('riwayat.status_kerjaan', 11);
    $this->db->where('riwayat.id_user', $id_user);
    return $this->db->get($this->table)->num_rows();
  }

  function penulis_proses_penerbitan($id_user)
  {
    $this->db->join('riwayat', 'produk.id_produk = riwayat.id_produk');
    $where = "riwayat.status_kerjaan NOT IN (2,9,14,15,16,23) AND riwayat.id_user = $id_user";
    $this->db->where($where);
    $this->db->group_by('riwayat.id_produk');

    return $this->db->get($this->table)->num_rows();
  }

  function penulis_produk_diterbitkan($id_user)
  {
    $this->db->join('riwayat', 'produk.id_produk = riwayat.id_produk');
    $where = "riwayat.status_kerjaan NOT IN (2,9,14,15,16,23) AND riwayat.id_user = $id_user";
    $this->db->where($where);
    $this->db->group_by('riwayat.id_produk');

    return $this->db->get($this->table)->num_rows();
  }
}

/* End of file Dashboard.php */
