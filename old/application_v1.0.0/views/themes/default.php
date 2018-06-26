<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<title><?=isset($site_title) ? $site_title : 'Watch School'?></title>


<link rel="icon" href="<?=base_url();?>assets/images/icon-35.png"  sizes="35x35"/>
<link rel="icon" href="<?=base_url();?>assets/images/icon-16.png"  sizes="16x16"/>
	<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
<!-- Custom CSS -->
<?php $this->minify->css(array('default.css','video.css','anime.css'));
echo $this->minify->deploy_css(); ?>

<script src="<?=base_url('assets/js/jquery-1.11.0.min.js')?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>


</head>
<body>

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

                          <li class="home-menu"> <a href="<?php echo site_url(); ?>">Home</a></li>
                          <li class="home-menu hidden"> <a href="<?php echo site_url('livechart'); ?>">Live Chart</a></li>
                          <li class="newvideos-menu"> <a href="<?php echo site_url('watch/new_upload'); ?>">Latest</a></li>
                          <li class="anime-menu"> <a href="<?php echo site_url('watch/anime'); ?>">Anime</a></li>
                          <li class="movies-menu"> <a href="<?php echo site_url('watch/movies'); ?>">Movies</a></li>
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
</div>
<div class="container">
  
<?php echo $body ?>
</div>
</body>
</html>