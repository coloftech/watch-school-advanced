<?php 

/**
* 
*/
class Anime extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}
	public function index($value='')
	{
		# code...
		$data['site_title'] = 'Watch School';
		$this->themes->run('default','anime/index.php');
	}
}