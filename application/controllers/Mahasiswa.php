<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth(); 
        $this->layout->auth_privilege($c_url);
        $this->load->model('MMahasiswa');
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['title'] = 'Mahasiswa';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Mahasiswa' => '',
        ];

        $data['page'] = 'mahasiswa/mahasiswa_list';
        $this->load->view('template/backend', $data);
    } 
    
    public function json() {
        header('Content-Type: application/json');
        echo $this->MMahasiswa->json();
    }

    public function read($id) 
    {
        $row = $this->MMahasiswa->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'npm' => $row->npm,
		'nama' => $row->nama,
		'tgl_lahir' => $row->tgl_lahir,
	    );
        $data['title'] = 'Mahasiswa';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'mahasiswa/mahasiswa_read';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('mahasiswa'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('mahasiswa/create_action'),
	    'id' => set_value('id'),
	    'npm' => set_value('npm'),
	    'nama' => set_value('nama'),
	    'tgl_lahir' => set_value('tgl_lahir'),
	);
        $data['title'] = 'Mahasiswa';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'mahasiswa/mahasiswa_form';
        $this->load->view('template/backend', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'npm' => $this->input->post('npm',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'tgl_lahir' => $this->input->post('tgl_lahir',TRUE),
	    );

            $this->MMahasiswa->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('mahasiswa'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->MMahasiswa->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('mahasiswa/update_action'),
		'id' => set_value('id', $row->id),
		'npm' => set_value('npm', $row->npm),
		'nama' => set_value('nama', $row->nama),
		'tgl_lahir' => set_value('tgl_lahir', $row->tgl_lahir),
	    );
            $data['title'] = 'Mahasiswa';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'mahasiswa/mahasiswa_form';
        $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('mahasiswa'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'npm' => $this->input->post('npm',TRUE),
		'nama' => $this->input->post('nama',TRUE),
		'tgl_lahir' => $this->input->post('tgl_lahir',TRUE),
	    );

            $this->MMahasiswa->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('mahasiswa'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->MMahasiswa->get_by_id($id);

        if ($row) {
            $this->MMahasiswa->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('mahasiswa'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('mahasiswa'));
        }
    }

    public function deletebulk(){
        $delete = $this->MMahasiswa->deletebulk();
        if($delete){
            $this->session->set_flashdata('success', 'Delete Record Success');
        }else{
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }
   
    public function _rules() 
    {
	$this->form_validation->set_rules('npm', 'npm', 'trim|required');
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('tgl_lahir', 'tgl lahir', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "mahasiswa.xls";
        $judul = "mahasiswa";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "Npm");
	xlsWriteLabel($tablehead, $kolomhead++, "Nama");
	xlsWriteLabel($tablehead, $kolomhead++, "Tgl Lahir");

	foreach ($this->MMahasiswa->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteNumber($tablebody, $kolombody++, $data->npm);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nama);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tgl_lahir);

	    $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=mahasiswa.doc");

        $data = array(
            'mahasiswa_data' => $this->MMahasiswa->get_all(),
            'start' => 0
        );
        
        $this->load->view('mahasiswa/mahasiswa_doc',$data);
    }

  public function printdoc(){
        $data = array(
            'mahasiswa_data' => $this->MMahasiswa->get_all(),
            'start' => 0
        );
        $this->load->view('mahasiswa/mahasiswa_print', $data);
    }

}

/* End of file Mahasiswa.php */
/* Location: ./application/controllers/Mahasiswa.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-08 19:27:25 */
/* http://harviacode.com */