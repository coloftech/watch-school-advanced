<?php 

/**
* 
*/
class Auth extends CI_Controller
{
	
	function __construct()
	{ 
		parent::__construct();
		$this->load->model('user_model', 'user');
	}
	public function index($value='')
	{
		# code...

		if(!empty($_POST)){
			$rules = $this->user->login_rules;
			$this->form_validation->set_rules($rules);
			if($this->form_validation->run())
			{
				$username = $this->input->post('username');
				$password = $this->input->post('password');

				$errors =  validation_errors();
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
					$response = array(
					'success' => false,
					'errors'  => json_errors(),
					'message' => 'Invalid Login.'
					);
			}
				//add the header here
				header('Content-Type: application/json');
				echo json_encode( $response );
				exit();
		}
		$this->load->view('chatschool/login');
	}
	public function register($value='')
	{
		# code...		
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
			exit();
		}

		$this->load->view('chatschool/register');
	}

	public function logout(){
		$id = $this->authentication->read('identifier');
		$this->user->update($id, array('online'=>'0'));	
		$this->authentication->logout();
	}
}