<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Distribusi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('M_Distribusi');
        $this->load->library('form_validation');
        $this->load->model('Produk_model');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'distribusi?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'distribusi?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'distribusi';
            $config['first_url'] = base_url() . 'distribusi';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->M_Distribusi->total_rows($q);
        $distribusi = $this->M_Distribusi->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'distribusi_data' => $distribusi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Distribusi';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Distribusi' => '',
        ];

        $data['page'] = 'distribusi/distribusi_list';
        $this->load->view('template/backend', $data);
    }

    public function read($id)
    {
        $row = $this->M_Distribusi->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'id_produk' => $row->id_produk,
                'tujuan_distribusi' => $row->tujuan_distribusi,
                'tanggal_distribusi' => $row->tanggal_distribusi,
            );
            $data['title'] = 'Distribusi';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'distribusi/distribusi_read';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('distribusi'));
        }
    }

    public function create()
    {


        $data = array(
            'button' => 'Create',
            'action' => site_url('distribusi/create_action'),
            'id' => set_value('id'),
            'id_produk' => set_value('id_produk'),
            'tujuan_distribusi' => set_value('tujuan_distribusi'),
            'tanggal_distribusi' => set_value('tanggal_distribusi'),
            'jumlah' => set_value('jumlah'),
        );
        $data['title'] = 'Distribusi';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];
        $data['produk'] = $this->Produk_model->get_produk_distribusi();

        $data['page'] = 'distribusi/distribusi_form';
        $this->load->view('template/backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_produk' => $this->input->post('id_produk', TRUE),
                'tujuan_distribusi' => $this->input->post('tujuan_distribusi', TRUE),
                'tanggal_distribusi' => $this->input->post('tanggal_distribusi', TRUE),
                'jumlah' => $this->input->post('jumlah', TRUE),
            );

            $this->M_Distribusi->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('distribusi'));
        }
    }

    public function update($id)
    {
        $row = $this->M_Distribusi->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('distribusi/update_action'),
                'id' => set_value('id', $row->id),
                'id_produk' => set_value('id_produk', $row->id_produk),
                'tujuan_distribusi' => set_value('tujuan_distribusi', $row->tujuan_distribusi),
                'tanggal_distribusi' => set_value('tanggal_distribusi', $row->tanggal_distribusi),
                'jumlah' => set_value('jumlah', $row->jumlah),
            );
            $data['title'] = 'Distribusi';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];
            $data['produk'] = $this->Produk_model->get_produk_distribusi();
            $data['page'] = 'distribusi/distribusi_form';
            $this->load->view('template/backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('distribusi'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'id_produk' => $this->input->post('id_produk', TRUE),
                'tujuan_distribusi' => $this->input->post('tujuan_distribusi', TRUE),
                'tanggal_distribusi' => $this->input->post('tanggal_distribusi', TRUE),
                'jumlah' => $this->input->post('jumlah', TRUE),
            );

            $this->M_Distribusi->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('distribusi'));
        }
    }

    public function delete($id)
    {
        $row = $this->M_Distribusi->get_by_id($id);

        if ($row) {
            $this->M_Distribusi->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('distribusi'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('distribusi'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->M_Distribusi->deletebulk();
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
        $this->form_validation->set_rules('tujuan_distribusi', 'tujuan distribusi', 'trim|required');
        $this->form_validation->set_rules('tanggal_distribusi', 'tanggal distribusi', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Distribusi.php */
/* Location: ./application/controllers/Distribusi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-05-17 13:40:46 */
/* http://harviacode.com */