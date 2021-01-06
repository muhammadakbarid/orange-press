<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SkpdSubBagian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model(array('MSkpdSubBagian', 'MSkpdBagian'));
        $this->load->library('form_validation');
    }

    function get_skpd_sub_bagian()
    {
        $id = $this->input->post('p_skpd_bagian_id');
        $data = $this->MSkpdSubBagian->get_all_by_skpd_bidang_id($id);
        echo json_encode($data);
    }


    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'skpdsubbagian?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'skpdsubbagian?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'skpdsubbagian';
            $config['first_url'] = base_url() . 'skpdsubbagian';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->MSkpdSubBagian->total_rows($q);
        $skpdsubbagian = $this->MSkpdSubBagian->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'skpdsubbagian_data' => $skpdsubbagian,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'SKPD';
        $data['subtitle'] = 'Sub Bagian SKPD';
        $data['crumb'] = [
            'Skpdsubbagian' => '',
        ];

        $data['page'] = 'skpdsubbagian/skpd_sub_bagian_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id)
    {
        $row = $this->MSkpdSubBagian->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'skpd_bagian_id' => $row->skpd_bagian_id,
                'nama' => $row->nama,
            );
            $data['title'] = 'SKPD';
            $data['subtitle'] = 'Sub Bagian SKPD';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'skpdsubbagian/skpd_sub_bagian_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('skpdsubbagian'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('skpdsubbagian/create_action'),
            'id' => set_value('id'),
            'skpd_bagian_id' => set_value('skpd_bagian_id'),
            'nama' => set_value('nama'),
        );
        $data['title'] = 'SKPD';
        $data['subtitle'] = 'Sub Bagian SKPD';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        //get data from Sub Bagian SKPD
        $data['list_bagian'] = $this->MSkpdBagian->get_all();


        $data['page'] = 'skpdsubbagian/skpd_sub_bagian_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'skpd_bagian_id' => $this->input->post('skpd_bagian_id', TRUE),
                'nama' => $this->input->post('nama', TRUE),
                'deskripsi' => $this->input->post('deskripsi', TRUE),
            );

            $this->MSkpdSubBagian->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('skpdsubbagian'));
        }
    }

    public function update($id)
    {
        $row = $this->MSkpdSubBagian->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('skpdsubbagian/update_action'),
                'id' => set_value('id', $row->id),
                'skpd_bagian_id' => set_value('skpd_bagian_id', $row->skpd_bagian_id),
                'nama' => set_value('nama', $row->nama),
            );
            $data['title'] = 'SKPD';
            $data['subtitle'] = 'Sub Bagian SKPD';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            //get data from Sub Bagian SKPD
            $data['list_bagian'] = $this->MSkpdBagian->get_all();

            $data['page'] = 'skpdsubbagian/skpd_sub_bagian_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('skpdsubbagian'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'skpd_bagian_id' => $this->input->post('skpd_bagian_id', TRUE),
                'nama' => $this->input->post('nama', TRUE),
                'deskripsi' => $this->input->post('deskripsi', TRUE),
            );

            $this->MSkpdSubBagian->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('skpdsubbagian'));
        }
    }

    public function delete($id)
    {
        $row = $this->MSkpdSubBagian->get_by_id($id);

        if ($row) {
            $this->MSkpdSubBagian->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('skpdsubbagian'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('skpdsubbagian'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->MSkpdSubBagian->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('skpd_bagian_id', 'Bagian SKPD', 'trim|required');
        $this->form_validation->set_rules('nama', 'Nama Sub Bagian', 'trim|required');
        //$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');
        // tidak ada
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file SkpdSubBagian.php */
/* Location: ./application/controllers/SkpdSubBagian.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-04 06:22:31 */
/* http://harviacode.com */