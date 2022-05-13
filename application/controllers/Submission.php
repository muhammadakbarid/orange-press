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
    $this->load->model('Produk_model');
    $this->load->model('Tim_penulis_model');
  }

  public function index()
  {
    // if form validation run
    $this->form_validation->set_rules('judul', 'Judul', 'required');
    $this->form_validation->set_rules('edisi', 'Edisi', 'required');
    // $this->form_validation->set_rules('file_hakcipta', 'File Hak Cipta', 'required');
    $this->form_validation->set_rules('jenis_kti', 'Jenis KTI', 'required');
    $this->form_validation->set_rules('tim_penulis[]', 'Tim Penulis', 'required');

    if ($this->form_validation->run() == FALSE) {

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
    } else {
      $file_hakcipta = $_FILES['file_hakcipta']['name'];
      $judul = $this->input->post('judul');
      $edisi = $this->input->post('edisi');
      $id_kti = $this->input->post('jenis_kti');
      $tim_penulis = $this->input->post('tim_penulis');

      if ($file_hakcipta) {
        $config['upload_path'] = './assets/uploads/files/file_hakcipta/';
        $config['allowed_types'] = 'pdf|jpg|png|jpeg';
        $config['max_size']     = '2048';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file_hakcipta')) {
          $new_file_hakcipta = htmlspecialchars($this->upload->data('file_name'));
          $this->db->set('file_hakcipta', $new_file_hakcipta);
        } else {
          $this->session->set_flashdata('success', $this->upload->display_errors());
          redirect('Submission');
        }
      }

      $this->db->set('judul', $judul);
      $this->db->set('edisi', $edisi);
      $this->db->set('id_kti', $id_kti);
      $this->db->set('status', "Submitted");
      $this->db->set('tgl_submit', date('Y-m-d'));

      $this->db->insert('produk');

      $id_produk = $this->db->insert_id();
      $status = NULL;

      foreach ($tim_penulis as $key => $value) {
        $this->db->set('id_produk', $id_produk);
        $this->db->set('id_penulis', $value);
        $this->db->set('penulis_ke', $key + 1);
        $this->db->set('status', $status);
        $this->db->insert('tim_penulis');
      }
      $this->session->set_flashdata('success', "Successfully submitted");
      redirect('Submission');
    }
  }

  public function list()
  {
    $data['list_submission'] = $this->Produk_model->get_list_submission();
    $data['title'] = 'List Submission';
    $data['subtitle'] = '';
    $data['crumb'] = [
      'List Submission' => '',
    ];

    $data['page'] = 'Submission/list';
    $this->load->view('template/backend', $data);
  }

  public function get_file_submission($file_name)
  {
    $file_path = 'assets/uploads/files/file_hakcipta/';
    get_file($file_path, $file_name);
  }
}

/* End of file Submission.php */
