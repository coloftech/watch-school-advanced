<?php 

/**
* 
*/
class Auth
{
	
        var $ci;
         
        function __construct() 
        {
            $this->ci =& get_instance();
        }
		# code...
		public function is_loggedIn($user=false)
		{
			# code...
			$data = $this->ci->session->userdata;
		    if(empty($data)){
		        return false;
		    }else{
		    	return true;
		    }
		}

		public function user_data()
		{
			# code...

				$data = $this->ci->session->userdata;
				if(empty($data)){
					return false;
				}else{
					return $data;
				}
		}
	
		public function role_no()
		{
			# code...

				$data = $this->ci->session->userdata;
				if(empty($data)){
					return 0;
				}else{
					return $data['role'];
				}
		}
	
		public function is_admin($user=false)
		{
			# code...
			$data = $this->ci->session->userdata;
		    if(empty($data)){
		        return false;
		    }else{
		    	
	   			$role_level = $this->role_level($this->role_no());
	   			if($role_level == 'is_admin'){
	   				return true;
	   			}else{
	   				return false;
	   			}
		    }
		}
		
	
		public function role_level($role=0)
		{
			# code...
			if($role == 1)
	            {
	                $userLevel = 'is_admin';
	            }
	            elseif($role == 2)
	            {
	                $userLevel = 'is_author';
	            }
	            elseif($role == 3)
	            {
	                $userLevel = 'is_editor';
	            }
	            elseif($role == 4)
	            {
	                $userLevel = 'is_subscriber';
	            }
	            else{
	            	$userLevel = 'is_guest';
	            }
	            return $userLevel;
		}
	
}
