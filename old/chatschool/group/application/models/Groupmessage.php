<?php 

/**
* 
*/
class Groupmessage extends CI_Model
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}


	public function insert($message=false)
	{

		if ($message) {

			$this->db->insert('message',$message);
			return $this->db->insert_id();
		}
		return false;
	}
}