<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->layout->auth();
		$data['crumb'] = [
			'Profile' => '',
		];
	}

	public function index()
	{

		$data['crumb'] = [
			'Profile' => ''
		];
		$this->load->model('users_model');
		$data['user'] = $this->db->get_where('users', ['email' => $this->session->userdata('email')])->row_array();
		$data['email'] = $this->session->userdata('email');
		$data['subtitle'] = '';

		$user_id = $this->session->userdata('user_id');
		$data['usergroups'] = $this->users_model->getUserGroups($user_id);

		$data['jenis_kelamin'] = config_item('jenis_kelamin');
		$data['bidang_kompetensi'] = config_item('bidang_kompetensi');
		$data['title'] = 'Profile';
		$email = $this->input->post('email');
		if ($email <> $this->session->userdata('email')) {
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[users.email]', [
				'is_unique' => 'This email has already registered!'
			]);
		} else {
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		}
		$this->form_validation->set_rules('first_name', 'Nama Awal', 'required|trim');
		$this->form_validation->set_rules('last_name', 'Nama Akhir', 'required|trim');
		$this->form_validation->set_rules('no_ktp', 'Nomor KTP', 'required|trim|numeric|min_length[16]|max_length[16]');
		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|trim|numeric');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim');
		$this->form_validation->set_rules('bidang_kompetensi', 'Bidang Kompetensi', 'required|trim');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
		$this->form_validation->set_rules('nip', 'nip', 'required|trim|numeric');
		$this->form_validation->set_rules('no_npwp', 'no npwp', 'required|trim|numeric|min_length[15]|max_length[16]');
		$this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'required|trim');
		$this->form_validation->set_rules('profesi', 'profesi', 'required|trim');
		$this->form_validation->set_rules('nama_instansi', 'nama_instansi', 'required|trim');
		$this->form_validation->set_rules('alamat_instansi', 'alamat_instansi', 'required|trim');
		$this->form_validation->set_rules('email_instansi', 'email_instansi', 'required|trim|valid_email');
		$this->form_validation->set_rules('no_telp_instansi', 'no_telp_instansi', 'required|trim|numeric');


		if ($this->form_validation->run() == false) {
			$data['page'] = 'profile';
			// if there are empty data on $data['user']
			foreach ($data['user'] as $key => $value) {
				if (empty($value)) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Masih ada data yang belum lengkap. Segera Lengkapi data anda!</div>');
				}
			}

			$this->load->view('template/Backend', $data);
		} else {
			$first_name = $this->input->post('first_name');
			$last_name = $this->input->post('last_name');
			$email = $this->input->post('email');
			$no_ktp = $this->input->post('no_ktp');
			$nip = $this->input->post('nip');
			$no_npwp = $this->input->post('no_npwp');
			$jenis_kelamin = $this->input->post('jenis_kelamin');
			$tempat_lahir = $this->input->post('tempat_lahir');
			$tanggal_lahir = $this->input->post('tanggal_lahir');
			$alamat = $this->input->post('alamat');
			$no_hp = $this->input->post('no_hp');
			$profesi = $this->input->post('profesi');
			$nama_instansi = $this->input->post('nama_instansi');
			$alamat_instansi = $this->input->post('alamat_instansi');
			$email_instansi = $this->input->post('email_instansi');
			$no_telp_instansi = $this->input->post('no_telp_instansi');
			$bidang_kompetensi = $this->input->post('bidang_kompetensi');



			//cek jika ada gambar yang akan diupload
			$upload_image = $_FILES['image']['name'];
			$upload_sc_form_penulis = $_FILES['sc_form_penulis']['name'];
			$upload_sc_ktp = $_FILES['sc_ktp']['name'];
			$upload_sc_cv = $_FILES['sc_cv']['name'];
			$upload_sc_npwp = $_FILES['sc_npwp']['name'];
			$upload_sc_foto = $_FILES['sc_foto']['name'];



			if ($upload_image) {
				$config['upload_path'] = './assets/uploads/image/profile/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']     = '2048';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {

					$old_image = $data['user']['image'];
					if ($old_image != 'default.jpg') {
						unlink(FCPATH . 'assets/uploads/image/profile/' . $old_image);
					}

					$new_image = htmlspecialchars($this->upload->data('file_name'));
					$this->db->set('image', $new_image);
				} else {
					$this->session->set_flashdata('success', $this->upload->display_errors());
					redirect('profile');
				}
			}
			if ($upload_sc_form_penulis) {
				$config['upload_path'] = './assets/uploads/files/sc_form_penulis/';
				$config['allowed_types'] = 'pdf|jpg|png|jpeg';
				$config['max_size']     = '2048';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('sc_form_penulis')) {

					$old_sc_form_penulis = $data['user']['sc_form_penulis'];
					if ($old_sc_form_penulis != 'default.jpg') {
						unlink(FCPATH . 'assets/uploads/sc_form_penulis/' . $old_sc_form_penulis);
					}

					$new_sc_form_penulis = htmlspecialchars($this->upload->data('file_name'));
					$this->db->set('sc_form_penulis', $new_sc_form_penulis);
				} else {
					$this->session->set_flashdata('success', $this->upload->display_errors());
					redirect('profile');
				}
			}
			if ($upload_sc_ktp) {
				$config['upload_path'] = './assets/uploads/files/sc_ktp/';
				$config['allowed_types'] = 'pdf|jpg|png|jpeg';
				$config['max_size']     = '2048';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('sc_ktp')) {

					$old_sc_ktp = $data['user']['sc_ktp'];
					if ($old_sc_ktp != 'default.jpg') {
						unlink(FCPATH . 'assets/uploads/sc_ktp/' . $old_sc_ktp);
					}

					$new_sc_ktp = htmlspecialchars($this->upload->data('file_name'));
					$this->db->set('sc_ktp', $new_sc_ktp);
				} else {
					$this->session->set_flashdata('success', $this->upload->display_errors());
					redirect('profile');
				}
			}
			if ($upload_sc_cv) {
				$config['upload_path'] = './assets/uploads/files/sc_cv/';
				$config['allowed_types'] = 'pdf|jpg|png|jpeg';
				$config['max_size']     = '2048';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('sc_cv')) {

					$old_sc_cv = $data['user']['sc_cv'];
					if ($old_sc_cv != 'default.jpg') {
						unlink(FCPATH . 'assets/uploads/sc_cv/' . $old_sc_cv);
					}

					$new_sc_cv = htmlspecialchars($this->upload->data('file_name'));
					$this->db->set('sc_cv', $new_sc_cv);
				} else {
					$this->session->set_flashdata('success', $this->upload->display_errors());
					redirect('profile');
				}
			}
			if ($upload_sc_npwp) {
				$config['upload_path'] = './assets/uploads/files/sc_npwp/';
				$config['allowed_types'] = 'pdf|jpg|png|jpeg';
				$config['max_size']     = '2048';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('sc_npwp')) {

					$old_sc_npwp = $data['user']['sc_npwp'];
					if ($old_sc_npwp != 'default.jpg') {
						unlink(FCPATH . 'assets/uploads/sc_npwp/' . $old_sc_npwp);
					}

					$new_sc_npwp = htmlspecialchars($this->upload->data('file_name'));
					$this->db->set('sc_npwp', $new_sc_npwp);
				} else {
					$this->session->set_flashdata('success', $this->upload->display_errors());
					redirect('profile');
				}
			}
			if ($upload_sc_foto) {
				$config['upload_path'] = './assets/uploads/files/sc_foto/';
				$config['allowed_types'] = 'pdf|jpg|png|jpeg';
				$config['max_size']     = '2048';

				$this->load->library('upload', $config);

				if ($this->upload->do_upload('sc_foto')) {

					$old_sc_foto = $data['user']['sc_foto'];
					if ($old_sc_foto != 'default.jpg') {
						unlink(FCPATH . 'assets/uploads/sc_foto/' . $old_sc_foto);
					}

					$new_sc_foto = htmlspecialchars($this->upload->data('file_name'));
					$this->db->set('sc_foto', $new_sc_foto);
				} else {
					$this->session->set_flashdata('success', $this->upload->display_errors());
					redirect('profile');
				}
			}


			$this->db->set('email', $email);
			$this->db->set('first_name', $first_name);
			$this->db->set('last_name', $last_name);
			$this->db->set('no_ktp', $no_ktp);
			$this->db->set('nip', $nip);
			$this->db->set('no_npwp', $no_npwp);
			$this->db->set('jenis_kelamin', $jenis_kelamin);
			$this->db->set('tempat_lahir', $tempat_lahir);
			$this->db->set('tanggal_lahir', $tanggal_lahir);
			$this->db->set('alamat', $alamat);
			$this->db->set('no_hp', $no_hp);
			$this->db->set('profesi', $profesi);
			$this->db->set('nama_instansi', $nama_instansi);
			$this->db->set('alamat_instansi', $alamat_instansi);
			$this->db->set('email_instansi', $email_instansi);
			$this->db->set('no_telp_instansi', $no_telp_instansi);
			$this->db->set('bidang_kompetensi', $bidang_kompetensi);

			$this->db->where('email', $this->session->userdata('email'));
			$this->db->update('users');



			if ($email <> $this->session->userdata('email')) {
				$this->session->set_flashdata('success', 'Your profile hass been updated!');
				$this->ion_auth->logout();
				redirect('login');
			} else {
				$this->session->set_flashdata('success', 'Your profile hass been updated!');
				redirect('profile');
			}
		}
	}
}
