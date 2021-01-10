<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Akbr_contoh extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Akbr_contoh_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'akbr_contoh?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'akbr_contoh?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'akbr_contoh';
            $config['first_url'] = base_url() . 'akbr_contoh';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Akbr_contoh_model->total_rows($q);
        $akbr_contoh = $this->Akbr_contoh_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'akbr_contoh_data' => $akbr_contoh,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Akbr Contoh';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Akbr Contoh' => '',
        ];

        $data['page'] = 'akbr_contoh/akbr_contoh_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Akbr_contoh_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama' => $row->nama,
		'alamat' => $row->alamat,
		'email' => $row->email,
	    );
        $data['title'] = 'Akbr Contoh';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'akbr_contoh/akbr_contoh_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('akbr_contoh'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('akbr_contoh/create_action'),
	    'id' => set_value('id'),
	    'nama' => set_value('nama'),
	    'alamat' => set_value('alamat'),
	    'email' => set_value('email'),
	);
        $data['title'] = 'Akbr Contoh';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'akbr_contoh/akbr_contoh_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'email' => $this->input->post('email',TRUE),
	    );

            $this->Akbr_contoh_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('akbr_contoh'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Akbr_contoh_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('akbr_contoh/update_action'),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
		'alamat' => set_value('alamat', $row->alamat),
		'email' => set_value('email', $row->email),
	    );
            $data['title'] = 'Akbr Contoh';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'akbr_contoh/akbr_contoh_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('akbr_contoh'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'email' => $this->input->post('email',TRUE),
	    );

            $this->Akbr_contoh_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('akbr_contoh'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Akbr_contoh_model->get_by_id($id);

        if ($row) {
            $this->Akbr_contoh_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('akbr_contoh'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('akbr_contoh'));
        }
    }

    public function deletebulk(){
        $delete = $this->Akbr_contoh_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('success', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('email', 'email', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Akbr_contoh.php */
/* Location: ./application/controllers/Akbr_contoh.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-08 18:39:50 */
/* http://harviacode.com */