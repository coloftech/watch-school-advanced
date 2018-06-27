<?php 

/**
* 
*/
class Watch extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('video_m');
		$this->load->model('video_model','watch');
	}
	public function index($value='')
	{
		# code...
		$views = $this->video_m->list_new_upload(10);
		$data['list_mostviews'] = $views;
		$playlist = $this->watch->listall(1,1,100,0);
		$data['playlist']=$playlist;

		$data['site_title'] = 'Watchschool Playlist';

		$this->themes->run('default','watch/listall',$data);

	}
	public function c($detail_id='')
	{
		# code...
		$details = $this->watch->getvideo($detail_id);
		//var_dump($details);
		if(count($details) > 0){
			$episodes = $this->watch->show_playlist($details[0]->video_detail_id);

					$data['episodes'] = $episodes;
									$ep_string = array();
									foreach ($episodes as $key){
										$ep_string[] = 'episode '.$key->episode;
									}
					$ep =implode(',', $ep_string);

			$data['fbshare'] = true;
			$data['meta_title'] = $details[0]->title;
			$data['description'] = !empty($details[0]->synopsis) ? $details[0]->synopsis.', '.$ep : false;
			$data['featured_image'] =  !empty($details[0]->thumbnail) ? $details[0]->thumbnail : false;
			$data['link'] = site_url('watch/v/'.$details[0]->slug);

		}
		$data['details'] = $details;
		$title = !empty($details[0]->title) ? $details[0]->title : '';
		$data['title']=$title;
		$data['site_title'] = 'Playlist | '.$title;

		$this->themes->run('default','watch/info',$data);
	}

	public function v($url='')
	{

		
		$video = $this->video_m->getVideo($url);
		$detail_id = 0;
		if($video){
			$video_id = $video[0]->video_id;
			$this->load->model('statistics');
			$views = $this->statistics->saveViews($video[0]->video_id);

			if($detail_id = $this->watch->getdetail_id($video_id)){

				if($previous = $this->watch->previous($detail_id,$video_id,$video[0]->episode_number)){

				$data['previous'] = $previous[0]->slug;
				}


				if($next = $this->watch->next($detail_id,$video_id,$video[0]->episode_number)){

				$data['next'] = $next[0]->slug;

				}
				
				}
			$mirror = $this->input->get('mirror');
				if($mirror > 0){

				if($toembed = $this->video_m->getMirror($video[0]->video_id,$mirror)){
					$embed = $toembed[0]->embed;
					$source_id = $toembed[0]->source_id;;

				$v = false;
				foreach ($video as $key) {
					# code...video_id,title,thumbnail,video_type,sypnosis,slug,episode_number
					$v = array(
						'video_id'=>$key->video_id,
						'title'=>$key->title,
						'thumbnail'=>$key->thumbnail,
						'video_type'=>$key->video_type,
						'sypnosis'=>$key->sypnosis,
						'slug'=>$key->slug,
						'episode_number'=>$key->episode_number,
						'embed'=>$embed,
						'source_id'=>$source_id
						); 
				}
				$video =false;
				$video[] = (object)$v;
				}
				
				
			}
			$data['mirrors'] = $this->video_m->getMirror($video_id);
			$data['meta_title'] = $video[0]->title;
			$data['description'] = !empty($video[0]->sypnosis) ? $video[0]->sypnosis : false;
			$data['featured_image'] =  !empty($video[0]->thumbnail) ? $video[0]->thumbnail : false;
			$data['link'] = site_url('watch/v/'.$video[0]->slug);
		}

		$details = $this->watch->getvideo($detail_id);
		$data['detail_cover_slug'] = isset($details[0]->slug) ? $details[0]->slug : false;
		$data['detail_cover_title'] = isset($details[0]->title) ? $details[0]->title : false;
		$this->load->model('video_m');
		$views = $this->video_m->list_new_upload(10);
		$data['is_countdown'] = true;
		$data['list_mostviews'] = $views;


		$data['detail_id'] = $detail_id;

		$data['fbshare'] = true;
		$data['video'] = isset($video[0]) ? $video[0] : false ;
		$data['site_title'] = isset($video[0]->title) ? $video[0]->title : 'Watch';
		$this->themes->run('default','watch/new-index',$data);
	}

	public function recents($offset=0)
	{
		# code...

		$playlist = $this->watch->listall(1,1,100,0);
		$data['playlist']=$playlist;
		
		$limit_1 = 10;
		$limit_2 = 24;
		$data['list_video'] = $this->video_m->list_new_upload($limit_2,$offset);

		$url = site_url('watch/recents');
		$total_rows = count($this->video_m->listall_new_upload());
		$data['pagination'] = $this->auto_m->create_link($url,$limit_2,$total_rows);

		$data['sidebar_title'] = 'PLAYLIST';
		$data['site_title'] = 'List recents videos';
		$this->themes->run('default','watch/new-video',$data) ;
	}

	public function newvideo($offset=0)
	{
		# code...
		$limit_1 = 10;
		$limit_2 = 24;
		$this->load->model('video_m');
		$views = $this->video_m->list_new_upload($limit_1);
		$data['list_mostviews'] = $views;

		$url = site_url('watch/newvideo');
		$total_rows = count($this->video_m->listall_new_video());

		$data['pagination'] = $this->auto_m->create_link($url,$limit_2,$total_rows);

		$data['list_video'] = $this->video_m->list_new_video($limit_2,$offset);


		$data['site_title'] = 'List new videos';
		$this->themes->run('default','watch/new-video',$data) ;
	}

	public function anime($value='')
	{
		# code...
		$data['list_video'] = $this->video_m->list_anime(50);
		$data['site_title'] = 'List uploaded videos by letters';
		$this->themes->run('default','watch/list',$data) ;
	}
	public function movies($value='')
	{
		# code...
		$data['list_video'] = $this->video_m->list_movies(50);
		$data['site_title'] = 'List uploaded videos by letters';
		$this->themes->run('default','watch/list',$data) ;
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