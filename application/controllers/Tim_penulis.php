<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tim_penulis extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('Tim_penulis_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'tim_penulis?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'tim_penulis?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'tim_penulis';
            $config['first_url'] = base_url() . 'tim_penulis';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Tim_penulis_model->total_rows($q);
        $tim_penulis = $this->Tim_penulis_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tim_penulis_data' => $tim_penulis,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Tim Penulis';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Tim Penulis' => '',
        ];

        $data['page'] = 'tim_penulis/tim_penulis_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->Tim_penulis_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'id_penulis' => $row->id_penulis,
		'id_produk' => $row->id_produk,
		'penulis_ke' => $row->penulis_ke,
		'status' => $row->status,
	    );
        $data['title'] = 'Tim Penulis';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'tim_penulis/tim_penulis_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('tim_penulis'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tim_penulis/create_action'),
	    'id' => set_value('id'),
	    'id_penulis' => set_value('id_penulis'),
	    'id_produk' => set_value('id_produk'),
	    'penulis_ke' => set_value('penulis_ke'),
	    'status' => set_value('status'),
	);
        $data['title'] = 'Tim Penulis';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'tim_penulis/tim_penulis_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_penulis' => $this->input->post('id_penulis',TRUE),
		'id_produk' => $this->input->post('id_produk',TRUE),
		'penulis_ke' => $this->input->post('penulis_ke',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Tim_penulis_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('tim_penulis'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tim_penulis_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tim_penulis/update_action'),
		'id' => set_value('id', $row->id),
		'id_penulis' => set_value('id_penulis', $row->id_penulis),
		'id_produk' => set_value('id_produk', $row->id_produk),
		'penulis_ke' => set_value('penulis_ke', $row->penulis_ke),
		'status' => set_value('status', $row->status),
	    );
            $data['title'] = 'Tim Penulis';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'tim_penulis/tim_penulis_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('tim_penulis'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'id_penulis' => $this->input->post('id_penulis',TRUE),
		'id_produk' => $this->input->post('id_produk',TRUE),
		'penulis_ke' => $this->input->post('penulis_ke',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

            $this->Tim_penulis_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('tim_penulis'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tim_penulis_model->get_by_id($id);

        if ($row) {
            $this->Tim_penulis_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('tim_penulis'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('tim_penulis'));
        }
    }

    public function deletebulk(){
        $delete = $this->Tim_penulis_model->deletebulk();
        if($delete){
            $this->session->set_flashdata('success', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('id_penulis', 'id penulis', 'trim|required');
	$this->form_validation->set_rules('id_produk', 'id produk', 'trim|required');
	$this->form_validation->set_rules('penulis_ke', 'penulis ke', 'trim|required');
	$this->form_validation->set_rules('status', 'status', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Tim_penulis.php */
/* Location: ./application/controllers/Tim_penulis.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-04-01 08:01:41 */
/* http://harviacode.com */