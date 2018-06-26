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
	}


	public function v($url='')
	{

		
		$video = $this->video_m->getVideo($url);
		if($video){
			$video_id = $video[0]->video_id;
			$this->load->model('statistics');
			$views = $this->statistics->saveViews($video[0]->video_id);

			if($has_parent = $this->video_m->getParent($video[0]->video_id)){
				$playlist = $this->video_m->getPlaylist($has_parent);
				$list = '';

				//var_dump($playlist);
				//exit();
				foreach ($playlist as $key) {
					# code...
					$info = '';
					$info = $this->video_m->getVideo($key->video_id);
					$info = $info[0];
					//var_dump($info);
					$list .= "<li><a href='$info->slug' >$info->title ($info->episode_number)</a></li>";
				}

					$info = '';
					$info = $this->video_m->getVideo($has_parent);
					$info = $info[0];
				//$list .= "<li><a href='$info->slug' >$info->title</a></li>";
				$data['playlist'] = $list;
				$episodes = $this->video_m->previus_next($has_parent,$video[0]->episode_number);

					if (isset($episodes)) {
						if (is_array($episodes)) {
								$no = count($episodes);
								if($no == 2){
									//foreach ($episodes as $ep) {
										$data['previous'] = $episodes[0]->slug;
										$data['next'] = $episodes[1]->slug;
									//}
								}else{
									if($episodes[0]->episode < $video[0]->episode_number){

										$data['previous'] = $episodes[0]->slug;
										$data['next'] = false;
									}else{

										$data['previous'] = false;
										$data['next'] = $episodes[0]->slug;
									}
								}
						}
					}


			}elseif($has_child = $this->video_m->getChild($video[0]->video_id)){

				//$playlist = $this->video_m->getPlaylist($has_child);
				$list = '';
				foreach ($has_child as $key) {
					# code...
					$info = '';
					$info = $this->video_m->getVideo($key->video_id);
					$info = $info[0];
					//var_dump($info);
					$list .= "<li><a href='$info->slug' >$info->title ($info->episode_number)</a></li>";
				}

				$episodes = $this->video_m->previus_next($video[0]->video_id,$video[0]->episode_number);
					if (isset($episodes)) {
						if (is_array($episodes)) {
								$no = count($episodes);
								if($no == 2){
									//foreach ($episodes as $ep) {
										$data['previous'] = $episodes[0]->$slug;
										$data['next'] = $episodes[1]->$slug;
									//}
								}else{
									if($episodes[0]->episode < $video[0]->episode_number){

										$data['previous'] = $episodes[0]->slug;
										$data['next'] = false;
									}else{

										$data['previous'] = false;
										$data['next'] = $episodes[0]->slug;
									}
								}
						}
					}
					$info = '';
					$info = $this->video_m->getVideo($video[0]->video_id);
					$info = $info[0];
				//$list .= "<li><a href='$info->slug' >$info->title</a></li>";
				$data['playlist'] = $list;
			}

			$mirror = $this->input->get('mirror');
			if($mirror > 0){

				if($toembed = $this->video_m->getMirror($video[0]->video_id,$mirror)){
					$embed = $toembed[0]->embed;

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
						'source_id'=>$key->source_id
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
		//var_dump($data['next']);
		//exit();
		//$data['fbshare'] = true;
		$data['video'] = isset($video[0]) ? $video[0] : false ;
		$data['site_title'] = isset($video[0]->title) ? $video[0]->title : 'Watch';
		$this->themes->run('default','watch/index',$data);
	}

	public function new_upload($value='')
	{
		# code...
		$data['list_video'] = $this->video_m->list_new_upload();
		$data['site_title'] = 'List new uploaded videos';
		$this->themes->run('default','watch/video',$data) ;
	}

	public function anime($value='')
	{
		# code...
		$data['list_video'] = $this->video_m->list_anime();
		$data['site_title'] = 'List uploaded videos by letters';
		$this->themes->run('default','watch/list',$data) ;
	}
	public function movies($value='')
	{
		# code...
		$data['list_video'] = $this->video_m->list_movies();
		$data['site_title'] = 'List uploaded videos by letters';
		$this->themes->run('default','watch/list',$data) ;
	}
    
    public function reader($link = false){
        if($this->input->get('url')){
            
            $file=urldecode($this->input->get('url'));

           /* header('Content-Type: video/mp4'); #Optional if you'll only load it from other pages
            header('Accept-Ranges: bytes');
            header('Content-Length:'.filesize($file));
            
            readfile($file);
            
            */
            
                    }
    }

	

	public function r($video=false)
	{
		if($video){
			$this->load->model('video_m');
			$link = $this->video_m->getLink($video);
			$base = base_url();
		    $file=str_replace($base,'',$link);
		    //echo $file;
		    //exit();
			header('Content-Type: video/mp4'); #Optional if you'll only load it from other pages
			header('Accept-Ranges: bytes');
			header('Content-Length:'.filesize($file));

			//readfile($file);
			
				    @readfile($file);
				 
				    // and flush the buffer
				    @ob_flush();
				    flush();
		}
	    


	}
	

 
	public function v_url(){
		//echo base_url('public/uploads/video/black-clover-18.mp4');
		$video = $this->input->post('video');

			$this->load->model('video_m');
			$link = $this->video_m->getLink($video);
			echo "$link";
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

	public function test($value='')
	{
		# code...
		$this->themes->run('default','test');
	}

}