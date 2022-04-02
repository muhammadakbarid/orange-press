<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class File_attach extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('File_attach_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'file_attach?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'file_attach?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'file_attach';
            $config['first_url'] = base_url() . 'file_attach';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->File_attach_model->total_rows($q);
        $file_attach = $this->File_attach_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'file_attach_data' => $file_attach,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'File Attach';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'File Attach' => '',
        ];

        $data['page'] = 'file_attach/file_attach_list';
        $this->load->view('template/Backend', $data);
    }

    public function read($id)
    {
        $row = $this->File_attach_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_file' => $row->id_file,
                'id_riwayat' => $row->id_riwayat,
                'nama_file' => $row->nama_file,
                'url_file' => $row->url_file,
                'keterangan' => $row->keterangan,
                'create_on' => $row->create_on,
            );
            $data['title'] = 'File Attach';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'file_attach/file_attach_read';
            $this->load->view('template/Backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('file_attach'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('file_attach/create_action'),
            'id_file' => set_value('id_file'),
            'id_riwayat' => set_value('id_riwayat'),
            'nama_file' => set_value('nama_file'),
            'url_file' => set_value('url_file'),
            'keterangan' => set_value('keterangan'),
            'create_on' => set_value('create_on'),
        );
        $data['title'] = 'File Attach';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'file_attach/file_attach_form';
        $this->load->view('template/Backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_riwayat' => $this->input->post('id_riwayat', TRUE),
                'nama_file' => $this->input->post('nama_file', TRUE),
                'url_file' => $this->input->post('url_file', TRUE),
                'keterangan' => $this->input->post('keterangan', TRUE),
                'create_on' => $this->input->post('create_on', TRUE),
            );

            $this->File_attach_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('file_attach'));
        }
    }

    public function update($id)
    {
        $row = $this->File_attach_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('file_attach/update_action'),
                'id_file' => set_value('id_file', $row->id_file),
                'id_riwayat' => set_value('id_riwayat', $row->id_riwayat),
                'nama_file' => set_value('nama_file', $row->nama_file),
                'url_file' => set_value('url_file', $row->url_file),
                'keterangan' => set_value('keterangan', $row->keterangan),
                'create_on' => set_value('create_on', $row->create_on),
            );
            $data['title'] = 'File Attach';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'file_attach/file_attach_form';
            $this->load->view('template/Backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('file_attach'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_file', TRUE));
        } else {
            $data = array(
                'id_riwayat' => $this->input->post('id_riwayat', TRUE),
                'nama_file' => $this->input->post('nama_file', TRUE),
                'url_file' => $this->input->post('url_file', TRUE),
                'keterangan' => $this->input->post('keterangan', TRUE),
                'create_on' => $this->input->post('create_on', TRUE),
            );

            $this->File_attach_model->update($this->input->post('id_file', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('file_attach'));
        }
    }

    public function delete($id)
    {
        $row = $this->File_attach_model->get_by_id($id);

        if ($row) {
            $this->File_attach_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('file_attach'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('file_attach'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->File_attach_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('success', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_riwayat', 'id riwayat', 'trim|required');
        $this->form_validation->set_rules('nama_file', 'nama file', 'trim|required');
        $this->form_validation->set_rules('url_file', 'url file', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
        $this->form_validation->set_rules('create_on', 'create on', 'trim|required');

        $this->form_validation->set_rules('id_file', 'id_file', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file File_attach.php */
/* Location: ./application/controllers/File_attach.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-04-01 08:02:08 */
/* http://harviacode.com */