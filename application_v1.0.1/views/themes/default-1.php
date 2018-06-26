<!DOCTYPE html>
<html>
<head>
	<title><?=isset($site_title) ? $site_title : 'Watch School'?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

  <meta property="og:url"           content="<?=isset($link) ? $link : site_url();?>" />
  <meta property="og:type"          content="article" />
  <meta property="og:locale"          content="en_US" />
  <meta property="og:title"         content="<?=isset($meta_title) ? $meta_title : 'WatchSchool XYZ by Coloftech'; ?>" />
  <meta property="og:description"   content="<?=isset($description) ? $description : 'WatchSchool XYZ by Coloftech - watch anime, anime live movies, full movies, korean dramas web epsiodes or asian dramas web epsiodes.'; ?>" />
  <meta property="og:image"         content="<?=isset($featured_image) ? $featured_image : base_url('public/images/default-img.png'); ?>" />
  <meta property="fb:app_id" content="908155116011125" />
<?php
if(isset($description)){
    
}else{
?>
<meta name="author" content="Harold Rita" />
<?php
}
?>
<meta name="keywords" content="<?=isset($keywords) ? $keywords : 'coloftech, harold rita, Watch Anime by Coloftech - watch anime, anime live movies, full movies, korean dramas web epsiodes or asian dramas web epsiodes.';?>  " />
<meta name="propeller" content="25ea6375b227314f8b736b7ecb49a535">
        <link rel="icon" href="<?=base_url();?>assets/images/icon-35.png"  sizes="35x35"/>
        <link rel="icon" href="<?=base_url();?>assets/images/icon-16.png"  sizes="16x16"/>
	<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">

<script src="<?=base_url('assets/js/jquery-1.11.0.min.js')?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<!-- Custom CSS -->
<?php $this->minify->css(array('chat-school-min-1.0.0.css','default.css','anime-1.css','video.css'));
echo $this->minify->deploy_css(); ?>

    <?php if (isset($fbshare)): ?>
       
<script> 
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId=908155116011125&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>
      <?php endif ?>

</head>
<body class="watchschool">


<!-- Header -->
<header id="top" class="header">
    <div class="text-vertical-center">
      

<style type="text/css">
  
</style>
<div class="container">
<nav class="navbar navbar-default watchschool-navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-portal" aria-expanded="false"> <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>

      </button><a class="navbar-brand" href="<?=site_url();?>"><i class="fa fa-institution"></i> <span class="hidden-xs">WATCHSCHOOL</span></a>

      <form class="formSearch" role="search" action="<?=site_url('home/search');?>">
        <div class="inner-addon left-addon"> <button class="btn"><span class="fa fa-search"></span></button>

          <input type="text" class="form-control" placeholder="Search" id="navbarSearchQuery" name="q">
        </div>
      </form>
    </div>
    <div class="collapse navbar-collapse" id="nav-portal">
      
                        <ul class="nav navbar-nav navbar-right" style="margin-right:10px;">

                          <li class="home"> <a href="<?php echo site_url(); ?>">Home</a></li>
                          <li class="home hidden"> <a href="<?php echo site_url('livechart'); ?>">Live Chart</a></li>
                          <li class="newvideos"> <a href="<?php echo site_url('watch/new_upload'); ?>">Latest</a></li>
                          <li class="anime"> <a href="<?php echo site_url('watch/anime'); ?>">Anime</a></li>
                          <li class="movies"> <a href="<?php echo site_url('watch/movies'); ?>">Movies</a></li>
                                        <?php 

                    if($this->authentication->is_loggedin()){
                      

                    $id = $this->authentication->read('identifier');
                    //echo "$id";
                    if($id == 1){
                      echo "<li class=\"home\"> <a href=\"".site_url('watchschool_anime_admin_home')."\">Administrator</a></li>";
                    }
                    }

                 ?>
                     
                        </ul>
    </div>
    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>
<div class="container-fluid">
<?php echo $body; ?>
</div>
<!-- Code to Display the chat button -/->
<a href="javascript:void(0)" id="chat-toggle" class="btn-chat btn  fixed-bottom pull-right">
   <i class="fa fa-comments-o fa-3x"></i> <span class="t-chat">Chat</span>
    <span class="badge progress-bar-danger"></span>
</a>

<!--CHAT CONTAINER STARTS HERE-/->
<div id="chatcontainer" class="device-pc fixed"></div>

<!--/-->

    </div>

</header>
</div>

<?php /* if (isset($is_countdown)): ?>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/plugin/jquery.countdown-2.2.0/jquery.countdown.js"></script>
<script type="text/javascript">
  $(function(){
  $('.countdown').each(function(){
    $(this).countdown($(this).attr('value'), function(event) {
      var ed = event.strftime('%d');
        var DH = '';
        if(ed < 1){

            DH = event.strftime('%H:%M:%S')
          }else{
        
            DH = event.strftime('%d days %H:%M:%S')
         }
      $(this).text(DH);
    });
  });

  });


</script>
<?php endif */ ?>


</script>
</body>
</html>