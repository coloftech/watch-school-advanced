<?php
session_start();
error_reporting(0); //Setting this to E_ALL showed that that cause of not redirecting were few blank lines added in some php files.
$db_config_path = '../application/config/database.php';

// Only load the classes in case the user submitted the form
if($_POST) {

	// Load the classes and create the new objects
	require_once('includes/core_class.php');
	require_once('includes/database_class.php');

	$core = new Core();
	$database = new Database();

	// Validate the post data
	if($core->validate_post($_POST) == true)
	{
		// First create the database, then create tables, then write config file
		$db_create = $database->create_database($_POST);

		if($db_create['success'] == false) {
			$message = $core->show_message('error', $db_create['msg']);
		} else if ($database->create_tables($_POST) == false) {
			$message = $core->show_message('error',"The database tables could not be created, please verify your settings.");
		} else if ($core->write_config($_POST) == false) {
			$message = $core->show_message('error',"The database configuration file could not be written, please chmod install/config/database.php file to 777");
		} 
		
		// If no errors, redirect to login page
		if(!isset($message)) {
		  $redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
	      $redir .= "://".$_SERVER['HTTP_HOST'];
	      $redir .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
	      $redir = str_replace('install/','',$redir); 
		  header( 'Location: ' . $redir) ;
		}
	}
	else {
		$message = $core->show_message('error','Not all fields have been filled in correctly. The host, username, database name are required.');
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta content="width=device-width, initial-scale=1" name="viewport"/>
		<script src="assets/js/jquery-1.7.1.min.js"></script>
		<script src="assets/js/jquery.validate.min.js"></script>
		<script src="assets/js/script.js"></script>
		<link href="assets/css/style-1.0.0.css" rel="stylesheet">
		<title>Install | Chat School</title>
	</head>
	<body>
    <?php if(is_writable($db_config_path)){?>
			<div class="chat-blue">
		  
		  <div class="heading"><h1>Chat School Installation</h1></div>
		  
		  <div class="body">
		  	
		  			  <form id="install_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		  <?php 
		  		if(isset($message)) {echo '<p class="alert alert-danger">' . $message . '</p>';}
		  		if(isset($_GET['e'])){
		  			$error = $_GET['e'];
		  			if($error == 'folder'){
		  				echo '<p class="alert alert-danger">Please delete or rename the <b>INSTALL FOLDER</b> to disable the installation script and then <a href="../"> Go to system</a></p>';
		  			}
		  			elseif ($error == 'db') {
		  				echo '<p class="alert alert-danger">The specified database does not exist, please set the correct database in <b> application/config/database.php </b> or run the installer again !!</p>';
		  			}
		  		}
		  ?>
		  <div class="table">
		  	
		  <div class="row">
		  	<div class="col">
		  	<h3>Database Details</h3>
		  	</div>
		  </div>
		  <div class="row">
			  <div class="col">		  	
			  	<label for="hostname">Hostname</label>       
			  </div>
			  <div class="col">
			  	<input type="text" id="hostname" value="<?php echo (isset($_POST['hostname'])) ? $_POST['hostname'] : ''; ?>" class="control" name="hostname" />
			  </div>
		  </div>
		  <div class="row">
			  <div class="col">
			  	
			  	    <label for="database">Database Name</label>
	         
			  </div>
			  <div class="col"><input type="text" id="db_name" value="<?php echo (isset($_POST['db_name'])) ? $_POST['db_name'] : ''; ?>" class="control" name="db_name" />
			  </div>
		  </div>
		  <div class="row">
		  	<div class="col"><label for="username">Database User</label></div>
		  	<div class="col"><input type="text" id="db_user" value="<?php echo (isset($_POST['db_user'])) ? $_POST['db_user'] : ''; ?>" class="control" name="db_user" /></div>
         
		  </div>
		  <diw class="row">
		  	 <div class="col"><label for="password">Database Password</label></div>
		  	 <div class="col"><input type="password" id="db_password" class="control" name="db_password" /></div>
		   
		  </diw>
		  <div class="row">
		  	<div class="col">
		  		<span class="span-x">&nbsp;</span>
		  	</div>
		  	<div class="col">
		  		
          		<input type="submit" value="Install" class="button" id="submit"/>
		  	</div>
		  </div>
		  </div>
          <div class="clr"></div>
		  </form> 	 
		  </div>
		  </div>


	  <?php } else { ?>

			<div class="chat-blue">
		  
		  <div class="heading"><h1>Alert warning</h1></div>
		  
		  <div class="body">
 		<p class="alert alert-danger">Please make the application/config/database.php file writable. <strong>Example</strong>:<br /><br /><code>chmod 777 application/config/database.php</code></p>
		  </div>
		  </div>
     
	  <?php } ?>	  
	</body>
</html>