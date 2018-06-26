<!--
| CHAT HEADER SECTION
-->
<style type="text/css">

</style>
<div class="chatschool">
  <div class="panel panel-primary">
    <div class="panel-heading">
       <label class="chat-icon"><i class="fa fa-comment"></i></label> <label class="heading-status">

            <label class="switch">
            <input type="checkbox" value='<?php if (isset($cur_user->online)) {
              echo $cur_user->online;
            }else{echo 0;} ?>' <?php if ($cur_user->online == 0) {
              echo 'checked';
            } ?> />
            <span class="slider"></span>
          </label>
            </label>
     <label class="heading-settings dropdown">
     <a  href="javascript:void(0)" class="btn btn-primary btn-sm "  class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i></a>

    <ul class="dropdown-menu">
        <li class="divider"></li>
        <li>
            <a href="javascript: void(0);" id="edit-profile">
              <span class="pull-left">Profile</span>
              <span class="fa fa-user pull-right"></span>
              <span class="clearfix"></span>
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="javascript: void(0);" id="change-password">
              <span class="pull-left">Change Password</span>
              <span class="fa fa-lock pull-right"></span>
              <span class="clearfix"></span>
            </a>
        </li>
        <li class="divider"></li>
        <li>
            <a href="javascript: void(0);" id="logout">
              <span class="pull-left">Sign Out</span>
              <span class="fa fa-sign-out pull-right"></span>
              <span class="clearfix"></span>
            </a>
        </li>
    </ul>

     </label>
     
     <label class="heading-close"> 
     <a href="javascript:void(0)"  class="btn btn-primary btn-sm chat-form-close"><i class=" fa fa-remove"></i></a>
     </label>
    </div>
      <div class="panel-body " id="chat-container">

<?php $base_url = base_url(); ?>
<!--
| CHAT CONTACTS LIST SECTION
-->
<div class="chat-inner" id="chat-inner" style="position:relative;">
<div class="chat-group">
  <div class="chat-window">
    <label class="chat-td is_active" data-td="private">USER</label>
    <label class="chat-td" data-td="group">GROUP</label>
  </div>

 <?php

 //var_dump($users);
  if (isset($users) && is_array($users)): ?>
     <?php foreach ($users as $user) { 
     // print_r($user);
      if($user->id != $cur_user->id ){ ?> 
    <a href="javascript: void(0)" data-toggle="popover" >
    <div class="contact-wrap">
      <input type="hidden" value="<?php echo $user->id; ?>" name="user_id" />
       <div class="contact-profile-img">
           <div class="profile-img">
            <?php  $avatar = $user->avatar != '' ? $user->avatar : 'no-image.jpg' ; ?>
            <img src="<?php echo $base_url;?>assets/images/thumbs/<?php echo $avatar; ?>" class="img-responsive">
           </div>
       </div>
        <span class="contact-name">
            <small class="user-name"><?php echo ucwords($user->firstname.' '.$user->lastname); ?></small>
            <span class="badge progress-bar-danger" rel="<?php echo $user->id; ?>"><?php echo $user->unread; ?></span>
        </span>
        <span style="display: table-cell;vertical-align: middle;" class="user_status">
            <?php $status = $user->online == 1 ? 'is-online' : 'is-offline'; ?> 
            <span class="user-status <?php echo $status; ?>"></span>
        </span>
    </div>
    </a>
 <?php  }} ?>
 <?php endif ?>
 
</div>
</div>

<!--
| CHAT CONTACT HOVER SECTION
-->

<div class="panel panel-info popover"  id="popover-content">
  <div class="panel-heading"></div>
  <div class="panel-body">
    <div id="contact-image"></div>
    <div class="contact-user-info">
        <div id="contact-user-name"></div>
        <div id="contact-user-status" class="online-status"></div>
    </div>
  </div>
</div>
<!--
| INDIVIDUAL CHAT SECTION
-->

<div id="school-chat-box" class="panel panel-primary min close" >
<div class=" panel-heading school-chat-box-header">
  <label class="actions pull-right">
    
    <a href="javascript: void(0);" class="school-chat-box-min">
        <i class="fa fa-caret-up"></i>
    </a>
    <a href="javascript: void(0);" class="school-chat-box-exit">
       <i class="fa fa-remove"></i>
    </a>
  </label>
    <span class="user-status is-online"></span>
    <span class="display-name"></span>
    <small></small>
</div>

<div class="panel-body school-chat-container">
    <div class="chat-content">
        <input type="hidden" name="chat_buddy_id" id="chat_buddy_id"/>
        <ul class="school-chat-box-body"></ul>
    </div>
    <div class="chat-textarea">
        <form id="sendchat" action="" method="post" style="padding:1px;">
          <span class="pull-right loader-sm hidden"></span>
        <button class="btn btn-default btn-sm btn-send-off" title="Click to cancel"><i class="fa fa-arrow-left"></i></button>
        <textarea placeholder="Type your message" class="form-control" ></textarea>
        <button class="btn btn-default btn-sm btn-send" title="Click to send"><i class="fa fa-arrow-right"></i></button>
        </form>
    </div>
</div>
</div>



      </div>
  </div>
</div>

<script type="text/javascript">
  var is_online = <?php if (isset($cur_user->online)){ echo $cur_user->online;}else{ echo 0;} ?>;
  

</script>