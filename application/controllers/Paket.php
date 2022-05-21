<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Paket extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Paket_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'paket?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'paket?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'paket';
            $config['first_url'] = base_url() . 'paket';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Paket_model->total_rows($q);
        $paket = $this->Paket_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'paket_data' => $paket,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Paket';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Paket' => '',
        ];

        $data['page'] = 'paket/paket_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id)
    {
        $row = $this->Paket_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_paket' => $row->id_paket,
                'nama_paket' => $row->nama_paket,
                'harga_paket' => $row->harga_paket,
                'keterangan' => $row->keterangan,
            );
            $data['title'] = 'Paket';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'paket/paket_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('paket'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('paket/create_action'),
            'id_paket' => set_value('id_paket'),
            'nama_paket' => set_value('nama_paket'),
            'harga_paket' => set_value('harga_paket'),
            'keterangan' => set_value('keterangan'),
        );
        $data['title'] = 'Paket';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'paket/paket_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama_paket' => $this->input->post('nama_paket', TRUE),
                'harga_paket' => $this->input->post('harga_paket', TRUE),
                'keterangan' => $this->input->post('keterangan', TRUE),
            );

            $this->Paket_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('paket'));
        }
    }

    public function update($id)
    {
        $row = $this->Paket_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('paket/update_action'),
                'id_paket' => set_value('id_paket', $row->id_paket),
                'nama_paket' => set_value('nama_paket', $row->nama_paket),
                'harga_paket' => set_value('harga_paket', $row->harga_paket),
                'keterangan' => set_value('keterangan', $row->keterangan),
            );
            $data['title'] = 'Paket';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'paket/paket_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('paket'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_paket', TRUE));
        } else {
            $data = array(
                'nama_paket' => $this->input->post('nama_paket', TRUE),
                'harga_paket' => $this->input->post('harga_paket', TRUE),
                'keterangan' => $this->input->post('keterangan', TRUE),
            );

            $this->Paket_model->update($this->input->post('id_paket', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('paket'));
        }
    }

    public function delete($id)
    {
        $row = $this->Paket_model->get_by_id($id);

        if ($row) {
            $this->Paket_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('paket'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('paket'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->Paket_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('success', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_paket', 'nama paket', 'trim|required');
        $this->form_validation->set_rules('harga_paket', 'harga paket', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim');

        $this->form_validation->set_rules('id_paket', 'id_paket', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Paket.php */
/* Location: ./application/controllers/Paket.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-05-20 15:39:08 */
/* http://harviacode.com */