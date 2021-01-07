<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Provinsi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('MProvinsi');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'provinsi?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'provinsi?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'provinsi';
            $config['first_url'] = base_url() . 'provinsi';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->MProvinsi->total_rows($q);
        $provinsi = $this->MProvinsi->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'provinsi_data' => $provinsi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Provinsi';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Provinsi' => '',
        ];

        $data['page'] = 'provinsi/provinsi_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->MProvinsi->get_by_id($id);
        if ($row) {
            $data = array(
		'id_prov' => $row->id_prov,
		'nama' => $row->nama,
	    );
        $data['title'] = 'Provinsi';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'provinsi/provinsi_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('provinsi'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('provinsi/create_action'),
	    'id_prov' => set_value('id_prov'),
	    'nama' => set_value('nama'),
	);
        $data['title'] = 'Provinsi';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'provinsi/provinsi_form';
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
	    );

            $this->MProvinsi->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('provinsi'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->MProvinsi->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('provinsi/update_action'),
		'id_prov' => set_value('id_prov', $row->id_prov),
		'nama' => set_value('nama', $row->nama),
	    );
            $data['title'] = 'Provinsi';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'provinsi/provinsi_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('provinsi'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_prov', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
	    );

            $this->MProvinsi->update($this->input->post('id_prov', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('provinsi'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->MProvinsi->get_by_id($id);

        if ($row) {
            $this->MProvinsi->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('provinsi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('provinsi'));
        }
    }

    public function deletebulk(){
        $delete = $this->MProvinsi->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');

	$this->form_validation->set_rules('id_prov', 'id_prov', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Provinsi.php */
/* Location: ./application/controllers/Provinsi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-07 03:22:30 */
/* http://harviacode.com */