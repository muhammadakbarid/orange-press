<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Skpd extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('MSkpd');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'skpd?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'skpd?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'skpd';
            $config['first_url'] = base_url() . 'skpd';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->MSkpd->total_rows($q);
        $skpd = $this->MSkpd->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'skpd_data' => $skpd,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Skpd';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Skpd' => '',
        ];

        $data['page'] = 'skpd/skpd_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->MSkpd->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'nama' => $row->nama,
		'deskripsi' => $row->deskripsi,
	    );
        $data['title'] = 'Skpd';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'skpd/skpd_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('skpd'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('skpd/create_action'),
	    'id' => set_value('id'),
	    'nama' => set_value('nama'),
	    'deskripsi' => set_value('deskripsi'),
	);
        $data['title'] = 'Skpd';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'skpd/skpd_form';
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
		'deskripsi' => $this->input->post('deskripsi',TRUE),
	    );

            $this->MSkpd->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('skpd'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->MSkpd->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('skpd/update_action'),
		'id' => set_value('id', $row->id),
		'nama' => set_value('nama', $row->nama),
		'deskripsi' => set_value('deskripsi', $row->deskripsi),
	    );
            $data['title'] = 'Skpd';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'skpd/skpd_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('skpd'));
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
		'deskripsi' => $this->input->post('deskripsi',TRUE),
	    );

            $this->MSkpd->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('skpd'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->MSkpd->get_by_id($id);

        if ($row) {
            $this->MSkpd->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('skpd'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('skpd'));
        }
    }

    public function deletebulk(){
        $delete = $this->MSkpd->deletebulk();
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
	$this->form_validation->set_rules('deskripsi', 'deskripsi', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Skpd.php */
/* Location: ./application/controllers/Skpd.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-04 06:21:20 */
/* http://harviacode.com */