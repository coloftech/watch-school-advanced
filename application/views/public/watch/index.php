<div class="anime">

	<main class="anime-body">
		<header class="heading heading-default"><h4>LIVE CHART</h4></header>
		<article class="live-chart-anime">
			<header class="heading-black">
				<h4>ANIME SERIES</h4>
			</header>
			<div class="content">
				<?php if (!empty($livecharts) && is_array($livecharts)): ?>
	<?php $anime_total = 0; ?>
	<?php foreach ($livecharts as $key): ?>
		<?php 

			$expired_onD = date('Y/m/d',strtotime($key->live_chart_date_end));
			$expired_onT = date('H:i:s',strtotime($key->live_chart_date_end));

						if($currentD == $expired_onD && $currentT > $expired_onT){
							$countdown = '<label>Now showing</label>';
						}else{
							$countdown = '<label class="countdown" value="'.$key->live_chart_date_end.'">'.$key->live_chart_date_end.'</label>';
						}

						$next = $this->auto_m->latestepisode($key->video_detail_id);
					 		$episode_url = '';
					 		$episode = '';
					 	if(is_object($next)){
					 		$episode_url = $next->slug;
					 		$episode = $next->episode;

					 	}
					 	$episode = $episode+0;
		 ?>
		<a class="cover-contents anime-col-3 anime-col-md-6" href="<?=site_url("watch/c/$key->slug/$episode")?>">
		<div class="cover-countdown"><?=$countdown?></div>
		<div class="cover-photo" data-cover="<?=$key->thumbnail?>">
			
		</div>
		<div class="cover-title"><?=$key->title?></div>
		</a>
	<?php endforeach ?>
	<?php endif ?>
			</div>
		</article>
	</main>
	
	<sidebar class="anime-sidebar">
		<header class="heading heading-default">
			<h4>RECENT POST</h4>
		</header>
		<article class="content">
			
			<?php if (!empty($list_mostviews) && is_array($list_mostviews)): ?>
				<?php /**/ foreach ($list_mostviews as $key): ?>
					
				<a class="anime-col-6 anime-col-sm-6 cover-contents" href="<?=site_url('watch/v/'.$key->slug)?>" data-slug="<?=$key->slug?>">
					<div class="cover-countdown"></div>
					<div class="cover-photo" data-cover="<?=$key->thumbnail?>"></div>
					<div class="cover-title" style="font-size:11px;"><?=$key->title?></div>

				</a>
				<?php endforeach /**/ ?>
			<?php endif ?>

		</article>
	</sidebar>

	<!--  END OF BODY -->
</div>







<script type="text/javascript">
	
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