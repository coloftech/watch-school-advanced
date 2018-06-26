<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model', 'user');
	}

	public function index()
	{
		if(!empty($_POST)){
			$rules = $this->user->login_rules;
			$this->form_validation->set_rules($rules);
			if($this->form_validation->run())
			{
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				if($this->authentication->login($username, $password)){
					$id = $this->authentication->read('identifier');
					$this->user->update($id, array('online'=>'1'));	
					$response = array(
					'success' => true,
					'errors'  => '',
					'message' => 'Login successful.'
					);
				}
				else{
					$response = array(
					'success' => false,
					'errors'  => json_errors(),
					'message' => 'Invalid Login.'
					);
				}
			}
			else{
				var_dump($this->form_validation->errors());
					$response = array(
					'success' => false,
					'errors'  => json_errors(),
					'message' => 'Invalid Login.'
					);
			}
				//add the header here
				header('Content-Type: application/json');
				echo json_encode( $response );
		}
		else{
			$this->load->view('login');
		}
		
	}

	public function logout(){
		$id = $this->authentication->read('identifier');
		$this->user->update($id, array('online'=>'0'));	
		$this->authentication->logout();
	}

	public function register(){
		if(!empty($_POST)){
			$rules = $this->user->register_rules;
			$this->form_validation->set_rules($rules);
			if($this->form_validation->run())
			{
				$this->user->insert(array(
						'firstname' => $this->input->post('firstname'),
						'lastname' => $this->input->post('lastname'),
						'email' => $this->input->post('email'),
						'username' => $this->input->post('username'),
						'password' => sha1($this->input->post('password'))
					));

				$response = array(
					'success' => true,
					'errors'  => '',
					'message' => 'Registration successful.'
					);
			}
			else{
				$response = array(
					'success' => false,
					'errors'  => json_errors(),
					'message' => 'Please correct the errors in the form.'
					);
			}
			//add the header here
			header('Content-Type: application/json');
			echo json_encode( $response );
		}
		else
		{
			$this->load->view('register');
		}
	}

	public function unique_email(){
		if(!$this->authentication->email_check($this->input->post('email'))) {
			$this->form_validation->set_message('unique_email', '%s should be unique');
			return FALSE;
		}
		return TRUE;
	}

	public function unique_username(){
		if(!$this->authentication->username_check($this->input->post('username'))) {
			$this->form_validation->set_message('unique_username', '%s should be unique');
			return FALSE;
		}
		return TRUE;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */