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
            <input type="checkbox" value='0' />
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
    <label class="chat-td" data-td="private">USER</label>
    <label class="chat-td is_active" data-td="group">GROUP</label>
  </div>

  <div class="group-message">
    
  </div>
  <div class="group-textarea">
  <form class="form" action="" id="frmgroup" action="groupchat">
    <button class="btn btn-default btn-sm btn-send-off-g" title="Click to cancel"><i class="fa fa-arrow-left"></i></button>
        <textarea placeholder="Type your message" class="form-control" id="grouptextarea"></textarea>
        <button class="btn btn-default btn-sm btn-send-g" title="Click to send"><i class="fa fa-arrow-right"></i></button>
  </form>
  </div>
</div>
</div>




      </div>
  </div>
</div>

<script type="text/javascript">
  
$('#frmgroup').on('submit',function(e){
    var messages = $('#grouptextarea').val();
    
    $('.group-message').append('<p>'+messages+'</p>');
    
    console.log(messages);
    return false;
  });

</script>