<?php 

/**
* 
*/
class Chat extends CI_Controller
{
	private $user_id = 0;
	protected $smiley_url = 'assets/images/smileys';
	function __construct()
	{
		# code...
		parent::__construct();
		if(!$this->authentication->is_loggedin()){
			redirect('auth');
		}
		$this->load->model('chat_m');
		$this->load->model('user_model', 'user');
		$this->load->model('message_model', 'message');
		$this->load->model('lastmsg_model', 'last');
		$this->load->helper('smiley');

	}
	public function index($value='')
	{
		# code...
	}

	public function messages(){
		/*$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
		$txt =json_encode($this->input->post('user'))."\n";
		fwrite($myfile, $txt);
		fclose($myfile);
		*/
		/*
		$per_page = 5;
		$buddy 		= $this->input->post('user');
		$limit 		= isset($_POST['limit']) ? $this->input->post('limit') : $per_page ;
		*/

		$per_page = 5;
		$user 		= $this->authentication->read('identifier');
		$buddy 		= $this->input->post('user');
		//$buddy = 2;
		$limit 		= isset($_POST['limit']) ? $this->input->post('limit') : $per_page ;

		$messages 	= array_reverse($this->message->conversation($user, $buddy, $limit));
		$total 		= $this->message->thread_len($user, $buddy);

		$thread = array();
		foreach ($messages as $message) {
			$owner = $this->user->get($message->from);
			$chat = array(
				'msg' 		=> $message->id,
				'sender' 	=> $message->from, 
				'recipient' => $message->to,
				'avatar' 	=> $owner->avatar != '' ? $owner->avatar : 'no-image.jpg',
				'body' 		=> parse_smileys($message->message, $this->smiley_url),
				'time' 		=> date("M j, Y, g:i a", strtotime($message->time)),
				'type'		=> $message->from == $user ? 'out' : 'in',
				'name'		=> $message->from == $user ? 'You' : ucwords($owner->firstname)
				);
			array_push($thread, $chat);
		}

		$chatbuddy = $this->user->get($buddy);

		$contact = array(
			'name'=>ucwords($chatbuddy->firstname.' '.$chatbuddy->lastname),
			'status'=>$chatbuddy->online,
			'id'=>$chatbuddy->id,
			'limit'=>$limit + $per_page,
			'more' => $total  <= $limit ? false : true, 
			'scroll'=> $limit > $per_page  ?  false : true,
			'remaining'=> $total - $limit
			);


		$response = array(
					'success' => true,
					'errors'  => '',
					'message' => '',
					'buddy'	  => $contact,
					'thread'  => $thread
					);
		//add the header here
		header('Content-Type: application/json');
		echo json_encode( $response );

		
	}
	public function save_message(){
		
		$logged_user = $this->authentication->read('identifier');
		$buddy 		= $this->input->post('user');
		$message 	= $this->input->post('message');
		if($message != '' && $buddy != '')
		{
			$msg_id = $this->message->insert(array(
						'from' 		=> $logged_user,
						'to' 		=> $buddy,
						'message' 	=> $message,
						'message' 	=> $message,
					));
			$msg = $this->message->get($msg_id);

			$owner = $this->user->get($msg->from);


		
			$chat = array(
				'msg' 		=> $msg->id,
				'sender' 	=> $msg->from, 
				'recipient' => $msg->to,
				'avatar' 	=> $owner->avatar != '' ? $owner->avatar : 'no-image.jpg',
				'body' 		=> parse_smileys($msg->message, $this->smiley_url),
				'time' 		=> date("M j, Y, g:i a", strtotime($msg->time)),
				'type'		=> $msg->from == $logged_user ? 'out' : 'in',
				'name'		=> $msg->from == $logged_user ? 'You' : ucwords($owner->firstname)
				);

			$response = array(
				'success' => true,
				'message' => $chat 	  
				);

		/*
		$myfile = fopen("file.txt", "w") or die("Unable to open file!");
		$txt =json_encode($response);
		fwrite($myfile, $txt);
		fclose($myfile);
		*/
		}
		else{
			  $response = array(
				'success' => false,
				'message' => 'Empty fields exists'
				);
		}
		//add the header here
		header('Content-Type: application/json');
		echo json_encode( $response );
	}

	

	public function updates(){
	    $new_exists = false;
		$user_id 	= $this->authentication->read('identifier');
		$last_seen  = $this->last->get_by('user_id', $user_id);
		$last_seen  = empty($last_seen) ? 0 : $last_seen->message_id;
		$exists = $this->message->latest_message($user_id, $last_seen);
		//echo $exists;
		if($exists){
			$new_exists = true;
		}
		// THIS WHOLE SECTION NEED A GOOD OVERHAUL TO CHANGE THE FUNCTIONALITY
	    if ($new_exists) {
	        $new_messages = $this->message->unread($user_id);
			$thread = array();
			$senders = array();
			foreach ($new_messages as $message) {
				if(!isset($senders[$message->from])){
					$senders[$message->from]['count'] = 1; 
				}
				else{
					$senders[$message->from]['count'] += 1; 
				}
				$owner = $this->user->get($message->from);
				$chat = array(
					'msg' 		=> $message->id,
					'sender' 	=> $message->from, 
					'recipient' => $message->to,
					'avatar' 	=> $owner->avatar != '' ? $owner->avatar : 'no-image.jpg',
					'body' 		=> parse_smileys($message->message, $this->smiley_url),
					'time' 		=> date("M j, Y, g:i a", strtotime($message->time)),
					'type'		=> $message->from == $user_id ? 'out' : 'in',
					'name'		=> $message->from == $user_id ? 'You' : ucwords($owner->firstname)
					);
				array_push($thread, $chat);
			}

			$groups = array();
			foreach ($senders as $key=>$sender) {
				$sender = array('user'=> $key, 'count'=>$sender['count']);
				array_push($groups, $sender);
			}
			// END OF THE SECTION THAT NEEDS OVERHAUL DESIGN
			$this->last->update_lastSeen($user_id);

			$response = array(
				'success' => true,
				'messages' => $thread,
				'senders' =>$groups
			);

			//add the header here
			header('Content-Type: application/json');
			echo json_encode( $response );
	    } 
	}
	public function mark_read(){
		$this->message->mark_read();
	}
}