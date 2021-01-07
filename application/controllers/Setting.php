<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setting extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('MSetting');
        $this->load->library('form_validation');
    }

    public function index2()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'setting?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'setting?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'setting';
            $config['first_url'] = base_url() . 'setting';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->MSetting->total_rows($q);
        $setting = $this->MSetting->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'setting_data' => $setting,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Setting';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Setting' => '',
        ];

        $data['page'] = 'setting/setting_aplikasi';
        $this->load->view('template/backend', $data);
    }

    public function read($id)
    {
        $row = $this->MSetting->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'kode' => $row->kode,
                'nama' => $row->nama,
                'nilai' => $row->nilai,
            );
            $data['title'] = 'Setting';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'setting/setting_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('setting'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('setting/create_action'),
            'id' => set_value('id'),
            'kode' => set_value('kode'),
            'nama' => set_value('nama'),
            'nilai' => set_value('nilai'),
        );
        $data['title'] = 'Setting';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'setting/setting_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'kode' => $this->input->post('kode', TRUE),
                'nama' => $this->input->post('nama', TRUE),
                'nilai' => $this->input->post('nilai', TRUE),
            );

            $this->MSetting->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('setting'));
        }
    }

    public function update($id)
    {
        $row = $this->MSetting->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('setting/update_action'),
                'id' => set_value('id', $row->id),
                'kode' => set_value('kode', $row->kode),
                'nama' => set_value('nama', $row->nama),
                'nilai' => set_value('nilai', $row->nilai),
            );
            $data['title'] = 'Setting';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'setting/setting_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('setting'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'kode' => $this->input->post('kode', TRUE),
                'nama' => $this->input->post('nama', TRUE),
                'nilai' => $this->input->post('nilai', TRUE),
            );

            $this->MSetting->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('setting'));
        }
    }

    public function delete($id)
    {
        $row = $this->MSetting->get_by_id($id);

        if ($row) {
            $this->MSetting->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('setting'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('setting'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->MSetting->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('kode', 'kode', 'trim|required');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('nilai', 'nilai', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    // setting aplikasi
    public function index()
    {
        $data['s_aplikasi'] = $this->db->get('setting')->row();
        $data['title'] = 'Setting';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Setting' => '',
        ];

        $data['page'] = 'setting/setting_aplikasi';

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('nilai', 'Alamat', 'required|trim');

        if ($this->form_validation->run() == false) {

            $this->load->view('template/backend', $data);
        } else {
            $name = $this->input->post('nama');
            $nilai = $this->input->post('nilai');
            $kode = $this->input->post('kode');

            //cek jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['nama'];

            if ($upload_image) {
                $config['upload_path'] = './assets/img/profile/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {

                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('kode', $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('user');
                }
            }

            $this->db->set('nama', $name);
            $this->db->set('nilai', $nilai);
            $this->db->update('setting');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile hass been updated!</div>');
            redirect('setting');
        }
    }
}

/* End of file Setting.php */
/* Location: ./application/controllers/Setting.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-07 12:36:58 */
/* http://harviacode.com */