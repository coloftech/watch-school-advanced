<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chatigniter chat system</title>

     <!-- Required CSS -->
    <?php $this->load->view('common/css'); ?>
   
</head>
<body>

<!-- Code to Display the chat button -->
<a href="javascript:void(0)" id="menu-toggle" class="btn-chat btn btn-success">
   <i class="fa fa-comments-o fa-3x"></i>
    <span class="badge progress-bar-danger"></span>
</a>

<!--CHAT CONTAINER STARTS HERE-->
<div id="chat-container" class="fixed"></div>

<!-- Header -->
<header id="top" class="header">
    <div class="text-vertical-center"></div>
</header>

<!-- Custom JavaScript Files Included Here -->
<?php $this->load->view('common/javascript'); ?>
    
</body>
</html>