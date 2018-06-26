<?php 

/**
* 
*/
class Chat_m extends CI_Model
{
	
	
	function online_user($user_id=false)
	{
		# code...
		$q = $this->db->select('*')
		->from('chatusers')
		->where('chatusers.id !=',$user_id,true)
			->get();
		return $q->result();
	}

	function current_user($user_id=false)
	{
		# code...
		$q = $this->db->from('chatusers')
		->where('id',$user_id)
		->get();
		if($r = $q->result()){
			return $r[0];
		}else{
			return false;
		}
	}
		public function unread($user){
		$messages  =  $this->db->where('to', $user)
							  ->where('is_read', '0')
							  ->order_by('time', 'asc')
							  ->get('messages');

		return $messages->result();
	}

	public function unread_per_user($id, $from){
		$count  =  $this->db->where('to', $id)
							->where('from', $from)
							->where('is_read', '0')
							->count_all_results('messages');
		return $count;
	}

	public function last_message($value='')
	{
		# code...
	}
}