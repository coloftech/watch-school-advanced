<?php

/**
* 
*/
class Playlist extends CI_COntroller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model('video_model','video');
	}
	public function index($value='')
	{
		# code...
		exit();
	}
	public function v($detail_id=false)
	{
		# code...
		if($detail_id){

			if($playlist = $this->video->show_playlist($detail_id)){
				//sort($playlist);
				header('Content-Type: application/json');
				echo json_encode(array('success'=>true,'message'=>$playlist));
				exit();
			}


		}
		header('Content-Type: application/json');
		echo json_encode(array('success'=>false,'message'=>$this->noinput()));
		exit();
		
	}

	public function all($type=false,$status=false,$limit=false,$offset=false)
	{
		# code...
		if($type){

			if($playlist = $this->video->listall($type,$status,$limit,$offset)){
				//sort($playlist);
				header('Content-Type: application/json');
				echo json_encode(array('success'=>true,'message'=>$playlist));
				exit();
			}


		}
		header('Content-Type: application/json');
		echo json_encode(array('success'=>false,'message'=>$this->noinput()));
		exit();
		
	}
	public function writejson($value='')
	{
		# code...
		$playlist = $this->video->json_playlist();
		
		header('Content-Type: application/json');
		$json =  json_encode(array('playlist'=>$playlist, JSON_FORCE_OBJECT));
		   if (json_decode($json) != null)
			   {
			     //$file = fopen('episode.json','w+');
			     //fwrite($file, $json);
			     //fclose($file);

				file_put_contents('episode.json', $json);
			   }

	}

	public function noinput($value='')
	{
		# code...
		return "Nothing to do here!";
	}

	public function search($value='')
	{
		# code...
		usleep(5000);
		$response = false;
		$message = $this->noinput();
		if($this->input->post()){
			$q = $this->input->post('q');
			$message = $this->video->search($q);
			if($message){
				$response = true;
				//$message = 'Query found.';
			}else{
				$response = false;
				//$message = 'No query found.';
			}

		}
		//echo json_encode($response);exit();

			echo json_encode(array('success'=>$response,'message'=>$message));
			exit();

	}

}