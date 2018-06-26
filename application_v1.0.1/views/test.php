<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

<meta content="width=device-width, initial-scale=1" name="viewport"/>
</head>
<body>
<div class="col-lg-12 col-md-12 col-sm-12">
	
<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/welcome_message.php</code>

		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/Welcome.php</code>

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

<?php $this->load->view('chatschool/assets/css'); ?>


	<!-- Code to Display the chat button -->
<a href="javascript:void(0)" id="menu-toggle" class="btn-chat btn btn-success">
   <i class="fa fa-comments-o fa-3x"></i> <span class='t-chat'>Chat</span>
    <span class="badge progress-bar-danger"></span>
</a>

<!--CHAT CONTAINER STARTS HERE-->
<div id="chatcontainer" class="device-pc fixed"></div>
</div>
<?php $this->load->view('chatschool/assets/js.php'); ?>
</div>
</body>
</html>