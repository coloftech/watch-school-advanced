
<div class="anime">
<?php if ($display == 'video'): ?>
	

	<main class="anime-body">
		<header class="heading heading-default item-1">
		<h4 style="vertical-align:text-top;" class="item-1"><span style="background-color:#000;color:#fff;padding:3px;display:inline-block;" class="item-4">YOU'RE WATCHING</span> <span class="item-2" style="display:inline-block;"><?php echo isset($episode_title) ? $episode_title : $title; ?></span></h4>
			<?php if (isset($details) && isset($details)): ?>
			<label>INFORMATION: <a href="<?=base_url("watch/c/".$details[0]->slug)?>"><?=$title?></a></label>	
			<?php endif ?>
			
			  <div class="fb-share-button" 
		    data-href="<?=$link?>" 
		    data-layout="button_count">
		  </div>
  		</header>
		<article class="live-chart-anime">
			
			<div class="content">
				<div class="video-content" style="display:block;">
		   		<div class="overlay-blur" style="position:absolute;background:#000;display:block;min-height:20px;width:180px;margin-top:2px;z-index:9999;border-radius:0 0 50px 0;color:#fff;padding-left:15px;font-size:10px;">WATCHSCHOOL</div>	
					<?php if ($source_id != 9): ?>
						
					<?=$embeded ?>
					<?php else: ?>
						<?php 
   						$parts = parse_url($video_link);

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
    
					<?php endif ?>

									<div class="video-controls">
				<div class="video-title"><?php echo isset($episode_title) ? $episode_title : $title; ?>
				 	<?php /* if ($this->authentication->is_loggedin()	): ?>
				<?php
				
                    $id = $this->authentication->read('identifier');
                    //echo "$id";
                    $d_id = isset($detail_id) ? $detail_id : 0;
                    if($id == 1){
                      echo '<a href="'.site_url('video/episode/'.$d_id.'/'.$video_id).'" class="btn"><i class="fa fa-edit">
                          </i></a>';
                    }
                    

                    ?>
		<?php endif */ ?></div>
				<div class="video-episode">
					<a class="video-episode-control video-previus <?=!empty($previous) ? 'ok' : 'no';?>" href="<?=isset($previous) ? $previous : '#';?>">Previous</a>
					<a class="video-episode-control video-next <?=!empty($next) ? 'ok' : 'no';?>" href="<?=isset($next) ? $next : '#';?>">Next</a>
				</div>
				<div class="video-error ok">Report Video</div>
			</div>
				</div>
			</div>
		</article>

		<article class="live-chart-anime episodes">
		<?php if (isset($episodes) && is_array($episodes)): ?>
			
			<?php foreach ($episodes as $key): ?>
				<?php $enum = $key->episode+0; ?>
				<a class="anime-list"href="<?=base_url('watch/c/'.$parent_slug.'/'.$enum)?>"><?php echo "$title - episode $enum";?></a>
			<?php endforeach ?>
		<?php endif ?>
		</article>
		<article class="video-content"  style="display:block;">
			
	   <?php /* Not yet available. */ ?>
	    <div id="disqus_thread"></div>
		
		</article>
	</main>



<?php endif ?>







<!--end of video preview -->




<!--Start of cover -->



<?php if ($display == 'cover'): ?>

	<main class="anime-body">
		<header class="heading heading-default"><h4>PLAYLIST <?=$button_edit?></h4></header>
		<article class="live-chart-anime">
			
			<div class="content">

				<?php if (isset($details) && is_array($details)): ?>
					<?php $details = $details[0]; ?>

					<div class="col-md-4">
						
						<div class="cover-photo" data-cover="<?=$details->thumbnail?>"></div>
					</div>

					<div class="col-md-8">
						<div class="form-group">
									<div class="fb-share-button" 
								    data-href="<?=$link;?>" 
								    data-layout="button_count">
								  </div>
						</div>
						<div class="form-group">
						<h3><?=$title?> 
				<?php /* if ($this->authentication->is_loggedin()	): ?>
				<?php
                    $id = $this->authentication->read('identifier');
                    //echo "$id";
                    if($id == 1){
                      echo '<a href="'.site_url('video/edit/'.$details->video_detail_id).'" class="btn"><i class="fa fa-edit">
                          </i></a>';
                    }
                    

                    ?>
				<?php endif */ ?></h3>
						</div>
						<div class="form-group">
						<div class="synopsis">
							<label>SYNOPSIS</label>
							<p style="padding-left:5px;"><?=$details->synopsis?></p>
							
						</div>
						</div>

						<div class="form-group">
						<div class="genre">
							<label>GENRE</label>
							<p style="padding-left:5px;"><?=$details->genre?></p>
							
						</div>
						</div>

						<div class="form-group">
						<div class="genre">
							<label>STATUS</label>
							<p style="padding-left:5px;"><?=$this->auto_m->video_status($details->status)?></p>
							
						</div>
						</div>


					</div>
				<?php endif ?>
			</div>
		</article>
		<article class="live-chart-anime">
			<label style="padding-left:10px;">EPISODES</label><br/>
		<?php if (isset($episodes) && is_array($episodes)): ?>
			
			<?php foreach ($episodes as $key): ?>

				<?php $enum = $key->episode+0; ?>
				<a class="anime-list item-3" href="<?php echo base_url('watch/c/'.$details->slug.'/'.$enum); ?>">EPISODE <?=$enum?></a>
			<?php endforeach ?>
		<?php endif ?>
		</article>


	<div class="video-content" style="display:block;">
	   <?php /* Not yet available. */ ?>
	    <div id="disqus_thread"></div>
		
	</div>
	</main>


<?php endif ?>

	<sidebar class="anime-sidebar">
		<header class="heading heading-default">
			<h4>RECENT POST</h4>
		</header>
		<article class="content">
			
			<?php if (!empty($list_mostviews) && is_array($list_mostviews)): ?>
				<?php /**/ foreach ($list_mostviews as $key): ?>
					
				<a class="cover-contents item-2 item-2-s item-1-xs" href="<?=site_url('watch/v/'.$key->slug)?>" data-slug="<?=$key->slug?>">
					<div class="cover-countdown"></div>
					<div class="cover-photo" data-cover="<?=$key->thumbnail?>"></div>
					<div class="cover-title" style="font-size:11px;"><?=$key->title?></div>

				</a>
				<?php endforeach /**/ ?>
			<?php endif ?>

		</article>
	</sidebar>

</div>







<script type="text/javascript">
	var reported = false;
	var reportedtxt = false;

	var video_id = 0;
	var video_title = false;
	var source_id = 0;

			<?php if(isset($video_id)): ?>

			video_id = <?=$video_id?>;
			video_title = '<?=$title?>';
			source_id = <?=$source_id?>;
			
			<?php endif ?>


	$('.video-error.ok').on('click',function(){

		/*alert('Greate');
		return false;*/
		if(reported == false && video_id > 0){

			var report = reportHistory();

			$.ajax({
				data:'video_id='+video_id+'&source_id='+source_id,
				url: base_url+'watch/reported',
				type:'post',
				dataType:'json',
				success: function(res){
				    alert('Thank you. We\'ll try to update the link');
				    console.log('Thank you');

				    reported = true;
				}
			});

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

<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/* */
var disqus_config = function () {
this.page.url = '<?php echo site_url("watch/c/$details->slug"); ?>';  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = '<?php echo $details->slug; ?>'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
/* */
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://watchschool.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>

