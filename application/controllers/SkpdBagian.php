<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class SkpdBagian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model(array('MSkpdBagian', 'MSkpd'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'skpdbagian?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'skpdbagian?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'skpdbagian';
            $config['first_url'] = base_url() . 'skpdbagian';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->MSkpdBagian->total_rows($q);
        $skpdbagian = $this->MSkpdBagian->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'skpdbagian_data' => $skpdbagian,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'SKPD';
        $data['subtitle'] = 'Bagian SKPD';
        $data['crumb'] = [
            'Skpdbagian' => '',
        ];

        $data['page'] = 'skpdbagian/skpd_bagian_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id)
    {
        $row = $this->MSkpdBagian->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'skpd_id' => $row->skpd_id,
                'nama' => $row->nama,
                'deskripsi' => $row->deskripsi,
            );
            $data['title'] = 'SKPD';
            $data['subtitle'] = 'Bagian SKPD';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'skpdbagian/skpd_bagian_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('skpdbagian'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('skpdbagian/create_action'),
            'id' => set_value('id'),
            'skpd_id' => set_value('skpd_id'),
            'nama' => set_value('nama'),
            'deskripsi' => set_value('deskripsi'),
        );
        $data['title'] = 'SKPD';
        $data['subtitle'] = 'Bagian SKPD';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        // get data from SKPD
        $data['list_skpd'] = $this->MSkpd->get_all();

        $data['page'] = 'skpdbagian/skpd_bagian_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'skpd_id' => $this->input->post('skpd_id', TRUE),
                'nama' => $this->input->post('nama', TRUE),
                'deskripsi' => $this->input->post('deskripsi', TRUE),
            );

            $this->MSkpdBagian->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('skpdbagian'));
        }
    }

    public function update($id)
    {
        $row = $this->MSkpdBagian->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('skpdbagian/update_action'),
                'id' => set_value('id', $row->id),
                'skpd_id' => set_value('skpd_id', $row->skpd_id),
                'nama' => set_value('nama', $row->nama),
                'deskripsi' => set_value('deskripsi', $row->deskripsi),
            );
            $data['title'] = 'SKPD';
            $data['subtitle'] = 'Bagian SKPD';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            // get data from SKPD
            $data['list_skpd'] = $this->MSkpd->get_all();

            $data['page'] = 'skpdbagian/skpd_bagian_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('skpdbagian'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'skpd_id' => $this->input->post('skpd_id', TRUE),
                'nama' => $this->input->post('nama', TRUE),
                'deskripsi' => $this->input->post('deskripsi', TRUE),
            );

            $this->MSkpdBagian->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('skpdbagian'));
        }
    }

    public function delete($id)
    {
        $row = $this->MSkpdBagian->get_by_id($id);

        if ($row) {
            $this->MSkpdBagian->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('skpdbagian'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('skpdbagian'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->MSkpdBagian->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('skpd_id', 'skpd id', 'trim|required');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file SkpdBagian.php */
/* Location: ./application/controllers/SkpdBagian.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-04 06:22:02 */
/* http://harviacode.com */