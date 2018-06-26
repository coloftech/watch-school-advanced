<?php 

/**
* 
*/
class Video_m extends CI_Model
{
	public function selectbyletter($letters=false){
		if($letters){
			$tbl = $this->db->dbprefix('videos');
			$sql = "SELECT video_id,title,slug,episode_number as episode,source_id FROM $tbl WHERE title REGEXP '^[$letters].*$' order by title";
			$query = $this->db->query($sql);

			return $query->result();

		}
			return false;
	}
	
	public function addlatestVideo($video_id=0)
	{
	    $q=$this->db->get_where('video_latest',array('video_id'=>$video_id));
	    if($q->result()){
	        
	        $this->db->set('date_updated',date('Y-m-d H:i:s'));
	        $this->db->where('video_id',$video_id);
	        $this->db->update('video_latest');
	    }else{
	        $this->db->set('order_number =','order_number + 1',true);
	        $this->db->set('video_id',$video_id);
	        $this->db->insert('video_latest');
	    }
	    return true;
	}
	public function list_link($video_id=0)
	{
		# code...
		if($video_id > 0){
		$parent_id = $this->getParent($video_id);

			$query = $this->db->select('episode,link')
				->from('videos')
				->join('video_episode','video_episode.video_id = videos.video_id')
				->where('parent_video_id',$parent_id)
				->group_by('videos.video_id')
				->order_by('episode','asc')
				->get();

				return $query->result();
		}

	}

	function save($data,$video_id=0){
		if($video_id > 0)
		{
			return $this->update();
		}else{
			//return ('Insert  ');
			return $this->insert($data);
		}
	}
	function insert($data){
		if($data){
		   // $_SESSION['newepisode'] = 1;
			$this->db->insert('videos',$data);
			return $this->db->insert_id();
		}
		return false;
	}
	public function addEpisodes($data='')
	{
		# code...
		return $this->db->insert('video_episode',$data);
	}
	function videoType($data='',$video_id=0)
	{
		# code...
		if($video_id > 0){
			return false;
		}else{
			$this->db->insert('video_group',$data);
		}
	}
	function update(){
		return false;
	}
	public function episode($data,$video_id='')
	{
		# code...
	}
	
	public function getLink($video='')
	{
		
		if($video){

			$query = $this->db->select('link')
				->from('videos')
				->where('video_id',$video)
				->or_where('slug',$video)
				->get();
				if($result = $query->result()){
					return $result[0]->link;
				}else{
					return false;
				}

		}else{
			return false;
		}
	}
	public function getVideo($video=false)
	{
		# code...
		if($video){

			$query = $this->db->select('*')
				->from('videos')
				->where('video_id',$video)
				->or_where('slug',$video)
				->or_where('title',$video)
				->get();
				return $query->result();

		}else{
			return false;
		}
	}

	public function getEpisodes($video_id=false)
	{
		# code...

		if($video_id){

			$query = $this->db->select('videos.video_id,title,episode_number,parent_video_id')
				->from('videos')
				->join('video_episode','video_episode.video_id = videos.video_id')
				->where('parent_video_id',$video_id)
				//->group_by('video_episode.video_id')
				->order_by('episode','desc')
				->get();
				return $query->result();

		}else{
			return false;
		}

	}


	public function searchVideo($video=false)
	{
		# code...
		if($video){

			$query = $this->db->select('video_id,title,thumbnail,video_type,sypnosis,slug,episode_number')
				->from('videos')
				->like('title',$video,'left')
				->get();
				return $query->result();

		}else{
			return false;
		}
	}

	public function getsearchVideo($video=false)
	{
		# code...
		if($video){

			$query = $this->db->select('video_id,title,thumbnail,video_type,sypnosis,slug,episode_number')
				->from('videos')
				->where('video_id',$video)
				->get();
				return $query->result();

		}else{
			return false;
		}
	}
		public function getGroup($video=false)
	{
		# code...
		if($video){

			$query = $this->db->select('*')
				->from('video_group')
				->where('video_id',$video)
				->or_where('video_parent_id',$video)
				->order_by('video_number','desc')
				->limit(1)
				->get();
				return $query->result();

		}else{
			return false;
		}
	}

		public function getPlaylist($video=false)
	{
		# code...
		if($video){

			$query = $this->db->select('*')
				->from('video_episode')
				->where('video_id',$video)
				->or_where('parent_video_id',$video)
				->order_by('episode','desc')
				->get();
				return $query->result();

		}else{
			return false;
		}
	}
	function getParent($video=false){
		# code...
		if($video){

			$query = $this->db->select('*')
				->from('video_episode')
				->where('video_id',$video)
				->order_by('episode','desc')
				->get();
				if($result =  $query->result()){
					return $result[0]->parent_video_id;
				}else{
					return false;
				}

		}else{
			return false;
		}
	}

	function getChild($video=false){
		# code...
		if($video){

			$query = $this->db->select('*')
				->from('video_episode')
				->where('parent_video_id',$video)
				->order_by('episode','desc')
				->get();
				return  $query->result();
					

		}else{
			return false;
		}
	}
	

	function getlatestepisode($video_id=false){
		# code...
		if($video_id){

			$query = $this->db->select('slug')
				->from('videos')
				->join('video_episode','video_episode.video_id = videos.video_id')
				->where('parent_video_id',$video_id)
				->order_by('episode','desc')
				->limit(1)
				->get();
				if($result = $query->result()){
					return $result[0]->slug;
				}
					return false;
			}
			return false;			
				
	}

	function list_new_video($limit=16,$offset=0)
	{
		# code...
		$query = $this->db->select('videos.video_id,title,slug,thumbnail,date_added,episode_number')
			->from('videos')
			->order_by('videos.title','asc')
			->limit($limit,$offset)
			->get();

			return $query->result();
	}

	function listall_new_video()
	{
		# code...
		$query = $this->db->select('videos.video_id,title,slug,thumbnail,date_added,episode_number')
			->from('videos')
			->order_by('videos.title','asc')
			->get();

			return $query->result();
	}

	function list_new_upload($limit=16,$offset=0)
	{
		# code...
		$query = $this->db->select('videos.video_id,title,slug,thumbnail,date_added,episode_number')
			->from('videos')
			->where('release_mode',1)
			->order_by('videos.video_id','desc')
			->limit($limit,$offset)
			->get();

			return $query->result();
	}

	function listall_new_upload($limit=16,$offset=0)
	{
		# code...
		$query = $this->db->select('videos.video_id,title,slug,thumbnail,date_added,episode_number')
			->from('videos')
			->where('release_mode',1)
			->order_by('videos.video_id','desc')
			->get();

			return $query->result();
	}
	function list_anime($limit=0)
	{
		# code...
		$this->db->select('videos.video_id,title,slug,thumbnail,date_added,episode_number')
			->from('videos')
			->where('video_type',1);
			if($limit > 0){

			$this->db->limit($limit);

			}
			//$query = $this->db->group_by('parent_video_id')
			$query = $this->db->order_by('title','asc')
			->get();

			return $query->result();
	}

	function list_movies($limit=24)
	{
		# code...
		$query = $this->db->select('videos.video_id,title,slug,thumbnail,date_added,episode_number')
			->from('videos')
			->where('video_type',2);
			if($limit > 0){

			$this->db->limit($limit);

			}
			//$query = $this->db->group_by('parent_video_id')
			$query = $this->db->order_by('title','asc')
			->get();

			return $query->result();
	}


	function list_most_views($limit=24)
	{
		# code...
		$query = $this->db->select('videos.video_id,title,slug,thumbnail,date_added,episode_number')
			->from('videos')
			->join('video_statistics','video_statistics.video_id = videos.video_id','left')
			//->where('date_added >=','DATE(NOW() - INTERVAL 7 DAY)',true)
			->limit($limit)
			->order_by('counter','desc')
			->get();

			return $query->result();
	}

	function previus_next($video_id=0,$episode=0)
	{
		# code...

		
		$sql = "select ve.video_id,ve.episode,v.title,v.slug from q_video_episode as ve LEFT JOIN q_videos as v ON v.video_id = ve.video_id\n"

    . "where ( \n"

    . "        episode = IFNULL((select min(episode) from q_video_episode where episode > $episode),0) \n"

    . "        or  episode = IFNULL((select max(episode) from q_video_episode where episode < $episode),0)\n"

    . "      )  AND parent_video_id = $video_id order by episode ASC";

	$query = $this->db->query($sql);
	if($result = $query->result()){
		return $result;
	}
	return false;
	}

	function temp($data=false,$table=''){
		if($_SESSION['tbltemp'] == 0){

			$_SESSION['tbltemp'] == 1;

			$sql = 'CREATE TEMPORARY TABLE IF NOT EXISTS `q_mytemp` (
			  `temp_id` int(11) NOT NULL AUTO_INCREMENT,
			  `video_id` int(11) NOT NULL,
			  PRIMARY KEY (`temp_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1';
			$_SESSION['tbltemp'] == 1;

			$this->db->query($sql);
			$this->db->insert('mytemp',$data);
		}else{
			$this->db->insert('mytemp',$data);
		}
	}
	public function tempOutput($limit=24)
	{
		# code...
				$output = false;
				$sql2 = 'SELECT video_id,count(*) as counter FROM q_mytemp group by video_id order by counter desc limit '.$limit;
				$query = $this->db->query($sql2);
				$temp = $query->result();
				foreach ($temp as $key) {
					# code...
					$result = $this->video_m->getsearchVideo($key->video_id);
					//print_r($result);
					$output[]=$result[0];

					//echo "<br/>";
				}
				return $output;
	}
	
	
	public function mirrorExist($video_id=0,$source_id=0){
		if($video_id > 0 && $source_id > 0){
			$query = $this->db->get_where('video_mirror',array('video_id'=>$video_id,'source_id'=>$source_id));
			return $query->result();
		}
		return false;
	}

	public function saveReport($data=false)
	{
		# code...
		$result =  $this->db->insert('video_reports',$data);
		return $result;
	}
	public function saveMirror($data='')
	{
		# code...
		return $this->db->insert('video_mirror',$data);
	}

	public function getMirror($video_id=false,$source_id = false)
	{
		# code...
		if($video_id && $source_id ){
			$query = $this->db->get_where('video_mirror',array('video_id'=>$video_id,'source_id'=>$source_id));
			return $query->result();
		}elseif($video_id > 0){

			$query = $this->db->get_where('video_mirror',array('video_id'=>$video_id));
			return $query->result();
		}
		return false;
	}
	
	function update_video($video_id=0 , $data = ''){
		$this->db->where('video_id',$video_id);
		return $this->db->update('videos',$data);
	}
	
	function update_episode($video_id=0 , $data = ''){
		$this->db->where('parent_video_id',$video_id);
		return $this->db->update('video_episode',$data);
	}

	public function saveCoverInfo($video_id=false,$data=false)
	{
		# code...

		if($video_id){

			$query = $this->db->select('video_cover.*')
				->from('video_cover')
				->where('video_id',$video_id)
				// ->group_by('video_episode.video_id')
				->get();
				if($query->result()){
					$data2 = array(
						'thumbnail'=>$data['thumbnail'],
						'cover_title'=>$data['cover_title'],
						'synopsis'=>$data['synopsis'],
						'genre'=>$data['genre'],
						'released_date'=>$data['released_date'],
						'expired_on'=>$data['expired_on']
						);
					$this->db->where('video_id',$video_id);
					$this->db->update('video_cover',$data2);
					return $this->db->error();
				}else{
					$this->db->insert('video_cover',$data);
					return $this->db->error();
				}

		}else{
			return false;
		}
	}

	public function getCoverInfo($video_id=false)
	{
		# code...

		if($video_id){

			$query = $this->db->select('video_cover.*')
				->from('video_cover')
				->where('video_id',$video_id)
				// ->group_by('video_episode.video_id')
				->get();
				return $query->result();

		}else{
			return false;
		}
	}
	public function displayCoverpage($value='')
	{
		# code...
		
		$query = $this->db->select('*,DATE_ADD(released_date,INTERVAL 7 DAY) as next_episode')
		->from('video_cover')
		->where('status !=',1,true)
		->order_by('released_date','asc')
				->get();
		return $query->result();
	}

	public function movetodetail($value='')
	{
		# code...

	}

}
