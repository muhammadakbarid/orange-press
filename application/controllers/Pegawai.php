<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model(array('MPegawai', 'MPangkat', 'MSkpdBagian', 'MSkpdSubBagian'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'pegawai?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pegawai?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pegawai';
            $config['first_url'] = base_url() . 'pegawai';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->MPegawai->total_rows($q);
        $pegawai = $this->MPegawai->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pegawai_data' => $pegawai,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Pegawai';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Pegawai' => '',
        ];

        $data['page'] = 'pegawai/pegawai_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id)
    {
        $row = $this->MPegawai->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'nip' => $row->nip,
                'nama' => $row->nama,
                'jenis_kelamin' => $row->jenis_kelamin,
                'jabatan' => $row->jabatan,
                'pangkat_id' => $row->pangkat_id,
                'jabatan_status' => $row->jabatan_status,
                'jabatan_fungsi' => $row->jabatan_fungsi,
                'eselon' => $row->eselon,
                'skpd_sub_bagian_id' => $row->skpd_sub_bagian_id,
                'komisi' => $row->komisi,
                'status' => $row->status,
                'create_on' => $row->create_on,
                'users_id' => $row->users_id,
            );
            $data['title'] = 'Pegawai';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'pegawai/pegawai_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pegawai/create_action'),
            'id' => set_value('id'),
            'nip' => set_value('nip'),
            'nama' => set_value('nama'),
            'jenis_kelamin' => set_value('jenis_kelamin'),
            'jabatan' => set_value('jabatan'),
            'pangkat_id' => set_value('pangkat_id'),
            'jabatan_status' => set_value('jabatan_status'),
            'jabatan_fungsi' => set_value('jabatan_fungsi'),
            'eselon' => set_value('eselon'),
            'skpd_sub_bagian_id' => set_value('skpd_sub_bagian_id'),
            'komisi' => set_value('komisi'),
            'status' => set_value('status'),
            'skpd_bagian_id' => set_value('skpd_bagian_id'),
            'users_id' => set_value('users_id'),
        );
        $data['title'] = 'Pegawai';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        // jika submit memilih SKPD bagian
        if ($data['skpd_bagian_id']) {
            $data['list_skpd_sub_bagian'] = $this->MSkpdSubBagian->get_all_by_skpd_bidang_id($data['skpd_bagian_id']);
        }

        // get data pangkat
        $data['list_pangkat'] = $this->MPangkat->get_all();
        // get status jabatan
        $data['list_status_jabatan'] = $this->config->item('list_status_jabatan');
        // get fungsi lain jabaran
        $data['list_fungsi_jabatan'] = $this->config->item('list_fungsi_jabatan');
        // get eselon
        $data['list_eselon'] = $this->config->item('list_eselon');
        $data['list_komisi'] = $this->config->item('list_komisi');
        // get SKPD bagian
        $data['list_skpd_bagian'] = $this->MSkpdBagian->get_all();

        $data['page'] = 'pegawai/pegawai_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nip' => $this->input->post('nip', TRUE),
                'nama' => $this->input->post('nama', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'jabatan' => $this->input->post('jabatan', TRUE),
                'pangkat_id' => $this->input->post('pangkat_id', TRUE),
                'jabatan_status' => $this->input->post('jabatan_status', TRUE),
                'jabatan_fungsi' => $this->input->post('jabatan_fungsi', TRUE),
                'eselon' => $this->input->post('eselon', TRUE),
                'skpd_sub_bagian_id' => $this->input->post('skpd_sub_bagian_id', TRUE),
                'komisi' => $this->input->post('komisi', TRUE),
                'status' => $this->input->post('status', TRUE),
                'users_id' => $this->session->userdata('user_id'),
            );

            $this->MPegawai->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('pegawai'));
        }
    }

    public function update($id)
    {
        $row = $this->MPegawai->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pegawai/update_action'),
                'id' => set_value('id', $row->id),
                'nip' => set_value('nip', $row->nip),
                'nama' => set_value('nama', $row->nama),
                'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
                'jabatan' => set_value('jabatan', $row->jabatan),
                'pangkat_id' => set_value('pangkat_id', $row->pangkat_id),
                'jabatan_status' => set_value('jabatan_status', $row->jabatan_status),
                'jabatan_fungsi' => set_value('jabatan_fungsi', $row->jabatan_fungsi),
                'eselon' => set_value('eselon', $row->eselon),
                'skpd_sub_bagian_id' => set_value('skpd_sub_bagian_id', $row->skpd_sub_bagian_id),
                'komisi' => set_value('komisi', $row->komisi),
                'status' => set_value('status', $row->status),
                'create_on' => set_value('create_on', $row->create_on),
                'users_id' => set_value('users_id', $row->users_id),
            );
            $data['title'] = 'Pegawai';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'pegawai/pegawai_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'nip' => $this->input->post('nip', TRUE),
                'nama' => $this->input->post('nama', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'jabatan' => $this->input->post('jabatan', TRUE),
                'pangkat_id' => $this->input->post('pangkat_id', TRUE),
                'jabatan_status' => $this->input->post('jabatan_status', TRUE),
                'jabatan_fungsi' => $this->input->post('jabatan_fungsi', TRUE),
                'eselon' => $this->input->post('eselon', TRUE),
                'skpd_sub_bagian_id' => $this->input->post('skpd_sub_bagian_id', TRUE),
                'komisi' => $this->input->post('komisi', TRUE),
                'status' => $this->input->post('status', TRUE),
                'create_on' => $this->input->post('create_on', TRUE),
                'users_id' => $this->input->post('users_id', TRUE),
            );

            $this->MPegawai->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pegawai'));
        }
    }

    public function delete($id)
    {
        $row = $this->MPegawai->get_by_id($id);

        if ($row) {
            $this->MPegawai->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pegawai'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pegawai'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->MPegawai->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
        $this->form_validation->set_rules('jabatan', 'jabatan', 'trim|required');
        $this->form_validation->set_rules('pangkat_id', 'pangkat id', 'trim|required');
        $this->form_validation->set_rules('status', 'status', 'trim|required');
        $this->form_validation->set_rules('skpd_sub_bagian_id', 'skpd sub bagian id', 'trim|required');
        $this->form_validation->set_rules('skpd_bagian_id', 'SKPD Bagian', 'trim|required');
        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "pegawai.xls";
        $judul = "pegawai";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nip");
        xlsWriteLabel($tablehead, $kolomhead++, "Nama");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
        xlsWriteLabel($tablehead, $kolomhead++, "Jabatan");
        xlsWriteLabel($tablehead, $kolomhead++, "Pangkat Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Jabatan Status");
        xlsWriteLabel($tablehead, $kolomhead++, "Jabatan Fungsi");
        xlsWriteLabel($tablehead, $kolomhead++, "Eselon");
        xlsWriteLabel($tablehead, $kolomhead++, "Skpd Sub Bagian Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Komisi");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");
        xlsWriteLabel($tablehead, $kolomhead++, "Create On");
        xlsWriteLabel($tablehead, $kolomhead++, "Users Id");

        foreach ($this->MPegawai->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nip);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
            xlsWriteLabel($tablebody, $kolombody++, $data->jabatan);
            xlsWriteNumber($tablebody, $kolombody++, $data->pangkat_id);
            xlsWriteNumber($tablebody, $kolombody++, $data->jabatan_status);
            xlsWriteNumber($tablebody, $kolombody++, $data->jabatan_fungsi);
            xlsWriteNumber($tablebody, $kolombody++, $data->eselon);
            xlsWriteNumber($tablebody, $kolombody++, $data->skpd_sub_bagian_id);
            xlsWriteNumber($tablebody, $kolombody++, $data->komisi);
            xlsWriteLabel($tablebody, $kolombody++, $data->status);
            xlsWriteLabel($tablebody, $kolombody++, $data->create_on);
            xlsWriteNumber($tablebody, $kolombody++, $data->users_id);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function printdoc()
    {
        $data = array(
            'pegawai_data' => $this->MPegawai->get_all(),
            'start' => 0
        );
        $this->load->view('pegawai/pegawai_print', $data);
    }
}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-06 09:10:51 */
/* http://harviacode.com */