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

	
	public function upload(){
		
		if($this->input->post()) {
			$dir = $this->input->post('type');
			$target_dir = UPLOADPATH."/$dir/";
			$target_file = $target_dir . basename($_FILES["upload"]["name"]);
			//$image_name = basename($_FILES["upload"]["name"]);
			$uploadOk = 1;
			$error = '';

    		$check = getimagesize($_FILES["upload"]["tmp_name"]);

				$image = basename($_FILES["upload"]["name"]);
				$info = pathinfo($image);		
				// get the filename without the extension
				$image_name =  basename($image,'.'.$info['extension']);
				// get the extension without the image name
				$exp = explode('.', $image);
				$ext = end($exp);

    			$image_url = $image_name.'.'.$ext;
    			
		    if($check !== false) {
		        //$error .= "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        $error .= "File is not an image.<br />";
		        $uploadOk = 0;
		    }

			// Check file size
			if ($_FILES["upload"]["size"] > 1500000) {
			    $error .= "Sorry, your file is too large.<br />";
			    $uploadOk = 0;
			}

		    // Check if file already exists
			if (file_exists($target_file)) {
			  
    			$uniqid = uniqid();
    			$target_file = $target_dir.$image_name.'-'.$uniqid.'.'.$ext;
    			$image_url = $image_name.'-'.$uniqid.'.'.$ext; 
			}
			if($uploadOk == 0){
				echo json_encode(array('stats'=>false,'msg'=>$error));
			}else{

				 if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
			       
				echo json_encode(array('stats'=>true,'msg'=>site_url('image/r/'.urlencode($image_url))));
			    } else {
			        
				echo json_encode(array('stats'=>false,'msg'=>"Sorry, there was an error uploading your file."));

			    }
			}
		}
	}


	
}