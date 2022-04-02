<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Frontend_menu extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $c_url = $this->router->fetch_class();
        $this->layout->auth();
        $this->layout->auth_privilege($c_url);
        $this->load->model('MFrontend_menu');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'frontend_menu?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'frontend_menu?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'frontend_menu';
            $config['first_url'] = base_url() . 'frontend_menu';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->MFrontend_menu->total_rows($q);
        $frontend_menu = $this->MFrontend_menu->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'frontend_menu_data' => $frontend_menu,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $data['title'] = 'Frontend Menu';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Frontend Menu' => '',
        ];

        $data['page'] = 'frontend_menu/frontend_menu_list';
        $this->load->view('template/Backend', $data);
    }

    public function read($id)
    {
        $row = $this->MFrontend_menu->get_by_id($id);
        if ($row) {
            $data = array(
                'id_menu' => $row->id_menu,
                'label' => $row->label,
                'link' => $row->link,
                'id' => $row->id,
                'sort' => $row->sort,
            );
            $data['title'] = 'Frontend Menu';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'frontend_menu/frontend_menu_read';
            $this->load->view('template/Backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('frontend_menu'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('frontend_menu/create_action'),
            'id_menu' => set_value('id_menu'),
            'label' => set_value('label'),
            'link' => set_value('link'),
            'id' => set_value('id'),
            'sort' => set_value('sort'),
        );
        $data['title'] = 'Frontend Menu';
        $data['subtitle'] = '';
        $data['crumb'] = [
            'Dashboard' => '',
        ];

        $data['page'] = 'frontend_menu/frontend_menu_form';
        $this->load->view('template/Backend', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'label' => $this->input->post('label', TRUE),
                'link' => $this->input->post('link', TRUE),
                'id' => $this->input->post('id', TRUE),
                'sort' => $this->input->post('sort', TRUE),
            );

            $this->MFrontend_menu->insert($data);
            $this->session->set_flashdata('success', 'Create Record Success');
            redirect(site_url('frontend_menu'));
        }
    }

    public function update($id)
    {
        $row = $this->MFrontend_menu->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('frontend_menu/update_action'),
                'id_menu' => set_value('id_menu', $row->id_menu),
                'label' => set_value('label', $row->label),
                'link' => set_value('link', $row->link),
                'id' => set_value('id', $row->id),
                'sort' => set_value('sort', $row->sort),
            );
            $data['title'] = 'Frontend Menu';
            $data['subtitle'] = '';
            $data['crumb'] = [
                'Dashboard' => '',
            ];

            $data['page'] = 'frontend_menu/frontend_menu_form';
            $this->load->view('template/Backend', $data);
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('frontend_menu'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_menu', TRUE));
        } else {
            $data = array(
                'label' => $this->input->post('label', TRUE),
                'link' => $this->input->post('link', TRUE),
                'id' => $this->input->post('id', TRUE),
                'sort' => $this->input->post('sort', TRUE),
            );

            $this->MFrontend_menu->update($this->input->post('id_menu', TRUE), $data);
            $this->session->set_flashdata('success', 'Update Record Success');
            redirect(site_url('frontend_menu'));
        }
    }

    public function delete($id)
    {
        $row = $this->MFrontend_menu->get_by_id($id);

        if ($row) {
            $this->MFrontend_menu->delete($id);
            $this->session->set_flashdata('success', 'Delete Record Success');
            redirect(site_url('frontend_menu'));
        } else {
            $this->session->set_flashdata('error', 'Record Not Found');
            redirect(site_url('frontend_menu'));
        }
    }

    public function deletebulk()
    {
        $delete = $this->MFrontend_menu->deletebulk();
        if ($delete) {
            $this->session->set_flashdata('success', 'Delete Record Success');
        } else {
            $this->session->set_flashdata('error', 'Delete Record failed');
        }
        echo $delete;
    }

    public function _rules()
    {
        $this->form_validation->set_rules('label', 'label', 'trim|required');
        $this->form_validation->set_rules('link', 'link', 'trim|required');
        $this->form_validation->set_rules('id', 'id', 'trim|required');
        $this->form_validation->set_rules('sort', 'sort', 'trim|required');

        $this->form_validation->set_rules('id_menu', 'id_menu', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Frontend_menu.php */
/* Location: ./application/controllers/Frontend_menu.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-01-10 11:06:27 */
/* http://harviacode.com */