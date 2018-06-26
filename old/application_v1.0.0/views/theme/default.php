<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($site_title) ? $site_title : 'COLOFTECH' ;?></title>
  <noscript>
  <meta http-equiv="refresh" content="0.0;url=nojs/index.php">
</noscript>
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
        <link rel="shortcut icon" href="<?=base_url();?>public/images/logo-only-icon.png"/>


        <link href="<?=base_url('public/assets/bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
        <link href="<?=base_url('public/assets/bootstrap');?>/css/font-awesome.css" rel="stylesheet">
        <link href="<?=base_url('public/assets/css/animate.css');?>" rel="stylesheet">

       

        <?php // add css files
        $this->minify->css(array('default-2.css','anime.css'));
        echo $this->minify->deploy_css();
        ?>


 <!-- CORE PLUGINS -->

        <?php // echo Minifier::minify('public/assets/js/jquery-1.11.0.min.js'); ?>
        <script src="<?=base_url('public/assets/js/jquery-1.11.0.min.js')?>" type="text/javascript"></script>
        <script src="<?=base_url('public/assets/bootstrap/js/bootstrap.min.js')?>" type="text/javascript"></script>
          <?php /*   

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
     (adsbygoogle = window.adsbygoogle || []).push({
          google_ad_client: "ca-pub-8571573304867694",
          enable_page_level_ads: true
     });
</script>

*/ ?>

</head>
<body class="site">

  <!--

<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-4992069019327122",
    enable_page_level_ads: true
  });
</script>

-->
<header class="wrapper navbar-fixed-top" >
    <div class="container" >
        

        <div class="logo"><a href="<?=site_url();?>" style="color:#fff;font-size:35px"><i class="fa fa-institution"></i></div></a>
        <div class="title"><a href="<?=site_url();?>"><h1 style="display:inline-block;color:#fff;"><span style='margin-top:-15px;position:absolute;font-size:28px;'>WatchSchool<span style="display:inline-block;font-size:18px;">.xyz</span></span><span style='font-size:10px;display: block;margin-top:12px;'>Coloftech - State of the Arts &amp; Technology</span></span></h1></a></div>
    </div>
    <div class="container">
        <?php include 'common/default_menu.php';?>
    </div>
</header>

<div class="site-body" >
  <div class="wrapper site-wrapper">
  <div class="container site-container">
    <?php echo $body; ?>

  </div>
  </div>
</div>

<div class="move-top">&nbsp;<a href="javascript:void(0)"  onclick="move_top()" class="btn btn-info" id="movetotop" style="display: none;"><i class="fa fa-angle-double-up"></i>Top</a></div>
<footer class="footer ">
    <div class="container">
    
     <div class="footer-bottom" style="height:10px;padding:5px;">
         <ul style="list-style:none;">
              <li><a href="<?=site_url()?>/home/policy">Private Policy & Disclaimer</a></li>
            </ul> 
     </div> 

    </div>
</footer>

        <script src="<?=base_url('public/assets/js/jquery-migrate.min.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('public/assets/js/notify/dist/notify.js');?>" type="text/javascript"></script>
        <script src="<?=base_url('public/assets/js/col-script.js');?>" type="text/javascript"></script>
      
     <?php if (isset($fbshare)): ?>
        <script src="<?=base_url('public/assets/plugin/jquery.countdown-2.2.0/jquery.countdown.min.js')?>" type="text/javascript"></script>

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

      <?php echo isset($js_script) ? $js_script : '';?>
<script>

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("movetotop").style.display = "block";
    } else {
        document.getElementById("movetotop").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function move_top() {
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
}

(function($) {
    var $window = $(window),
        $footer = $('.footer');
        $custom_div = $('.result-controls')
        $watch = $('.watch')

    function resize() {
        if ($window.width() > 768) {
            $custom_div.removeClass('col-md-4-c');
            $custom_div.addClass('col-md-4');
            $watch.removeClass('watch-mobile');
            $watch.addClass('watch-pc');
            return;// $footer.addClass('navbar-fixed-bottom');

        }

        $custom_div.addClass('col-md-4-c');
        $custom_div.removeClass('col-md-4');
        //$footer.removeClass('navbar-fixed-bottom');

            $watch.removeClass('watch-pc');
            $watch.addClass('watch-mobile');

    }

    $window
        .resize(resize)
        .trigger('resize');
})(jQuery);
</script>
<script src="//basepush.com/ntfc.php?p=1734261" data-cfasync="false" async></script>
<script src="//pushance.com/ntfc.php?p=1734265&tco=1" data-cfasync="false" async></script>
</body>
</html>
