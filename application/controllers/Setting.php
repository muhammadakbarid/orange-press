<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    // public function index()
    // {
    //     $data['s_aplikasi'] = $this->db->get('setting')->row();
    //     $data['title'] = 'Setting';
    //     $data['subtitle'] = '';
    //     $data['crumb'] = [
    //         'Setting' => '',
    //     ];

    //     $data['page'] = 'setting/setting_aplikasi';
    //     $this->load->view('template/backend', $data);
    // }

    public function index()
    {
        $data['s_aplikasi'] = $this->db->get('setting')->row();
        $data['title'] = 'Setting';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Setting' => '',
        ];

        $data['page'] = 'setting/setting_aplikasi';


        $this->form_validation->set_rules('nama', 'Nama Aplikasi', 'required|trim');
        $this->form_validation->set_rules('nilai', 'Alamat', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/backend', $data);
        } else {
            $nama = $this->input->post('nama');
            $nilai = $this->input->post('nilai');

            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['kode']['name'];

            if ($upload_image) {
                $config['upload_path'] = './assets/uploads/image/logo/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('kode')) {

                    $old_image = $data['s_aplikasi']->kode;
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/uploads/image/logo/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('kode', $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('setting');
                }
            }

            $this->db->set('nama', $nama);
            $this->db->set('nilai', $nilai);
            $this->db->where('id', 1);
            $this->db->update('setting');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile hass been updated!</div>');
            redirect('setting');
        }
    }
}
