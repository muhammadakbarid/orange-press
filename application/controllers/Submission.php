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
    $this->load->model('Riwayat_model');
    $this->load->model('File_attach_model');
  }

  public function submit() // Penulis submit draft buku
  {
    // cek validasi form
    $this->form_validation->set_rules('judul', 'Judul', 'required');
    $this->form_validation->set_rules('edisi', 'Edisi', 'required');
    // $this->form_validation->set_rules('file_attach', 'Draft Buku', 'required');
    $this->form_validation->set_rules('tim_penulis[]', 'Tim Penulis', 'required');

    if ($this->form_validation->run() == FALSE) {
      // jika form tidak jalan
      $data = array(
        'judul' => $this->form_validation->set_value('judul'),
        'edisi' => $this->form_validation->set_value('edisi'),
        'jenis_kti' => $this->form_validation->set_value('jenis_kti'),
        'tim_penulis[]' => $this->form_validation->set_value('tim_penulis[]'),
      );
      $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
      $data['title'] = 'Submission';
      $data['subtitle'] = '';

      $data['crumb'] = [
        'Submission' => '',
      ];
      $data['jenis_kti'] = $this->Jenis_kti_model->get_all();

      // ambil semua data penulis
      $data['list_penulis'] = $this->Users_model->get_all_by_id_groups(34);

      $data['page'] = 'Submission/submit';
      $this->load->view('template/Backend', $data);
    } else {
      // jika form jalan

      // ambil data dari form
      $file_attach = $_FILES['file_attach']['name'];
      $judul = $this->input->post('judul');
      $edisi = $this->input->post('edisi');
      $jenis_kti = $this->input->post('jenis_kti');
      $tim_penulis = $this->input->post('tim_penulis');
      $status = 11;

      // cek apakah ada file yang diupload
      if ($file_attach) {
        $config['upload_path'] = './assets/uploads/files/file_attach/';
        $config['allowed_types'] = 'txt|xls|xlsx|doc|docx|pdf';
        $config['max_size']     = '2048';

        $this->load->library('upload', $config);

        // upload file ke repository
        if ($this->upload->do_upload('file_attach')) {
          $new_file_attach = htmlspecialchars($this->upload->data('file_name'));
        } else {
          // $this->session->set_flashdata('error', $this->upload->display_errors());
          redirect('Submission/submit');
        }
      } else {
        $this->session->set_flashdata('error', 'File harus diupload');
        redirect('Submission/submit');
      }

      // insert produk
      $this->db->set('judul', $judul);
      $this->db->set('edisi', $edisi);
      $this->db->set('id_kti', $jenis_kti);
      $this->db->set('tgl_submit', date('Y-m-d'));

      $this->db->insert('produk');

      $id_produk = $this->db->insert_id();

      // insert riwayat
      $data_riwayat = [
        'id_produk' => $id_produk,
        'id_user' => $this->session->userdata('user_id'),
        'status_kerjaan' => $status,
        'keterangan' => 'Penulis melakukan submit',
      ];

      $this->Riwayat_model->insert($data_riwayat);
      $id_riwayat = $this->db->insert_id();

      // insert file attach
      $data_file_attach = [
        'id_riwayat' => $id_riwayat,
        'nama_file' => $new_file_attach,
        'url_file' => base_url('assets/uploads/files/file_attach/' . $new_file_attach),
      ];

      $this->File_attach_model->insert($data_file_attach);

      $status = NULL;

      // insert tim penulis
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

  public function plot_lead_editor($id_produk) // Plotting Lead Editor
  {
    $this->form_validation->set_rules('editor', 'Lead Editor', 'required');

    if ($this->form_validation->run() == FALSE) {
      $data['id_produk'] = $id_produk;
      $data['produk'] = $this->Produk_model->get_by_id($id_produk);
      $data['title'] = 'Plot Lead Editor';
      $data['label'] = 'Lead Editor';
      $data['subtitle'] = '';
      $data['keterangan'] = $this->Riwayat_model->get_detail($id_produk);
      $data['action'] = 'Submission/plot_lead_editor/' . $id_produk;
      $data['crumb'] = [
        'Plot Lead Editor' => '',
      ];
      $data['list_editor'] = $this->Users_model->get_all_by_id_groups(33);

      $data['page'] = 'Submission/plot_editor';
      $this->load->view('template/backend', $data);
    } else {
      $lead_editor = $this->input->post('editor');
      $tgl_plotting = date('Y-m-d');
      $tgl_selesai = NULL;
      $status = 10; // Status : Lead Editor Plotted
      $keterangan = 'Lead Editor Plotted';
      $this->db->set('id_user', $lead_editor);
      $this->db->set('id_produk', $id_produk);
      $this->db->set('tgl_plotting', $tgl_plotting);
      $this->db->set('tgl_selesai', $tgl_selesai);
      $this->db->set('keterangan', $keterangan);
      $this->db->set('status_kerjaan', $status);

      if ($this->db->insert('riwayat')) {
        $this->session->set_flashdata('success', "Successfully plotted");
        redirect('Submission/list');
      } else {
        $this->session->set_flashdata('success', "Failed to plot");
        redirect('Submission/list');
      }
    }
  }

  public function change_lead_editor($id_produk) // Change Lead Editor
  {
    // if form validation success
    $this->form_validation->set_rules('editor', 'Lead Editor', 'required');
    if ($this->form_validation->run() == FALSE) {
      $riwayat = $this->Riwayat_model->get_lead_by_id_produk($id_produk);
      $data['id_produk'] = $id_produk;
      $data['id_lead_editor'] = $riwayat->id_user;
      $data['id_riwayat'] = $riwayat->id_riwayat;
      $data['keterangan'] = $this->Riwayat_model->get_detail($id_produk);
      $data['produk'] = $this->Produk_model->get_by_id($id_produk);
      $data['list_editor'] = $this->Users_model->get_all_by_id_groups(33);
      $data['title'] = 'Change Lead Editor';
      $data['subtitle'] = '';
      $data['label'] = 'Lead Editor';
      $data['action'] = 'Submission/change_lead_editor/' . $id_produk;
      $data['crumb'] = [
        'Change Lead Editor' => '',
      ];

      $data['page'] = 'Submission/plot_editor';
      $this->load->view('template/backend', $data);
    } else {
      $lead_editor = $this->input->post('editor');
      $id_riwayat = $this->input->post('id_riwayat');
      $data_riwayat = [
        'id_user' => $lead_editor,
      ];

      // update riwayat where id_riwayat = $id_riwayat
      if ($this->Riwayat_model->update($id_riwayat, $data_riwayat)) {
        $this->session->set_flashdata('success', "Successfully changed");
        redirect('Submission/list');
      } else {
        $this->session->set_flashdata('success', "Failed to change");
        redirect('Submission/list');
      }
    }
  }

  public function approve_submission() // Lead Editor Approve Submission dari Penulis
  {
    $id_produk = $this->input->post('id');
    $keterangan = $this->input->post('keterangan');

    $status = 1; // Status : Acceptance Submission

    $data_riwayat = [
      'id_user' => $this->session->userdata('user_id'),
      'id_produk' => $id_produk,
      'status_kerjaan' => $status,
      'keterangan' => $keterangan,
    ];

    if ($this->Riwayat_model->insert($data_riwayat)) {
      $this->session->set_flashdata('success', "Successfully approved");
      redirect('Submission/list_editor');
    } else {
      $this->session->set_flashdata('success', "Failed to approve");
      redirect('Submission/list_editor');
    }
  }

  public function reject_submission()  // Lead Editor Reject Submission dari Penulis
  {
    $id_produk = $this->input->post('id');
    $status = 2; // Status : Rejected
    $keterangan = $this->input->post('keterangan');
    $data_riwayat = [
      'id_user' => $this->session->userdata('user_id'),
      'id_produk' => $id_produk,
      'status_kerjaan' => $status,
      'tgl_selesai' => date('Y-m-d'),
      'keterangan' => $keterangan,
    ];

    if ($this->Riwayat_model->insert($data_riwayat)) {
      $this->session->set_flashdata('success', "Successfully rejected");
      redirect('Submission/list_editor');
    } else {
      $this->session->set_flashdata('success', "Failed to reject");
      redirect('Submission/list_editor');
    }
  }

  public function bayar($id_produk) // Penulis membayar
  {
    $this->load->model('Paket_model');
    $data['produk'] = $this->Produk_model->get_produk_by_id($id_produk);
    $data['paket'] = $this->Paket_model->get_all();
    $data['action'] = base_url('Submission/bayar_action');
    $data['title'] = 'Pembayaran';
    $data['subtitle'] = '';
    $data['crumb'] = [
      'Pembayaran' => '',
    ];
    $data['keterangan'] = $this->Riwayat_model->get_detail($id_produk);

    $data['page'] = 'Submission/bayar';
    $this->load->view('template/backend', $data);
  }

  public function bayar_action() // Action Penulis membayar
  {
    // rules
    $this->form_validation->set_rules('paket', 'Paket', 'required');
    $this->form_validation->set_rules('jumlah_bayar', 'Jumlah bayar', 'required|trim');


    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('error', 'Pembayaran gagal dilakukan');
      redirect('Submission');
    } else {
      $this->load->model('Pembayaran_model');
      $id_produk = $this->input->post('id_produk');
      $jumlah_bayar = $this->input->post('jumlah_bayar');
      $jumlah_bayar = str_replace('.', '', $jumlah_bayar);
      $paket = $this->input->post('paket');
      $status = 17; // Waiting for Payment Verification

      // bukti bayar
      if ($_FILES['file_attach']['name'] != "") {
        $file_attach = $_FILES['file_attach']['name'];
      } else {
        $file_attach = false;
      }
      // cek apakah ada file yang diupload
      if ($file_attach) {
        $config['upload_path'] = './assets/uploads/files/bukti_bayar/';
        $config['allowed_types'] = 'pdf|png|jpg|jpeg';
        $config['max_size']     = '2048';

        $this->load->library('upload', $config);

        // upload file ke repository
        if ($this->upload->do_upload('file_attach')) {
          $new_file_attach = htmlspecialchars($this->upload->data('file_name'));
        } else {
          $this->session->set_flashdata('error', $this->upload->display_errors());
          redirect('Submission/bayar/' . $id_produk);
        }
      } else {
        $new_file_attach = NULL;
      }

      $data_pembayaran = [
        'id_produk' => $id_produk,
        'tanggal_bayar' => date('Y-m-d'),
        'status' => 0, // 0 = belum lunas
        'bukti_bayar' => $new_file_attach,
        'jumlah' => $jumlah_bayar,
        'jenis' => $paket,
      ];

      $data_riwayat = [
        'id_produk' => $id_produk,
        'id_user' => $this->session->userdata('user_id'),
        'keterangan' => 'Penulis melakukan pembayaran',
        'status_kerjaan' => $status,
      ];

      $this->Riwayat_model->insert($data_riwayat);
      $this->Pembayaran_model->insert($data_pembayaran);

      $this->session->set_flashdata('success', 'Pembayaran berhasil dilakukan');
      redirect('Submission');
    }
  }

  public function verify_payment($id_produk) // Verifikasi Pembayaran oleh Lead Editor
  {
    $this->load->model('Paket_model');
    $this->load->model('Pembayaran_model');
    $data['produk'] = $this->Produk_model->get_produk_by_id($id_produk);
    $data['pembayaran'] = $this->Pembayaran_model->get_by_id_produk($id_produk);
    $data['action'] = base_url('Submission/verify_payment_action');
    $data['paket'] = $this->Paket_model->get_by_id($data['pembayaran']->jenis);
    $data['keterangan'] = $this->Riwayat_model->get_detail($id_produk);
    $data['title'] = 'Verifikasi Pembayaran';
    $data['subtitle'] = '';
    $data['crumb'] = [
      'Verifikasi Pembayaran' => '',
    ];

    $data['page'] = 'Submission/verify_payment';
    $this->load->view('template/backend', $data);
  }

  public function verify_payment_action() // Action Verifikasi Pembayaran
  {

    $this->form_validation->set_rules('id_produk', 'Id Produk', 'required');
    $this->form_validation->set_rules('id_pembayaran', 'Id Pembayaran', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('error', 'Verifikasi gagal dilakukan');
      redirect('Submission/list_editor');
    } else {
      $this->load->model('Pembayaran_model');

      $id_produk = $this->input->post('id_produk');
      $id_pembayaran = $this->input->post('id_pembayaran');

      $status = 3; // Paid
      $data_riwayat = [
        'id_produk' => $id_produk,
        'id_user' => $this->session->userdata('user_id'),
        'keterangan' => 'Pembayaran telah diverifikasi',
        'status_kerjaan' => $status,
      ];

      $data_pembayaran = [
        'status' => 1, // 1 = lunas
      ];

      $this->Riwayat_model->insert($data_riwayat);
      $this->Pembayaran_model->update($id_pembayaran, $data_pembayaran);

      $this->session->set_flashdata('success', 'Pembayaran berhasil diverifikasi');
      redirect('Submission/list_editor');
    }
  }

  public function plot_editor($id_produk) // Plotting Editor sunting oleh Lead Editor
  {
    $this->form_validation->set_rules('editor', 'Editor', 'required');
    if ($this->form_validation->run() == FALSE) {
      $data['id_produk'] = $id_produk;
      $data['produk'] = $this->Produk_model->get_by_id($id_produk);
      $data['title'] = 'Plot Editor Sunting';
      $data['label'] = 'Editor Sunting';
      $data['subtitle'] = '';
      $data['keterangan'] = $this->Riwayat_model->get_detail($id_produk);
      $data['action'] = 'Submission/plot_editor/' . $id_produk;
      $data['crumb'] = [
        'Plot Editor' => '',
      ];
      $data['list_editor'] = $this->Users_model->get_all_by_id_groups(36);

      $data['page'] = 'Submission/plot_editor';
      $this->load->view('template/backend', $data);
    } else {
      $editor = $this->input->post('editor');
      $id_editor = $editor;
      $tgl_plotting = date('Y-m-d');
      $status = 12; // editor plotted
      $data_riwayat = [
        'id_user' => $id_editor,
        'id_produk' => $id_produk,
        'tgl_plotting' => $tgl_plotting,
        'status_kerjaan' => $status,
        'keterangan' => 'Editor Sunting PLotted'
      ];

      if ($this->Riwayat_model->insert($data_riwayat)) {
        $this->session->set_flashdata('success', "Successfully plotted");
        redirect('Submission/list');
      } else {
        $this->session->set_flashdata('error', "Failed to plot");
        redirect('Submission/list');
      }
    }
  }

  public function penyuntingan_naskah($id_produk) // Penyuntingan Naskah oleh Editor Sunting
  {

    $data['produk'] = $this->Produk_model->get_produk_by_id($id_produk);
    $data['keterangan'] = $this->Riwayat_model->get_detail($id_produk);
    $data['title'] = 'Submission';
    $data['subtitle'] = 'Penyuntingan Naskah';
    $data['label'] = 'File Penyuntingan Naskah';
    $data['action'] = 'Submission/penyuntingan_naskah_action';
    $data['crumb'] = [
      'Penyuntingan Naskah' => '',
    ];

    $data['page'] = 'Submission/submission_form';
    $this->load->view('template/backend', $data);
  }

  public function penyuntingan_naskah_action() // Action Penyuntingan Naskah oleh Editor Sunting
  {
    // rules
    $this->form_validation->set_rules('id_produk', 'Id Produk', 'required');
    $this->form_validation->set_rules('keterangan', 'Keteragan', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('error', 'Penyuntingan gagal dilakukan');
      redirect('Submission/penyuntingan_naskah/' . $this->input->post('id_produk'));
    } else {
      $id_produk = $this->input->post('id_produk');
      $keterangan = $this->input->post('keterangan');
      $file_attach = $_FILES['file_attach']['name'];
      $status = 4; // corection
      if ($file_attach) {
        $config['upload_path'] = './assets/uploads/files/file_attach/';
        $config['allowed_types'] = 'txt|xls|xlsx|doc|docx|pdf';
        $config['max_size']     = '2048';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file_attach')) {
          $new_file_attach = htmlspecialchars($this->upload->data('file_name'));
          $data_riwayat = [
            'id_produk' => $id_produk,
            'id_user' => $this->session->userdata('user_id'),
            'tgl_plotting' => date('Y-m-d'),
            'status_kerjaan' => $status,
            'keterangan' => $keterangan
          ];

          $this->Riwayat_model->insert($data_riwayat);
          $id_riwayat = $this->db->insert_id();

          $data_file_attach = [
            'id_riwayat' => $id_riwayat,
            'nama_file' => $new_file_attach,
            'url_file' => base_url('assets/uploads/files/file_attach/' . $new_file_attach),
          ];
          $this->Produk_model->insert_file_attach($data_file_attach);

          $this->session->set_flashdata('success', 'Naskah berhasil disunting');
          redirect('Submission/list_editors');
        } else {
          $this->session->set_flashdata('error', 'Naskah gagal disunting');
          redirect('Submission/list_editors');
        }
      }
    }
  }

  public function resubmit_penyuntingan_naskah($id_produk) // Resubmit Penyuntingan Naskah oleh Penulis
  {

    $data['produk'] = $this->Produk_model->get_produk_by_id($id_produk);
    $data['action'] = 'Submission/resubmit_penyuntingan_naskah_action';
    $data['title'] = 'Submission';
    $data['label'] = 'File Naskah';
    $data['subtitle'] = 'Resubmit Penyuntingan Naskah';
    $data['crumb'] = [
      'Resubmit Penyuntingan Naskah' => '',
    ];
    $data['keterangan'] = $this->Riwayat_model->get_detail($id_produk);

    $data['page'] = 'Submission/submission_form';
    $this->load->view('template/backend', $data);
  }

  public function resubmit_penyuntingan_naskah_action() // Action Resubmit Penyuntingan Naskah oleh Penulis
  {
    // rules
    $this->form_validation->set_rules('id_produk', 'Id Produk', 'required');
    $this->form_validation->set_rules('keterangan', 'Keteragan', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('error', 'Penyuntingan gagal dilakukan');
      redirect('Submission/penyuntingan_naskah/' . $this->input->post('id_produk'));
    } else {
      $id_produk = $this->input->post('id_produk');
      $keterangan = $this->input->post('keterangan');
      $file_attach = $_FILES['file_attach']['name'];
      $status = 18; // Correction : Resubmit
      if ($file_attach) {
        $config['upload_path'] = './assets/uploads/files/file_attach/';
        $config['allowed_types'] = 'txt|xls|xlsx|doc|docx|pdf';
        $config['max_size']     = '2048';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file_attach')) {
          $new_file_attach = htmlspecialchars($this->upload->data('file_name'));
          $data_riwayat = [
            'id_produk' => $id_produk,
            'id_user' => $this->session->userdata('user_id'),
            'tgl_plotting' => date('Y-m-d'),
            'status_kerjaan' => $status,
            'keterangan' => $keterangan
          ];

          $this->Riwayat_model->insert($data_riwayat);
          $id_riwayat = $this->db->insert_id();

          $data_file_attach = [
            'id_riwayat' => $id_riwayat,
            'nama_file' => $new_file_attach,
            'url_file' => base_url('assets/uploads/files/file_attach/' . $new_file_attach),
          ];
          $this->Produk_model->insert_file_attach($data_file_attach);

          $this->session->set_flashdata('success', 'Naskah berhasil disubmit ulang');
          redirect('Submission/list');
        } else {
          $this->session->set_flashdata('error', 'Naskah gagal disubmit ulang');
          redirect('Submission/list');
        }
      }
    }
  }

  public function penyuntingan_naskah_approve() // Approve Penyuntingan Naskah oleh Editor Sunting
  {
    $id_produk = $this->input->post('id');
    $keterangan = $this->input->post('keterangan');
    $status = 5; // Sunting Naskah Approve

    $data_riwayat = [
      'id_produk' => $id_produk,
      'id_user' => $this->session->userdata('user_id'),
      'tgl_plotting' => date('Y-m-d'),
      'status_kerjaan' => $status,
      'keterangan' => $keterangan
    ];

    if ($this->Riwayat_model->insert($data_riwayat)) {
      $this->session->set_flashdata('success', "Successfully approved");
      redirect('Submission/list_editors');
    } else {
      $this->session->set_flashdata('success', "Failed to approve");
      redirect('Submission/list_editors');
    }
  }

  public function plot_editor_proofreading($id_produk) // Plotting Editor proofreading oleh Lead Editor
  {

    $this->form_validation->set_rules('editor', 'Editor', 'required');

    if ($this->form_validation->run() == FALSE) {
      $data['id_produk'] = $id_produk;
      $data['produk'] = $this->Produk_model->get_by_id($id_produk);
      $data['title'] = 'Plot Editor Proofreading';
      $data['label'] = 'Editor Proofreading';
      $data['subtitle'] = '';
      $data['keterangan'] = $this->Riwayat_model->get_detail($id_produk);
      $data['action'] = 'Submission/plot_editor_proofreading/' . $id_produk;
      $data['crumb'] = [
        'Plot Editor' => '',
      ];
      $data['list_editor'] = $this->Users_model->get_all_by_id_groups(35);

      $data['page'] = 'Submission/plot_editor';
      $this->load->view('template/backend', $data);
    } else {
      $editor = $this->input->post('editor');
      $id_editor = $editor;
      $tgl_plotting = date('Y-m-d');
      $status = 19; // Proofreading Plotted
      $data_riwayat = [
        'id_user' => $id_editor,
        'id_produk' => $id_produk,
        'tgl_plotting' => $tgl_plotting,
        'status_kerjaan' => $status,
        'keterangan' => 'Editor Proofreading Plotted'
      ];

      if ($this->Riwayat_model->insert($data_riwayat)) {
        $this->session->set_flashdata('success', "Successfully plotted");
        redirect('Submission/list');
      } else {
        $this->session->set_flashdata('error', "Failed to plot");
        redirect('Submission/list');
      }
    }
  }

  public function proofreading($id_produk) // Proofreading Form
  {

    $data['produk'] = $this->Produk_model->get_produk_by_id($id_produk);
    $data['keterangan'] = $this->Riwayat_model->get_detail($id_produk);
    $data['action'] = 'Submission/proofreading_action/' . $id_produk;
    $data['label'] = 'File Proofreading';
    $data['title'] = 'Submission';
    $data['subtitle'] = 'Proofreading';
    $data['crumb'] = [
      'Proofreading' => '',
    ];

    $data['page'] = 'Submission/submission_form';
    $this->load->view('template/backend', $data);
  }

  public function proofreading_action() // Proofreading Form
  {
    // rules
    $this->form_validation->set_rules('id_produk', 'Id Produk', 'required');
    $this->form_validation->set_rules('keterangan', 'Keteragan', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('error', 'Penyuntingan gagal dilakukan');
      redirect('Submission/proofreading/' . $this->input->post('id_produk'));
    } else {
      $id_produk = $this->input->post('id_produk');
      $keterangan = $this->input->post('keterangan');
      $file_attach = $_FILES['file_attach']['name'];
      $status = 13; // corection proofreading
      if ($file_attach) {
        $config['upload_path'] = './assets/uploads/files/file_attach/';
        $config['allowed_types'] = 'txt|xls|xlsx|doc|docx|pdf';
        $config['max_size']     = '2048';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file_attach')) {
          $new_file_attach = htmlspecialchars($this->upload->data('file_name'));
          $data_riwayat = [
            'id_produk' => $id_produk,
            'id_user' => $this->session->userdata('user_id'),
            'tgl_plotting' => date('Y-m-d'),
            'status_kerjaan' => $status,
            'keterangan' => $keterangan
          ];

          $this->Riwayat_model->insert($data_riwayat);
          $id_riwayat = $this->db->insert_id();

          $data_file_attach = [
            'id_riwayat' => $id_riwayat,
            'nama_file' => $new_file_attach,
            'url_file' => base_url('assets/uploads/files/file_attach/' . $new_file_attach),
          ];
          $this->Produk_model->insert_file_attach($data_file_attach);

          $this->session->set_flashdata('success', 'Naskah berhasil disunting');
          redirect('Submission/list_editor_proofreader');
        } else {
          $this->session->set_flashdata('error', 'Naskah gagal disunting');
          redirect('Submission/list_editor_proofreader');
        }
      }
    }
  }

  public function resubmit_proofreading($id_produk) // Resubmit Proofreading oleh Penulis
  {

    $data['produk'] = $this->Produk_model->get_produk_by_id($id_produk);
    $data['action'] = 'Submission/resubmit_proofreading_action';
    $data['title'] = 'Submission';
    $data['keterangan'] = $this->Riwayat_model->get_detail($id_produk);
    $data['label'] = 'File Naskah';
    $data['subtitle'] = 'Resubmit Proofreading Naskah';
    $data['crumb'] = [
      'Resubmit Proofreading Naskah' => '',
    ];

    $data['page'] = 'Submission/submission_form';
    $this->load->view('template/backend', $data);
  }

  public function resubmit_proofreading_action() // Action Resubmit Proofreading oleh Penulis
  {
    // rules
    $this->form_validation->set_rules('id_produk', 'Id Produk', 'required');
    $this->form_validation->set_rules('keterangan', 'Keteragan', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('error', 'Penyuntingan gagal dilakukan');
      redirect('Submission/proofreading/' . $this->input->post('id_produk'));
    } else {
      $id_produk = $this->input->post('id_produk');
      $keterangan = $this->input->post('keterangan');
      $file_attach = $_FILES['file_attach']['name'];
      $status = 20; // Proofreading : Resubmit
      if ($file_attach) {
        $config['upload_path'] = './assets/uploads/files/file_attach/';
        $config['allowed_types'] = 'txt|xls|xlsx|doc|docx|pdf';
        $config['max_size']     = '2048';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file_attach')) {
          $new_file_attach = htmlspecialchars($this->upload->data('file_name'));
          $data_riwayat = [
            'id_produk' => $id_produk,
            'id_user' => $this->session->userdata('user_id'),
            'tgl_plotting' => date('Y-m-d'),
            'status_kerjaan' => $status,
            'keterangan' => $keterangan
          ];

          $this->Riwayat_model->insert($data_riwayat);
          $id_riwayat = $this->db->insert_id();

          $data_file_attach = [
            'id_riwayat' => $id_riwayat,
            'nama_file' => $new_file_attach,
            'url_file' => base_url('assets/uploads/files/file_attach/' . $new_file_attach),
          ];
          $this->Produk_model->insert_file_attach($data_file_attach);

          $this->session->set_flashdata('success', 'Naskah berhasil disubmit ulang');
          redirect('Submission/list');
        } else {
          $this->session->set_flashdata('error', 'Naskah gagal disubmit ulang');
          redirect('Submission/list');
        }
      }
    }
  }

  public function proofreading_approve() // Approve Proofreading oleh Proofreader
  {
    $id_produk = $this->input->post('id');
    $keterangan = $this->input->post('keterangan');
    $status = 6; // Proofreading Approve

    $data_riwayat = [
      'id_produk' => $id_produk,
      'id_user' => $this->session->userdata('user_id'),
      'tgl_plotting' => date('Y-m-d'),
      'status_kerjaan' => $status,
      'keterangan' => $keterangan
    ];

    if ($this->Riwayat_model->insert($data_riwayat)) {
      $this->session->set_flashdata('success', "Successfully approved");
      redirect('Submission/list_editor_proofreader');
    } else {
      $this->session->set_flashdata('success', "Failed to approve");
      redirect('Submission/list_editor_proofreader');
    }
  }

  public function plot_editor_desainer($id_produk) // Plotting Editor desainer oleh Lead Editor
  {

    $this->form_validation->set_rules('editor', 'Editor', 'required');

    if ($this->form_validation->run() == FALSE) {
      $data['id_produk'] = $id_produk;
      $data['produk'] = $this->Produk_model->get_by_id($id_produk);
      $data['title'] = 'Plot Editor Desainer';
      $data['label'] = 'Editor Desainer';
      $data['subtitle'] = '';
      $data['keterangan'] = $this->Riwayat_model->get_detail($id_produk);
      $data['action'] = 'Submission/plot_editor_desainer/' . $id_produk;
      $data['crumb'] = [
        'Plot Editor' => '',
      ];
      $data['list_editor'] = $this->Users_model->get_all_by_id_groups(37);

      $data['page'] = 'Submission/plot_editor';
      $this->load->view('template/backend', $data);
    } else {
      $editor = $this->input->post('editor');
      $id_editor = $editor;
      $tgl_plotting = date('Y-m-d');
      $status = 21; // Desainer Plotted
      $data_riwayat = [
        'id_user' => $id_editor,
        'id_produk' => $id_produk,
        'tgl_plotting' => $tgl_plotting,
        'status_kerjaan' => $status,
        'keterangan' => 'Editor Layout Cover Plotted'
      ];

      if ($this->Riwayat_model->insert($data_riwayat)) {
        $this->session->set_flashdata('success', "Successfully plotted");
        redirect('Submission/list');
      } else {
        $this->session->set_flashdata('error', "Failed to plot");
        redirect('Submission/list');
      }
    }
  }

  public function layout_cover($id_produk) // Tambah layout cover oleh Desainer
  {

    $data['produk'] = $this->Produk_model->get_produk_by_id($id_produk);
    $data['keterangan'] = $this->Riwayat_model->get_detail($id_produk);
    $data['action'] = 'Submission/layout_cover_action/' . $id_produk;
    $data['label'] = 'File layout_cover';
    $data['title'] = 'Submission';
    $data['subtitle'] = 'layout cover';
    $data['crumb'] = [
      'layout cover' => '',
    ];

    $data['page'] = 'Submission/submission_form';
    $this->load->view('template/backend', $data);
  }

  public function layout_cover_action() // Action Tambah layout cover oleh Desainer
  {
    // rules
    $this->form_validation->set_rules('id_produk', 'Id Produk', 'required');
    $this->form_validation->set_rules('keterangan', 'Keteragan', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('error', 'Penyuntingan gagal dilakukan');
      redirect('Submission/layout_cover/' . $this->input->post('id_produk'));
    } else {
      $id_produk = $this->input->post('id_produk');
      $keterangan = $this->input->post('keterangan');
      $file_attach = $_FILES['file_attach']['name'];
      $status = 7; // Layout Cover Processed
      if ($file_attach) {
        $config['upload_path'] = './assets/uploads/files/file_attach/';
        $config['allowed_types'] = 'txt|xls|xlsx|doc|docx|pdf';
        $config['max_size']     = '2048';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file_attach')) {
          $new_file_attach = htmlspecialchars($this->upload->data('file_name'));
          $data_riwayat = [
            'id_produk' => $id_produk,
            'id_user' => $this->session->userdata('user_id'),
            'tgl_plotting' => date('Y-m-d'),
            'status_kerjaan' => $status,
            'keterangan' => $keterangan
          ];

          $this->Riwayat_model->insert($data_riwayat);
          $id_riwayat = $this->db->insert_id();

          $data_file_attach = [
            'id_riwayat' => $id_riwayat,
            'nama_file' => $new_file_attach,
            'url_file' => base_url('assets/uploads/files/file_attach/' . $new_file_attach),
          ];
          $this->Produk_model->insert_file_attach($data_file_attach);

          $this->session->set_flashdata('success', 'Layout Cover berhasil ditambahkan');
          redirect('Submission/list_desainer');
        } else {
          $this->session->set_flashdata('error', 'Layout Cover gagal ditambahkan');
          redirect('Submission/list_desainer');
        }
      }
    }
  }

  public function add_file_hak_cipta($id_produk) // Tambah file hak cipta oleh admin
  {

    $this->load->model('Tim_penulis_model');

    $data['produk'] = $this->Produk_model->get_produk_by_id($id_produk);
    $data['keterangan'] = $this->Riwayat_model->get_detail($id_produk);
    $data['action'] = 'Submission/add_file_hak_cipta_action/' . $id_produk;
    $data['label'] = 'File hak cipta';
    $data['daftar_penulis'] = $this->Tim_penulis_model->get_daftar_penulis_hak_cipta($id_produk);

    $data['title'] = 'Submission';
    $data['subtitle'] = 'Hak Cipta';
    $data['crumb'] = [
      'Hak Cipta' => '',
    ];

    $data['page'] = 'Submission/hak_cipta';
    $this->load->view('template/backend', $data);
  }

  public function add_file_hak_cipta_action() // Action Tambah file hak cipta oleh admin
  {
    // rules
    $this->form_validation->set_rules('id_produk', 'Id Produk', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('error', 'Penyuntingan gagal dilakukan');
      redirect('Submission/layout_cover/' . $this->input->post('id_produk'));
    } else {
      $id_produk = $this->input->post('id_produk');
      $file_attach = $_FILES['file_attach']['name'];
      $status = 24; // File hak cipta added
      if ($file_attach) {
        $config['upload_path'] = './assets/uploads/files/file_attach/';
        $config['allowed_types'] = 'txt|xls|xlsx|doc|docx|pdf|jpg|jpeg|png';
        $config['max_size']     = '2048';

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file_attach')) {
          $new_file_attach = htmlspecialchars($this->upload->data('file_name'));
          $data_riwayat = [
            'id_produk' => $id_produk,
            'id_user' => $this->session->userdata('user_id'),
            'tgl_plotting' => date('Y-m-d'),
            'status_kerjaan' => $status,
          ];

          $data_produk = [
            'file_hakcipta' => $new_file_attach,
          ];

          $this->Produk_model->update($id_produk, $data_produk);
          $this->Riwayat_model->insert($data_riwayat);
          $id_riwayat = $this->db->insert_id();

          $data_file_attach = [
            'id_riwayat' => $id_riwayat,
            'nama_file' => $new_file_attach,
            'url_file' => base_url('assets/uploads/files/file_attach/' . $new_file_attach),
          ];
          $this->Produk_model->insert_file_attach($data_file_attach);

          $this->session->set_flashdata('success', 'File Hak Cipta berhasil ditambahkan');
          redirect('Submission/list');
        } else {
          $this->session->set_flashdata('error', 'File Hak Cipta gagal ditambahkan');
          redirect('Submission/list');
        }
      }
    }
  }

  public function approve_dummy() // Penulis Approve Layout Cover dan Dummy dari Desainer
  {
    $id_produk = $this->input->post('id');
    $keterangan = $this->input->post('keterangan');

    $status = 8; // Status : ISBN Processed

    $data_riwayat = [
      'id_user' => $this->session->userdata('user_id'),
      'id_produk' => $id_produk,
      'status_kerjaan' => $status,
      'keterangan' => $keterangan,
    ];

    if ($this->Riwayat_model->insert($data_riwayat)) {
      $this->session->set_flashdata('success', "Successfully approved");
      redirect('Submission');
    } else {
      $this->session->set_flashdata('success', "Failed to approve");
      redirect('Submission');
    }
  }

  public function reject_dummy()  // Penulis Reject Layout Cover dan Dummy dari Desainer
  {
    $id_produk = $this->input->post('id');
    $status = 22; // Status : Rejected
    $keterangan = $this->input->post('keterangan');
    $data_riwayat = [
      'id_user' => $this->session->userdata('user_id'),
      'id_produk' => $id_produk,
      'status_kerjaan' => $status,
      'tgl_selesai' => date('Y-m-d'),
      'keterangan' => $keterangan,
    ];

    if ($this->Riwayat_model->insert($data_riwayat)) {
      $this->session->set_flashdata('success', "Successfully rejected");
      redirect('Submission');
    } else {
      $this->session->set_flashdata('success', "Failed to reject");
      redirect('Submission');
    }
  }

  public function add_isbn($id_produk) // Input ISBN
  {

    $data['produk'] = $this->Produk_model->get_produk_by_id($id_produk);
    $data['keterangan'] = $this->Riwayat_model->get_detail($id_produk);
    $data['title'] = 'Submission';
    $data['subtitle'] = 'Add ISBN';
    $data['crumb'] = [
      'Add ISBN' => '',
    ];

    $data['page'] = 'Submission/add_isbn';
    $this->load->view('template/backend', $data);
  }

  public function add_isbn_action() // Action Input ISBN
  {
    $id_produk = $this->input->post('id_produk');
    $no_isbn = $this->input->post('no_isbn');
    $status = 9; // Status : Complete

    $data_produk = [
      'no_isbn' => $no_isbn
    ];

    $keterangan = 'No ISBN : ' . $no_isbn;

    $data_riwayat = [
      'id_user' => $this->session->userdata('user_id'),
      'id_produk' => $id_produk,
      'status_kerjaan' => $status,
      'keterangan' => $keterangan,
    ];

    if ($this->Produk_model->update($id_produk, $data_produk) && $this->Riwayat_model->insert($data_riwayat)) {
      $this->session->set_flashdata('success', 'No ISBN berhasil ditambahkan');
      redirect('Submission/list');
    } else {
      $this->session->set_flashdata('success', 'No ISBN gagal ditambahkan');
      redirect('Submission/list');
    }
  }


  // CETAK OPOSIONAL //
  public function bayar_oposional($id_produk) // Penulis membayar oposional
  {

    $this->load->model('Paket_model');
    $data['keterangan'] = $this->Riwayat_model->get_detail($id_produk);
    $data['produk'] = $this->Produk_model->get_produk_by_id($id_produk);
    $data['paket'] = $this->Paket_model->get_paket_cetak();
    $data['action'] = base_url('Submission/bayar_oposional_action');
    $data['title'] = 'Pembayaran';
    $data['subtitle'] = '';
    $data['crumb'] = [
      'Pembayaran' => '',
    ];

    $data['page'] = 'Submission/bayar';
    $this->load->view('template/backend', $data);
  }

  public function bayar_oposional_action() // Action Penulis membayar oposional
  {
    // rules
    $this->form_validation->set_rules('paket', 'Paket', 'required');
    $this->form_validation->set_rules('jumlah_bayar', 'Jumlah bayar', 'required|trim');


    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('error', 'Pembayaran gagal dilakukan');
      redirect('Submission');
    } else {
      $this->load->model('Pembayaran_model');
      $id_produk = $this->input->post('id_produk');
      $jumlah_bayar = $this->input->post('jumlah_bayar');
      $jumlah_bayar = str_replace('.', '', $jumlah_bayar);
      $paket = $this->input->post('paket');
      $status = 23; // Waiting for Payment Verification by Admin

      // bukti bayar
      if ($_FILES['file_attach']['name'] != "") {
        $file_attach = $_FILES['file_attach']['name'];
      } else {
        $file_attach = false;
      }
      // cek apakah ada file yang diupload
      if ($file_attach) {
        $config['upload_path'] = './assets/uploads/files/bukti_bayar/';
        $config['allowed_types'] = 'pdf|png|jpg|jpeg';
        $config['max_size']     = '2048';

        $this->load->library('upload', $config);

        // upload file ke repository
        if ($this->upload->do_upload('file_attach')) {
          $new_file_attach = htmlspecialchars($this->upload->data('file_name'));
        } else {
          $this->session->set_flashdata('error', $this->upload->display_errors());
          redirect('Submission/bayar_oposional/' . $id_produk);
        }
      } else {
        $new_file_attach = NULL;
      }

      $data_pembayaran = [
        'id_produk' => $id_produk,
        'tanggal_bayar' => date('Y-m-d'),
        'status' => 0, // 0 = belum lunas
        'bukti_bayar' => $new_file_attach,
        'jumlah' => $jumlah_bayar,
        'jenis' => $paket,
      ];

      $data_riwayat = [
        'id_produk' => $id_produk,
        'id_user' => $this->session->userdata('user_id'),
        'keterangan' => 'Penulis melakukan pembayaran',
        'status_kerjaan' => $status,
      ];

      $this->Riwayat_model->insert($data_riwayat);
      $this->Pembayaran_model->insert($data_pembayaran);

      $this->session->set_flashdata('success', 'Pembayaran berhasil dilakukan');
      redirect('Submission');
    }
  }

  public function verify_payment_opotional($id_produk) // Verifikasi Pembayaran oleh Lead Editor
  {

    $this->load->model('Paket_model');
    $this->load->model('Pembayaran_model');
    $data['keterangan'] = $this->Riwayat_model->get_detail($id_produk);
    $data['produk'] = $this->Produk_model->get_produk_by_id($id_produk);
    $data['pembayaran'] = $this->Pembayaran_model->get_by_id_produk($id_produk);
    $data['action'] = base_url('Submission/verify_payment_opotional_action');
    $data['paket'] = $this->Paket_model->get_by_id($data['pembayaran']->jenis);

    $data['title'] = 'Verifikasi Pembayaran';
    $data['subtitle'] = '';
    $data['crumb'] = [
      'Verifikasi Pembayaran' => '',
    ];

    $data['page'] = 'Submission/verify_payment';
    $this->load->view('template/backend', $data);
  }

  public function verify_payment_opotional_action() // Action Verifikasi Pembayaran
  {

    $this->form_validation->set_rules('id_produk', 'Id Produk', 'required');
    $this->form_validation->set_rules('id_pembayaran', 'Id Pembayaran', 'required');

    if ($this->form_validation->run() == FALSE) {
      $this->session->set_flashdata('error', 'Verifikasi gagal dilakukan');
      redirect('Submission/list_editor');
    } else {
      $this->load->model('Pembayaran_model');

      $id_produk = $this->input->post('id_produk');
      $id_pembayaran = $this->input->post('id_pembayaran');

      $status = 14; // Proses Mencetak
      $data_riwayat = [
        'id_produk' => $id_produk,
        'id_user' => $this->session->userdata('user_id'),
        'keterangan' => 'Pembayaran telah diverifikasi, Proses cetak dimulai',
        'status_kerjaan' => $status,
      ];

      $data_pembayaran = [
        'status' => 1, // 1 = lunas
      ];

      $this->Riwayat_model->insert($data_riwayat);
      $this->Pembayaran_model->update($id_pembayaran, $data_pembayaran);

      $this->session->set_flashdata('success', 'Pembayaran berhasil diverifikasi');
      redirect('Submission/list');
    }
  }


  public function selesai_cetak() // selesai mencetak
  {
    $id_produk = $this->input->post('id');
    $status = 9; // selesai mencetak

    $data_riwayat = [
      'id_produk' => $id_produk,
      'id_user' => $this->session->userdata('user_id'),
      'keterangan' => 'Proses cetak selesai',
      'status_kerjaan' => $status,
    ];

    $this->Riwayat_model->insert($data_riwayat);
  }
  // END CETAK OPOSIONAL //




  // LIST LIST LIST LIST LIST LIST LIST LIST //
  public function index() // list submission penulis
  {
    $user_id = $this->session->userdata('user_id');
    $kelengkapan_penulis = $this->Users_model->check_is_empty($user_id);

    // jika lengkap
    if ($kelengkapan_penulis == 0) {
      $id_penulis = $user_id;

      $data['submission'] = $this->Produk_model->get_list_penulis_submission($id_penulis);

      $data['title'] = 'Submission';
      $data['subtitle'] = '';
      $data['crumb'] = [
        'Submission' => '',
      ];

      $data['page'] = 'Submission/index';
      $this->load->view('template/backend', $data);
    } else {
      redirect('profile');
    }
  }

  public function list() // List Submission admin
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

  public function list_editor() // List Submission Lead Editor
  {
    $id_user = $this->session->userdata('user_id');
    $data['list_submission'] = $this->Produk_model->get_list_editor_submission($id_user);

    $data['title'] = 'List Submission';
    $data['subtitle'] = '';
    $data['crumb'] = [
      'List Submission' => '',
    ];

    $data['page'] = 'Submission/list_editor';
    $this->load->view('template/backend', $data);
  }

  public function list_editor_proofreader() // List Submission Editor Proofreader
  {
    $id_user = $this->session->userdata('user_id');
    $data['list_submission'] = $this->Produk_model->get_list_editor_proofreader_submission($id_user);
    $data['title'] = 'Submission List';
    $data['subtitle'] = '';
    $data['crumb'] = [
      'Submission List' => '',
    ];

    $data['page'] = 'Submission/list_editor_proofreader';
    $this->load->view('template/backend', $data);
  }
  public function list_desainer() // List Submission Desainer
  {
    $id_user = $this->session->userdata('user_id');
    $data['list_submission'] = $this->Produk_model->get_list_desainer_submission($id_user);
    $data['title'] = 'Submission List';
    $data['subtitle'] = '';
    $data['crumb'] = [
      'Submission List' => '',
    ];

    $data['page'] = 'Submission/list_desainer';
    $this->load->view('template/backend', $data);
  }
  public function list_editors() // List Submission Editor Sunting
  {
    $id_user = $this->session->userdata('user_id');
    $data['list_submission'] = $this->Produk_model->get_list_editors_submission($id_user);
    $data['title'] = 'Submission List';
    $data['subtitle'] = '';
    $data['crumb'] = [
      'Submission List' => '',
    ];

    $data['page'] = 'Submission/list_editors';
    $this->load->view('template/backend', $data);
  }
  // ENDLIST ENDLIST ENDLIST ENDLIST ENDLIST //





  // OTHER OTHER OTHER OTHER OTHER OTHER OTHER //
  public function get_last_riwayat($id_produk)
  {
    // get last riwayat where id_produk = $id_produk
    $id_riwayat = $this->Riwayat_model->get_last_riwayat_by_id_produk($id_produk);
    $id_riwayat = $id_riwayat->id_riwayat;

    return $id_riwayat;
  }

  public function find_file_submission($id_produk)
  {

    $id_riwayat = $this->get_last_riwayat($id_produk);
    // get file_attach by id_riwayat
    $file_attach = $this->File_attach_model->get_by_id_riwayat($id_riwayat);

    return $file_attach;
  }

  public function get_file_submission($id_produk)
  {
    $file = $this->find_file_submission($id_produk);
    $file_name = $file->nama_file;

    $file_path = 'assets/uploads/files/file_attach/';
    get_file($file_path, $file_name);
  }

  public function get_file_user($path, $nama_file)
  {
    $file_name = $nama_file;
    $file_path = $path;
    get_file($file_path, $file_name);
  }

  public function get_sc_form_penulis($file_name)
  {
    $file_path = 'assets/uploads/files/sc_form_penulis/';
    get_file($file_path, $file_name);
  }
  public function get_sc_ktp($file_name)
  {
    $file_path = 'assets/uploads/files/sc_ktp/';
    get_file($file_path, $file_name);
  }
  public function get_sc_cv($file_name)
  {
    $file_path = 'assets/uploads/files/sc_cv/';
    get_file($file_path, $file_name);
  }
  public function get_sc_npwp($file_name)
  {
    $file_path = 'assets/uploads/files/sc_npwp/';
    get_file($file_path, $file_name);
  }
  public function get_sc_foto($file_name)
  {
    $file_path = 'assets/uploads/files/sc_foto/';
    get_file($file_path, $file_name);
  }

  public function get_file_riwayat($nama_file)
  {
    $file_path = 'assets/uploads/files/file_attach/';
    get_file($file_path, $nama_file);
  }

  public function get_bukti_bayar($file_name)
  {
    $file_path = 'assets/uploads/files/bukti_bayar/';
    get_file($file_path, $file_name);
  }

  public function get_harga_paket()
  {
    $this->load->model('Paket_model');
    $id_paket = $this->input->post('id_paket');
    $harga_paket = $this->Paket_model->get_harga_paket($id_paket);
    $harga_paket = rupiah($harga_paket);
    echo json_encode($harga_paket);
  }

  // ENDOTHER ENDOTHER ENDOTHER ENDOTHER ENDOTHER //
}
