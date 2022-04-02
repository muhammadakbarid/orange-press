<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Pembayaran_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'pembayaran?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'pembayaran?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'pembayaran';
            $config['first_url'] = base_url() . 'pembayaran';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Pembayaran_model->total_rows($q);
        $pembayaran = $this->Pembayaran_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'pembayaran_data' => $pembayaran,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Pembayaran';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Pembayaran' => '',
        ];

        $data['page'] = 'pembayaran/pembayaran_list';
        $this->load->view('template/Backend', $data);
    }

    public function read($id)
    {
        $row = $this->Pembayaran_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_bayar' => $row->id_bayar,
                'id_produk' => $row->id_produk,
                'tanggal_bayar' => $row->tanggal_bayar,
                'jumlah' => $row->jumlah,
                'jenis' => $row->jenis,
            );
            $data['title'] = 'Pembayaran';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'pembayaran/pembayaran_read';
            $this->load->view('template/Backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('pembayaran'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pembayaran/create_action'),
            'id_bayar' => set_value('id_bayar'),
            'id_produk' => set_value('id_produk'),
            'tanggal_bayar' => set_value('tanggal_bayar'),
            'jumlah' => set_value('jumlah'),
            'jenis' => set_value('jenis'),
        );
        $data['title'] = 'Pembayaran';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'pembayaran/pembayaran_form';
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
                'tanggal_bayar' => $this->input->post('tanggal_bayar', TRUE),
                'jumlah' => $this->input->post('jumlah', TRUE),
                'jenis' => $this->input->post('jenis', TRUE),
            );

            $this->Pembayaran_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('pembayaran'));
        }
    }

    public function update($id)
    {
        $row = $this->Pembayaran_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pembayaran/update_action'),
                'id_bayar' => set_value('id_bayar', $row->id_bayar),
                'id_produk' => set_value('id_produk', $row->id_produk),
                'tanggal_bayar' => set_value('tanggal_bayar', $row->tanggal_bayar),
                'jumlah' => set_value('jumlah', $row->jumlah),
                'jenis' => set_value('jenis', $row->jenis),
            );
            $data['title'] = 'Pembayaran';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'pembayaran/pembayaran_form';
            $this->load->view('template/Backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('pembayaran'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_bayar', TRUE));
        } else {
            $data = array(
                'id_produk' => $this->input->post('id_produk', TRUE),
                'tanggal_bayar' => $this->input->post('tanggal_bayar', TRUE),
                'jumlah' => $this->input->post('jumlah', TRUE),
                'jenis' => $this->input->post('jenis', TRUE),
            );

            $this->Pembayaran_model->update($this->input->post('id_bayar', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('pembayaran'));
        }
    }

    public function delete($id)
    {
        $row = $this->Pembayaran_model->get_by_id($id);

        if ($row) {
            $this->Pembayaran_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('pembayaran'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('pembayaran'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->Pembayaran_model->deletebulk();
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
        $this->form_validation->set_rules('tanggal_bayar', 'tanggal bayar', 'trim|required');
        $this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');
        $this->form_validation->set_rules('jenis', 'jenis', 'trim|required');

        $this->form_validation->set_rules('id_bayar', 'id_bayar', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Pembayaran.php */
/* Location: ./application/controllers/Pembayaran.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-04-01 08:01:59 */
/* http://harviacode.com */