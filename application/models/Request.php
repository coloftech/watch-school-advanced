<?php 

/**
* 
*/
class Request extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}
	public function save_request($data='')
	{
		# code...
		$this->db->insert('request',$data);
	}
}