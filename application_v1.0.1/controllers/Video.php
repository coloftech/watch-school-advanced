<?php 

/**
* 
*/
class Video extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		if (!$this->authentication->is_loggedin())
		redirect();

		$this->load->model('video_model','video');
		$this->load->model('video_m');

	}
	public function index($value='')
	{
		# code...
		$letters = 'A-E';
		if($this->input->get('s') && $this->input->get('e')){
		$s = $this->input->get('s') ;
		$e = $this->input->get('e') ;
		$letters = "$s-$e";
		}
		$videos = $this->video->selectbyletter($letters);
		$data['videos'] = $videos;
		$data['site_title'] = 'Add new of video.';
		$this->themes->run('admin','admin/video/new',$data);
	}
	public function info($video_id=0)
	{
		# code...
		$_SESSION['newepisode'] = 0;
		$data['video_id'] = $video_id;
		$info = $this->video_m->getVideo($video_id);
		//var_dump($info);

		//if($videos = $this->video_m->getEpisodes($video_id)){

		//}else{
			$parent = $this->video_m->getParent($video_id);
			$videos = $this->video_m->getEpisodes($parent);
			$data['parent_video_id'] = $parent;
		//}
//var_dump($videos);exit();
		$data['total_episodes'] = count($videos);
		$data['list_episodes'] = $videos;
		$data['links'] = $this->video_m->list_link($video_id);

		$data['infos'] = isset($info[0]) ? $info[0] : false;

		$data['site_title'] = 'Information';
		$this->themes->run('admin','admin/anime/info',$data);
	}
	
	public function change_cover($detail_id=0)
	{

		# code...
		//echo json_encode($this->input->post());exit();
		if($this->input->post()){
			$data = array('thumbnail'=>$this->input->post('thumbnail'));
			$result = $this->video->update($detail_id,$data);

			header('Content-Type: application/json');
			echo json_encode(array('success'=>$result,'message'=>$result));
			exit();
		}

			header('Content-Type: application/json');
			echo json_encode(array('success'=>false,'message'=>$this->noinput()));
			exit();
	}

		public function cover_page($video_id=0)
	{
		# code...
		$info = false;
		$data['cover_page'] = false;
		if($video_id > 0){

			$video = $this->video_m->getVideo($video_id);
			$data['video_info'] = $video[0];

			if($cover_page = $this->video_m->getCoverInfo($video_id)){

			$data['cover_page'] = $cover_page[0];
			}
			
		}
		$data['video_id'] = $video_id;
		$data['site_title'] = 'Cover page';
		$this->themes->run('admin','admin/anime/cover',$data) ;
	}
	public function edit($detail_id=0)
	{
		# code...
		$details = $this->video->getvideo($detail_id);
		if(count($details) > 0){
			$data['episodes'] = $this->video->show_playlist($detail_id);
		}
		$data['details'] = isset($details) ? $details[0] : false;
		$data['site_title'] = 'Edit video';
		$this->themes->run('admin','admin/video/edit',$data);
		
	}

	public function episode($detail_id,$video_id)
	{
		# code...
		$title = '';

		$details = $this->video->getepisode($video_id);
		if(is_object($details)){
			$title = $details->title;
		}
			
		$data['detail_id'] = $detail_id;
		$data['details'] = $details;
		$data['site_title'] = 'Edit episode | '.$title;
		$this->themes->run('admin','admin/video/episode',$data);
		
	}

	public function moveepisode($detail_id=0)
	{
		# code...
		if($this->input->post()){
			$array = (object)$this->input->post();
			foreach ($array->episodes as $key) {
				# code...
				if(!$exist = $this->video->isexisting($key)){
					if($info = $this->video_m->getVideo($key)){
						$obj = $info[0];
						$data = array(
							'video_id'=>$obj->video_id,
							'video_episode'=>$obj->episode_number,
							'video_type'=>$obj->video_type,
							'video_detail_id'=>$detail_id
							);
						$result = $this->video->addto_playlist($detail_id,$data);
					}
				}
			}
			header('Content-Type: application/json');
			echo json_encode(array('success'=>$result,'message'=>$result));
			exit();
			
		}
			header('Content-Type: application/json');
			echo json_encode(array('success'=>false,'message'=>$this->noinput()));
			exit();
	}

	public function remove($detail_id='')
	{
		# code...
		if($this->input->post()){
			//var_dump($this->input->post());
			$detail_id = $this->input->post('detail_id');
			$removed = $this->video->remove_video(array('video_detail_id'=>$detail_id));

						$response = array(
							'success' => $removed,
							'errors'  => $this->video->dberror(),
							'message' => 'Video was removed'
							);
			//add the header here
			header('Content-Type: application/json');
			echo json_encode($response);
			exit();
		}
	}

	public function addvideo($value='')
	{
		if($this->input->post()){
			$errors = array();
			$rules = $this->video->video_details_rules;
			$this->form_validation->set_rules($rules);

			if($this->form_validation->run())
			{
			$obj = (object)$this->input->post();
				$data = array(
					'title'=>$obj->title,
					'synopsis'=>$obj->synopsis,
					'genre'=>$obj->genre,
					'release_date'=>$obj->release_date,
					'live_chart_date'=>$obj->countdown_date.' '.$obj->countdown_time,
					'live_chart_date_end'=>$obj->expired_date.' '.$obj->expired_time,
					'thumbnail'=>$obj->thumbnail,
					'status'=>$obj->status,
					'type'=>$obj->type,
					'slug'=>$this->slug->create($obj->title.' '.date('Y',strtotime($obj->release_date)))
					);

					if($errors = $this->video->insert_detail($data)){

						$response = array(
							'success' => true,
							'errors'  => $errors,
							'message' => 'Video added successfuly'
							);
					}else{

					$response = array(
					'success' => false,
					'errors'  => $this->video->dberror(),
					'message' => 'Video added successfuly'
					);
					}


			}else{

				$response = array(
					'success' => false,
					'errors'  => json_errors(),
					'message' => 'Errors exists in form.'
					);
			}

			//add the header here
			header('Content-Type: application/json');
			echo json_encode($response);
			exit();
		}

			//add the header here
			header('Content-Type: application/json');
			echo json_encode(array('success'=>false,'error'=>array(),'message'=>'No input received.'));
	}
	public function saveepisode($detail_id=0)
	{
		# code...
		if($this->input->post() && !empty($detail_id)){
			$obj = (object)$this->input->post();
			$vid = $this->video->getvideo($detail_id);


			$input = array(
				'title'=>$obj->episode_title,
				'slug'=>$this->slug->create($obj->episode_title.' no '.$obj->episode_number.' m '.$obj->videosource),
				'embed'=>$obj->embed,
				'link'=>$obj->episode_url,
				'thumbnail'=>$obj->episode_thumbnail,	
				'source_id'=>$obj->videosource,	
				'episode_number'=>$obj->episode_number,
				'sypnosis'=>$obj->episode_syspnosis,
				'video_type'=>(isset($vid[0]->type) ? $vid[0]->type: 1),
				'release_mode'=>$obj->release_mode
				);
			usleep(2000000);
			if($is_added = $this->video_m->save($input)){
			    $_SESSION['newepisode'] = 1;


						$data = array(
							'video_id'=>$is_added,
							'video_episode'=>$obj->episode_number,
							'video_type'=>$vid[0]->type,
							'video_detail_id'=>$detail_id
							);
						$result = $this->video->addto_playlist($detail_id,$data);

				/*$parent_video_id = $obj->video_id;
				if($hasparent = $this->video_m->getParent($obj->video_id)){
				
				$parent_video_id = $hasparent;
				}
				$input2 = array(
					'video_id'=>$is_added,
					'parent_video_id'=>$parent_video_id,
					'source_id'=>$obj->videosource,
					'episode'=>$obj->txtepisodenumber
					);*/
				//$saveEp = $this->video_m->addEpisodes($input2);
			}
			if($is_added > 0){
				$response = true;
			}
			echo json_encode(array('success'=>$response,'message'=>$is_added));

			exit();
			//end of post
		}
		
				//echo json_encode(array('stats'=>true,'msg'=>"Video added successfully.",'video_id'=>$is_added));


			header('Content-Type: application/json');
			echo json_encode(array('success'=>false,'error'=>array(),'message'=>'No input received.'));
	}
	public function search_episode(){
		//var_dump($this->input->post());
		$status = false;
		$search_result = false;
		if($this->input->post()){
			$q = $this->input->post('q');
			$slug = $this->slug->create($q);

			$keywords = explode('-', $slug);
			$infos = false;
			$keys = false;
			$_SESSION['tbltemp'] = 0;

			$drop = 'DROP TABLE IF EXISTS `q_mytemp`';
			$this->db->query($drop);

			foreach ($keywords as $key) {
				# code...
				if($videos = $this->video_m->searchVideo($key)){

					//$infos[] = $videos;
					foreach ($videos as $value) {
						# code...
						if($keys){
							if(in_array($value->video_id, $keys)){

							}else{

							$infos[] = $value;
							}
						}else{

						$infos[] = $value;
						}
						

						$keys[] = $value->video_id;
                            if($value->video_id > 0){
                                
						$this->video_m->temp(array('video_id'=>$value->video_id));
                            }
					}

					}
				}
				
                if(count($keys > 0) && $keys[0] > 0){
                    
                $output = $this->video_m->tempOutput(10);
                $status = true;
                }
                
				$search_result = isset($output) ? $output : false;

			
		}
		$response = array('success'=>$status,'output'=>$search_result);

		header('Content-Type: application/json');
		echo json_encode($response);
	}

	public function updateepisode($detail_id='',$video_id='')
	{
		# code...
		header('X-XSS-Protection: 0');
		//var_dump($this->input->post());
		//exit();
		if($this->input->post() && !empty($detail_id) && !empty($video_id)){
			$obj = (object)$this->input->post();
			$vid = $this->video->getvideo($detail_id);


			$input = array(
				'thumbnail'=>$obj->episode_thumbnail,
				'title'=>$obj->episode_title,
				'embed'=>$obj->embed,
				'link'=>$obj->episode_url,
				'source_id'=>$obj->videosource,	
				'episode_number'=>$obj->episode_number,
				'sypnosis'=>$obj->episode_syspnosis,
				'video_type'=>(isset($vid[0]->type) ? $vid[0]->type: 1),
				'release_mode'=>$obj->release_mode
				);
			usleep(2000000);
			if($is_updated = $this->video->updatevideos($video_id,$input)){
			    
				$response = true;
				$message = 'Video updated successfully.';
			}else{

				$response = false;
				$message = 'No changes made.';
			}
			echo json_encode(array('success'=>$response,'message'=>$message));

			exit();
			//end of post
		}
		
			header('Content-Type: application/json');
			echo json_encode(array('success'=>false,'error'=>array(),'message'=>'No input received.'));
	}

	public function updatedetail($detail_id=0)
	{
		# code...
		//echo json_encode($this->input->post());exit();

		if($this->input->post()){
			$obj = (object)$this->input->post();

			$date = $obj->countdown_date.' '.$obj->countdown_time;
			$date = strtotime($date);
			$date = strtotime("+7 day", $date);
			$end_date =  date('Y-m-d H:i:s', $date);

			$data = array(

					'title'=>$obj->title,
					'synopsis'=>$obj->synopsis,
					'genre'=>$obj->genre,
					'release_date'=>$obj->release_date,
					'live_chart_date'=>$obj->countdown_date.' '.$obj->countdown_time,
					'live_chart_date_end'=>$end_date,
					'status'=>$obj->status,
					'type'=>$obj->type

				);

			$result = $this->video->update($detail_id,$data);


			header('Content-Type: application/json');
			echo json_encode(array('success'=>$result,'message'=>$result));
			exit();
		}

			header('Content-Type: application/json');
			echo json_encode(array('success'=>false,'message'=>$this->noinput()));
			exit();
	}

	public function playlist($detail_id=false){
		if($detail_id){

			if($playlist = $this->video->show_playlist($detail_id)){

				header('Content-Type: application/json');
				echo json_encode(array('success'=>true,'message'=>$playlist));
				exit();
			}


		}
		header('Content-Type: application/json');
		echo json_encode(array('success'=>false,'message'=>$this->noinput()));
		exit();
		
	}

	public function removetoplaylist($detail_id=0)
	{

		# code...
		if($this->input->post()){
			$data = array('video_id'=>$this->input->post('video_id'));
			$result = $this->video->removeto_playlist($detail_id,$data);

			header('Content-Type: application/json');
			echo json_encode(array('success'=>$result,'message'=>$result));
			exit();
		}

			header('Content-Type: application/json');
			echo json_encode(array('success'=>false,'message'=>$this->noinput()));
			exit();
	}
	public function noinput($value='')
	{
		# code...
		return "Nothing to do here!";
	}
	


		public function anime($value='')
	{
		# code...
		$data['list_video'] = $this->video_m->list_anime(0);
		$data['site_title'] = 'List uploaded videos by letters';
		$this->themes->run('admin','admin/anime/list',$data) ;
	}
	public function movies($value='')
	{
		# code...
		$data['list_video'] = $this->video_m->list_movies();
		$data['site_title'] = 'List uploaded videos by letters';
		$this->themes->run('admin','admin/anime/list',$data) ;
	}


	public function reports(){
		$this->load->model('reports');
		$data['brokenlink'] = $this->reports->brokenLink();
		$data['site_title'] = 'List of reported video';
		$this->themes->run('admin','admin/reports/video_error',$data);
	}
	public function removevideo()
	{
		# code...

		if($this->input->post()){
			$data = array('video_id'=>$this->input->post('video_id'));
			$result = $this->video->delete_video($data);

			header('Content-Type: application/json');
			echo json_encode(array('success'=>$result,'message'=>$result));
			exit();
		}

			header('Content-Type: application/json');
			echo json_encode(array('success'=>false,'message'=>$this->noinput()));
			exit();
	}

}