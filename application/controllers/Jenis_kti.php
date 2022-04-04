<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jenis_kti extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Jenis_kti_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'jenis_kti?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'jenis_kti?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'jenis_kti';
            $config['first_url'] = base_url() . 'jenis_kti';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Jenis_kti_model->total_rows($q);
        $jenis_kti = $this->Jenis_kti_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'jenis_kti_data' => $jenis_kti,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Jenis KTI';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Jenis KTI' => '',
        ];

        $data['page'] = 'jenis_kti/jenis_kti_list';
        $this->load->view('template/Backend', $data);
    }

    public function read($id)
    {
        $row = $this->Jenis_kti_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_kti' => $row->id_kti,
                'nama_kti' => $row->nama_kti,
                'harga_terbit' => $row->harga_terbit,
                'nama_paket' => $row->nama_paket,
            );
            $data['title'] = 'Jenis KTI';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'jenis_kti/jenis_kti_read';
            $this->load->view('template/Backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('jenis_kti'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('jenis_kti/create_action'),
            'id_kti' => set_value('id_kti'),
            'nama_kti' => set_value('nama_kti'),
            'harga_terbit' => set_value('harga_terbit'),
            'nama_paket' => set_value('nama_paket'),
        );
        $data['title'] = 'Jenis KTI';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'jenis_kti/jenis_kti_form';
        $this->load->view('template/Backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama_kti' => $this->input->post('nama_kti', TRUE),
                'harga_terbit' => $this->input->post('harga_terbit', TRUE),
                'nama_paket' => $this->input->post('nama_paket', TRUE),
            );

            $this->Jenis_kti_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('jenis_kti'));
        }
    }

    public function update($id)
    {
        $row = $this->Jenis_kti_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('jenis_kti/update_action'),
                'id_kti' => set_value('id_kti', $row->id_kti),
                'nama_kti' => set_value('nama_kti', $row->nama_kti),
                'harga_terbit' => set_value('harga_terbit', $row->harga_terbit),
                'nama_paket' => set_value('nama_paket', $row->nama_paket),
            );
            $data['title'] = 'Jenis KTI';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'jenis_kti/jenis_kti_form';
            $this->load->view('template/Backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('jenis_kti'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kti', TRUE));
        } else {
            $data = array(
                'nama_kti' => $this->input->post('nama_kti', TRUE),
                'harga_terbit' => $this->input->post('harga_terbit', TRUE),
                'nama_paket' => $this->input->post('nama_paket', TRUE),
            );

            $this->Jenis_kti_model->update($this->input->post('id_kti', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('jenis_kti'));
        }
    }

    public function delete($id)
    {
        $row = $this->Jenis_kti_model->get_by_id($id);

        if ($row) {
            $this->Jenis_kti_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('jenis_kti'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('jenis_kti'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->Jenis_kti_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('success', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_kti', 'nama kti', 'trim|required');
        $this->form_validation->set_rules('harga_terbit', 'harga terbit', 'trim|required');
        $this->form_validation->set_rules('nama_paket', 'nama paket', 'trim|required');

        $this->form_validation->set_rules('id_kti', 'id_kti', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Jenis_kti.php */
/* Location: ./application/controllers/Jenis_kti.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-04-01 08:02:02 */
/* http://harviacode.com */