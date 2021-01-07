<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Program extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('MProgram');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'program?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'program?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'program';
            $config['first_url'] = base_url() . 'program';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->MProgram->total_rows($q);
        $program = $this->MProgram->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'program_data' => $program,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Program & Kegiatan';
        $data['subtitle'] = 'Program';
        $data['crumb'] = [
            'Program' => '',
        ];

        $data['page'] = 'program/program_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id)
    {
        $row = $this->MProgram->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'no_rekening' => $row->no_rekening,
                'nama' => $row->nama,
            );
            $data['title'] = 'Program & Kegiatan';
            $data['subtitle'] = 'Program';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'program/program_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('program'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('program/create_action'),
            'id' => set_value('id'),
            'no_rekening' => set_value('no_rekening'),
            'nama' => set_value('nama'),
        );
        $data['title'] = 'Program & Kegiatan';
        $data['subtitle'] = 'Program';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'program/program_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'no_rekening' => $this->input->post('no_rekening', TRUE),
                'nama' => $this->input->post('nama', TRUE),
            );

            $this->MProgram->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('program'));
        }
    }

    public function update($id)
    {
        $row = $this->MProgram->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('program/update_action'),
                'id' => set_value('id', $row->id),
                'no_rekening' => set_value('no_rekening', $row->no_rekening),
                'nama' => set_value('nama', $row->nama),
            );
            $data['title'] = 'Program & Kegiatan';
            $data['subtitle'] = 'Program';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'program/program_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('program'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'no_rekening' => $this->input->post('no_rekening', TRUE),
                'nama' => $this->input->post('nama', TRUE),
            );

            $this->MProgram->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('program'));
        }
    }

    public function delete($id)
    {
        $row = $this->MProgram->get_by_id($id);

        if ($row) {
            $this->MProgram->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('program'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('program'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->MProgram->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('no_rekening', 'no rekening', 'trim|required');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Program.php */
/* Location: ./application/controllers/Program.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-07 08:44:08 */
/* http://harviacode.com */