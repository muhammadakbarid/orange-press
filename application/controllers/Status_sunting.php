<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Status_sunting extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Status_sunting_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'status_sunting?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'status_sunting?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'status_sunting';
            $config['first_url'] = base_url() . 'status_sunting';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Status_sunting_model->total_rows($q);
        $status_sunting = $this->Status_sunting_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'status_sunting_data' => $status_sunting,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Status Sunting';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Status Sunting' => '',
        ];

        $data['page'] = 'status_sunting/status_sunting_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Status_sunting_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_status' => $row->id_status,
		'nama_status' => $row->nama_status,
	    );
        $data['title'] = 'Status Sunting';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'status_sunting/status_sunting_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('status_sunting'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('status_sunting/create_action'),
	    'id_status' => set_value('id_status'),
	    'nama_status' => set_value('nama_status'),
	);
        $data['title'] = 'Status Sunting';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'status_sunting/status_sunting_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama_status' => $this->input->post('nama_status',TRUE),
	    );

            $this->Status_sunting_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('status_sunting'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Status_sunting_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('status_sunting/update_action'),
		'id_status' => set_value('id_status', $row->id_status),
		'nama_status' => set_value('nama_status', $row->nama_status),
	    );
            $data['title'] = 'Status Sunting';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'status_sunting/status_sunting_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('status_sunting'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_status', TRUE));
        } else {
            $data = array(
		'nama_status' => $this->input->post('nama_status',TRUE),
	    );

            $this->Status_sunting_model->update($this->input->post('id_status', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('status_sunting'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Status_sunting_model->get_by_id($id);

        if ($row) {
            $this->Status_sunting_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('status_sunting'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('status_sunting'));
        }
    }

    public function deletebulk(){
        $delete = $this->Status_sunting_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('success', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('nama_status', 'nama status', 'trim|required');

	$this->form_validation->set_rules('id_status', 'id_status', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Status_sunting.php */
/* Location: ./application/controllers/Status_sunting.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-04-01 08:01:46 */
/* http://harviacode.com */