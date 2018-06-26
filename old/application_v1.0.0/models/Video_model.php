<?php 

/**
* 
*/
class Video_model extends CI_Model
{
	
	
	public function latest_episode($offset=0,$limit=40)
	{
		# code...
		$row = array();
		$query = $this->db->select('video_id')
					->from('video_episode')
					->group_by('parent_video_id')
					->order_by('episode','desc')
					->get();
			if($r=$query->result()){
				foreach ($r as $k) {

				$rows[] = $this->get_video($k->video_id);

				}

				return $rows;

			}else{
				return false;
			}
	}
	public function get_video($video_id = 0)
	{
		# code...
		$q = $this->db->get_where('videos',array('video_id'=>$video_id));
		if($r = $q->result()){
			return $r[0];
		}

	}
}