<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Produk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('Produk_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'produk?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'produk?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'produk';
            $config['first_url'] = base_url() . 'produk';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Produk_model->total_rows($q);
        $produk = $this->Produk_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'produk_data' => $produk,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Produk';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Produk' => '',
        ];

        $data['page'] = 'produk/produk_list';
        $this->load->view('template/Backend', $data);
    }

    public function read($id)
    {
        $row = $this->Produk_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_produk' => $row->id_produk,
                'id_kti' => $row->id_kti,
                'judul' => $row->judul,
                'edisi' => $row->edisi,
                'tgl_submit' => $row->tgl_submit,
                'no_isbn' => $row->no_isbn,
                'file_hakcipta' => $row->file_hakcipta,
            );
            $data['title'] = 'Produk';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'produk/produk_read';
            $this->load->view('template/Backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('produk'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('produk/create_action'),
            'id_produk' => set_value('id_produk'),
            'id_kti' => set_value('id_kti'),
            'judul' => set_value('judul'),
            'edisi' => set_value('edisi'),
            'tgl_submit' => set_value('tgl_submit'),
            'no_isbn' => set_value('no_isbn'),
            'file_hakcipta' => set_value('file_hakcipta'),
        );
        $data['title'] = 'Produk';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'produk/produk_form';
        $this->load->view('template/Backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'id_kti' => $this->input->post('id_kti', TRUE),
                'judul' => $this->input->post('judul', TRUE),
                'edisi' => $this->input->post('edisi', TRUE),
                'tgl_submit' => $this->input->post('tgl_submit', TRUE),
                'no_isbn' => $this->input->post('no_isbn', TRUE),
                'file_hakcipta' => $this->input->post('file_hakcipta', TRUE),
            );

            $this->Produk_model->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('produk'));
        }
    }

    public function update($id)
    {
        $row = $this->Produk_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('produk/update_action'),
                'id_produk' => set_value('id_produk', $row->id_produk),
                'id_kti' => set_value('id_kti', $row->id_kti),
                'judul' => set_value('judul', $row->judul),
                'edisi' => set_value('edisi', $row->edisi),
                'tgl_submit' => set_value('tgl_submit', $row->tgl_submit),
                'no_isbn' => set_value('no_isbn', $row->no_isbn),
                'file_hakcipta' => set_value('file_hakcipta', $row->file_hakcipta),
            );
            $data['title'] = 'Produk';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'produk/produk_form';
            $this->load->view('template/Backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('produk'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_produk', TRUE));
        } else {
            $data = array(
                'id_kti' => $this->input->post('id_kti', TRUE),
                'judul' => $this->input->post('judul', TRUE),
                'edisi' => $this->input->post('edisi', TRUE),
                'tgl_submit' => $this->input->post('tgl_submit', TRUE),
                'no_isbn' => $this->input->post('no_isbn', TRUE),
                'file_hakcipta' => $this->input->post('file_hakcipta', TRUE),
            );

            $this->Produk_model->update($this->input->post('id_produk', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('produk'));
        }
    }

    public function delete($id)
    {
        $row = $this->Produk_model->get_by_id($id);

        if ($row) {
            $this->Produk_model->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('produk'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('produk'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->Produk_model->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('success', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('id_kti', 'id kti', 'trim|required');
        $this->form_validation->set_rules('judul', 'judul', 'trim|required');
        $this->form_validation->set_rules('edisi', 'edisi', 'trim|required');
        $this->form_validation->set_rules('tgl_submit', 'tgl submit', 'trim|required');
        $this->form_validation->set_rules('no_isbn', 'no isbn', 'trim|required');
        $this->form_validation->set_rules('file_hakcipta', 'file hakcipta', 'trim|required');

        $this->form_validation->set_rules('id_produk', 'id_produk', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Produk.php */
/* Location: ./application/controllers/Produk.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2022-04-01 08:01:54 */
/* http://harviacode.com */