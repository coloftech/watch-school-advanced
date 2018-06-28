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
	public function index($value='')
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
		$data['livecharts'] = $this->video->list_chart(1,1);

		$this->load->model('video_model','video');
		$data['livecharts3'] = $this->video->list_chart(3,1);

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


		$data['site_title'] = 'Watch School Advanced';
		$this->themes->run('default','home/new-index',$data);
	}
	public function old_index()
	{
        
		$this->load->model('video_m');
		//$views = $this->video_m->list_most_views();
		$views = $this->video_m->list_new_upload();
		$data['is_countdown'] = true;
		$data['list_mostviews'] = $views;
		$data['livechart'] = $this->cover();
		$data['site_title'] = 'Watch School';
		$this->themes->run('default','home/index',$data);
	}

	public function search($value='')
	{
		# code...
		$data['query'] = $this->input->get('q');
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
