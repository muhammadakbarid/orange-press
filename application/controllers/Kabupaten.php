<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kabupaten extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('MKabupaten');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'kabupaten?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kabupaten?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kabupaten';
            $config['first_url'] = base_url() . 'kabupaten';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->MKabupaten->total_rows($q);
        $kabupaten = $this->MKabupaten->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kabupaten_data' => $kabupaten,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Kabupaten';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Kabupaten' => '',
        ];

        $data['page'] = 'kabupaten/kabupaten_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id) 
    {
        $row = $this->MKabupaten->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kab' => $row->id_kab,
		'id_prov' => $row->id_prov,
		'nama' => $row->nama,
		'id_jenis' => $row->id_jenis,
	    );
        $data['title'] = 'Kabupaten';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'kabupaten/kabupaten_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kabupaten'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kabupaten/create_action'),
	    'id_kab' => set_value('id_kab'),
	    'id_prov' => set_value('id_prov'),
	    'nama' => set_value('nama'),
	    'id_jenis' => set_value('id_jenis'),
	);
        $data['title'] = 'Kabupaten';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'kabupaten/kabupaten_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'id_prov' => $this->input->post('id_prov',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'id_jenis' => $this->input->post('id_jenis',TRUE),
	    );

            $this->MKabupaten->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kabupaten'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->MKabupaten->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kabupaten/update_action'),
		'id_kab' => set_value('id_kab', $row->id_kab),
		'id_prov' => set_value('id_prov', $row->id_prov),
		'nama' => set_value('nama', $row->nama),
		'id_jenis' => set_value('id_jenis', $row->id_jenis),
	    );
            $data['title'] = 'Kabupaten';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'kabupaten/kabupaten_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kabupaten'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kab', TRUE));
        } else {
            $data = array(
		'id_prov' => $this->input->post('id_prov',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'id_jenis' => $this->input->post('id_jenis',TRUE),
	    );

            $this->MKabupaten->update($this->input->post('id_kab', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kabupaten'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->MKabupaten->get_by_id($id);

        if ($row) {
            $this->MKabupaten->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kabupaten'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kabupaten'));
        }
    }

    public function deletebulk(){
        $delete = $this->MKabupaten->deletebulk();
        if($delete){
            $this->session->set_flashdata('message', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('id_prov', 'id prov', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('id_jenis', 'id jenis', 'trim|required');

	$this->form_validation->set_rules('id_kab', 'id_kab', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kabupaten.php */
/* Location: ./application/controllers/Kabupaten.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-07 03:22:42 */
/* http://harviacode.com */