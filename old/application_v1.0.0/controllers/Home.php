<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct($value='')
	{
		# code...
		parent::__construct();
	}
	public function index()
	{

		$this->load->model('video_m');
		$this->load->model('video_model','video');

		//$latest = $this->video->latest_episode();

		//$views = $this->video_m->list_most_views();
		
		$views = $this->video_m->list_new_upload();
		//foreach ($latest as $key) {
			# code...
			//print_r($key);
		//}
		/**/

		$data['list_mostviews'] = $views;
		$data['livechart'] = $this->cover();

		/**/

		$data['is_countdown'] = true;
		$data['site_title'] = 'Watch School';
		//$this->themes->run('default','home/index',$data);
		$this->themes->run('default','video/welcome',$data);
	}

	public function search($value='')
	{
		# code...
		$this->load->model('video_m');
		if($this->input->get()){
			$q = $this->input->get('q');
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
                    
                $output = $this->video_m->tempOutput();
                }
                
				$data['search_result'] = isset($output) ? $output : false;

			
		}
		$data['site_title'] = "Search Video";
		$this->themes->run('default','home/search',$data);
	}

	public function policy($value='')
	{
		# code...
		$data['site_title'] = 'Disclaimer & Policy';
		$this->themes->run('default','home/policy',$data);
	}
	
	

	public function livechart(){
	    
			$data['meta_title'] = 'Watchschool XYZ - Anime Live Chart';
		$data['livechart'] = $this->cover();
		$data['site_title'] = 'Anime Live Chart';
		$this->themes->run('default','home/livechart',$data);
	}


	function cover($value='')
	{
		# code...
		$this->load->model('video_m');
		$video = $this->video_m;
		return $video->displayCoverpage();

	}


}
