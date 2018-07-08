<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
    class Themes 
    {
        var $ci;
         
        function __construct() 
        {
            $this->ci =& get_instance();
	        $this->ci->load->database();
        }
        function load($tpl_view=false, $body_view = null, $data = null) 
			{
				
				//exit();
				if(empty($tpl_view)) $tpl_view='default';
				$dir = explode('/', $body_view); // check if the body views is inside the subfolder
				$dir_total = count($dir);

		    if ( ! is_null( $body_view ) ) 
		    {
		        if ( file_exists( APPPATH.'views/'.$tpl_view.'/'.$body_view ) ) 
		        {
		            $body_view_path = $tpl_view.'/'.$body_view;
		        }
		        else if ( file_exists( APPPATH.'views/'.$tpl_view.'/'.$body_view.'.php' ) ) 
		        {
		            $body_view_path = $tpl_view.'/'.$body_view.'.php';
		        }
		        else if ( file_exists( APPPATH.'views/'.$body_view ) ) 
		        {
		            $body_view_path = $body_view;
		        }
		        else if ( file_exists( APPPATH.'views/'.$body_view.'.php' ) ) 
		        {
		            $body_view_path = $body_view.'.php';
		        }
		        else if($dir_total > 1) {
					# code...
					$i = 1;
					$folder = '';
					foreach ($dir as $key) {
						# code...
						if ($i<$dir_total) {
									# code...
							$folder .=$key.'/';
								}else{
							$view = $key;
								}
						$i++;		
					}

		            $body_view_path = $folder.$view.'.php';

		        }
		        else

		        {
		        	
		            show_error('Unable to load the requested file: ' . $tpl_name.'/'.$view_name.'.php');
		        }
		         
		        $body = $this->ci->load->view($body_view_path, $data, TRUE);
		         
		        if ( is_null($data) ) 
		        {
		            $data = array('body' => $body);
		        }
		        else if ( is_array($data) )
		        {
		            $data['body'] = $body;
		        }
		        else if ( is_object($data) )
		        {
		            $data->body = $body;
		        }
		    }
     
		    $this->ci->load->view('themes/'.$tpl_view, $data);
			}

	
    }
