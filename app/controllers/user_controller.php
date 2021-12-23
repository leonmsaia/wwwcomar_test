<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_controller extends CI_Controller {

	public function login()
	{
    // Template Information
    $data['layout'] = 'initial';
    $data['page'] = 'pages/login';

    // Page Information
    $data['title'] = 'Iniciar Sesion | Datos Usuario';
    $data['description'] = 'Sistema de Login y Modificacion de Datos';
    $data['keywords'] = 'login, datos, usuarios';
    $data['author'] = 'LeonMSaia';

		$this->load->view('layout/' . $data['layout'], $data);
	}

  public function edit()
  {
		if ($name = $_SESSION['username'] != NULL) {
			// Template Information
			$data['layout'] = 'initial';
			$data['page'] = 'pages/edit';

			// Page Information
			$data['title'] = 'Editar Usuario | Datos Usuario';
			$data['description'] = 'Sistema de Login y Modificacion de Datos';
			$data['keywords'] = 'login, datos, usuarios';
			$data['author'] = 'LeonMSaia';

			// Load User Information
			$this->load->model('user_model');
			$session_active_name_mail = $_SESSION['username'];
			$data['user_data'] = $this->user_model->get_user_information_by_user_mail($session_active_name_mail);

			$this->load->view('layout/' . $data['layout'], $data);
		}else{
			redirect(base_url() . 'login');
		}
  }

	public function doLogin()
	{
		// Set Validation Terms for Login
		$this->form_validation->set_rules('user_val', 'Username', 'required');
		$this->form_validation->set_rules('user_pass', 'Password', 'required');

		// Simple Honeypot Validation
		$honeypot = $this->input->post('_noval_ue');
		if ($honeypot == NULL) {

			// Run Validation
			if($this->form_validation->run()){

				// Get Input Vars and Sanitize Them
				$username = $this->input->post('user_val');
				$password = $this->input->post('user_pass');

				// Load User Model to Call Login Methods
				$this->load->model('user_model');
				if ($this->user_model->can_login($username, $password)) {
					$session_data = array(
						'username' => $username
					);
					$this->session->set_userdata($session_data);
					$this->session->set_flashdata('login_grant', 'Bienvenido Usuario: ' . $username);
					redirect(base_url() . 'edit');
				}else{
					$this->session->set_flashdata('login_error', 'Usuario o Contraseña Incorrecta');
					redirect(base_url() . 'login');
				}
			}else{
				$this->session->set_flashdata('login_error', 'Ocurrio un error, por favor intente nuevamente.');
				redirect(base_url() . 'login');
			}
		}else {
			redirect(base_url() . 'login');
		}

	}

	public function doLoginOut()
	{
		// Clean Session Information
		$this->session->unset_userdata('username');
		redirect(base_url() . 'login');
	}

	public function update_user_information()
	{
		// Get Current Active User
		$session_active_name_mail = $_SESSION['username'];

		// Get Input Vars and Sanitize Them
		$user_firstname_val = $this->input->post('user_name_val');
		$user_lastname_val = $this->input->post('user_lastname_val');
		$user_dni_val = $this->input->post('user_dni_val');
		$user_mail_val = $this->input->post('user_mail_val');

		// Prepare Array with Update Information
		$dataCommon = array(
			'user_firstname' => $user_firstname_val,
			'user_lastname' => $user_lastname_val,
			'user_dni' => $user_dni_val,
			'user_mail' => $user_mail_val
		);

		// Insert Data by User_Mail
		$this->db->where('user_mail', $session_active_name_mail);
		$this->db->update('users', $dataCommon);

		// Load User Information
		$this->load->model('user_model');
		$session_active_name_mail = $_SESSION['username'];

		// Get Previous User Mail Value
		$current_mail_val = $this->user_model->get_user_information_by_user_mail($session_active_name_mail)->result()[0]->user_mail;

		// Check if User Mail Change to Restart Session
		if ($user_mail_val == $current_mail_val) {
			// Redirect to Edit Page
			redirect(base_url() . 'edit');
		}else{
			// Redirect to Login Out Method
			redirect(base_url() . 'user_controller/doLoginOut');
		}
	}

	public function uploadPicture()
	{
		// Load User Information
		$session_active_name_mail = $_SESSION['username'];
		$this->load->model('user_model');
		$current_user_id = $this->user_model->get_user_id_by_user_mail($session_active_name_mail);

		// Config Upload Information
		$image_name = 'profile_pic_user_' . $current_user_id;
		$ext = '.' . pathinfo($_FILES['userfile']['name'], PATHINFO_EXTENSION);
		$file = 'userfile';
		$name = $image_name;
		$path = 'assets/uploads';
		$deletable = true;

		// Create Path for DB
		$picture_path = $path . '/' . $name .  $ext;

		// Check if File Exist and IF TRUE delete it
		if (file_exists($picture_path) AND $deletable == TRUE) {
      unlink($picture_path);
    }

		// Update user_picture_path in DB
		$dataCmmon = array(
			 'user_picturepath' => $picture_path
		);
		$this->db->where('user_id', $current_user_id);
		$this->db->update('users', $dataCmmon);

		// Config Upload Method
	  $config['file_name'] = $name;
	  $config['upload_path'] = $path;
	  $config['allowed_types'] = 'gif|jpg|png|doc|txt';
	  $config['max_size'] = 1024 * 8;
	  $config['encrypt_name'] = FALSE;

		// Load Upload Library
		$this->load->library('upload', $config);

		// Do Upload Process
		$this->upload->do_upload('userfile');

		// Finish and Redirect to Edit Page
		redirect(base_url() . 'edit');

	}

	function uploadFile($advise_code, $file, $name, $path, $type, $ext, $deletable) {
	  $ci =& get_instance();

	  // Check if File Path Exist
	  $commonPath = './assets/uploads/' . $type . '/';
	  $completePath = $commonPath . $advise_code . '/' . $path;

	  if (!file_exists($commonPath . $advise_code)) {
	    mkdir($completePath, 0777, true);
	  }

	  if ($deletable == true) {
	    if (file_exists($completePath . '/' . $name . $ext)) {
	      unlink($completePath . '/' . $name . $ext);
	    }
	  }

	  // Config Upload Engine
	  $config['file_name'] = $name;
	  $config['upload_path'] = $commonPath . $advise_code . '/pictures';
	  $config['allowed_types'] = 'gif|jpg|png|doc|txt';
	  $config['max_size'] = 1024 * 8;
	  $config['encrypt_name'] = FALSE;
	  // Config Upload Engine End

	  // Do Upload
	  $ci->load->library('upload', $config);
	  $ci->upload->do_upload($file);
	}

}
