<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->layout->auth();
		$this->load->model('Dashboard_model');
		$this->load->model('Produk_model');
		$this->load->model('Tim_penulis_model');
		$this->load->model('M_Distribusi');
		$this->load->model('Riwayat_model');
	}

	public function index()
	{

		$data['title'] = 'Dashboard';
		$data['subtitle'] = '';
		$data['crumb'] = [
			'Dashboard' => '',
		];
		$id_user = $this->session->userdata('user_id');

		// dashboard penulis
		if ($this->ion_auth->in_group(34)) {
			$data['penulis_jumlah_produk'] = $this->Dashboard_model->penulis_jumlah_produk($id_user);
			$data['penulis_proses_penerbitan'] = $this->Dashboard_model->penulis_proses_penerbitan($id_user);
			$data['penulis_produk_diterbitkan'] = $this->Dashboard_model->penulis_produk_diterbitkan($id_user);
		}

		// dashboard admin
		if ($this->ion_auth->in_group(1)) {
			$data['admin_jumlah_penulis'] =  $this->Tim_penulis_model->admin_jumlah_penulis(); // jumlah penulis yang terdaftar pada produk
			$data['admin_jumlah_produk'] =  $this->Dashboard_model->admin_jumlah_produk(); // total semua produk
			$data['admin_jumlah_produk_proses_terbit'] =  $this->Dashboard_model->admin_jumlah_produk_proses_terbit(); // jumlah produk sedang proses
			$data['admin_jumlah_produk_terbit'] =  $this->Produk_model->admin_jumlah_produk_terbit(); // jumlah produk yang sudah terbit Nomord ISBN nya
			$data['admin_distribusi'] =  $this->M_Distribusi->admin_distribusi(); // tabel distribusi
			$data['admin_riwayat'] =  $this->Riwayat_model->get_log_limit(); // tabel riwayat
		}


		$setting_aplikasi = $this->db->get('setting')->row();
		$data['setting_aplikasi'] = $setting_aplikasi;
		//$this->layout->set_privilege(1);
		$data['page'] = 'Dashboard/Index';
		$this->load->view('template/Backend', $data);
	}
}
