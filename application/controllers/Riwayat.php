<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Riwayat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Riwayat_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'Riwayat?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'Riwayat?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'Riwayat';
            $config['first_url'] = base_url() . 'Riwayat';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Riwayat_model->total_rows($q);
        $Riwayat = $this->Riwayat_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'Riwayat_data' => $Riwayat,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Riwayat';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Riwayat' => '',
        ];

        $data['page'] = 'Riwayat/Riwayat_list';
        $this->load->view('template/Backend', $data);
    }

    public function read($id)
    {
        $row = $this->Riwayat_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_riwayat' => $row->id_riwayat,
                'id_produk' => $row->id_produk,
                'tgl_plotting' => $row->tgl_plotting,
                'tgl_selesai' => $row->tgl_selesai,
                'status_kerjaan' => $row->status_kerjaan,
            );
            $data['title'] = 'Riwayat';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'Riwayat/Riwayat_read';
            $this->load->view('template/Backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('Riwayat'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('Riwayat/create_action'),
            'id_riwayat' => set_value('id_riwayat'),
            'id_produk' => set_value('id_produk'),
            'tgl_plotting' => set_value('tgl_plotting'),
            'tgl_selesai' => set_value('tgl_selesai'),
            'status_kerjaan' => set_value('status_kerjaan'),
        );
        $data['title'] = 'Riwayat';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'Riwayat/Riwayat_form';
        $this->load->view('template/Backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_produk' => $this->input->post('id_produk', TRUE),
                'tgl_plotting' => $this->input->post('tgl_plotting', TRUE),
                'tgl_selesai' => $this->input->post('tgl_selesai', TRUE),
                'status_kerjaan' => $this->input->post('status_kerjaan', TRUE),
            );

            $this->Riwayat_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('Riwayat'));
        }
    }

    public function update($id)
    {
        $row = $this->Riwayat_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('Riwayat/update_action'),
                'id_riwayat' => set_value('id_riwayat', $row->id_riwayat),
                'id_produk' => set_value('id_produk', $row->id_produk),
                'tgl_plotting' => set_value('tgl_plotting', $row->tgl_plotting),
                'tgl_selesai' => set_value('tgl_selesai', $row->tgl_selesai),
                'status_kerjaan' => set_value('status_kerjaan', $row->status_kerjaan),
            );
            $data['title'] = 'Riwayat';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'Riwayat/Riwayat_form';
            $this->load->view('template/Backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('Riwayat'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_riwayat', TRUE));
        } else {
            $data = array(
                'id_produk' => $this->input->post('id_produk', TRUE),
                'tgl_plotting' => $this->input->post('tgl_plotting', TRUE),
                'tgl_selesai' => $this->input->post('tgl_selesai', TRUE),
                'status_kerjaan' => $this->input->post('status_kerjaan', TRUE),
            );

            $this->Riwayat_model->update($this->input->post('id_riwayat', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('Riwayat'));
        }
    }

    public function delete($id)
    {
        $row = $this->Riwayat_model->get_by_id($id);

        if ($row) {
            $this->Riwayat_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('Riwayat'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('Riwayat'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->Riwayat_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('success', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_produk', 'id produk', 'trim|required');
        $this->form_validation->set_rules('tgl_plotting', 'tgl plotting', 'trim|required');
        $this->form_validation->set_rules('tgl_selesai', 'tgl selesai', 'trim|required');
        $this->form_validation->set_rules('status_kerjaan', 'status kerjaan', 'trim|required');

        $this->form_validation->set_rules('id_riwayat', 'id_riwayat', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Riwayat.php */
/* Location: ./application/controllers/Riwayat.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-04-01 08:01:50 */
/* http://harviacode.com */