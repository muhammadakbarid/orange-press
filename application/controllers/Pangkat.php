<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pangkat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('MPangkat');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Pangkat';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Pangkat' => '',
        ];

        $data['page'] = 'pangkat/pangkat_list';
        $this->load->view('template/backend', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->MPangkat->json();
    }

    public function read($id) 
    {
        $row = $this->MPangkat->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'golongan' => $row->golongan,
		'ruang' => $row->ruang,
		'nama_pangkat' => $row->nama_pangkat,
	    );
        $data['title'] = 'Pangkat';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'pangkat/pangkat_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pangkat'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pangkat/create_action'),
	    'id' => set_value('id'),
	    'golongan' => set_value('golongan'),
	    'ruang' => set_value('ruang'),
	    'nama_pangkat' => set_value('nama_pangkat'),
	);
        $data['title'] = 'Pangkat';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'pangkat/pangkat_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'golongan' => $this->input->post('golongan',TRUE),
		'ruang' => $this->input->post('ruang',TRUE),
		'nama_pangkat' => $this->input->post('nama_pangkat',TRUE),
	    );

            $this->MPangkat->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pangkat'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->MPangkat->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pangkat/update_action'),
		'id' => set_value('id', $row->id),
		'golongan' => set_value('golongan', $row->golongan),
		'ruang' => set_value('ruang', $row->ruang),
		'nama_pangkat' => set_value('nama_pangkat', $row->nama_pangkat),
	    );
            $data['title'] = 'Pangkat';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'pangkat/pangkat_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pangkat'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'golongan' => $this->input->post('golongan',TRUE),
		'ruang' => $this->input->post('ruang',TRUE),
		'nama_pangkat' => $this->input->post('nama_pangkat',TRUE),
	    );

            $this->MPangkat->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pangkat'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->MPangkat->get_by_id($id);

        if ($row) {
            $this->MPangkat->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pangkat'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pangkat'));
        }
    }

    public function deletebulk(){
        $delete = $this->MPangkat->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('golongan', 'golongan', 'trim|required');
	$this->form_validation->set_rules('ruang', 'ruang', 'trim|required');
	$this->form_validation->set_rules('nama_pangkat', 'nama pangkat', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Pangkat.php */
/* Location: ./application/controllers/Pangkat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-04 14:40:33 */
/* http://harviacode.com */