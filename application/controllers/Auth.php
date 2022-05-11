<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */
class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth', 'form_validation'));
		$this->load->helper(array('url', 'language'));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}

	/**
	 * Redirect if needed, otherwise display the user list
	 */
	public function index()
	{

		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('login', 'refresh');
		} else {
			redirect('dashboard');
		}
	}

	/**
	 * Log the user in
	 */
	public function login()
	{
		$this->data['title'] = $this->lang->line('login_heading');
		if ($this->ion_auth->logged_in()) {
			redirect('dashboard');
		}
		// validate form input
		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

		if ($this->form_validation->run() === TRUE) {
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool)$this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
				//if the login is successful
				//redirect them back to the home page

				$this->session->set_flashdata('success', $this->ion_auth->messages());
				redirect('dashboard', 'refresh');
			} else {
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('success', $this->ion_auth->errors());
				redirect('login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		} else {
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array(
				'name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array(
				'name' => 'password',
				'id' => 'password',
				'type' => 'password',
			);

			$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'login', $this->data);
		}
	}

	/**
	 * Log the user out
	 */
	public function logout()
	{
		$this->data['title'] = "Logout";

		// log the user out
		$logout = $this->ion_auth->logout();

		// redirect them to the login page
		$this->session->set_flashdata('success', $this->ion_auth->messages());
		redirect('login', 'refresh');
	}

	/**
	 * Change password
	 */
	public function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in()) {
			redirect('login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() === FALSE) {
			// display the form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array(
				'name' => 'old',
				'id' => 'old',
				'type' => 'password',
			);
			$this->data['new_password'] = array(
				'name' => 'new',
				'id' => 'new',
				'type' => 'password',
				'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
			);
			$this->data['new_password_confirm'] = array(
				'name' => 'new_confirm',
				'id' => 'new_confirm',
				'type' => 'password',
				'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
			);
			$this->data['user_id'] = array(
				'name' => 'user_id',
				'id' => 'user_id',
				'type' => 'hidden',
				'value' => $user->id,
			);

			// render
			$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'change_password', $this->data);
		} else {
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change) {
				//if the password was successfully changed
				$this->session->set_flashdata('success', $this->ion_auth->messages());
				$this->logout();
			} else {
				$this->session->set_flashdata('error', $this->ion_auth->errors());
				redirect('auth/change_password', 'refresh');
			}
		}
	}

	/**
	 * Forgot password
	 */
	public function forgot_password()
	{
		$this->data['title'] = 'Forgot Password';
		$this->data['subtitle'] = '';
		$this->data['crumb'] = [
			'User' => '',
		];
		// setting validation rules by checking whether identity is username or email
		if ($this->config->item('identity', 'ion_auth') != 'email') {
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		} else {
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}


		if ($this->form_validation->run() === FALSE) {
			$this->data['type'] = $this->config->item('identity', 'ion_auth');
			// setup the input
			$this->data['identity'] = array(
				'name' => 'identity',
				'id' => 'identity',
			);

			if ($this->config->item('identity', 'ion_auth') != 'email') {
				$this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			} else {
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			// set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'forgot_password', $this->data);
		} else {
			$identity_column = $this->config->item('identity', 'ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

			if (empty($identity)) {

				if ($this->config->item('identity', 'ion_auth') != 'email') {
					$this->ion_auth->set_error('forgot_password_identity_not_found');
				} else {
					$this->ion_auth->set_error('forgot_password_email_not_found');
				}

				$this->session->set_flashdata('error', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten) {
				// if there were no errors
				$this->session->set_flashdata('success', $this->ion_auth->messages());
				redirect("login", 'refresh'); //we should display a confirmation page here instead of the login page
			} else {
				$this->session->set_flashdata('error', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	/**
	 * Reset password - final step for forgotten password
	 *
	 * @param string|null $code The reset code
	 */
	public function reset_password($code = NULL)
	{
		if (!$code) {
			show_404();
		}

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user) {
			// if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() === FALSE) {
				// display the form

				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = array(
					'name' => 'new',
					'id' => 'new',
					'type' => 'password',
					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				);
				$this->data['new_password_confirm'] = array(
					'name' => 'new_confirm',
					'id' => 'new_confirm',
					'type' => 'password',
					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				);
				$this->data['user_id'] = array(
					'name' => 'user_id',
					'id' => 'user_id',
					'type' => 'hidden',
					'value' => $user->id,
				);
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				// render
				$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'reset_password', $this->data);
			} else {
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) {

					// something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($code);

					show_error($this->lang->line('error_csrf'));
				} else {
					// finally change the password
					$identity = $user->{$this->config->item('identity', 'ion_auth')};

					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change) {
						// if the password was successfully changed
						$this->session->set_flashdata('success', $this->ion_auth->messages());
						redirect("login", 'refresh');
					} else {
						$this->session->set_flashdata('error', $this->ion_auth->errors());
						redirect('auth/reset_password/' . $code, 'refresh');
					}
				}
			}
		} else {
			// if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('error', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	/**
	 * Activate the user
	 *
	 * @param int         $id   The user ID
	 * @param string|bool $code The activation code
	 */
	public function activate($id, $code = FALSE)
	{
		if ($code !== FALSE) {
			$activation = $this->ion_auth->activate($id, $code);
		} else if ($this->ion_auth->is_admin()) {
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation) {
			// redirect them to the auth page
			$this->session->set_flashdata('success', $this->ion_auth->messages());
			if ($code !== FALSE) {
				redirect("auth", 'refresh');
			} else {
				redirect("users", 'refresh');
			}
		} else {
			// redirect them to the forgot password page
			$this->session->set_flashdata('error', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	/**
	 * Deactivate the user
	 *
	 * @param int|string|null $id The user ID
	 */
	public function deactivate($id = NULL)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			// redirect them to the home page because they must be an administrator to view this
			return show_error('You must be an administrator to view this page.');
		}

		$id = (int)$id;

		$this->load->library('form_validation');
		// $this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() === FALSE) {
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();
			$this->data['title'] = 'User';
			$this->data['subtitle'] = '';
			$this->data['crumb'] = [
				'User' => '',
			];

			$this->data['page'] = 'auth/deactivate_user';
			$this->load->view('template/backend', $this->data);
			//$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'deactivate_user', $this->data);
		} else {
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes') {
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
					return show_error($this->lang->line('error_csrf'));
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
					$this->ion_auth->deactivate($id);
					$this->session->set_flashdata('success', $this->ion_auth->messages());
				}
			}

			// redirect them back to the auth page
			redirect('users', 'refresh');
		}
	}


	/**
	 * Create a new user
	 */

	public function create_user()
	{
		$this->data['title'] = $this->lang->line('create_user_heading');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			redirect('auth', 'refresh');
		}

		$tables = $this->config->item('tables', 'ion_auth');
		$identity_column = $this->config->item('identity', 'ion_auth');
		$groups = $this->ion_auth->groups()->result_array();
		$this->data['identity_column'] = $identity_column;

		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'trim|required');
		$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'trim|required');
		if ($identity_column !== 'email') {
			$this->form_validation->set_rules('identity', $this->lang->line('create_user_validation_identity_label'), 'trim|required|is_unique[' . $tables['users'] . '.' . $identity_column . ']');
			$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email');
		} else {
			$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
		}

		$this->form_validation->set_rules('no_hp', $this->lang->line('create_user_validation_no_hp_label'), 'trim');
		$this->form_validation->set_rules('no_ktp', $this->lang->line('create_user_validation_no_ktp_label'), 'trim');
		$this->form_validation->set_rules('nip', $this->lang->line('create_user_validation_nip_label'), 'trim');
		$this->form_validation->set_rules('no_npwp', $this->lang->line('create_user_validation_no_npwp_label'), 'trim');
		$this->form_validation->set_rules('jenis_kelamin', $this->lang->line('create_user_validation_jenis_kelamin_label'), 'trim');
		$this->form_validation->set_rules('tempat_lahir', $this->lang->line('create_user_validation_tempat_lahir_label'), 'trim');
		$this->form_validation->set_rules('tanggal_lahir', $this->lang->line('create_user_validation_tanggal_lahir_label'), 'trim');
		$this->form_validation->set_rules('alamat', $this->lang->line('create_user_validation_alamat_label'), 'trim');
		$this->form_validation->set_rules('profesi', $this->lang->line('create_user_validation_profesi_label'), 'trim');
		$this->form_validation->set_rules('bidang_kompetensi', $this->lang->line('create_user_validation_bidang_kompetensi_label'), 'trim');

		$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

		if ($this->form_validation->run() === TRUE) {
			$email = strtolower($this->input->post('email'));
			$identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
			$password = $this->input->post('password');

			$additional_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'phone' => $this->input->post('no_hp'),
				'no_ktp' => $this->input->post('no_ktp'),
				'nip' => $this->input->post('nip'),
				'no_npwp' => $this->input->post('no_npwp'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'tempat_lahir' => $this->input->post('tempat_lahir'),
				'tanggal_lahir' => $this->input->post('tanggal_lahir'),
				'alamat' => $this->input->post('alamat'),
				'profesi' => $this->input->post('profesi'),
				'bidang_kompetensi' => $this->input->post('bidang_kompetensi')

			);
			$hak_akses = $this->input->post('groups[]');
		}
		if ($this->form_validation->run() === TRUE && $this->ion_auth->register($identity, $password, $email, $additional_data, $hak_akses)) {
			// check to see if we are creating the user
			// redirect them back to the admin page
			$this->session->set_flashdata('success', $this->ion_auth->messages());

			redirect("user", 'refresh');
		} else {
			// display the create user form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));


			$this->data['first_name'] = array(
				'name' => 'first_name',
				'id' => 'first_name',
				'type' => 'text',
				'value' => $this->form_validation->set_value('first_name'),
				'class' => 'form-control'
			);
			$this->data['last_name'] = array(
				'name' => 'last_name',
				'id' => 'last_name',
				'type' => 'text',
				'value' => $this->form_validation->set_value('last_name'),
				'class' => 'form-control'
			);
			$this->data['foto'] = array(
				'name' => 'foto',
				'id' => 'foto',
				'type' => 'file',
				'value' => $this->form_validation->set_value('foto'),
				'class' => 'form-control'
			);
			$this->data['identity'] = array(
				'name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
				'class' => 'form-control'
			);
			$this->data['email'] = array(
				'name' => 'email',
				'id' => 'email',
				'type' => 'text',
				'value' => $this->form_validation->set_value('email'),
				'class' => 'form-control'
			);
			$this->data['no_ktp'] = array(
				'name' => 'no_ktp',
				'id' => 'no_ktp',
				'type' => 'text',
				'value' => $this->form_validation->set_value('no_ktp'),
				'class' => 'form-control'
			);
			$this->data['nip'] = array(
				'name' => 'nip',
				'id' => 'nip',
				'type' => 'text',
				'value' => $this->form_validation->set_value('nip'),
				'class' => 'form-control'
			);
			$this->data['no_npwp'] = array(
				'name' => 'no_npwp',
				'id' => 'no_npwp',
				'type' => 'text',
				'value' => $this->form_validation->set_value('no_npwp'),
				'class' => 'form-control'
			);
			$this->data['jenis_kelamin'] = array(
				'name' => 'jenis_kelamin',
				'id' => 'jenis_kelamin',
				'type' => 'text',
				'value' => $this->form_validation->set_value('jenis_kelamin'),
				'class' => 'form-control'
			);
			$this->data['tanggal_lahir'] = array(
				'name' => 'tanggal_lahir',
				'id' => 'tanggal_lahir',
				'type' => 'text',
				'value' => $this->form_validation->set_value('tanggal_lahir'),
				'class' => 'form-control'
			);
			$this->data['alamat'] = array(
				'name' => 'alamat',
				'id' => 'alamat',
				'type' => 'text',
				'value' => $this->form_validation->set_value('alamat'),
				'class' => 'form-control'
			);
			$this->data['no_hp'] = array(
				'name' => 'no_hp',
				'id' => 'no_hp',
				'type' => 'text',
				'value' => $this->form_validation->set_value('no_hp'),
				'class' => 'form-control'
			);
			$this->data['profesi'] = array(
				'name' => 'profesi',
				'id' => 'profesi',
				'type' => 'text',
				'value' => $this->form_validation->set_value('profesi'),
				'class' => 'form-control'
			);

			$this->data['tempat_lahir'] = array(
				'name' => 'tempat_lahir',
				'id' => 'tempat_lahir',
				'type' => 'text',
				'value' => $this->form_validation->set_value('tempat_lahir'),
				'class' => 'form-control'
			);

			$this->data['bidang_kompetensi'] = array(
				'name' => 'bidang_kompetensi',
				'id' => 'bidang_kompetensi',
				'type' => 'text',
				'value' => $this->form_validation->set_value('bidang_kompetensi'),
				'class' => 'form-control'
			);
			$this->data['password'] = array(
				'name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'value' => $this->form_validation->set_value('password'),
				'class' => 'form-control'
			);
			$this->data['password_confirm'] = array(
				'name' => 'password_confirm',
				'id' => 'password_confirm',
				'type' => 'password',
				'value' => $this->form_validation->set_value('password_confirm'),
				'class' => 'form-control'
			);
			$this->data['title'] = 'User';
			$this->data['subtitle'] = '';
			$this->data['crumb'] = [
				'User' => '',
			];

			$this->data['groups'] = $groups;


			$this->data['jenis_kelamin_opt'] = config_item('jenis_kelamin');
			$this->data['bidang_kompetensi_opt'] = config_item('bidang_kompetensi');


			$this->data['page'] = 'auth/create_user';
			$this->load->view('template/backend', $this->data);
			//$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'create_user', $this->data);
		}
	}

	/**
	 * Redirect a user checking if is admin
	 */
	public function redirectUser()
	{
		if ($this->ion_auth->is_admin()) {
			redirect('users', 'refresh');
		}
		redirect('/', 'refresh');
	}

	/**
	 * Edit a user
	 *
	 * @param int|string $id
	 */

	public function unlink_file($url, $old)
	{
		unlink(FCPATH . $url . $old);
	}

	public function edit_user($id)
	{
		$this->data['title'] = $this->lang->line('edit_user_heading');

		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
			redirect('auth', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();

		$groups = $this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'trim|required');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'trim|required');
		// $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'trim|required');
		// $this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'trim|required');

		if (isset($_POST) && !empty($_POST)) {
			// do we have a valid request?
			// if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
			// 	show_error($this->lang->line('error_csrf'));
			// }

			// update the password if it was posted
			if ($this->input->post('password')) {
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE) {

				//cek jika ada gambar yang akan diupload
				$upload_image = $_FILES['image']['name'];
				if (isset($_FILES['sc_form_penulis'])) {
					$upload_sc_form_penulis = $_FILES['sc_form_penulis']['name'];
				}
				if (isset($_FILES['sc_ktp'])) {
					$upload_sc_ktp = $_FILES['sc_ktp']['name'];
				}
				if (isset($_FILES['sc_cv'])) {
					$upload_sc_cv = $_FILES['sc_cv']['name'];
				}
				if (isset($_FILES['sc_npwp'])) {
					$upload_sc_npwp = $_FILES['sc_npwp']['name'];
				}
				if (isset($_FILES['sc_foto'])) {
					$upload_sc_foto = $_FILES['sc_foto']['name'];
				}

				if ($upload_image) {

					$config['upload_path'] = './assets/uploads/image/profile/';
					$config['allowed_types'] = 'gif|jpg|png';
					$config['max_size']     = '2048';

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('image')) {

						$old_image = $user->image;
						if ($old_image != 'default.jpg') {
							// unlink(FCPATH . 'assets/uploads/image/profile/' . $old_image);
							$this->unlink_file('assets/uploads/image/profile/', $old_image);
						}


						$new_image = htmlspecialchars($this->upload->data('file_name'));

						$this->db->set('image', $new_image);
						$this->db->where('id', $user->id);
						$this->db->update('users');
					} else {
						$this->session->set_flashdata('success', $this->upload->display_errors());
						$this->redirectUser();
					}
				}


				if ($upload_sc_form_penulis) {

					$config['upload_path'] = './assets/uploads/files/sc_form_penulis/';
					$config['allowed_types'] = 'pdf|jpg|png|jpeg';
					$config['max_size']     = '2048';

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('sc_form_penulis')) {

						$old_sc_form_penulis = $user->sc_form_penulis;

						if ($old_sc_form_penulis != 'default.jpg') {
							// unlink(FCPATH . 'assets/uploads/files/sc_form_penulis/' . $old_sc_form_penulis);
							$this->unlink_file('assets/uploads/files/sc_form_penulis/', $old_sc_form_penulis);
						}

						$new_sc_form_penulis = htmlspecialchars($this->upload->data('file_name'));
						$this->db->set('sc_form_penulis', $new_sc_form_penulis);
						$this->db->where('id', $user->id);
						$this->db->update('users');
					} else {
						$this->session->set_flashdata('success', $this->upload->display_errors());
						$this->redirectUser();
					}
				}
				if ($upload_sc_ktp) {
					$config['upload_path'] = './assets/uploads/files/sc_ktp/';
					$config['allowed_types'] = 'pdf|jpg|png|jpeg';
					$config['max_size']     = '2048';

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('sc_ktp')) {

						$old_sc_ktp = $user->sc_ktp;
						if ($old_sc_ktp != 'default.jpg') {
							// unlink(FCPATH . 'assets/uploads/files/sc_ktp/' . $old_sc_ktp);
							$this->unlink_file('assets/uploads/files/sc_ktp/', $old_sc_ktp);
						}

						$new_sc_ktp = htmlspecialchars($this->upload->data('file_name'));
						$this->db->set('sc_ktp', $new_sc_ktp);
						$this->db->where('id', $user->id);
						$this->db->update('users');
					} else {
						$this->session->set_flashdata('success', $this->upload->display_errors());
						$this->redirectUser();
					}
				}
				if ($upload_sc_cv) {
					$config['upload_path'] = './assets/uploads/files/sc_cv/';
					$config['allowed_types'] = 'pdf|jpg|png|jpeg';
					$config['max_size']     = '2048';

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('sc_cv')) {

						$old_sc_cv = $user->sc_cv;
						if ($old_sc_cv != 'default.jpg') {
							// unlink(FCPATH . 'assets/uploads/files/sc_cv/' . $old_sc_cv);
							$this->unlink_file('assets/uploads/files/sc_cv/', $old_sc_cv);
						}

						$new_sc_cv = htmlspecialchars($this->upload->data('file_name'));
						$this->db->set('sc_cv', $new_sc_cv);
						$this->db->where('id', $user->id);
						$this->db->update('users');
					} else {
						$this->session->set_flashdata('success', $this->upload->display_errors());
						$this->redirectUser();
					}
				}
				if ($upload_sc_npwp) {
					$config['upload_path'] = './assets/uploads/files/sc_npwp/';
					$config['allowed_types'] = 'pdf|jpg|png|jpeg';
					$config['max_size']     = '2048';

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('sc_npwp')) {

						$old_sc_npwp = $user->sc_npwp;
						if ($old_sc_npwp != 'default.jpg') {
							// unlink(FCPATH . 'assets/uploads/files/sc_npwp/' . $old_sc_npwp);
							$this->unlink_file('assets/uploads/files/sc_npwp/', $old_sc_npwp);
						}

						$new_sc_npwp = htmlspecialchars($this->upload->data('file_name'));
						$this->db->set('sc_npwp', $new_sc_npwp);
						$this->db->where('id', $user->id);
						$this->db->update('users');
					} else {
						$this->session->set_flashdata('success', $this->upload->display_errors());
						$this->redirectUser();
					}
				}
				if ($upload_sc_foto) {
					$config['upload_path'] = './assets/uploads/files/sc_foto/';
					$config['allowed_types'] = 'pdf|jpg|png|jpeg';
					$config['max_size']     = '2048';

					$this->load->library('upload', $config);

					if ($this->upload->do_upload('sc_foto')) {

						$old_sc_foto = $user->sc_foto;
						if ($old_sc_foto != 'default.jpg') {
							// unlink(FCPATH . 'assets/uploads/files/sc_foto/' . $old_sc_foto);
							$this->unlink_file('assets/uploads/files/sc_foto/', $old_sc_foto);
						}

						$new_sc_foto = htmlspecialchars($this->upload->data('file_name'));
						$this->db->set('sc_foto', $new_sc_foto);
						$this->db->where('id', $user->id);
						$this->db->update('users');
					} else {
						$this->session->set_flashdata('success', $this->upload->display_errors());
						$this->redirectUser();
					}
				}

				$data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'no_ktp' => $this->input->post('no_ktp'),
					'nip' => $this->input->post('nip'),
					'no_npwp' => $this->input->post('no_npwp'),
					'jenis_kelamin' => $this->input->post('jenis_kelamin'),
					'tempat_lahir' => $this->input->post('tempat_lahir'),
					'tanggal_lahir' => $this->input->post('tanggal_lahir'),
					'alamat' => $this->input->post('alamat'),
					'no_hp' => $this->input->post('no_hp'),
					'profesi' => $this->input->post('profesi'),
					'nama_instansi' => $this->input->post('nama_instansi'),
					'alamat_instansi' => $this->input->post('alamat_instansi'),
					'email_instansi' => $this->input->post('email_instansi'),
					'no_telp_instansi' => $this->input->post('no_telp_instansi'),

					'bidang_kompetensi' => $this->input->post('bidang_kompetensi')
				);


				// update the password if it was posted
				if ($this->input->post('password')) {
					$data['password'] = $this->input->post('password');
				}

				// Only allow updating groups if user is admin
				if ($this->ion_auth->is_admin()) {
					// Update the groups user belongs to
					$groupData = $this->input->post('groups');

					if (isset($groupData) && !empty($groupData)) {

						$this->ion_auth->remove_from_group('', $id);

						foreach ($groupData as $grp) {
							$this->ion_auth->add_to_group($grp, $id);
						}
					}
				}

				// check to see if we are updating the user
				if ($this->ion_auth->update($user->id, $data)) {
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('success', $this->ion_auth->messages());
					$this->redirectUser();
				} else {
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('error', $this->ion_auth->errors());
					$this->redirectUser();
				}
			}
		}

		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['first_name'] = array(
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
			'class' => 'form-control'

		);
		$this->data['last_name'] = array(
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
			'class' => 'form-control'

		);
		$this->data['email'] = array(
			'name'  => 'email',
			'id'    => 'email',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('email', $user->email),
			'class' => 'form-control'

		);

		$this->data['image'] = array(
			'name'  => 'image',
			'id'    => 'image',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('image', $user->image),
			'class' => 'form-control'
		);
		$this->data['no_ktp'] = array(
			'name'  => 'no_ktp',
			'id'    => 'no_ktp',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('no_ktp', $user->no_ktp),
			'class' => 'form-control'
		);
		$this->data['nip'] = array(
			'name'  => 'nip',
			'id'    => 'nip',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('nip', $user->nip),
			'class' => 'form-control'
		);
		$this->data['no_npwp'] = array(
			'name'  => 'no_npwp',
			'id'    => 'no_npwp',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('no_npwp', $user->no_npwp),
			'class' => 'form-control'
		);
		$this->data['jenis_kelamin'] = array(
			'name'  => 'jenis_kelamin',
			'id'    => 'jenis_kelamin',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('jenis_kelamin', $user->jenis_kelamin),
			'class' => 'form-control'
		);
		$this->data['tempat_lahir'] = array(
			'name'  => 'tempat_lahir',
			'id'    => 'tempat_lahir',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('tempat_lahir', $user->tempat_lahir),
			'class' => 'form-control'
		);
		$this->data['tanggal_lahir'] = array(
			'name'  => 'tanggal_lahir',
			'id'    => 'tanggal_lahir',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('tanggal_lahir', $user->tanggal_lahir),
			'class' => 'form-control'
		);
		$this->data['alamat'] = array(
			'name'  => 'alamat',
			'id'    => 'alamat',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('alamat', $user->alamat),
			'class' => 'form-control'
		);
		$this->data['no_hp'] = array(
			'name'  => 'no_hp',
			'id'    => 'no_hp',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('no_hp', $user->no_hp),
			'class' => 'form-control'
		);
		$this->data['profesi'] = array(
			'name'  => 'profesi',
			'id'    => 'profesi',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('profesi', $user->profesi),
			'class' => 'form-control'
		);
		$this->data['nama_instansi'] = array(
			'name'  => 'nama_instansi',
			'id'    => 'nama_instansi',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('nama_instansi', $user->nama_instansi),
			'class' => 'form-control'
		);
		$this->data['alamat_instansi'] = array(
			'name'  => 'alamat_instansi',
			'id'    => 'alamat_instansi',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('alamat_instansi', $user->alamat_instansi),
			'class' => 'form-control'
		);
		$this->data['email_instansi'] = array(
			'name'  => 'email_instansi',
			'id'    => 'email_instansi',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('email_instansi', $user->email_instansi),
			'class' => 'form-control'
		);
		$this->data['no_telp_instansi'] = array(
			'name'  => 'no_telp_instansi',
			'id'    => 'no_telp_instansi',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('no_telp_instansi', $user->no_telp_instansi),
			'class' => 'form-control'
		);
		$this->data['sc_form_penulis'] = array(
			'name'  => 'sc_form_penulis',
			'id'    => 'sc_form_penulis',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('sc_form_penulis', $user->sc_form_penulis),
			'class' => 'form-control'
		);
		$this->data['sc_ktp'] = array(
			'name'  => 'sc_ktp',
			'id'    => 'sc_ktp',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('sc_ktp', $user->sc_ktp),
			'class' => 'form-control'
		);
		$this->data['sc_cv'] = array(
			'name'  => 'sc_cv',
			'id'    => 'sc_cv',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('sc_cv', $user->sc_cv),
			'class' => 'form-control'
		);
		$this->data['sc_npwp'] = array(
			'name'  => 'sc_npwp',
			'id'    => 'sc_npwp',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('sc_npwp', $user->sc_npwp),
			'class' => 'form-control'
		);
		$this->data['sc_foto'] = array(
			'name'  => 'sc_foto',
			'id'    => 'sc_foto',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('sc_foto', $user->sc_foto),
			'class' => 'form-control'
		);
		$this->data['bidang_kompetensi'] = array(
			'name'  => 'bidang_kompetensi',
			'id'    => 'bidang_kompetensi',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('bidang_kompetensi', $user->bidang_kompetensi),
			'class' => 'form-control'
		);
		$this->data['password'] = array(
			'name' => 'password',
			'id'   => 'password',
			'type' => 'password',
			'class' => 'form-control'
		);
		$this->data['password_confirm'] = array(
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'type' => 'password',
			'class' => 'form-control'
		);
		$this->data['title'] = 'User';
		$this->data['subtitle'] = '';
		$this->data['crumb'] = [
			'User' => '',
		];
		$this->data['jenis_kelamin_opt'] = config_item('jenis_kelamin');
		$this->data['bidang_kompetensi_opt'] = config_item('bidang_kompetensi');

		$this->data['page'] = 'auth/edit_user';
		$this->load->view('template/backend', $this->data);
		//$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'edit_user', $this->data);
	}

	/**
	 * Create a new group
	 */
	public function create_group()
	{
		$this->data['title'] = $this->lang->line('create_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			redirect('auth', 'refresh');
		}

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'trim|required|alpha_dash');

		if ($this->form_validation->run() === TRUE) {
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
			if ($new_group_id) {
				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('success', $this->ion_auth->messages());
				redirect("auth", 'refresh');
			}
		} else {
			// display the create group form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['group_name'] = array(
				'name'  => 'group_name',
				'id'    => 'group_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('group_name'),
			);
			$this->data['description'] = array(
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('description'),
			);

			$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'create_group', $this->data);
		}
	}

	/**
	 * Edit a group
	 *
	 * @param int|string $id
	 */
	public function edit_group($id)
	{
		// bail if no group id given
		if (!$id || empty($id)) {
			redirect('auth', 'refresh');
		}

		$this->data['title'] = $this->lang->line('edit_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			redirect('auth', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

		if (isset($_POST) && !empty($_POST)) {
			if ($this->form_validation->run() === TRUE) {
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], $_POST['group_description']);

				if ($group_update) {
					$this->session->set_flashdata('success', $this->lang->line('edit_group_saved'));
				} else {
					$this->session->set_flashdata('error', $this->ion_auth->errors());
				}
				redirect("auth", 'refresh');
			}
		}

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['group'] = $group;

		$readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

		$this->data['group_name'] = array(
			'name'    => 'group_name',
			'id'      => 'group_name',
			'type'    => 'text',
			'value'   => $this->form_validation->set_value('group_name', $group->name),
			$readonly => $readonly,
		);
		$this->data['group_description'] = array(
			'name'  => 'group_description',
			'id'    => 'group_description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_description', $group->description),
		);

		$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'edit_group', $this->data);
	}

	/**
	 * @return array A CSRF key-value pair
	 */
	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	/**
	 * @return bool Whether the posted CSRF token matches
	 */
	public function _valid_csrf_nonce()
	{
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue')) {
			return TRUE;
		}
		return FALSE;
	}

	/**
	 * @param string     $view
	 * @param array|null $data
	 * @param bool       $returnhtml
	 *
	 * @return mixed
	 */
	public function _render_page($view, $data = NULL, $returnhtml = FALSE) //I think this makes more sense
	{

		$this->viewdata = (empty($data)) ? $this->data : $data;

		$view_html = $this->load->view($view, $this->viewdata, $returnhtml);

		// This will return html on 3rd argument being true
		if ($returnhtml) {
			return $view_html;
		}
	}

	public function register_user()
	{
		$this->data['title'] = "Daftar Akun Baru";

		// if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
		// 	redirect('auth', 'refresh');
		// }

		$tables = $this->config->item('tables', 'ion_auth');
		$identity_column = $this->config->item('identity', 'ion_auth');
		$this->data['identity_column'] = $identity_column;

		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'trim|required');
		$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'trim|required');
		if ($identity_column !== 'email') {

			$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email');
		} else {
			$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'trim|required|valid_email|is_unique[' . $tables['users'] . '.email]');
		}

		$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

		if ($this->form_validation->run() === TRUE) {
			$email = strtolower($this->input->post('email'));
			$identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
			$password = $this->input->post('password');

			$additional_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
			);
		}
		if ($this->form_validation->run() === TRUE && $this->ion_auth->register($identity, $password, $email, $additional_data)) {
			// check to see if we are creating the user
			// redirect them back to the admin page
			$this->session->set_flashdata('success', $this->ion_auth->messages());

			redirect("auth/register_success", 'refresh');
		} else {
			// display the create user form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['first_name'] = array(
				'name' => 'first_name',
				'id' => 'first_name',
				'type' => 'text',
				'value' => $this->form_validation->set_value('first_name'),
				'class' => 'form-control'
			);
			$this->data['last_name'] = array(
				'name' => 'last_name',
				'id' => 'last_name',
				'type' => 'text',
				'value' => $this->form_validation->set_value('last_name'),
				'class' => 'form-control'
			);

			$this->data['email'] = array(
				'name' => 'email',
				'id' => 'email',
				'type' => 'text',
				'value' => $this->form_validation->set_value('email'),
				'class' => 'form-control'
			);

			$this->data['password'] = array(
				'name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'value' => $this->form_validation->set_value('password'),
				'class' => 'form-control'
			);
			$this->data['password_confirm'] = array(
				'name' => 'password_confirm',
				'id' => 'password_confirm',
				'type' => 'password',
				'value' => $this->form_validation->set_value('password_confirm'),
				'class' => 'form-control'
			);
			$this->data['title'] = 'Registrasi';
			$this->data['subtitle'] = '';
			$this->data['crumb'] = [
				'User' => '',
			];

			// $this->data['page'] = 'auth/register_user';
			$this->load->view('auth/register_user', $this->data);
			//$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'create_user', $this->data);
		}
	}
	public function register_success()
	{
		$this->data['title'] = 'Registrasi';
		$this->data['subtitle'] = '';
		$this->data['crumb'] = [
			'User' => '',
		];
		$this->load->view('auth/register_success', $this->data);
	}
}
