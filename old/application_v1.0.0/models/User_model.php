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
					'rules' => 'trim|required|valid_email|is_unique[users.email]|xss_clean'
			),
			'username' => array (
					'field' => 'username',
					'label' => 'username',
					'rules' => 'trim|required|is_unique[users.username]|xss_clean'
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
					'rules' => 'trim|required'
			),
			'password' => array (
					'field' => 'password',
					'label' => 'password',
					'rules' => 'trim|required'
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


		public function insert($data=false)
			{
				# code...
				if($data){
					$this->db->insert('users',$data);
				}
			}

		public function update($id=0,$data=false)
			{
				# code...
				if($data){
					$this->db->where('id',$id);
					$this->db->update('users',$data);
				}
			}
			
		public function get($id=0)
			{
				# code...
				$q = $this->db->where('id',$id)->get('users');
				if($r = $q->result()){
					return $r[0];

				}else{
					return false;
				}
			}

		public function get_all($id=0)
			{
				# code...
				# code...
				$q = $this->db->get('users');
				if($r = $q->result()){
					return $r;

				}else{
					return false;
				}
			}


		public function get_by($elem='',$data)
			{
				# code...
				$q = $this->db->where($elem,$data)->get('users');
				if($r = $q->result()){
					return $r[0];

				}else{
					return false;
				}
			}

}