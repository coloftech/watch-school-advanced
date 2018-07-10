<?php 

/**
* 
*/
class Video extends CI_Controller
{
    public $status;
    public $roles;

    function __construct(){
        parent::__construct();
        $this->load->model('User_model', 'user_model', TRUE);
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->status = $this->config->item('status');
        $this->roles = $this->config->item('roles');
        $this->load->library('userlevel');


		$this->load->model('video_model','video');
		$this->load->model('video_m');
		$this->load->library('auth');

		if(!$this->auth->is_loggedIn()){
			redirect('main/login');
		}
		if (!$this->auth->is_admin()) {
			# code...

			redirect('main');
		}


       }
	public function index($series=false,$video=false)
	{
		# code...

	    $data = $this->session->userdata;
	    $data['groups'] = $this->user_model->getUserData();
	    if($series){
	    	$data['series_id'] = $series;
	    }
	    
	    $dataLevel = $this->userlevel->checkLevel($data['role']);

	    $data['title'] = "Video";
            $this->load->view('header', $data);
            $this->load->view('navbar', $data);
            $this->load->view('container');
            $this->load->view('video/index', $data);
            $this->load->view('footer');
	}

	public function list_all($l1=false, $l2 =false)
	{
		# code...



		$letters = 'all';
		if($l1 || $l2){
		$s = $l1;// $this->input->get('s') ;
		$e = $l2;//$this->input->get('e') ;
		$letters = "$s-$e";
		}
		$videos = $this->video->selectbyletter($letters);
		$data['videos'] = $videos;



            $this->load->view('video/list-all', $data);
	}

	public function new_series()
	{
		# code...

			$data['title'] = 'New series';
            $this->load->view('video/new-series', $data);
	}

	public function new_video()
	{
		# code...

			$data['title'] = 'New video';

            $this->load->view('video/new-video', $data);
	}

	public function videocategory($detail_id=false)
	{
		# code...

		//$option = false;
			$category = $this->input->post('videocategory');
			switch ($category) {
				case 2:
					# code...
				$cat = 'Movie';
					break;
				
				case 3:
					# code...
				$cat = 'Asian/Drama';
					break;
				default:
					# code...
				$cat = 'Anime';
					break;
			}
			$option = '<option value="0">-Add '.$cat.' as single video- (select more option) </option>';

		if($videos = $this->video->listall($category)){
			//return $videos;

			foreach ($videos as $key) {
				# code...

				$option .= "<option value='$key->video_detail_id'";
				if($detail_id != false){
					if($detail_id == $key->video_detail_id){
						$option .= " selected ";
					}
				}
				$option .= ">$key->title</option>";
				//$options[] = array('id'=>$key->video_detail_id,'title'=>$key->title);
			}
		}
		echo $option;
		//echo $option;
	}

	public function parent_thumbnail($value='')
	{
		# code...
		if($this->input->post()){
			$parent = $this->video->getvideo($this->input->post('parent_id'));
			if(count($parent) > 0){
				echo isset($parent[0]->thumbnail) ? $parent[0]->thumbnail : site_url('image/r/no-thumbnail.jpg');

				exit();
			}
		}
		echo site_url('image/r/no-thumbnail.jpg');

	}

	public function add_video(){
		$errors = false;
		$result = false;
		$status = false;
		if($this->input->post()){

			$obj = (object)$this->input->post();
			$year  = date('Y');
			$slug = $this->slug->create($obj->title.'-'.$year);
			$is_exist = $this->video->getepisode($slug);
			if($is_exist != false){
				$slug = $slug.'-'.uniqid();
			}
			//$result = array($slug,$is_exist);
			$data = array(
				'title'=>$obj->title,
				'sypnosis'=>$obj->synopsis,
				'slug'=>$slug,
				'link'=>$obj->episode_url,
				'embed'=>$obj->embed,
				'thumbnail'=>$obj->episode_thumbnail,
				'episode_number'=>$obj->episode_number,
				'source_id'=>$obj->videosource,
				'video_type'=>$obj->videocategory,
				'release_mode'=>$obj->release_mode
				);

			if($is_added = $this->video_m->insert($data)){
				if($obj->videoparent != 0){
					$data2 = array(
						'video_detail_id'=>$obj->videoparent,
						'video_id'=>$is_added,
						'video_episode'=>$obj->episode_number,
						'video_type'=>$obj->videosource
						);
					$is_playlist = $this->video->addto_playlist($data2);

				}
				$status = true;
				$result = $is_added;

			}

		}

		$response = array('success'=>$status,'error'=>$errors,'msg'=>$result);


		echo json_encode($response);
	}


	public function update_video(){
		$errors = false;
		$result = false;
		$status = false;
		if($this->input->post()){

			$obj = (object)$this->input->post();
			
			$data = array(
				'title'=>$obj->title,
				'sypnosis'=>$obj->synopsis,
				'link'=>$obj->episode_url,
				'embed'=>$obj->embed,
				'thumbnail'=>$obj->episode_thumbnail,
				'episode_number'=>$obj->episode_number,
				'source_id'=>$obj->videosource,
				'video_type'=>$obj->videocategory,
				'release_mode'=>$obj->release_mode
				);

			if($is_added = $this->video_m->update_video($obj->video_id,$data)){
				
				$status = true;
				$result = $is_added;

			}

		}

		$response = array('success'=>$status,'error'=>$errors,'msg'=>$result);


		echo json_encode($response);
	}

	public function add_series($value='')
	{
		# code...
		$errors = false;
		$result = false;
		$status = false;
		if($this->input->post()){

			$obj = (object)$this->input->post();
			$year  = date('Y',strtotime($obj->release_date));
			$slug = $this->slug->create($obj->title.'-'.$year);
			$is_exist = $this->video->getvideo($slug);
			if($is_exist != false){
				$slug = $slug.'-'.uniqid();
			}

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
					'live_chart_date_end'=>$end_date ,
					'thumbnail'=>$obj->thumbnail,
					'status'=>$obj->status,
					'type'=>$obj->type,
					'islivechart'=>$obj->islivechart,
					'slug'=>$this->slug->create($obj->title.' '.date('Y',strtotime($obj->release_date)))
					);

					if($is_series = $this->video->insert_detail($data)){
							$status = true;
							$result = array('id'=>$is_series,'msg'=>'Playlist added successfully!');
					}

			}

		

		$response = array('success'=>$status,'error'=>$errors,'msg'=>$result);


		echo json_encode($response);
	}

	public function removeseries($detail_id='')
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

	
	public function edit_video($series=false,$video_id = false)
	{
		if($video_id){

			$details = $this->video_m->getVideo($video_id);

			$data['details'] = $details[0];
		}

		$data['detail_id'] = $series;

			$data['title'] = 'Edit series';
            $this->load->view('video/edit-video', $data);
	}

	public function edit_series($series=false,$video_id = false)
	{
		if($series){

			$details = $this->video->getvideo($series);

			# code...
			if($video_id){
				$detail_id = $this->video->getdetail_id($video_id);
			}

			if(count($details) > 0){
				$data['episodes'] = $this->video->show_playlist($series);
			}
			$data['details'] = $details[0];
		}
			$data['detail_id'] = $series;
			$data['title'] = 'Edit series';
            $this->load->view('video/edit-series', $data);

	}

	public function update_series($detail_id=0)
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
					'thumbnail'=>$obj->thumbnail,
					'synopsis'=>$obj->synopsis,
					'genre'=>$obj->genre,
					'release_date'=>$obj->release_date,
					'live_chart_date'=>$obj->countdown_date.' '.$obj->countdown_time,
					'live_chart_date_end'=>$end_date,
					'status'=>$obj->status,
					'type'=>$obj->type,
					'islivechart'=>$obj->islivechart

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

	public function addtoplaylist($detail_id=0)
	{
		# code...
		if($this->input->post()){
			$array = (object)$this->input->post();

				$data3 = false;
				$error = 0;
				$i=0;
			foreach ($array->episodes as $key) {
				# code...
				$input = array('video_detail_id'=>$detail_id,'video_id'=>$key);
				//exit();
				if(!$exist = $this->video->isexisting($input)){
					if($info = $this->video_m->getVideo($key)){
						$obj = $info[0];
								$data2 = array(
									'video_detail_id'=>$detail_id,
									'video_id'=>$key,
									'video_episode'=>$obj->episode_number,
									'video_type'=>$obj->video_type
									);
								if($result = $this->video->addto_playlist($data2)){
									$error = $error+0;
								}else{
									$error++;
								}
							//$data3[] = $is_playlist;
							
							
					}

				}
				$i++;
			}

				if($error > 0){

				}
			header('Content-Type: application/json');
			echo json_encode(array('success'=>true,'message'=>'Episode added with '.$error.' error out of '.$i.' data'));
			exit();
			
		}
			header('Content-Type: application/json');
			echo json_encode(array('success'=>false,'message'=>$this->noinput()));
			exit();
	}


	public function statistics($value='')
	{
		# code...

		$this->load->model('statistics');
		$statistics = $this->statistics;
		$data['statistics'] = $statistics->getVideoStatitics(100);

			$data['title'] = 'Edit series';
            $this->load->view('video/statistics', $data);

	}
	
	public function reported($value='')
	{
		# code...

		$data['brokenlink'] = $this->video->brokenLink();
			$data['title'] = 'Edit series';
            $this->load->view('video/reported', $data);
	}
	public function list_video($value='')
	{
		# code...

		$data['list_video'] = $this->video_m->list_anime();
		$data['site_title'] = 'List uploaded videos by letters';
        $this->load->view('video/list-videos', $data);
	}
	public function noinput($value='')
	{
		# code...
		return "Nothing to do here!";
	}
	
}