<?php 

/**
* 
*/
class Statistics extends CI_Model
{
	
	function saveViews($video_id=0,$ip=false)
	{
		# code...
		if($video_id > 0){

			//$this->db->insert('metrics',array('video_id'=>$video_id,'ip_address'=>$ip));


			$current = date('Y-m-d');
			$query = $this->db->select('*')
							->from('video_statistics')
							->where('video_id',$video_id)
							->where("date_format(date(watch_date),'%Y-%m-%d') = ", $current,true)
							->get();

				
			//$query = $this->db->get_where('video_statistics',$video_id);
			/* $query = /* $this->db->select('*')->from('video_statistics')->where('video_id',$video_id)->get();*/
			if($r = $query->result()) {
				# code...
				$this->db->set('counter','counter+1',false);
				$this->db->where('statistics_id',$r[0]->statistics_id);
				$this->db->update('video_statistics');

				//var_dump($this->db->error());
			}else{
				$this->db->insert('video_statistics',array('video_id'=>$video_id,'counter'=>1,'watch_date'=>$current));

				//var_dump($this->db->error());
			}

			$this->load->library('auth');

			$info = $this->auth->guest_info($ip);

			$info = json_decode($info);
			$this->save_country($info->country_name);
			
		}
	}
	public function getVideoStatitics($limit=50,$offset=0)
	{
		# code...

			$current = date('Y-m-d');
			$query = $this->db->select('videos.video_id,title,sum(counter) as counter')
			->from('videos')
			->join('video_statistics','video_statistics.video_id = videos.video_id')
			->where("date_format(date(watch_date),'%Y-%m-%d') = ", $current,true)
			->group_by('video_id')
			->order_by('counter','desc')
			->limit($limit)
			->get();
			return $query->result();
	}
    
	public function restartliveChart($value='')
	{
		# code...
		$td = date('Y-m-d');
		$q1 = $this->db->select('video_id,expired_on')
				->from('video_cover')
				->where("date_format(date(expired_on),'%Y-%m-%d') < ", $td,true)
				->where('status',0)
				->get();
		if($r1 = $q1->result()){
			$q2 = sprintf("UPDATE q_video_cover set released_date = expired_on, expired_on = DATE_ADD(expired_on,INTERVAL 7 DAY) where video_id = %d ",$r1[0]->video_id);
			$this->db->query($q2);
		}

	}

	public function save_country($info='')
	{
		# code...
		if (empty($info)) {
			# code...
			$info = 'Unknown';
		}
		$data = array(
			'country'=>$info,
			'year'=>date('Y'),
			'month'=>date('m')
			);
		$info = $this->db->get_where('visitor_info',$data);
		if($r = $info->result()){

				$this->db->set('counter','counter+1',false);
				$this->db->where('info_id',$r[0]->info_id);
				$this->db->update('visitor_info');
		}else{
			$this->db->insert('visitor_info',$data);
		}
		//return false;

	}
	public function listbycountry_monthly($month=0,$year=false)
	{
		# code...

			if ($year == false) {
				# code...
				$year = date('Y');
			}	
		if($month > 0){

				$query = $this->db->get_where('visitor_info',array('month'=>$month,'year'=>$year));
				return $query->result();
		}else{
				$month = date('m');
				$query = $this->db->get_where('visitor_info',array('month'=>$month,'year'=>$year));
				return $query->result();
		}
	}
}