
<?php $this->load->view('chatschool/assets/css'); ?>
<!-- Code to Display the chat button -->
<a href="javascript:void(0)" id="menu-toggle" class="btn-chat btn btn-success">
   <i class="fa fa-comments-o fa-3x"></i> <span class='t-chat'>Chat</span>
    <span class="badge progress-bar-danger"></span>
</a>

<!--CHAT CONTAINER STARTS HERE-->
<div id="chat-container" class="fixed"></div>

<?php $this->load->view('chatschool/assets/js.php'); ?>