<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->layout->auth();
		$this->load->model('Produk_model');
	}

	public function index()
	{

		$data['title'] = 'Dashboard';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Dashboard' => '',
		];
		$id_user = $this->session->userdata('user_id');
		if ($this->ion_auth->in_group(34)) {
			$data['penulis_jumlah_produk'] = $this->Produk_model->penulis_jumlah_produk($id_user);
			$data['penulis_proses_penerbitan'] = $this->Produk_model->penulis_proses_penerbitan($id_user);
			// print_r($data['penulis_proses_penerbitan']);
			// die;
			$data['penulis_produk_diterbitkan'] = $this->Produk_model->penulis_produk_diterbitkan($id_user);
		}

		if ($this->ion_auth->in_group(1)) {
			$data['admin_jumlah_produk'] =  $this->Produk_model->admin_jumlah_produk();
			$data['admin_jumlah_produk_proses_terbit'] =  $this->Produk_model->admin_jumlah_produk_proses_terbit();
		}


		$setting_aplikasi = $this->db->get('setting')->row();
		$data['setting_aplikasi'] = $setting_aplikasi;
		//$this->layout->set_privilege(1);
		$data['page'] = 'Dashboard/Index';
		$this->load->view('template/Backend', $data);
	}
}
