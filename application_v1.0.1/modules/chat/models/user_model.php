<?php

class User_model extends CI_Model{

	public $register_rules = array(
		    'firstname' => array (
					'field' => 'firstname',
					'label' => 'first name',
					'rules' => 'trim|required|xss_clean'
			),
			'lastname' => array (
					'field' => 'lastname',
					'label' => 'last name',
					'rules' => 'trim|required|xss_clean'
			),
			'email' => array (
					'field' => 'email',
					'label' => 'email',
					'rules' => 'trim|required|valid_email|callback_unique_email|xss_clean'
			),
			'username' => array (
					'field' => 'username',
					'label' => 'username',
					'rules' => 'trim|required|callback_unique_username|xss_clean'
			),
			'password' => array (
					'field' => 'password',
					'label' => 'password',
					'rules' => 'trim|required|matches[cpassword]|xss_clean'
			),
			'cpassword' => array (
					'field' => 'cpassword',
					'label' => 'confirm password',
					'rules' => 'trim|required|matches[password]|xss_clean'
			)
		);

		public $login_rules = array(
			'username' => array (
					'field' => 'username',
					'label' => 'username',
					'rules' => 'trim|required|xss_clean'
			),
			'password' => array (
					'field' => 'password',
					'label' => 'password',
					'rules' => 'trim|required|xss_clean'
			)
		);	

		public $profile_rules = array(
			'firstname' => array (
					'field' => 'firstname',
					'label' => 'firstname',
					'rules' => 'trim|required|xss_clean'
			),
			'lastname' => array (
					'field' => 'lastname',
					'label' => 'lastname',
					'rules' => 'trim|required|xss_clean'
			),
			'email' => array (
					'field' => 'email',
					'label' => 'email',
					'rules' => 'trim|required|valid_email|callback_email_check|xss_clean'
			)
		);	
		public $password_rules = array(
			'current_password' => array (
					'field' => 'current_password',
					'label' => 'current password',
					'rules' => 'trim|required|callback_password_check|xss_clean'
			),
			'new_password' => array (
					'field' => 'new_password',
					'label' => 'new password',
					'rules' => 'trim|required|xss_clean'
			),
			'confirm_newpassword' => array (
					'field' => 'confirm_newpassword',
					'label' => 'confirm password',
					'rules' => 'trim|required|matches[new_password]|xss_clean'
			)
		);	
}