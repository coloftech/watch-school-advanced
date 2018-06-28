<div class="anime">
	<div class="anime-body">
				<div class="heading heading-default"><h4>LIVE CHART - INCOMING</h4></div>
		 <div class="live-chart-anime"><div class="heading-black"><h4 >Anime Series</h4></div>
		 	<?php if (!empty($livecharts) && is_array($livecharts)): ?>
	<?php foreach ($livecharts as $key): ?>
		<?php 

					 	$next = $this->auto_m->latestepisode($key->video_detail_id);
					 	//var_dump($next);	

					 		$episode_url = '';
					 		$episode_number = '';
					 	if(is_object($next)){
					 		$episode_url = $next->slug;
					 		$episode_number = $next->episode;

					 	}
					 	 ?>
					 	 <?php if (!empty($episode_number)): ?>
					 	 	<div class="anime-col-3 anime-col-md-6  anime-col-sm-6  cover-contents">
							<div class="cover-countdown"> <?php
					 	$currentD = date('Y/m/d');

						$currentT = date('H:i:s');

						$expired_onD = date('Y/m/d',strtotime($key->live_chart_date_end));

						$expired_onT = date('H:i:s',strtotime($key->live_chart_date_end));
						//if($key->status == 0){

						if($currentD == $expired_onD && $currentT > $expired_onT){

							echo '<label>Now showing</label>';
						}else{

							?>
						<?php if ($currentD > $expired_onD): ?>

							 
							<label>Completed</label>

							<?php else: ?> 
								<label class="countdown" value="  value='<?=isset($key->live_chart_date_end) ? $key->live_chart_date_end : "";?>"><?=isset($key->live_chart_date_end) ? $key->live_chart_date_end : "";?></label>
					
						<?php endif ?>
							<?php
						}
						//}else{
						//echo "<label>Season completed</label>";
						//}
					 ?></div>
					<a href="<?=site_url('watch/v/'.$episode_url)?>" class="cover-photo" data-cover="<?=$key->thumbnail?>"><!--img src="<?=$key->thumbnail?>"--></a>
					<div class="cover-title"><?=$key->title?> (<?=$episode_number?>)</div>

	</div>
					 	 <?php endif ?>
	

	<?php endforeach ?>
							<?php else: ?> <br/>
<?php endif ?>
		 </div>
		 <div class="live-chart-asian"><div class="heading-black"><h4>Asian/Drama Series</h4></div>
		 	<?php if (!empty($livecharts3) && is_array($livecharts3)): ?>
	<?php foreach ($livecharts3 as $key): ?>
		<?php 

					 	$next = $this->auto_m->latestepisode($key->video_detail_id);
					 	//var_dump($next);	

					 		$episode_url = '';
					 		$episode_number = '';
					 	if(is_object($next)){
					 		$episode_url = $next->slug;
					 		$episode_number = $next->episode;

					 	}
					 	 ?>
					 	 <?php if (!empty($episode_number)): ?>
					 	 	<div class="anime-col-3 anime-col-md-6  anime-col-sm-6  cover-contents">
							<div class="cover-countdown"> <?php
					 	$currentD = date('Y/m/d');

						$currentT = date('H:i:s');

						$expired_onD = date('Y/m/d',strtotime($key->live_chart_date_end));

						$expired_onT = date('H:i:s',strtotime($key->live_chart_date_end));
						//if($key->status == 0){

						if($currentD == $expired_onD && $currentT > $expired_onT){
							echo '<label>Now showing</label>';
						}else{
							?>
						
					

						<?php if ($currentD > $expired_onD): ?>

							 
							<label>Completed</label>
							
							<?php else: ?> 
								<label class="countdown" value="  value='<?=isset($key->live_chart_date_end) ? $key->live_chart_date_end : "";?>"><?=isset($key->live_chart_date_end) ? $key->live_chart_date_end : "";?></label>
					
						<?php endif ?>
								<?php
						}
						//}else{
						//echo "<label>Season completed</label>";
						//}
					 ?></div>
					<a href="<?=site_url('watch/v/'.$episode_url)?>" class="cover-photo" data-cover="<?=$key->thumbnail?>"><!--img src="<?=$key->thumbnail?>"--></a>
					<div class="cover-title"><?=$key->title?> (<?=$episode_number?>)</div>

	</div>
					 	 <?php endif ?>
	

	<?php endforeach ?>
							<?php else: ?> <br/>
<?php endif ?>
		 </div>

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