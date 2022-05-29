<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Riwayat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Riwayat_model');
        $this->load->library('form_validation');
    }

    public function log()
    {
        $data['log'] = $this->Riwayat_model->get_log();
        $data['title'] = 'Log Riwayat';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Log Riwayat' => '',
        ];

        $data['page'] = 'Riwayat/log';
        $this->load->view('template/backend', $data);
    }

    public function riwayat_sunting()
    {
        $data['riwayat_sunting'] = $this->Riwayat_model->get_riwayat();
        $data['title'] = 'Riwayat Sunting';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Riwayat Sunting' => '',
        ];

        $data['page'] = 'Riwayat/riwayat_sunting';
        $this->load->view('template/backend', $data);
    }

    public function riwayat_sunting_penulis()
    {
        $data['riwayat_sunting'] = $this->Riwayat_model->get_riwayat_penulis();
        $data['title'] = 'Riwayat Sunting';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Riwayat Sunting' => '',
        ];

        $data['page'] = 'Riwayat/riwayat_sunting';
        $this->load->view('template/backend', $data);
    }

    public function detail($id_produk)
    {
        $this->load->model('Tim_penulis_model');
        $this->load->model('Produk_model');
        $lead_editor = $this->Riwayat_model->get_lead_editor($id_produk);
        if ($lead_editor) {
            $lead_editor = $this->ion_auth->user($lead_editor)->row();
            $data['lead_editor'] = $lead_editor->first_name . ' ' . $lead_editor->last_name;
        } else {
            $data['lead_editor'] = " - ";
        }
        // ambil data file hak cipta
        $data['produk'] = $this->Produk_model->get_by_id($id_produk);
        $data['daftar_penulis'] = $this->Tim_penulis_model->get_daftar_penulis($id_produk);
        $data['detail'] = $this->Riwayat_model->get_detail($id_produk);

        $data['editors'] = $this->Riwayat_model->get_editors($id_produk);
        $data['title'] = 'Riwayat Sunting';
        $data['subtitle'] = 'Detail Riwayat';
        $data['crumb'] = [
            'Riwayat Sunting' => '',
        ];

        $data['page'] = 'Riwayat/detail';
        $this->load->view('template/backend', $data);
    }
}

/* End of file Riwayat.php */
/* Location: ./application/controllers/Riwayat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-04-01 08:01:50 */
/* http://harviacode.com */