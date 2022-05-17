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
  }

  public function index()
  {
    $id_penulis = $this->session->userdata('user_id');
    $data['submission'] = $this->Produk_model->get_list_penulis_submission($id_penulis);
    $data['title'] = 'Submission';
    $data['subtitle'] = '';
    $data['crumb'] = [
      'Submission' => '',
    ];

    $data['page'] = 'Submission/index';
    $this->load->view('template/backend', $data);
  }

  public function bayar($id_produk)
  {
    $data['produk'] = $this->Produk_model->get_produk_by_id($id_produk);

    $data['title'] = 'Pembayaran';
    $data['subtitle'] = '';
    $data['crumb'] = [
      'Pembayaran' => '',
    ];

    $data['page'] = 'Submission/bayar';
    $this->load->view('template/backend', $data);
  }

  public function bayar_action()
  {
    $this->load->model('Pembayaran_model');
    $id_produk = $this->input->post('id_produk');
    $jumlah_bayar = $this->input->post('jumlah_bayar');
    $jenis_pembayaran = $this->input->post('jenis_pembayaran');
    $status_produk = 3;
    $data_produk = [
      'status' => $status_produk,
    ];
    $data_pembayaran = [
      'tanggal_bayar' => date('Y-m-d'),
      'jumlah' => $jumlah_bayar,
      'id_produk' => $id_produk,
      'jenis' => $jenis_pembayaran,
    ];

    if ($this->Produk_model->update($id_produk, $data_produk) && $this->Pembayaran_model->insert($data_pembayaran)) {
      $this->session->set_flashdata('success', 'Pembayaran berhasil dilakukan');
      redirect('Submission');
    } else {
      $this->session->set_flashdata('error', 'Pembayaran gagal dilakukan');
      redirect('Submission');
    }
  }

  public function bayar_cetak($id_produk)
  {
    $data['produk'] = $this->Produk_model->get_produk_by_id_cetak($id_produk);

    $data['title'] = 'Pembayaran';
    $data['subtitle'] = '';
    $data['crumb'] = [
      'Pembayaran' => '',
    ];

    $data['page'] = 'Submission/bayar_cetak';
    $this->load->view('template/backend', $data);
  }



  public function bayar_cetak_action()
  {
    $this->load->model('Pembayaran_model');
    $id_produk = $this->input->post('id_produk');
    $jumlah_bayar = $this->input->post('jumlah_bayar');
    $jenis_pembayaran = $this->input->post('jenis_pembayaran');
    $status_produk = 14;
    $data_produk = [
      'status' => $status_produk,
    ];
    $data_pembayaran = [
      'tanggal_bayar' => date('Y-m-d'),
      'jumlah' => $jumlah_bayar,
      'id_produk' => $id_produk,
      'jenis' => $jenis_pembayaran,
    ];

    if ($this->Produk_model->update($id_produk, $data_produk) && $this->Pembayaran_model->insert($data_pembayaran)) {
      $this->session->set_flashdata('success', 'Pembayaran berhasil dilakukan');
      redirect('Submission');
    } else {
      $this->session->set_flashdata('error', 'Pembayaran gagal dilakukan');
      redirect('Submission');
    }
  }

  public function penyuntingan_naskah($id_produk)
  {
    $data['produk'] = $this->Produk_model->get_produk_by_id($id_produk);

    $data['title'] = 'Submission';
    $data['subtitle'] = 'Penyuntingan Naskah';
    $data['crumb'] = [
      'Penyuntingan Naskah' => '',
    ];

    $data['page'] = 'Submission/penyuntingan_naskah';
    $this->load->view('template/backend', $data);
  }

  public function penyuntingan_naskah_action()
  {
    $id_produk = $this->input->post('id_produk');
    $keterangan = $this->input->post('keterangan');
    $file_attach = $_FILES['file_attach']['name'];
    $status = 4;
    if ($file_attach) {
      $config['upload_path'] = './assets/uploads/files/file_attach/';
      $config['allowed_types'] = 'pdf|jpg|png|jpeg';
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

        $this->Riwayat_model->insert($data_riwayat);
        $id_riwayat = $this->db->insert_id();

        $data_file_attach = [
          'id_riwayat' => $id_riwayat,
          'nama_file' => $new_file_attach,
          'url_file' => base_url('assets/uploads/files/file_attach/' . $new_file_attach),
          'keterangan' => $keterangan
        ];
        $this->Produk_model->insert_file_attach($data_file_attach);

        $data_produk = [
          'status' => $status,
        ];
        $this->Produk_model->update($id_produk, $data_produk);

        $this->session->set_flashdata('success', 'Naskah berhasil disunting');
        redirect('Submission/list_editors');
      } else {
        $this->session->set_flashdata('success', $this->upload->display_errors());
        redirect('Submission/list_editors');
      }
    }
  }

  public function penyuntingan_naskah_approve()
  {
    $id_produk = $this->input->post('id');
    $status = 5;
    $data_produk = [
      'status' => $status,
    ];
    $this->Produk_model->update($id_produk, $data_produk);

    $data_riwayat = [
      'id_produk' => $id_produk,
      'id_user' => $this->session->userdata('user_id'),
      'tgl_plotting' => date('Y-m-d'),
      'status_kerjaan' => $status,
    ];

    $this->Riwayat_model->insert($data_riwayat);
  }

  public function proofreading($id_produk)
  {
    $data['produk'] = $this->Produk_model->get_produk_by_id($id_produk);

    $data['title'] = 'Submission';
    $data['subtitle'] = 'Proofreading';
    $data['crumb'] = [
      'Proofreading' => '',
    ];

    $data['page'] = 'Submission/proofreading';
    $this->load->view('template/backend', $data);
  }

  public function proofreading_action()
  {
    $id_produk = $this->input->post('id_produk');
    $keterangan = $this->input->post('keterangan');
    $file_attach = $_FILES['file_attach']['name'];
    $status = 13;
    if ($file_attach) {
      $config['upload_path'] = './assets/uploads/files/file_attach/';
      $config['allowed_types'] = 'pdf|jpg|png|jpeg';
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

        $this->Riwayat_model->insert($data_riwayat);
        $id_riwayat = $this->db->insert_id();

        $data_file_attach = [
          'id_riwayat' => $id_riwayat,
          'nama_file' => $new_file_attach,
          'url_file' => base_url('assets/uploads/files/file_attach/' . $new_file_attach),
          'keterangan' => $keterangan
        ];
        $this->Produk_model->insert_file_attach($data_file_attach);

        $data_produk = [
          'status' => $status,
        ];
        $this->Produk_model->update($id_produk, $data_produk);

        $this->session->set_flashdata('success', 'Naskah berhasil disunting');
        redirect('Submission/list_editors');
      } else {
        $this->session->set_flashdata('success', $this->upload->display_errors());
        redirect('Submission/list_editors');
      }
    }
  }

  public function proofreading_approve()
  {
    $id_produk = $this->input->post('id');
    $status = 6;
    $data_produk = [
      'status' => $status,
    ];
    $this->Produk_model->update($id_produk, $data_produk);

    $data_riwayat = [
      'id_produk' => $id_produk,
      'id_user' => $this->session->userdata('user_id'),
      'tgl_plotting' => date('Y-m-d'),
      'status_kerjaan' => $status,
    ];

    $this->Riwayat_model->insert($data_riwayat);
  }

  public function approve_cetak()
  {
    $id_produk = $this->input->post('id');
    $status = 16;
    $data_produk = [
      'status' => $status,
    ];
    $this->Produk_model->update($id_produk, $data_produk);

    $data_riwayat = [
      'id_produk' => $id_produk,
      'id_user' => $this->session->userdata('user_id'),
      'tgl_plotting' => date('Y-m-d'),
      'status_kerjaan' => $status,
    ];

    $this->Riwayat_model->insert($data_riwayat);
  }


  public function selesai_mencetak()
  {
    $id_produk = $this->input->post('id');
    $status = 15;
    $data_produk = [
      'status' => $status,
    ];
    $this->Produk_model->update($id_produk, $data_produk);

    $data_riwayat = [
      'id_produk' => $id_produk,
      'id_user' => $this->session->userdata('user_id'),
      'tgl_plotting' => date('Y-m-d'),
      'status_kerjaan' => $status,
    ];

    $this->Riwayat_model->insert($data_riwayat);
  }

  public function layout_cover($id_produk)
  {
    $data['produk'] = $this->Produk_model->get_produk_by_id($id_produk);

    $data['title'] = 'Submission';
    $data['subtitle'] = 'Layout Cover';
    $data['crumb'] = [
      'Layout Cover' => '',
    ];

    $data['page'] = 'Submission/layout_cover';
    $this->load->view('template/backend', $data);
  }

  public function layout_cover_action()
  {
    $id_produk = $this->input->post('id_produk');
    $keterangan = $this->input->post('keterangan');
    $file_attach = $_FILES['file_attach']['name'];
    $status = 7;
    if ($file_attach) {
      $config['upload_path'] = './assets/uploads/files/file_attach/';
      $config['allowed_types'] = 'pdf|jpg|png|jpeg';
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

        $this->Riwayat_model->insert($data_riwayat);
        $id_riwayat = $this->db->insert_id();

        $data_file_attach = [
          'id_riwayat' => $id_riwayat,
          'nama_file' => $new_file_attach,
          'url_file' => base_url('assets/uploads/files/file_attach/' . $new_file_attach),
          'keterangan' => $keterangan
        ];
        $this->Produk_model->insert_file_attach($data_file_attach);

        $data_produk = [
          'status' => $status,
        ];
        $this->Produk_model->update($id_produk, $data_produk);

        $this->session->set_flashdata('success', 'Layout Cover berhasil ditambahkan');
        redirect('Submission/list_editors');
      } else {
        $this->session->set_flashdata('success', $this->upload->display_errors());
        redirect('Submission/list_editors');
      }
    }
  }

  public function add_isbn($id_produk)
  {
    $data['produk'] = $this->Produk_model->get_produk_by_id($id_produk);

    $data['title'] = 'Submission';
    $data['subtitle'] = 'Add ISBN';
    $data['crumb'] = [
      'Add ISBN' => '',
    ];

    $data['page'] = 'Submission/add_isbn';
    $this->load->view('template/backend', $data);
  }

  public function add_isbn_action()
  {
    $id_produk = $this->input->post('id_produk');
    $no_isbn = $this->input->post('no_isbn');
    $status = 8;

    $data_produk = [
      'status' => $status,
      'no_isbn' => $no_isbn,
    ];
    if ($this->Produk_model->update($id_produk, $data_produk)) {
      $this->session->set_flashdata('success', 'No ISBN berhasil ditambahkan');
      redirect('Submission/list_editors');
    } else {
      $this->session->set_flashdata('success', 'No ISBN gagal ditambahkan');
      redirect('Submission/list_editors');
    }
  }

  public function submit()
  {
    // if form validation run
    $this->form_validation->set_rules('judul', 'Judul', 'required');
    $this->form_validation->set_rules('edisi', 'Edisi', 'required');
    $this->form_validation->set_rules('jenis_kti', 'Jenis KTI', 'required');
    $this->form_validation->set_rules('tim_penulis[]', 'Tim Penulis', 'required');
    if ($this->form_validation->run() == FALSE) {

      $data['title'] = 'Submission';
      $data['subtitle'] = '';
      $data['crumb'] = [
        'Submission' => '',
      ];
      $data['jenis_kti'] = $this->Jenis_kti_model->get_all();
      // ambil data penulis
      $data['list_penulis'] = $this->Users_model->get_all_by_id_groups(34);

      $data['page'] = 'Submission/submit';
      $this->load->view('template/Backend', $data);
    } else {
      $file_hakcipta = $_FILES['file_hakcipta']['name'];
      $judul = $this->input->post('judul');
      $edisi = $this->input->post('edisi');
      $id_kti = $this->input->post('jenis_kti');
      $tim_penulis = $this->input->post('tim_penulis');
      $status = 11;

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
      $this->db->set('status', $status);
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

  public function list_editor()
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

  public function list_editors()
  {
    $id_user = $this->session->userdata('user_id');
    $data['list_submission'] = $this->Produk_model->get_list_editors_submission($id_user);
    $data['title'] = 'List Submission';
    $data['subtitle'] = '';
    $data['crumb'] = [
      'List Submission' => '',
    ];

    $data['page'] = 'Submission/list_editors';
    $this->load->view('template/backend', $data);
  }

  public function get_file_submission($file_name)
  {
    $file_path = 'assets/uploads/files/file_hakcipta/';
    get_file($file_path, $file_name);
  }

  public function plot_lead_editor($id_produk)
  {
    $this->form_validation->set_rules('lead_editor', 'Lead Editor', 'required');

    if ($this->form_validation->run() == FALSE) {
      $data['id_produk'] = $id_produk;
      $data['produk'] = $this->Produk_model->get_by_id($id_produk);
      $data['title'] = 'Plot Lead Editor';
      $data['label'] = 'Lead Editor';
      $data['subtitle'] = '';
      $data['action'] = 'Submission/plot_lead_editor/' . $id_produk;
      $data['crumb'] = [
        'Plot Lead Editor' => '',
      ];
      $data['list_editor'] = $this->Users_model->get_all_by_id_groups(33);

      $data['page'] = 'Submission/plot_lead_editor';
      $this->load->view('template/backend', $data);
    } else {
      $lead_editor = $this->input->post('lead_editor');
      $tgl_plotting = date('Y-m-d');
      $tgl_selesai = NULL;
      $status_kerjaan = 10;
      $this->db->set('id_user', $lead_editor);
      $this->db->set('id_produk', $id_produk);
      $this->db->set('tgl_plotting', $tgl_plotting);
      $this->db->set('tgl_selesai', $tgl_selesai);
      $this->db->set('status_kerjaan', $status_kerjaan);

      if ($this->db->insert('riwayat')) {
        $status_produk = 10;
        $data_produk = [
          'status' => $status_produk,
        ];

        if ($this->Produk_model->update($id_produk, $data_produk)) {
          $this->session->set_flashdata('success', "Successfully plotted");
          redirect('Submission/list');
        } else {
          $this->session->set_flashdata('success', "Failed to plot");
          redirect('Submission/list');
        }
      } else {
        $this->session->set_flashdata('success', "Failed to plot");
        redirect('Submission/list');
      }
    }
  }

  public function plot_editor($id_produk)
  {
    $this->form_validation->set_rules('editor[]', 'Editor', 'required');

    if ($this->form_validation->run() == FALSE) {
      $data['id_produk'] = $id_produk;
      $data['produk'] = $this->Produk_model->get_by_id($id_produk);
      $data['title'] = 'Plot Editor';
      $data['label'] = 'Editor';
      $data['subtitle'] = '';
      $data['action'] = 'Submission/plot_editor/' . $id_produk;
      $data['crumb'] = [
        'Plot Editor' => '',
      ];
      $data['list_editor'] = $this->Users_model->get_all_by_id_groups(36);

      $data['page'] = 'Submission/plot_editor';
      $this->load->view('template/backend', $data);
    } else {
      $editor = $this->input->post('editor');
      foreach ($editor as $editor) {
        $id_editor = $editor;
        $tgl_plotting = date('Y-m-d');
        $tgl_selesai = NULL;
        $status_kerjaan = 12;
        $data_editor = [
          'id_user' => $id_editor,
          'id_produk' => $id_produk,
          'tgl_plotting' => $tgl_plotting,
          'tgl_selesai' => $tgl_selesai,
          'status_kerjaan' => $status_kerjaan,
        ];
        $this->Riwayat_model->insert($data_editor);
      }

      $status_produk = 12;
      $data_produk = [
        'status' => $status_produk,
      ];

      if ($this->Produk_model->update($id_produk, $data_produk)) {

        $this->session->set_flashdata('success', "Successfully plotted");
        redirect('Submission/list');
      } else {
        $this->session->set_flashdata('success', "Failed to plot");
        redirect('Submission/list');
      }
    }
  }

  public function change_lead_editor($id_produk)
  {
    // if form validation success
    $this->form_validation->set_rules('lead_editor', 'Lead Editor', 'required');

    if ($this->form_validation->run() == FALSE) {
      $riwayat = $this->Riwayat_model->get_by_id_produk($id_produk);
      $data['id_produk'] = $id_produk;
      $data['id_lead_editor'] = $riwayat->id_user;
      $data['id_riwayat'] = $riwayat->id_riwayat;
      $data['produk'] = $this->Produk_model->get_by_id($id_produk);
      $data['list_editor'] = $this->Users_model->get_all_by_id_groups(33);
      $data['title'] = 'Change Lead Editor';
      $data['subtitle'] = '';
      $data['action'] = 'Submission/change_lead_editor/' . $id_produk;
      $data['crumb'] = [
        'Change Lead Editor' => '',
      ];

      $data['page'] = 'Submission/plot_lead_editor';
      $this->load->view('template/backend', $data);
    } else {
      $lead_editor = $this->input->post('lead_editor');
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

  public function approve_submission()
  {
    $id_produk = $this->input->post('id');
    $status_produk = 1;
    $data_produk = [
      'status' => $status_produk,
    ];
    $data_riwayat = [
      'id_user' => $this->session->userdata('user_id'),
      'id_produk' => $id_produk,
      'status_kerjaan' => $status_produk,
    ];

    if ($this->Produk_model->update($id_produk, $data_produk) and $this->Riwayat_model->insert($data_riwayat)) {
      $this->session->set_flashdata('success', "Successfully approved");
      redirect('Submission/list_editor');
    } else {
      $this->session->set_flashdata('success', "Failed to approve");
      redirect('Submission/list_editor');
    }
  }

  public function reject_submission()
  {
    $id_produk = $this->input->post('id');
    $status_produk = 2;
    $data_produk = [
      'status' => $status_produk,
    ];
    $data_riwayat = [
      'id_user' => $this->session->userdata('user_id'),
      'id_produk' => $id_produk,
      'status_kerjaan' => $status_produk,
      'tgl_selesai' => date('Y-m-d'),
    ];

    if ($this->Produk_model->update($id_produk, $data_produk) and $this->Riwayat_model->insert($data_riwayat)) {
      $this->session->set_flashdata('success', "Successfully approved");
      redirect('Submission/list_editor');
    } else {
      $this->session->set_flashdata('success', "Failed to approve");
      redirect('Submission/list_editor');
    }
  }
}
