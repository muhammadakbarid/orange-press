<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class ProgramSub extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model(array('MProgramSub', 'MProgramKegiatan'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'programsub?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'programsub?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'programsub';
            $config['first_url'] = base_url() . 'programsub';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->MProgramSub->total_rows($q);
        $programsub = $this->MProgramSub->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'programsub_data' => $programsub,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Program & Kegiatan';
        $data['subtitle'] = 'Sub Kegiatan';
        $data['crumb'] = [
            'Programsub' => '',
        ];

        $data['page'] = 'programsub/program_sub_kegiatan_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id)
    {
        $row = $this->MProgramSub->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'program_kegiatan_id' => $row->program_kegiatan_id,
                'no_rekening' => $row->no_rekening,
                'nama' => $row->nama,
                'tahun' => $row->tahun,
                'anggaran' => $row->anggaran,
            );
            $data['title'] = 'Program & Kegiatan';
            $data['subtitle'] = 'Sub Kegiatan';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'programsub/program_sub_kegiatan_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('programsub'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('programsub/create_action'),
            'id' => set_value('id'),
            'program_kegiatan_id' => set_value('program_kegiatan_id'),
            'no_rekening' => set_value('no_rekening'),
            'nama' => set_value('nama'),
            'tahun' => set_value('tahun'),
            'anggaran' => set_value('anggaran'),
        );
        $data['title'] = 'Program & Kegiatan';
        $data['subtitle'] = 'Sub Kegiatan';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        // list program kegiatan
        $data['list_program_kegiatan'] = $this->MProgramKegiatan->get_all();

        $data['page'] = 'programsub/program_sub_kegiatan_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'program_kegiatan_id' => $this->input->post('program_kegiatan_id', TRUE),
                'no_rekening' => $this->input->post('no_rekening', TRUE),
                'nama' => $this->input->post('nama', TRUE),
                'tahun' => $this->input->post('tahun', TRUE),
                'anggaran' => hilangkantitik($this->input->post('anggaran', TRUE)),
            );

            $this->MProgramSub->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('programsub'));
        }
    }

    public function update($id)
    {
        $row = $this->MProgramSub->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('programsub/update_action'),
                'id' => set_value('id', $row->id),
                'program_kegiatan_id' => set_value('program_kegiatan_id', $row->program_kegiatan_id),
                'no_rekening' => set_value('no_rekening', $row->no_rekening),
                'nama' => set_value('nama', $row->nama),
                'tahun' => set_value('tahun', $row->tahun),
                'anggaran' => set_value('anggaran', $row->anggaran),
            );
            $data['title'] = 'Program & Kegiatan';
            $data['subtitle'] = 'Sub Kegiatan';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            // list program kegiatan
            $data['list_program_kegiatan'] = $this->MProgramKegiatan->get_all();

            $data['page'] = 'programsub/program_sub_kegiatan_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('programsub'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'program_kegiatan_id' => $this->input->post('program_kegiatan_id', TRUE),
                'no_rekening' => $this->input->post('no_rekening', TRUE),
                'nama' => $this->input->post('nama', TRUE),
                'tahun' => $this->input->post('tahun', TRUE),
                'anggaran' => hilangkantitik($this->input->post('anggaran', TRUE)),
            );

            $this->MProgramSub->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('programsub'));
        }
    }

    public function delete($id)
    {
        $row = $this->MProgramSub->get_by_id($id);

        if ($row) {
            $this->MProgramSub->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('programsub'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('programsub'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->MProgramSub->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('program_kegiatan_id', 'program kegiatan id', 'trim|required');
        $this->form_validation->set_rules('no_rekening', 'no rekening', 'trim|required');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
        $this->form_validation->set_rules('anggaran', 'anggaran', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file ProgramSub.php */
/* Location: ./application/controllers/ProgramSub.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-07 10:02:12 */
/* http://harviacode.com */