<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->layout->auth();
        $c_url = $this->router->fetch_class();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Users_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
    }

    public function index()
    {
        // set the flash data error message if there is one
        $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        //list the users
        $data['users'] = $this->ion_auth->users()->result();
        foreach ($data['users'] as $k => $user) {
            $data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
        }
        $data['title'] = 'User';
        $data['subtitle'] = 'Users';
        $data['crumb'] = [
            'Users' => '',
        ];

        $data['page'] = 'users/list';
        $this->load->view('template/Backend', $data);
    }


    public function index2()
    {
        $data['title'] = 'User';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'users/users_list';
        $this->load->view('template/Backend', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Users_model->json();
    }

    public function read($id)
    {
        $row = $this->Users_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'email' => $row->email,
                'name' => $row->first_name . ' ' . $row->last_name,
                'active' => $row->active,
                'image' => $row->image,
                'no_ktp' => $row->no_ktp,
                'nip' => $row->nip,
                'no_npwp' => $row->no_npwp,
                'jenis_kelamin' => $row->jenis_kelamin,
                'tempat_lahir' => $row->tempat_lahir,
                'tanggal_lahir' => $row->tanggal_lahir,
                'alamat' => $row->alamat,
                'no_hp' => $row->no_hp,
                'profesi' => $row->profesi,
                'nama_instansi' => $row->nama_instansi,
                'alamat_instansi' => $row->alamat_instansi,
                'email_instansi' => $row->email_instansi,
                'no_telp_instansi' => $row->no_telp_instansi,
                'sc_form_penulis' => $row->sc_form_penulis,
                'sc_ktp' => $row->sc_ktp,
                'sc_cv' => $row->sc_cv,
                'sc_npwp' => $row->sc_npwp,
                'sc_foto' => $row->sc_foto,
                'bidang_kompetensi' => $row->bidang_kompetensi,
                'create_on' => $row->create_on
            );
            $data['title'] = 'Users';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'users/users_read';
            $this->load->view('template/Backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('users'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('users/create_action'),
            'id' => set_value('id'),
            'email' => set_value('email'),
            'first_name' => set_value('first_name'),
            'last_name' => set_value('last_name'),
            'active' => set_value('active'),
            'image' => set_value('image'),
            'no_ktp' => set_value('no_ktp'),
            'nip' => set_value('nip'),
            'no_npwp' => set_value('no_npwp'),
            'jenis_kelamin' => set_value('jenis_kelamin'),
            'tempat_lahir' => set_value('tempat_lahir'),
            'tanggal_lahir' => set_value('tanggal_lahir'),
            'alamat' => set_value('alamat'),
            'no_hp' => set_value('no_hp'),
            'profesi' => set_value('profesi'),
            'nama_instansi' => set_value('nama_instansi'),
            'alamat_instansi' => set_value('alamat_instansi'),
            'email_instansi' => set_value('email_instansi'),
            'no_telp_instansi' => set_value('no_telp_instansi'),
            'sc_form_penulis' => set_value('sc_form_penulis'),
            'sc_ktp' => set_value('sc_ktp'),
            'sc_cv' => set_value('sc_cv'),
            'sc_npwp' => set_value('sc_npwp'),
            'sc_foto' => set_value('sc_foto'),
            'bidang_kompetensi' => set_value('bidang_kompetensi'),
            'create_on' => set_value('create_on')
        );

        $data['title'] = 'Users';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'users/users_form';
        $this->load->view('template/Backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'email' => $this->input->post('email', TRUE),
                'first_name' => $this->input->post('first_name', TRUE),
                'last_name' => $this->input->post('last_name', TRUE),
                'active' => $this->input->post('active', TRUE),
                'image' => $this->input->post('image', TRUE),
                'no_ktp' => $this->input->post('no_ktp', TRUE),
                'nip' => $this->input->post('nip', TRUE),
                'no_npwp' => $this->input->post('no_npwp', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
                'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'no_hp' => $this->input->post('no_hp', TRUE),
                'profesi' => $this->input->post('profesi', TRUE),
                'nama_instansi' => $this->input->post('nama_instansi', TRUE),
                'alamat_instansi' => $this->input->post('alamat_instansi', TRUE),
                'email_instansi' => $this->input->post('email_instansi', TRUE),
                'no_telp_instansi' => $this->input->post('no_telp_instansi', TRUE),
                'sc_form_penulis' => $this->input->post('sc_form_penulis', TRUE),
                'sc_ktp' => $this->input->post('sc_ktp', TRUE),
                'sc_cv' => $this->input->post('sc_cv', TRUE),
                'sc_npwp' => $this->input->post('sc_npwp', TRUE),
                'sc_foto' => $this->input->post('sc_foto', TRUE),
                'bidang_kompetensi' => $this->input->post('bidang_kompetensi', TRUE),
                // current datetime
                'create_on' => date('Y-m-d H:i:s')
            );

            $this->Users_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('users'));
        }
    }

    public function update($id)
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('users/update_action'),
                'id' => set_value('id', $row->id),
                'email' => set_value('email', $row->email),
                'first_name' => set_value('first_name', $row->first_name),
                'last_name' => set_value('last_name', $row->last_name),
                'active' => set_value('active', $row->active),
                'image' => set_value('image', $row->image),
                'no_ktp' => set_value('no_ktp', $row->no_ktp),
                'nip' => set_value('nip', $row->nip),
                'no_npwp' => set_value('no_npwp', $row->no_npwp),
                'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
                'tempat_lahir' => set_value('tempat_lahir', $row->tempat_lahir),
                'tanggal_lahir' => set_value('tanggal_lahir', $row->tanggal_lahir),
                'alamat' => set_value('alamat', $row->alamat),
                'no_hp' => set_value('no_hp', $row->no_hp),
                'profesi' => set_value('profesi', $row->profesi),
                'nama_instansi' => set_value('nama_instansi', $row->nama_instansi),
                'alamat_instansi' => set_value('alamat_instansi', $row->alamat_instansi),
                'email_instansi' => set_value('email_instansi', $row->email_instansi),
                'no_telp_instansi' => set_value('no_telp_instansi', $row->no_telp_instansi),
                'sc_form_penulis' => set_value('sc_form_penulis', $row->sc_form_penulis),
                'sc_ktp' => set_value('sc_ktp', $row->sc_ktp),
                'sc_cv' => set_value('sc_cv', $row->sc_cv),
                'sc_npwp' => set_value('sc_npwp', $row->sc_npwp),
                'sc_foto' => set_value('sc_foto', $row->sc_foto),
                'bidang_kompetensi' => set_value('bidang_kompetensi', $row->bidang_kompetensi),
                'create_on' => set_value('create_on', $row->create_on),
            );

            $data['title'] = 'Users';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'users/users_form';
            $this->load->view('template/Backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('users'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'email' => $this->input->post('email', TRUE),
                'first_name' => $this->input->post('first_name', TRUE),
                'last_name' => $this->input->post('last_name', TRUE),
                'active' => $this->input->post('active', TRUE),
                'image' => $this->input->post('image', TRUE),
                'no_ktp' => $this->input->post('no_ktp', TRUE),
                'nip' => $this->input->post('nip', TRUE),
                'no_npwp' => $this->input->post('no_npwp', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'tempat_lahir' => $this->input->post('tempat_lahir', TRUE),
                'tanggal_lahir' => $this->input->post('tanggal_lahir', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'no_hp' => $this->input->post('no_hp', TRUE),
                'profesi' => $this->input->post('profesi', TRUE),
                'nama_instansi' => $this->input->post('nama_instansi', TRUE),
                'alamat_instansi' => $this->input->post('alamat_instansi', TRUE),
                'email_instansi' => $this->input->post('email_instansi', TRUE),
                'no_telp_instansi' => $this->input->post('no_telp_instansi', TRUE),
                'sc_form_penulis' => $this->input->post('sc_form_penulis', TRUE),
                'sc_ktp' => $this->input->post('sc_ktp', TRUE),
                'sc_cv' => $this->input->post('sc_cv', TRUE),
                'sc_npwp' => $this->input->post('sc_npwp', TRUE),
                'sc_foto' => $this->input->post('sc_foto', TRUE),
                'bidang_kompetensi' => $this->input->post('bidang_kompetensi', TRUE),
                // current datetime
                'create_on' => $this->input->post('create_on', TRUE)
            );

            $this->Users_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('users'));
        }
    }

    public function delete($id)
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $this->ion_auth->delete_user($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('users'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('users'));
        }
    }

    public function deletebulk()
    {
        $data = $_POST['msg_'];
        $dataid = explode(',', $data);
        foreach ($dataid as $key => $value) {
            $this->Users_model->delete($value);
            $this->session->set_flashdata('success', 'Delete Record Success');
        }
        echo true;
    }
    public function printdoc()
    {
        $data = array(
            'users_data' => $this->Users_model->get_all(),
            'start' => 0
        );
        $this->load->view('users/users_print', $data);
    }
    public function _rules()
    {
        $this->form_validation->set_rules('email', 'email', 'trim|required');
        $this->form_validation->set_rules('first_name', 'first name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'last name', 'trim|required');
        $this->form_validation->set_rules('active', 'active', 'trim|required');
        $this->form_validation->set_rules('image', 'image', 'trim|required');
        $this->form_validation->set_rules('no_ktp', 'no ktp', 'trim|required');
        $this->form_validation->set_rules('nip', 'nip', 'trim|required');
        $this->form_validation->set_rules('no_npwp', 'no npwp', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
        $this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'trim|required');
        $this->form_validation->set_rules('tanggal_lahir', 'tanggal lahir', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('no_hp', 'no hp', 'trim|required');
        $this->form_validation->set_rules('profesi', 'profesi', 'trim|required');
        $this->form_validation->set_rules('nama_instansi', 'nama instansi', 'trim|required');
        $this->form_validation->set_rules('alamat_instansi', 'alamat instansi', 'trim|required');
        $this->form_validation->set_rules('email_instansi', 'email instansi', 'trim|required');
        $this->form_validation->set_rules('no_telp_instansi', 'no telp instansi', 'trim|required');
        $this->form_validation->set_rules('sc_form_penulis', 'sc form penulis', 'trim|required');
        $this->form_validation->set_rules('sc_ktp', 'sc ktp', 'trim|required');
        $this->form_validation->set_rules('sc_cv', 'sc cv', 'trim|required');
        $this->form_validation->set_rules('sc_npwp', 'sc npwp', 'trim|required');
        $this->form_validation->set_rules('sc_foto', 'sc foto', 'trim|required');
        $this->form_validation->set_rules('bidang_kompetensi', 'bidang kompetensi', 'trim|required');
        // $this->form_validation->set_rules('create_on', 'create on', 'trim|required');


        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-11-08 19:47:42 */
/* http://harviacode.com */