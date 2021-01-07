<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ProgramKegiatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model(array('MProgramKegiatan', 'MProgram'));
        $this->load->library('form_validation');
    }

    function get_no_rekening()
    {
        $id = $this->input->post('p_program_id');
        $data = $this->MProgram->get_by_id($id);
        echo json_encode($data);
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'programkegiatan?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'programkegiatan?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'programkegiatan';
            $config['first_url'] = base_url() . 'programkegiatan';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->MProgramKegiatan->total_rows($q);
        $programkegiatan = $this->MProgramKegiatan->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'programkegiatan_data' => $programkegiatan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Program & Kegiatan';
        $data['subtitle'] = 'Kegiatan';
        $data['crumb'] = [
            'Programkegiatan' => '',
        ];

        $data['page'] = 'programkegiatan/program_kegiatan_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id)
    {
        $row = $this->MProgramKegiatan->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'program_id' => $row->program_id,
                'no_rekening' => $row->no_rekening,
                'nama' => $row->nama,
            );
            $data['title'] = 'Program & Kegiatan';
            $data['subtitle'] = 'Kegiatan';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'programkegiatan/program_kegiatan_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('programkegiatan'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('programkegiatan/create_action'),
            'id' => set_value('id'),
            'program_id' => set_value('program_id'),
            'no_rekening' => set_value('no_rekening'),
            'nama' => set_value('nama'),
        );
        $data['title'] = 'Program & Kegiatan';
        $data['subtitle'] = 'Kegiatan';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        // get list program
        $data['list_program'] = $this->MProgram->get_all();

        $data['page'] = 'programkegiatan/program_kegiatan_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'program_id' => $this->input->post('program_id', TRUE),
                'no_rekening' => $this->input->post('no_rekening', TRUE),
                'nama' => $this->input->post('nama', TRUE),
            );

            $this->MProgramKegiatan->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('programkegiatan'));
        }
    }

    public function update($id)
    {
        $row = $this->MProgramKegiatan->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('programkegiatan/update_action'),
                'id' => set_value('id', $row->id),
                'program_id' => set_value('program_id', $row->program_id),
                'no_rekening' => set_value('no_rekening', $row->no_rekening),
                'nama' => set_value('nama', $row->nama),
            );
            $data['title'] = 'Program & Kegiatan';
            $data['subtitle'] = 'Kegiatan';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            // get list program
            $data['list_program'] = $this->MProgram->get_all();

            $data['page'] = 'programkegiatan/program_kegiatan_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('programkegiatan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'program_id' => $this->input->post('program_id', TRUE),
                'no_rekening' => $this->input->post('no_rekening', TRUE),
                'nama' => $this->input->post('nama', TRUE),
            );

            $this->MProgramKegiatan->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('programkegiatan'));
        }
    }

    public function delete($id)
    {
        $row = $this->MProgramKegiatan->get_by_id($id);

        if ($row) {
            $this->MProgramKegiatan->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('programkegiatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('programkegiatan'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->MProgramKegiatan->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('program_id', 'program id', 'trim|required');
        $this->form_validation->set_rules('no_rekening', 'no rekening', 'trim|required');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file ProgramKegiatan.php */
/* Location: ./application/controllers/ProgramKegiatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-07 09:14:48 */
/* http://harviacode.com */