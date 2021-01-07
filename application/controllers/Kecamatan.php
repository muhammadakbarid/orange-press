<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kecamatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model(array('MKecamatan', 'MKabupaten'));
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'kecamatan?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kecamatan?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kecamatan';
            $config['first_url'] = base_url() . 'kecamatan';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->MKecamatan->total_rows($q);
        $kecamatan = $this->MKecamatan->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kecamatan_data' => $kecamatan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Wilayah';
        $data['subtitle'] = 'Kecamatan';
        $data['crumb'] = [
            'Kecamatan' => '',
        ];

        $data['page'] = 'kecamatan/kecamatan_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id)
    {
        $row = $this->MKecamatan->get_by_id($id);
        if ($row) {
            $data = array(
                'id_kec' => $row->id_kec,
                'id_kab' => $row->id_kab,
                'nama' => $row->nama,
            );
            $data['title'] = 'Wilayah';
            $data['subtitle'] = 'Kecamatan';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'kecamatan/kecamatan_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kecamatan'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('kecamatan/create_action'),
            'id_kec' => set_value('id_kec'),
            'id_kab' => set_value('id_kab'),
            'nama' => set_value('nama'),
        );
        $data['title'] = 'Wilayah';
        $data['subtitle'] = 'Kecamatan';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        // get Kab
        $data['list_kabupaten'] = $this->MKabupaten->get_all();

        $data['page'] = 'kecamatan/kecamatan_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            // get last id_kac
            $last_id_kec = $this->MKecamatan->get_last_id_kec($this->input->post('id_kab', TRUE));
            $new_id_kec = ($last_id_kec->id_kec + 1);
            $data = array(
                'id_kec' => $new_id_kec,
                'id_kab' => $this->input->post('id_kab', TRUE),
                'nama' => $this->input->post('nama', TRUE),
            );

            $this->MKecamatan->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kecamatan'));
        }
    }

    public function update($id)
    {
        $row = $this->MKecamatan->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('kecamatan/update_action'),
                'id_kec' => set_value('id_kec', $row->id_kec),
                'id_kab' => set_value('id_kab', $row->id_kab),
                'nama' => set_value('nama', $row->nama),
            );
            $data['title'] = 'Wilayah';
            $data['subtitle'] = 'Kecamatan';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            // get Kab
            $data['list_kabupaten'] = $this->MKabupaten->get_all();

            $data['page'] = 'kecamatan/kecamatan_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kecamatan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kec', TRUE));
        } else {
            $data = array(
                'id_kab' => $this->input->post('id_kab', TRUE),
                'nama' => $this->input->post('nama', TRUE),
            );

            $this->MKecamatan->update($this->input->post('id_kec', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kecamatan'));
        }
    }

    public function delete($id)
    {
        $row = $this->MKecamatan->get_by_id($id);

        if ($row) {
            $this->MKecamatan->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kecamatan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kecamatan'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->MKecamatan->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('message', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('message_error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_kab', 'id kab', 'trim|required');
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');

        $this->form_validation->set_rules('id_kec', 'id_kec', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Kecamatan.php */
/* Location: ./application/controllers/Kecamatan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-07 03:22:51 */
/* http://harviacode.com */