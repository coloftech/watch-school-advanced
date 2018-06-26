<div class="anime">
	<div class="anime-body">
		<div class="heading heading-default"><h4><span style="background-color:#000;color:#fff;padding:3px;display:inline-block;" class="item-4 item-4-xs">YOU'RE WATCHING</span> <span class="item-2 item-2-xs" style="display:inline-block;"><?php if(isset($video->title)) echo $video->title; ?></span></h4>  
		<?php if (isset($detail_cover_title)): ?>
			<label><a href="<?=site_url("watch/c/$detail_cover_slug")?>"><?=$detail_cover_title?> Info</a></label>
		<?php endif ?>
		<div class="fb-share-button" 
    data-href="<?=$link;?>" 
    data-layout="button_count">
  </div></div>
	
	<style type="text/css">
	.mirrors{
		display: block;
	}
	.mirrors .table-mirror tr td{
		color: #000;
		text-transform: uppercase;
	}

	.mirrors .table-mirror tr td.mirror-note{
		
	}
	.mirrors .table-mirror tr td.mirror-url{
		background-color: rgba(0,0,250,0.3);
		font-weight: bold;
	}
	.mirrors .table-mirror tr td.mirror-url:hover{
		background-color: #e5e5e5;
		color: #555555;
		cursor: pointer;
	}
	.post-index{
		min-width: 350px;
	}
	.embed-responsive{
	    border:solid 2px #000;
	}
	/*----------------controls--------------------*/

	.video{}
	.video-controls{
		display: block;
		background-color: #000;
		min-height:50px;
		padding: 5px;
		color: #fff;
		vertical-align: text-top;
		overflow: hidden;
	}
	.video-controls > .video-title{
		display: inline-block;
		font-size: 14px;
		color: #fff;
		width: 48%;
		vertical-align: text-top;
		overflow: hidden;
	}
	.video-controls > .video-episode{
		display: inline-block;
		text-align: center;
		width: 30%;
		vertical-align: text-top;
	}
	.video-controls > .video-episode > .video-previus{
		display: inline-block;
		width: 48%;
		vertical-align: text-top;
		padding: 5px;
	}

	.video-controls > .video-episode > .video-next{
		display: inline-block;
		width: 48%;
		vertical-align: text-top;
		padding: 5px;
	}
	.video-controls > .video-episode > .video-previus.ok,
	.video-controls > .video-episode > .video-next.ok{

	}

	.video-controls > .video-episode > .video-previus.no,
	.video-controls > .video-episode > .video-next.no{
		color: #e5e5e5;
	}
	.video-controls > .video-error{
		display: inline-block;
		width: 20%;
		vertical-align: text-top;
		text-align: center;
		color: red;
		padding: 5px;
	}
	.video-controls > .video-episode > .video-previus.ok:hover,
	.video-controls > .video-episode > .video-next.ok:hover,
	.video-controls > .video-error.ok:hover{
		cursor: pointer;
		background-color: rgba(250,250,250,0.5);
	}
	@media only screen and (max-width: 768px){
	.anime-title{}
	.video-controls > .video-title{font-size: 12px;}
	.video-controls > .video-title,
	.video-controls > .video-episode,
	.video-controls > .video-episode,
	.video-controls > .video-error{
		display: block;
		width: 100%;
		text-align: left;
	}

	
	}

/*--------------------end controls-------------------------*/
	</style>	 

<?php if(isset($video) && isset($video->title)): ?>

<div class="panel">
	<div class="panel-body">

	<div class="mirrors" style="margin-top:-20px;">
		<table class="table table-hovered table-mirror">
		    
			<tr>
			<td class="mirror-note">MIRROR </td>
			<td class="mirror-url" data-mirror='<?=$video->slug?>'><?php echo $this->auto_m->mirror($video->source_id); ?></td>
					<?php if (isset($mirrors)): ?>

						<?php if (is_array($mirrors)): ?>
							<?php foreach ($mirrors as $m): ?>
								<?php 
									$mirror = $m->source_id;
									$m_name = $this->auto_m->mirror($mirror);
								 ?>
					<td class="mirror-url" data-mirror='<?=$video->slug?>?mirror=<?=$m->source_id?>'><?=$m_name?></td>
							<?php endforeach ?>
						<?php endif ?>
					<?php endif ?>
			</tr>
		</table>
		
	</div>	
	<script type="text/javascript">
	$(document).on('click','.mirror-url',function(e){
		var url = $(this).data('mirror');
		//console.log(url);
		window.location = '<?php echo site_url("watch/v/'+url+'");?>';
	});
	</script>
	<div class="video-content" style="display:block;">
		
		
    <?php if ($video->source_id == 9): ?>
    
    <?php 
    $url = $video->link;

    $parts = parse_url($url);
    $output = [];
    parse_str($parts['query'], $output);
    $exp = $output['e'];

    $current = time();

    if($exp	< $current){
    	
    $exp = time() + 60*60*2;
    }
    
    $video_url = $parts['scheme'].'://'.$parts['host'].':'.$parts['port'].$parts['path'].'?st='.$output['st'].'&e='.$exp;
    
    
     ?>
    <div class="embed-responsive embed-responsive-16by9"><video class="embed-responsive-item" controls controlsList="nodownload"><source src="<?=$video_url?>">Your browser does not support the video tag.</video></div>
    
    <?php else: ?>
    
    <?php echo $video->embed; ?>
    <?php endif ?>

	</div>
				<div class="video-controls">
				<div class="video-title"><?=$video->title;?> 	<?php if ($this->authentication->is_loggedin()	): ?>
				<?php
                    $id = $this->authentication->read('identifier');
                    //echo "$id";
                    if($id == 1){
                      echo '<a href="'.site_url('video/episode/'.$detail_id.'/'.$video->video_id).'" class="btn"><i class="fa fa-edit">
                          </i></a>';
                    }
                    

                    ?>
		<?php endif ?></div>
				<div class="video-episode">
					<div class="video-episode-control video-previus <?=!empty($previous) ? 'ok' : 'no';?>" data-slug="<?=isset($previous) ? $previous : '';?>">Previous</div>
					<div class="video-episode-control video-next <?=!empty($next) ? 'ok' : 'no';?>" data-slug="<?=isset($next) ? $next : '';?>">Next</div>
				</div>
				<div class="video-error ok">Report Video</div>
			</div>
</div>
</div>
<?php endif ?>
</div>
	<div class="anime-sidebar">
		 				<div class="video-anime">
				<div class="heading heading-default"><h4>RECENT RELEASE</h4></div>

			<?php if (!empty($list_mostviews) && is_array($list_mostviews)): ?>
				<?php /**/ foreach ($list_mostviews as $key): ?>
					
				<div class="anime-col-6 anime-col-sm-6 cover-contents" data-slug="<?=$key->slug?>">
					<div class="cover-countdown"></div>
					<div class="cover-photo" data-cover="<?=$key->thumbnail?>"></div>
					<div class="cover-title" style="font-size:11px;"><?=$key->title?></div>

				</div>
				<?php endforeach /**/ ?>
			<?php endif ?>

				</div>
	</div>
</div>



	<script type="text/javascript">
	$('.video-episode-control.ok').on('click',function(e){
		var slug = $(this).data('slug');
		//console.log(slug);
		window.location = '<?=site_url("watch/v/'+slug+'")?>'
	});

	</script>
<script type="text/javascript">
	/*
$('.cover-contents').on('click',function(){
	var slug = $(this).data('slug');
	window.location = '<?php echo site_url("watch/v/'+slug+'")?>';
})*/
$(function(){
 
  $('.cover-photo').each(function(){
    $(this).attr('data-cover',function(e){

          var url = $(this).data('cover');

          if(url.length <= 0){
          	url = '<?=base_url("assets/images/default.jpg")?>';
          }
          
      $(this).css('background','url('+url+')')
      		.css('background-size','100% 100%')
      		.css('background-repeat','no-repeat');
    }); 

  });
});
</script>


<script type="text/javascript">
	var reported = false;
	var reportedtxt = false;

	var video_id = 0;
	var video_title = false;
	var source_id = 0;

			<?php if(isset($video->video_id)): ?>

			video_id = <?=$video->video_id?>;
			video_title = '<?=$video->title?>';
			source_id = <?=$video->source_id?>;
			
			<?php endif ?>


	$('.video-error.ok').on('click',function(){
		if(reported == false && video_id > 0){

			var report = reportHistory();

			$.ajax({
				data:'video_id='+video_id+'&source_id='+source_id,
				url:'../../watch/reported',
				type:'post',
				dataType:'json',
				success: function(res){
				    alert('Thank you. We\'ll try to update the link');
				    console.log('Thank you');

				    reported = true;
				}
			})

		}


	});


	function randomtext() {
	  var text = "";
	  var possible = "ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz23456789";

	  for (var i = 0; i < 6; i++)
	    text += possible.charAt(Math.floor(Math.random() * possible.length));

	  return text;
	}


	function reportHistory(){


				if(sessionStorage){

					var videos = sessionStorage.getItem("video_"+video_id);

					if(videos != null){

					
						console.log(videos);


						$('.video-error').removeClass('ok').addClass("no");



					}else{

						$('.video-error').removeClass('ok').addClass("no");

						sessionStorage.setItem("video_"+video_id, video_title);


					}


				}else{

					alert('Report failed. Maybe your browser is not supported.');

				}
	}

window.onload = function() {
  //console.log('window - onload'); // 4th


  if(video_id > 0){

				if(sessionStorage){

					var videos = sessionStorage.getItem("video_"+video_id);

					if(videos != null){

						reported == true;
						console.log(videos);


						$('.video-error').removeClass('ok').addClass("no");

						return true;


					}

				}
				reported == true;
  }else{
  	reported = false;
  }

$('video').attr('controlsList',"nodownload").bind("contextmenu",function(){
        return false;
        });
};



</script>