<html>
<head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=isset($site_title) ? $site_title : 'Watch School 2018 App' ?></title>
	<link rel="icon" href="<?=base_url();?>public/images/w-icon-1.png"  sizes="35x35"/>
   <meta property="og:url"           content="<?=isset($link) ? $link : site_url();?>" />
  <meta property="og:type"          content="article" />
  <meta property="og:locale"          content="en_US" />
  <meta property="og:title"         content="<?=isset($meta_title) ?strip_tags($meta_title) : 'Watch School Advanced by Coloftech'; ?>" />
  <meta property="og:description"   content="<?=isset($description) ? strip_tags($description) : 'Watch School Advanced by Coloftech - watch anime, anime live movies, full movies, korean dramas web epsiodes or asian dramas web epsiodes.'; ?>" />
  <meta property="og:image"         content="<?=isset($featured_image) ? $featured_image : base_url('public/images/default-img.png'); ?>" />
  <meta property="fb:app_id" content="908155116011125" />
  <meta name="keywords" content="<?=isset($keywords) ? 'watch school xyz, anime xyz, watch anime xyz, watch school, watchschool, watchschool 2018, watch anime 2018, watch free anime, what anime, whats cool, free anime, watch anime online, no ads anime, best anime, gogoanime, funimation 2018, soul-anime, anisubbed, '.$keywords.' ,winter anime 2018, spring anime 2018, summer anime 2018, anime live chart, anime countdown, anime counter' : 'watch school xyz, anime live chart, anime countdown, anime counter, anime xyz, watch anime xyz, watch school, watchschool, watchschool 2018, watch anime 2018, watch free anime, what anime, whats cool, free anime, watch anime online, no ads anime, best anime, gogoanime, funimation 2018, soul-anime, anisubbed, coloftech, Watch Anime by Coloftech - watch anime, anime live movies, full movies, korean dramas web epsiodes or asian dramas web epsiodes.,winter anime 2018, spring anime 2018, summer anime 2018';?>  " />

  <meta name="propeller" content="25ea6375b227314f8b736b7ecb49a535">
  <meta name='dailymotion-domain-verification' content='dmzehbpd69cnjdbdc' />


	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>public/css/watch.css">

	<script type="text/javascript"	src="<?=base_url()?>public/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript"	src="<?=base_url()?>public/js/bootstrap.min.js"></script>


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

<body>
<header>
	<div class="navbar navbar-default navbar-fixed-top">
   <div class="container">
      <div class="navbar-header">
         <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         </button>
         <a class="navbar-brand hidden-xs" href="<?=site_url()?>"><img src="<?=base_url()?>public/images/w-icon-1.png" alt="W" style="display:inline-block;margin-top:-10px;margin-left:-10px;"> WATCHSCHOOL</a>
         <a class="navbar-brand visible-xs" href="<?=site_url()?>"><img src="<?=base_url()?>public/images/w-icon-1.png" alt="W" style="display:inline-block;margin-top:-10px;margin-left:-10px;"></a>
         <form class="navbar-form pull-left" role="search">
            <div class="input-group">
               <input type="text" class="form-control" placeholder="Search">
               <div id="search-output">
                <ul id="listhere"></ul>
              </div>
               <div class="input-group-btn">
                  <button type="submit" class="btn btn-default" style="padding:9px;background-color:yellow;border-radius:0;border-color:yellow;"><span class="fa fa-search"></span></button>
               </div>
               <div class="form-group">
              
              </div>
            </div>
         </form>
      </div>
      <div class="navbar-collapse collapse">
         <ul class="nav navbar-nav navbar-right">
            <li class="<?php if(isset($menu)) {if($menu== 'home') echo 'active';} ?>"><a href="<?=site_url()?>">HOME</a></li>
            <li class="<?php if(isset($menu)) {if($menu== 'series') echo 'active';} ?>"><a href="<?=site_url('watch/playlist')?>">PLAYLIST</a></li>
            <li class="<?php if(isset($menu)) {if($menu== 'recents') echo 'active';} ?>"><a href="<?=site_url('watch/recents')?>">RECENTS</a></li>
            <li class="<?php if(isset($menu)) {if($menu== 'completed') echo 'active';} ?>"><a href="<?=site_url('watch/completed')?>">COMPLETED</a></li>
            <li class="hidden"><a href="<?=site_url('watch/videos')?>">V-LIBRARY</a></li>
         </ul>
      </div>
      <!--/.navbar-collapse -->
   </div>
</div>
</header>
<div class="container">
	
<?php echo $body; ?>
</div>


<script type="text/javascript">
  var base_url = '<?=base_url()?>';
</script>
<script type="text/javascript" src="<?=base_url('public/js/watch.js');?>"></script>
<script type="text/javascript" src="<?=base_url('public/plugin/jquery.countdown-2.2.0/jquery.countdown.min.js');?>"></script>

  <?php 

            $currentD = date('Y/m/d');
            $currentT = date('H:i:s');
$time = date('H');
$m = date('i');
$ads = '<script type="text/javascript" src="//go.oclasrv.com/apu.php?zoneid=1734346"></script><br>Ads is active';
$noads = '';

$active_ads = isset($_SESSION['ads']) ? $_SESSION['ads'] : false;
$ads_counter = isset($_SESSION['ads_counter']) ? $_SESSION['ads_counter'] : false;
if (!$active_ads) {
  # code...
    echo $ads;
    $_SESSION['ads'] =  true;
    $_SESSION['ads_counter'] = 1;
}elseif($ads_counter == 1){

   // echo $ads;
    $_SESSION['ads_counter'] = false;
}

$rand = rand(0,23);
if($rand === $time){
    echo $ads;
}
?>
<?php if (isset($is_countdown)): ?>
  <?php if ($is_countdown == true): ?>
  
  <script src="<?=base_url('assets/js/plugin/jquery.countdown-2.2.0/jquery.countdown.min.js')?>" type="text/javascript"></script>

<script type="text/javascript">

  $(function(){


                $('.countdown').each(function(){

          var timer = $(this).text();
          $(this).countdown(timer, function(event) {
            $(this).text(
              event.strftime('%D days %H:%M:%S')
            );
          });
        });

           
});


</script>
<?php endif ?>
<?php endif ?>

</body>
</html>