<?php 

/**
* 
*/
class Watch extends CI_Controller
{
	public $theme = 'default';
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('video_m');
		$this->load->model('video_model','video');
	}

	public function index($value='')
	{
		# code...

		# code...
		//list_chart(type,status,limit,offset);
		//type
		//1-anime
		//2-movies
		//3-tv series
		//status
		//1-ongoing
		//2-incoming
		//3-completed
		//12-ongoing/incoming

		$this->load->model('video_model','video');
		$data['livecharts'] = $this->video->list_chart(1,1);
		$data['livecharts2'] = $this->video->list_chart(2,1);
		$data['livecharts3'] = $this->video->list_chart(3,1);

		$data['video_counter'] = $this->video->video_counter();
		
		
		$this->load->model('video_m');
		$views = $this->video_m->list_new_upload(20);
		$data['is_countdown'] = true;
		$data['list_mostviews'] = $views;

		if(!empty($views) && is_array($views)){
			$keywords = "";
			foreach ($views as $key) {
				# code...
				$keywords[] = $key->title;
			}
			$data['keywords'] = implode(', ', $keywords);
		}

			$data['currentD'] = date('Y/m/d');
			$data['currentT'] = date('H:i:s');
		$data['site_title'] = 'Watch School 2018';
		$data['menu'] = 'home';
		$this->themes->load($this->theme,'public/watch/new-index-2',$data);
	}
	public function c($detail=false,$episode_number=false)
	{
		# code...


	    $data = $this->session->userdata;
	    $this->load->model('user_model','user');
	    $this->load->library('userlevel','level');
	    $data['groups'] = $this->user->getUserData();
	    //check user level
	    if(!empty($data['role'])){

	    $dataLevel = $this->userlevel->checkLevel($data['role']);
	    }


		$this->load->model('video_m');
		$views = $this->video_m->list_new_upload(20);
		$data['is_countdown'] = true;
		$data['list_mostviews'] = $views;


		if($detail){
			$display = 'cover';

				$details = $this->video->getvideo($detail);
				$detail_id = isset($details[0]->video_detail_id) ? $details[0]->video_detail_id : 0 ;
				$title = !empty($details[0]->title) ? $details[0]->title : '';

				$meta_title = $title;
				$meta_description = !empty($details[0]->synopsis) ? $details[0]->synopsis : false;
				$meta_image =  !empty($details[0]->thumbnail) ? $details[0]->thumbnail : false;
				$meta_url = base_url('watch/c/'.$details[0]->slug);



				$button_edit = false;
			if($episode_number){


				if($episode = $this->video->episodeInfo($detail_id,$episode_number)){

			$this->load->model('statistics');
			$views = $this->statistics->saveViews($episode->video_id,$this->getIp());


					$data['episode'] = $episode_number;
					$data['video_url'] = $episode->link;
					$data['embeded'] = $episode->embed;
					$data['source_id'] = $episode->source_id;
					$data['video_id'] = $episode->video_id;					
					$episode_title = $episode->title;				
					$data['episode_title'] = $episode_title;			
					$data['slug'] = $episode->slug;			
					$data['video_link'] = $episode->link;


					$meta_title = $episode_title;
					$meta_image = $episode->thumbnail;
					$meta_description = $episode->sypnosis;
					$meta_url =  base_url('watch/c/'.$details[0]->slug.'/'.$episode_number);


					$data['site_title'] = $episode->title;
					$display = 'video';
					//exit();
									if($previous = $this->video->previous($detail_id,$episode->video_id,$episode_number)){

											$enum1 = $previous[0]->video_episode+0;
									$data['previous'] = base_url('watch/c/'.$details[0]->slug.'/'.$enum1);
									}


									if($next = $this->video->next($detail_id,$episode->video_id,$episode_number)){

										if($next[0]->video_episode == $episode_number){
											$data['next'] = false;
										}else{
											$enum2 = $next[0]->video_episode+0;
											$data['next'] = base_url('watch/c/'.$details[0]->slug.'/'.$enum2);
										
										}
									}
				}
				if(!empty($dataLevel) && $dataLevel == 'is_admin'){
				$button_edit = '<a href="'.base_url("video/index/$detail_id/$episode->video_id").'"class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>';
				}
			}else{
				if(!empty($dataLevel) && $dataLevel == 'is_admin'){
					$button_edit = '<a href="'.base_url("video/index/$detail_id").'"class="btn btn-default btn-sm"><i class="fa fa-edit"></i></a>';
				}
				
			}
			$data['button_edit'] = $button_edit;

				if(count($details) > 0){
				$episodes = $this->video->show_playlist($details[0]->video_detail_id);
			
			
					$data['episodes'] = $episodes;
									$ep_string = array();
									foreach ($episodes as $key){
										$ep_string[] = 'episode '.$key->episode;
									}
					$ep =implode(',', $ep_string);


				$data['fbshare'] = true;
				$data['meta_title'] = $meta_title;
				$data['description'] = $meta_description.', '.$ep;
				$data['featured_image'] =  $meta_image;
				$data['link'] = $meta_url;



				}

			$data['parent_slug'] = $details[0]->slug;
			$data['display'] = $display;
			$data['details'] = $details;
			$data['title']=$title;
			$data['site_title'] = $meta_title;

			$this->themes->load($this->theme,'public/watch/viewer',$data);
		}
	}

	public function playlist($value='')
	{
		# code...
		$views = $this->video_m->list_new_upload(10);
		$data['list_mostviews'] = $views;
		$playlist = $this->video->listall(1,1,0,0);
		$data['playlist']=$playlist;

		$data['site_title'] = 'Watchschool Playlist';

		$data['menu'] = 'series';
		$this->themes->load($this->theme,'public/watch/listall',$data);

	}
public function v($url='') /*onld video viewer */
	{

		$this->load->model('video_m');
		$views = $this->video_m->list_new_upload(20);
		$data['is_countdown'] = true;
		$data['list_mostviews'] = $views;

		$detail_id =0;
		$video = $this->video_m->getVideo($url);
		$data['display'] = 'video';
		if($video){
			$video = $video[0];
			if($detail_id = $this->video->getdetail_id($video->video_id)){
				$series	= $this->video->getvideo($detail_id);
				$series = $series[0];
				$enum = $video->episode_number+0;
				redirect('watch/c/'.$series->slug.'/'.$enum);
			}

			$this->load->model('statistics');
			$views = $this->statistics->saveViews($video->video_id,$this->getIp());


			$data['title'] = $video->title;
			$data['details'] = false;
			$meta_url = base_url('watch/v/'.$video->slug);
			$data['slug'] = $video->slug;
			$data['embeded'] = $video->embed;
			$data['source_id'] = $video->source_id;

					$meta_title = $video->title;
					$meta_image = $video->thumbnail;
					$meta_description = $video->sypnosis;

		}

				$data['fbshare'] = true;
				$data['meta_title'] = $meta_title;
				$data['description'] = $meta_description.', '.$meta_title;
				$data['featured_image'] =  $meta_image;
				$data['link'] = isset($meta_url) ? $meta_url : '';

		$this->themes->load($this->theme,'public/watch/viewer',$data);
	}
	public function completed($offset=0)
	{

		# code...
		//list_chart(type,status,limit,offset);
		//type
		//1-anime
		//2-movies
		//3-tv series
		//status
		//1-ongoing
		//2-incoming
		//3-completed
		//12-ongoing/incoming

		$data['menu'] = 'completed';
		$this->load->model('video_model','video');
		$data['livecharts'] = $this->video->list_chart(1,3);

		$this->load->model('video_model','video');
		$data['livecharts3'] = $this->video->list_chart(3,3);

		$this->load->model('video_m');
		$views = $this->video_m->list_new_upload(10);

		if(!empty($views) && is_array($views)){
			$keywords = "";
			foreach ($views as $key) {
				# code...
				$keywords[] = $key->title;
			}
			$data['keywords'] = implode(', ', $keywords);
		}
		$data['is_countdown'] = true;
		$data['list_mostviews'] = $views;


		$this->themes->load($this->theme,'public/watch/completed',$data) ;


	}
	
	public function incoming($offset=0)
	{

		# code...
		//list_chart(type,status,limit,offset);
		//type
		//1-anime
		//2-movies
		//3-tv series
		//status
		//1-ongoing
		//2-incoming
		//3-completed
		//12-ongoing/incoming

		$this->load->model('video_model','video');
		$data['livecharts'] = $this->video->list_chart(1,2);

		$this->load->model('video_model','video');
		$data['livecharts3'] = $this->video->list_chart(3,2);

		$this->load->model('video_m');
		$views = $this->video_m->list_new_upload(10);

		if(!empty($views) && is_array($views)){
			$keywords = "";
			foreach ($views as $key) {
				# code...
				$keywords[] = $key->title;
			}
			$data['keywords'] = implode(', ', $keywords);
		}
		$data['is_countdown'] = true;
		$data['list_mostviews'] = $views;


		$this->themes->load($this->theme,'public/watch/incoming',$data) ;


	}

	public function recents($offset=0)
	{
		# code...
		
		$data['menu'] = 'recents';
		$playlist = $this->video->listall(1,1,100,0);
		$data['playlist']=$playlist;
		
		
		$limit_1 = 10;
		$limit_2 = 24;
		$data['list_video'] = $this->video_m->list_new_upload($limit_2,$offset);

		$url = base_url('watch/recents');
		$total_rows = count($this->video_m->listall_new_upload());
		$data['pagination'] = $this->auto_m->create_link($url,$limit_2,$total_rows);

		$data['sidebar_title'] = 'PLAYLIST';
		$data['site_title'] = 'List recents videos';
		$this->themes->load($this->theme,'public/watch/new-video',$data) ;
	}

	public function newvideo($offset=0)
	{
		# code...
		$limit_1 = 10;
		$limit_2 = 24;
		$this->load->model('video_m');
		$views = $this->video_m->list_new_upload($limit_1);
		$data['list_mostviews'] = $views;

		$url = base_url('watch/newvideo');
		$total_rows = count($this->video_m->listall_new_video());

		$data['pagination'] = $this->auto_m->create_link($url,$limit_2,$total_rows);

		$data['list_video'] = $this->video_m->list_new_video($limit_2,$offset);


		$data['site_title'] = 'List new videos';
		$this->themes->load($this->theme,'public/watch/new-video',$data) ;
	}

	public function anime($char='')
	{
		# code...
		$data['list_video'] = $this->video->listallchar(1,false,false,false,$char);
		$data['site_title'] = 'List uploaded videos by letters';
		$this->themes->load($this->theme,'public/watch/anime',$data) ;
	}
	public function movies($value='')
	{
		# code...
		$data['list_video'] = $this->video_m->list_movies(50);
		$data['site_title'] = 'List uploaded videos by letters';
		$this->themes->load($this->theme,'public/watch/list',$data) ;
	}
    	
	
	public function reported(){
		if($this->input->post()){
			$this->load->model('video_m');
			$obj = (object)$this->input->post();

			$user_ip = $this->getIp();
			
			$data = array(
			    'video_id'=>(int)$obj->video_id,
			    'source_id'=>(int)$obj->source_id,
			    'user_ip'=>$user_ip
			    );
			
			if($reported = $this->video_m->saveReport($data)){
			    
			echo json_encode(array('stats'=>true,'msg'=>'Thank you'));
			}else{
			    
			echo json_encode(array('stats'=>false,'msg'=>"Unknown server error"));
			}

		}
	}
	
	function getIp()
	{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
	}
	
}