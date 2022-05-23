<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Riwayat_model extends CI_Model
{

    public $table = 'Riwayat';
    public $id = 'id_riwayat';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }



    function get_last_riwayat_by_id_produk()
    {
        $this->db->select('*');
        $this->db->from('Riwayat');
        $this->db->join('file_attach', 'riwayat.id_riwayat = file_attach.id_riwayat');
        $this->db->where('id_produk', $this->uri->segment(3));
        $this->db->order_by('file_attach.id_riwayat', 'DESC');
        $this->db->limit(1);
        return $this->db->get()->row();
    }
    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_log()
    {
        $this->db->select('riwayat.id_riwayat, riwayat.tgl_plotting,riwayat.tgl_selesai,produk.judul,users.first_name,users.email,users.last_name,status_sunting.nama_status');

        $this->db->join('users', 'Users.id = Riwayat.id_user');
        $this->db->join('produk', 'produk.id_produk = riwayat.id_produk');
        $this->db->join('status_sunting', 'status_sunting.id_status = riwayat.status_kerjaan');
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_riwayat()
    {
        $this->db->select('produk.id_produk,produk.judul,produk.no_isbn');
        $this->db->join('produk', 'produk.id_produk = riwayat.id_produk');
        $this->db->order_by($this->id, $this->order);
        $this->db->group_by('riwayat.id_produk');
        return $this->db->get($this->table)->result();
    }

    function get_riwayat_penulis()
    {
        $id_penulis = $this->session->userdata('user_id');

        $this->db->select('produk.id_produk,produk.judul,produk.no_isbn');
        $this->db->join('produk', 'produk.id_produk = riwayat.id_produk');
        $this->db->where('riwayat.status_kerjaan', 11);
        $this->db->where('riwayat.id_user', $id_penulis);

        $this->db->order_by($this->id, $this->order);
        $this->db->group_by('riwayat.id_produk');
        return $this->db->get($this->table)->result();
    }

    function get_detail($id_produk)
    {
        $this->db->select('riwayat.id_riwayat,riwayat.keterangan, riwayat.tgl_plotting,riwayat.tgl_selesai,produk.judul,users.first_name,users.email,users.last_name,status_sunting.nama_status,users.id as user_id,riwayat.status_kerjaan,file_attach.nama_file');

        $this->db->join('file_attach', 'riwayat.id_riwayat=file_attach.id_riwayat', 'left');
        $this->db->join('status_sunting', ' riwayat.status_kerjaan=status_sunting.id_status');
        $this->db->join('users', 'riwayat.id_user=users.id');
        $this->db->join('produk', 'produk.id_produk = riwayat.id_produk');

        $this->db->where('riwayat.id_produk', $id_produk);

        $this->db->order_by('riwayat.id_riwayat', 'ASC');
        return $this->db->get($this->table)->result();
    }

    function get_editors($id_produk)
    {
        $this->db->select('users.first_name,users.email,users.last_name,status_sunting.nama_status,users.id as user_id,riwayat.status_kerjaan');

        $this->db->join('users', 'Users.id = Riwayat.id_user');
        $this->db->join('produk', 'produk.id_produk = riwayat.id_produk');
        $this->db->join('status_sunting', 'status_sunting.id_status = riwayat.status_kerjaan');
        $this->db->group_by('riwayat.id_user');
        $this->db->where('riwayat.id_produk', $id_produk);

        $this->db->order_by($this->id, 'ASC');
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
        $this->db->like('id_riwayat', $q);
        $this->db->or_like('id_produk', $q);
        $this->db->or_like('tgl_plotting', $q);
        $this->db->or_like('tgl_selesai', $q);
        $this->db->or_like('status_kerjaan', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id_riwayat', $q);
        $this->db->or_like('id_produk', $q);
        $this->db->or_like('tgl_plotting', $q);
        $this->db->or_like('tgl_selesai', $q);
        $this->db->or_like('status_kerjaan', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->affected_rows();
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
        // return true if update success
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

    // get by id produk
    function get_lead_by_id_produk($id)
    {
        $this->db->where('id_produk', $id);
        $this->db->where('status_kerjaan', 10);
        $this->db->order_by('id_riwayat', 'ASC');
        return $this->db->get($this->table)->row();
    }

    function get_lead_editor($id_produk)
    {
        $this->db->where('status_kerjaan', 10);
        $this->db->where('id_produk', $id_produk);
        $this->db->order_by('id_riwayat', 'DESC');
        $data = $this->db->get($this->table)->row();
        if ($data) {
            return $data->id_user;
        } else {
            return false;
        }
    }
}

/* End of file Riwayat_model.php */
/* Location: ./application/models/Riwayat_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-04-01 08:01:50 */
/* http://harviacode.com */