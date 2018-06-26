<!DOCTYPE html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta content="width=device-width, initial-scale=1" name="viewport"/>
	<title><?=isset($site_title) ? $site_title : 'Watch School'?></title>
  <meta property="og:url"           content="<?=isset($link) ? $link : site_url();?>" />
  <meta property="og:type"          content="article" />
  <meta property="og:locale"          content="en_US" />
  <meta property="og:title"         content="<?=isset($meta_title) ?strip_tags($meta_title) : 'WatchSchool XYZ by Coloftech'; ?>" />
  <meta property="og:description"   content="<?=isset($description) ? strip_tags($description) : 'WatchSchool XYZ by Coloftech - watch anime, anime live movies, full movies, korean dramas web epsiodes or asian dramas web epsiodes.'; ?>" />
  <meta property="og:image"         content="<?=isset($featured_image) ? $featured_image : base_url('public/images/default-img.png'); ?>" />
  <meta property="fb:app_id" content="908155116011125" />
  <meta name="propeller" content="25ea6375b227314f8b736b7ecb49a535">

<link rel="icon" href="<?=base_url();?>assets/images/icon-35.png"  sizes="35x35"/>
<link rel="icon" href="<?=base_url();?>assets/images/icon-16.png"  sizes="16x16"/>
	<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css">
<!-- Custom CSS -->
<!--
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-yNuQMX46Gcak2eQsUzmBYgJ3eBeWYNKhnjyiBqLd1vvtE9kuMtgw6bjwN8J0JauQ" crossorigin="anonymous">
-->
<?php $this->minify->css(array('default.css','anime-v1.0.2.css'));
echo $this->minify->deploy_css(); ?>
<!-- -->
<script src="<?=base_url('assets/js/jquery-1.11.0.min.js')?>" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

<!-- -->

<!-- -/->
<script
  src="https://code.jquery.com/jquery-1.11.1.min.js"
  integrity="sha256-VAvG3sHdS5LqTT+5A/aeq/bZGa/Uj04xKxY8KM/w9EE="
  crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- -->
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

<nav class="navbar navbar-default watchschool-navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-portal" aria-expanded="false"> <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>

      </button><a class="navbar-brand" href="<?=site_url();?>"><i class="fa fa-institution"></i> <span class="hidden-xs">WATCHSCHOOL</span></a>

      <form class="formSearch" role="search" action="<?=site_url('home/search');?>" autocomplete="off">
        <div class="inner-addon left-addon"> <button class="btn"><span class="fa fa-search"></span></button>

          <input type="search" class="form-control" placeholder="Search" id="defaultq" name="q">
            <div class="form-group">
              <div id="search-output">
                <ul id="listhere"></ul>
              </div>
            </div>
        </div>
      </form>
    </div>
    <div class="collapse navbar-collapse" id="nav-portal">
      
                        <ul class="nav navbar-nav navbar-right" style="margin-right:10px;">

                          <li class="home-menu hidden"> <a href="<?php echo site_url(); ?>">Home</a></li>
                          <li class="home-menu hidden"> <a href="<?php echo site_url('livechart'); ?>">Live Chart</a></li>
                          <li class="newvideos-menu"> <a href="<?php echo site_url('watch'); ?>">Playlist</a></li>
                          <li class="anime-menu"> <a href="<?php echo site_url('watch/recents'); ?>">Recent release</a></li>
                          <li class="anime-menu"> <a href="<?php echo site_url('watch/newvideo'); ?>">Video library</a></li>
                          <li class="movies-menu hidden"> <a href="<?php echo site_url('watch/movies'); ?>">Movies</a></li>
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
<script type="text/javascript">
    $('.cover-contents').on('click',function(){
	var slug = $(this).data('slug');
	window.location = '<?php echo site_url("watch/v/'+slug+'")?>';
})





$('#defaultq').on('keyup',function(){
  var q = $(this).val();
  if(q.length < 2){
    return false;
  }

  $('#listhere').html('');
  $.ajax({
    data: 'q='+q,
    type: 'post',
    dataType: 'json',
    url:'<?php echo site_url("playlist/search");?>',
    
    success: function(response){
      console.clear();
      console.log(response);
      if(response.success == true){

          $.each(response.message, function(k, v) {
            
            var surl = '<?php echo site_url("watch/v/'+v.slug+'");?>';
            $('#listhere').append('<li onclick="addtolist('+v.video_id+','+v.episode_number+','+'\''+v.title+'\''+')"><a href="'+surl+'">'+v.title+'</a></li>');
        
          });

    }else{
      $('#listhere').html('<li>No reponse.</li>');
    }


    },
        error: function(xhr, status, error) {
          //var err = eval("(" + xhr.responseText + ")");
          console.log(xhr.responseText);

        }
  });
});

</script>
<!-- <script src="//basepush.com/ntfc.php?p=1734261" data-cfasync="false" async></script> -/->
<script src="//pushance.com/ntfc.php?p=1734265&tco=1" data-cfasync="false" async></script>

<!-- -->
</body>
</html>