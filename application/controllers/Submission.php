<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Submission extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->layout->auth();
    $this->load->model('Jenis_kti_model');
    $this->load->model('Users_model');
  }

  public function index()
  {
    $data['title'] = 'Submission';
    $data['subtitle'] = '';
    $data['crumb'] = [
      'Submission' => '',
    ];
    $data['jenis_kti'] = $this->Jenis_kti_model->get_all();
    $user_groups = $this->ion_auth->get_users_groups($this->session->userdata('user_id'))->result();
    // ambil data penulis
    $data['list_penulis'] = $this->Users_model->get_all_by_id_groups(34);

    // $data['list_user'] = $this->Users_model->get_all();
    $data['page'] = 'Submission/Index';
    $this->load->view('template/Backend', $data);
  }
}

/* End of file Submission.php */
