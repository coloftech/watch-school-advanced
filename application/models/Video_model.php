<?php 

/**
* 
*/
class Video_model extends CI_Model
{

	public $video_details_rules = array(
		    'title' => array (
					'field' => 'title',
					'label' => 'title',
					'rules' => 'trim|required|xss_clean'
			)
		);


	public function video_counter($type=0){
		$this->db->select('video_id');
		$this->db->from('videos');
		$num_results = $this->db->count_all_results();
		return $num_results;
	}
	
	public function list_chart($type,$status=0,$limit=false,$offset=false)
	{
		# code...
		switch ((int)$status) {

			case 12:
				# code...
				$where = " WHERE status = 1  and type = $type and islivechart = 0 or status = 2 and type = $type and islivechart = 0";
				break;

			case 13:
				# code...
				$where = " WHERE status = 1  and type = $type and islivechart = 0 or status = 3 and type = $type and islivechart = 0";
				break;
			case 23:
				# code...
				$where = " WHERE status = 2  and type = $type and islivechart = 0 or status = 3 and type = $type and islivechart = 0";
				break;
			default:
				# code...
				$where = " WHERE status = $status and type = $type and islivechart = 0";
				break;
				break;
		}
		$sql = "SELECT * FROM ".$this->db->dbprefix('video_detail')." $where order by live_chart_date_end asc";
		$result = $this->db->query($sql);
		return $result->result();
		
	}
	
	public function listall($type=false,$status=false,$limit=0,$offset=0,$char=false){
		//if($type && $status){
			//$tbl = $this->db->dbprefix('video_detail');
			//$sql = "SELECT video_detail_id,title,slug,status,thumbnail,type,synopsis FROM $tbl WHERE type = $type and status = $status order by title asc";
			
			//$query = $this->db->query($sql);
			$this->db->select('video_detail_id,title,slug,status,thumbnail,type,synopsis')
						->from('video_detail');					
		
				if($char){
					$this->db->like('title',$char,'LEFT');
				}					
				if($type){
					$this->db->where('type',$type);
				}
				if($status){
					$this->db->where('status',$status);
				}
				if($limit > 0){
					$this->db->limit($limit,$offset);
				}

			$query = $this->db->order_by('title')
					->get();

			return $query->result();

		//}
		//return false;
	}

	public function listallchar($type=false,$status=false,$limit=0,$offset=0,$char=false){
		if($status){

			$status = " and status = $status ";
		}else{
			$status = " ";
		}
		if ($char) {
			# code...
			if ($char == 'NO') {
				# code...
				$char = " title REGEXP '^[0-9]' AND ";
			}else{

			$char = " title REGEXP '^[$char].*$' and ";
			}


		}else{
			$char = " ";
		}

			$tbl = $this->db->dbprefix('video_detail');
		$sql = "SELECT * FROM $tbl WHERE $char type = $type $status  $limit";

		$query = $this->db->query($sql);

		return $query->result();
	}
	public function selectbyletter($letters=false,$limit=0,$offset=0){
		if($letters){
			$tbl = $this->db->dbprefix('video_detail');
			$sql = "SELECT video_detail_id,title,slug,status,thumbnail,type FROM $tbl WHERE title REGEXP '^[$letters].*$' order by title";
			$query = $this->db->query($sql);

			return $query->result();

		}
			return false;
	}

	public function getdetail_id($video_id=false)
	{
		# code...
		if ($video_id) {
			# code...
			$query = $this->db->select('video_detail_id')
								->where('video_id',$video_id)
								->limit(1)
								->get('video_group');
			if($r = $query->result()){
				return $r[0]->video_detail_id;
			}

			//return $this->db->get_where('video_detail',array('video_detail_id'=>$detail_id))->result();
		}
		return false;
	}

	public function getvideo($detail_id=false)
	{
		# code...
		if ($detail_id) {
			# code...
			$query = $this->db->where('video_detail_id',$detail_id)
								->or_where('slug',$detail_id)
								->limit(1)
								->get('video_detail');
			if($r = $query->result()){
				return $r;
			}

			//return $this->db->get_where('video_detail',array('video_detail_id'=>$detail_id))->result();
		}
		return false;
	}

	public function lastepisode($detail_id=false)
	{
		# code...
		if ($detail_id) {
			# code...
			$query = $this->db->select('video_group.video_id,slug,video_episode as episode')
							->from('video_group')
							->join('videos','videos.video_id = video_group.video_id','left')
							->where('video_detail_id',$detail_id)
							->order_by('video_episode','desc')
							->limit(1)
							->get();
			if($r = $query->result()){
				return $r[0];
			}

			//return $this->db->get_where('video_detail',array('video_detail_id'=>$detail_id))->result();
		}
		return false;
	}

	public function episodeInfo($detail_id = false, $episode=false)
	{
		# code...
		if ($episode ) {

			$query = $this->db->select('videos.*')
							->from('videos')
							->join('video_group','video_group.video_id = videos.video_id','left')
							->where('video_detail_id',$detail_id)
							->where('video_episode',$episode)
							->limit(1)
							->get();
			if($result = $query->result()){
				return $result[0];
			}
		}
		return false;
	}

	public function getepisode($video_id=false)
	{
		# code...
		if ($video_id) {
			# code...
			$query = $this->db->where('video_id',$video_id)
								->or_where('slug',$video_id)
								->limit(1)
								->get('videos');
			if($r = $query->result()){
				return $r[0];
			}

			//return $this->db->get_where('video_detail',array('video_detail_id'=>$detail_id))->result();
		}
		return false;
	}

	public function getpslug($detail_id=false)
	{
		# code...
		if ($detail_id) {
			# code...
			$query = $this->db->select('slug')
								->where('video_detail_id',$detail_id)
								->limit(1)
								->get('video_detail');
			if($r = $query->result()){
				return $r[0]->slug;
			}

			//return $this->db->get_where('video_detail',array('video_detail_id'=>$detail_id))->result();
		}
		return false;
	}

	public function getslug($video_id=false)
	{
		# code...
		if ($video_id) {
			# code...
			$query = $this->db->select('slug')
								->where('video_id',$video_id)
								->limit(1)
								->get('videos');
			if($r = $query->result()){
				return $r[0]->slug;
			}

			//return $this->db->get_where('video_detail',array('video_detail_id'=>$detail_id))->result();
		}
		return false;
	}

	function insert_detail($data){
		$this->db->insert('video_detail',$data);
		return $this->db->insert_id();
	}

	function dberror(){
		return $this->db->error();
	}

	public function remove_video($data='')
	{
		# code...
		//return false;
		return $this->db->delete('video_detail',$data);
	}

	public function show_playlist($detail_id){
		$query = $this->db->select('videos.video_id,title,slug,episode_number as episode')
						->from('videos')
						->join('video_group','video_group.video_id = videos.video_id','left')
						->where('video_detail_id',$detail_id)
						->order_by('episode_number','asc')
						->get();
						if($r = $query->result()){
							return $r;
						}
							return false;
						
		//return $this->db->get_where('video_group',array('video_detail_id'=>$detail_id))->result();
	}

	public function json_playlist(){
		$query = $this->db->select('video_detail_id as detail_id,videos.video_id,title,slug,episode_number as episode')
						->from('videos')
						->join('video_group','video_group.video_id = videos.video_id','right')
						//->where('video_detail_id',$detail_id)
						->get();
						if($r = $query->result_array()){
							return $r;
						}
							return false;
						
		//return $this->db->get_where('video_group',array('video_detail_id'=>$detail_id))->result();
	}
	public function addto_playlist($data){
		return $this->db->insert('video_group',$data);
	}
	public function previous($detail_id,$video_id,$episode)
	{
		# code...
		$query = $this->db->select('videos.video_id,video_group.video_episode, videos.slug')
			->from('video_group')
			->join('videos','videos.video_id = video_group.video_id','left')
			->where('video_group.video_episode <',$episode,true)
			->where('video_group.video_detail_id',$detail_id)
			->order_by('video_episode','desc')
			->limit(1)
			->get();
			return $query->result();

	}

	public function next($detail_id,$video_id,$episode)
	{
		# code...
		$query = $this->db->select('videos.video_id,video_group.video_episode, videos.slug')
			->from('video_group')
			->join('videos','videos.video_id = video_group.video_id','left')
			->where('video_group.video_episode >',$episode,true)
			->where('video_group.video_detail_id',$detail_id)
			->order_by('video_episode','asc')
			->limit(1)
			->get();
			return $query->result();

	}

	function previus_next($video_id=0,$episode=0)
	{
		# code...

		
		$sql = "select ve.video_id,ve.video_episode as episode,v.title,v.slug from q_video_group as ve left JOIN q_videos as v ON v.video_id = ve.video_id\n"

    . "where ( \n"

    . "        video_episode = IFNULL((select min(video_episode) from q_video_episode where video_episode > $episode),0) \n"

    . "        or  video_episode = IFNULL((select max(video_episode) from q_video_episode where video_episode < $episode),0)\n"

    . "      )  AND v.video_id = $video_id order by video_episode ASC limit 2";

	$query = $this->db->query($sql);
	if($result = $query->result()){
		return $result;
	}
	return false;
	}

	public function delete_video($data='')
	{
		# code...
		//return false;
		return $this->db->delete('videos',$data);
	}



	public function removeto_playlist($detail_id,$data){
		$this->db->where('video_detail_id',$detail_id);
		$this->db->where($data);
		return $this->db->delete('video_group');
	}
	public function update($detail_id,$data){
		$this->db->where('video_detail_id',$detail_id);
		return $this->db->update('video_detail',$data);
	}

	public function updatevideos($video_id,$data){
		$this->db->where('video_id',$video_id);
		return $this->db->update('videos',$data);
	}
	public function isexisting($data)
	{
		# code...
		if(count($data) > 0){
			return $this->db->get_where('video_group',$data)->result();
		}
		return false;
	}

	public function search($title){
		//return $title;
		if(!empty($title)){
			$this->db->select('video_id,slug,title,episode_number,sypnosis as synopsis');
			$this->db->from('videos');
			$this->db->like('title',$title);
			$this->db->order_by('episode_number');
			$this->db->limit(20);
			$query = $this->db->get()->result();
			if(!empty($query)){
				return $query;
			}
		}
		return false;
	}

	public function title($video_id=0)
	{
		# code...
	}
	
 	public function brokenLink()
 	{
 		# code...
 		$query = $this->db->select('videos.video_id,title,video_reports.source_id,count(*) as reports,date_reported')
 			->from('video_reports')
 			->join('videos','videos.video_id = video_reports.video_id','left')
 			->group_by('videos.video_id,video_reports.source_id')
 			->order_by('reports','desc')
 			->get();
 			return $query->result();
 	}
}