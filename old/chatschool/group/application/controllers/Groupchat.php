<?php 

/**
* 
*/
class Groupchat extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if(!$this->authentication->is_loggedin()) redirect('auth');

		$this->load->model('user_model', 'user');
		$this->load->model('message_model', 'message');
		$this->load->model('groupmessage', 'group');
		$this->load->model('lastmsg_model', 'last');
		$this->load->helper('smiley');
	}
	public function index($value='')
	{
		# code...
		$this->load->view('group-form');
	}
	public function save_message($value='')
	{
		# code...
		$message = array(
			'from' 		=> $logged_user,
			'to' 		=> $buddy,
			'message' 	=> $message,
			'type'		=> 2
			);
	}
}