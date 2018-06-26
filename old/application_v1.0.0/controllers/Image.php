<?php 

/**
* 
*/
class Image extends CI_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
	}
	public function r($image=false)
	{
		# code...
		if($image){
		    $image = urldecode($image);
			echo $this->showimage($image);
		}else{
			echo $this->showimage('default-img.jpg');
		}
	}
	public function showimage($image='')
	{
		# code...
		//$image="path-to-your-image"; //this can also be a url
		$filepath = UPLOADPATH.'images/'.$image;
		if(!file_exists($filepath)){
		    $filepath = UPLOADPATH.'uploads/'.$image;
		    if(!file_exists($filepath)){
		        
			$filepath = UPLOADPATH.'images/default-img.jpg';
		    }
		}
		$ctype = mime_content_type($filepath);
		

		header('Content-type: ' . $ctype);
		$image = file_get_contents($filepath);
		return $image;
	}
	
}